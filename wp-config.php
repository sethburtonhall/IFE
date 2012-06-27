<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ife_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'u]M2:,s^%{/`*$ZYGg7b^g%~A~Nb6yM+8+d|j5:G^xSZA`dijQMx7Lq8_>?#gR{y');
define('SECURE_AUTH_KEY',  '%JUc+K$|Ad^!<MhvOpN</h_AGYD,zjm>YnQ{cz(U*EPBj`s5CKls|q3-_PUL+Q3X');
define('LOGGED_IN_KEY',    'iTp)7e6ZHegl?4g|Q8&k|1Q-?!>TE 1<UIU?MLTVvW87[b;+QFw08h-/+b*}@Qg-');
define('NONCE_KEY',        'i$S*YcYDx8Dy)leMY:aO{@ewUmij?&2nOhGJ@UQ)llB!ySmt(0b-0MX).$&`_+Nt');
define('AUTH_SALT',        'RqEbd<%G(3-66SnTG@0=e.<Ux.lXLVu4!FH7mkY45OzEsd=MZW[AlfXRj!rWq>2g');
define('SECURE_AUTH_SALT', '=$D`?4BOzrOUIK0y6~rvV1Wwwx=Pk|aiq$HiZ3:3W276X-EwK+z4Lc6r$+WTm||W');
define('LOGGED_IN_SALT',   'Zt2Im#%l$IZg-j+rL>}k,6;`#5-2QcaQkb^2My%4AM`L++ewf#0wW~]uzASs_?mb');
define('NONCE_SALT',       '0v3YTU^,_D<?%yKciu5FLr(K`6<&X2BD=!a+|4U_PFFO-;xq@Yf1JmB`NS9-/?yn');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
