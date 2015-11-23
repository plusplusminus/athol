<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'atholmoult');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'AEGvtT?Q)[|^cpFv|%R^3DDSp|$w8~c:zs.}(b,R@zQr[CL^`&)r8U@O_MMIe|T{');
define('SECURE_AUTH_KEY',  '-tFxny>5kw}rBe| J4|D55vuRbB4m-r?F:9^$-3bV-UZuUPn+|p{gk-w-K5!>9`Z');
define('LOGGED_IN_KEY',    'fL_A5n,}>`/zms`j,f5F1uJ;9c4o`#m,qHR/++<8OsG8Gzka^8G^,oOS~b&DsC(2');
define('NONCE_KEY',        'Sx9=hqR:-{V9a#wR,3swe|Gsho/?Rb4J1A!y;swsL,n/>5/6 ].#xlEW!Aa{Rkr^');
define('AUTH_SALT',        'l}iYDy7>:B`xT&z+l~|~rHff7LQS]Xdqk! t~?CVf%,TC+su}282u/],w4yS+</Z');
define('SECURE_AUTH_SALT', 'Kh:m@]k!.BVTe6g:-O^WwL%/v` }Z6J.|OHhYyrtU?Z+RaT)oHV%L9fJXQ|4&nZX');
define('LOGGED_IN_SALT',   '+wkv$q[a=4|DmRN9P~gAh)]s1DfM@2MaO#!9.K,>n`xME`vp_Z$3&+=^`f2/Vr-!');
define('NONCE_SALT',       '2RJ+q&10:+N&_<S0C`HOX+rh2X0P{$9/wS>l3a?wsXlwtUbaO*OxS_%`e+3mUjHy');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
