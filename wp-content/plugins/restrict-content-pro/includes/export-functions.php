<?php

function rcp_export_members() {
	if( isset( $_POST['rcp-action'] ) && $_POST['rcp-action'] == 'export-members' ) {

		global $wpdb;
		if( $_POST['rcp-subscription'] == 'all' ) {
			$sql = "SELECT ID, user_login, display_name, user_email, user_url FROM $wpdb->users
				LEFT JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id
				WHERE meta_key = 'rcp_status'
				AND meta_value = '{$_POST['rcp-status']}';";
			$filename = 'restrict-content-pro-' . $_POST['rcp-status'] . '-members.csv';	
			
		} else {
			$sql = "SELECT ID, user_login, display_name, user_email, user_url FROM $wpdb->users
				LEFT JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id
				WHERE meta_key = 'rcp_status'
				AND meta_value = '{$_POST['rcp-status']}'
				AND ID IN (
					SELECT ID FROM $wpdb->users
					LEFT JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id
					WHERE meta_key = 'rcp_subscription_level'
					AND meta_value = '{$_POST['rcp-subscription']}'
				)
				;";
			$filename = 'restrict-content-pro-' . str_replace( ' ', '_', rcp_get_subscription_name( $_POST['rcp-subscription'] ) ) . '-' . $_POST['rcp-status'] . '-members.csv';
		}
		rcp_query_to_csv( $sql, $filename );
	}
}
add_action( 'admin_init', 'rcp_export_members' );

function rcp_export_payments() {
	if( isset( $_POST['rcp-action'] ) && $_POST['rcp-action'] == 'export-payments' ) {
		global $wpdb, $rcp_payments_db_name;
		
		$sql = "SELECT * FROM  " . $rcp_payments_db_name . ";";
		$filename = 'restrict-content-pro-payments.csv';
		rcp_query_to_csv( $sql, $filename );
	}
}
add_action( 'admin_init', 'rcp_export_payments' );

function rcp_query_to_csv( $sql, $filename ) {
      
	$csv_terminated = "\n"; 
	$csv_separator = ","; 
	$csv_enclosed = '"'; 
	$csv_escaped = "\\"; 
	$sql_query = $sql; 

	// Gets the data from the database 
	$result = mysql_query( $sql_query ); 
	
	$fields_cnt = mysql_num_fields( $result ); 

	$schema_insert = ''; 

	for ( $i = 0; $i < $fields_cnt; $i++ )  { 
		$l = $csv_enclosed . str_replace( $csv_enclosed, $csv_escaped . $csv_enclosed, stripslashes( mysql_field_name( $result, $i ) ) ) . $csv_enclosed; 
		$schema_insert .= $l; 
		$schema_insert .= $csv_separator; 
	} // end for 

	$out = trim( substr( $schema_insert, 0, -1 ) ); 
	$out .= $csv_terminated; 

	// Format the data 
	while ( $row = mysql_fetch_array( $result ) ) { 
		$schema_insert = ''; 
		for ( $j = 0; $j < $fields_cnt; $j++ ) { 
			if ( $row[$j] == '0' || $row[$j] != '' ) { 
				if ($csv_enclosed == '') { 
					$schema_insert .= $row[ $j ]; 
				} else { 
					$schema_insert .= $csv_enclosed . 
					str_replace( $csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j] ) . $csv_enclosed; 
				} 
			} else { 
				$schema_insert .= ''; 
			} 

			if ( $j < $fields_cnt - 1 ) { 
				$schema_insert .= $csv_separator; 
			} 
		} // end for 

		$out .= $schema_insert; 
		$out .= $csv_terminated; 
	} // end while 

	header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" ); 
	header( "Content-Length: " . strlen( $out ) ); 
	// Output to browser with appropriate mime type, you choose  
	header( "Content-type: text/x-csv"); 
	//header("Content-type: text/csv"); 
	//header("Content-type: application/csv"); 
	header( "Content-Disposition: attachment; filename=$filename" ); 
	echo $out; 
	exit; 
}