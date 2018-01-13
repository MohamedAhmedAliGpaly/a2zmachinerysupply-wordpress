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
define('DB_NAME', 'a2zmachinerysupply');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'gpHj6KTeK~|<4G`y4+,=e4)F>=;X9-~sigUr$Af_k(hGqnQU<1,)pQi.M&7>,^w5');
define('SECURE_AUTH_KEY',  '5$XSyxxnKi!IXnP(GZWv oYx{]?]EdaaY%aWuj8u9R,%i-5V+Te[QvaG)QHQw1Xf');
define('LOGGED_IN_KEY',    'hM>RTS,Utp^Z{;7Rw55(x@&LfMW>uMV;&@F<?^eC<Ap6M9q^@Pv$e}Z]Q?U|#[jl');
define('NONCE_KEY',        ',(e^4zF}Pcx@htRY_HE5(G 76FJHh0iAp{JF(~3F:vV=j)7,[KTUGI#,$*JdBII,');
define('AUTH_SALT',        'ME)QWHTlZ6*z]IY=y*LZ!ZJN/*m8U@GP6b[.RHmrHA0DR)A,39DEP?A:xt$kBBNM');
define('SECURE_AUTH_SALT', 'HM15G6rgen9]L(`th}:>tfJWN*ya4.2Uq%?H+{eNhfY.~P;r1$5l61y?:}Q+JYY[');
define('LOGGED_IN_SALT',   'DIg:CQ%ubM?}#+>+z!n[69||?{LF}?ol+1g|c|sB-<8pdJV/V96ywL=84vQ5 :by');
define('NONCE_SALT',       'BI|~TBJZ*[~HTO3>SWH%~zWnlkI3;:`L00cv&pC/p/2ug*djD-U%%8yy_qKJP.cA');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
