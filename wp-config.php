<?php
define( 'WP_CACHE', true );
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
define('WP_MEMORY_LIMIT', '64M');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'o(@3@G-oN/R<Ai(8Wo60,j.)ooCt%eC.}29;`+#3y@0JA-JkW LFhEJU1L,$.bTq' );
define( 'SECURE_AUTH_KEY',  'UAo?MMWDaca6D]J/CWuKpGA59gA/0_@m?mk#|%5`FDCUZ1#w7/V|xQ{3B_l8x;B;' );
define( 'LOGGED_IN_KEY',    '$XKTAz )+DLm[z3`S4sa;FiN]n<uer?oc*Jmg,MeF,ytq@ci(|{vw~{ZaLzESh|<' );
define( 'NONCE_KEY',        '{MRbxMUCb9e;ahev/[r$)@0EGyrw(d|N4xFvuR9v)LUg?|8*<DK%5(LTUKZ]4q4F' );
define( 'AUTH_SALT',        'SiA4wNBedWlylcX c8PWx`9x0Go>=Zuy{%];_B/B6F[h-2pB|F7D%$%jA gZYD&A' );
define( 'SECURE_AUTH_SALT', '1bpAqU2lXy*A3#[9Z6ooP)FF#?t-]4#(0D<hA0ZHDktLC34;}+qq1lX%1IT)h:N:' );
define( 'LOGGED_IN_SALT',   ';rPEJ3tVo^IvTHbq]vi9R|6seHiV.FDX09TPbldEcD-9bg5`sd|@ 0dKe*dHM49u' );
define( 'NONCE_SALT',       '3Yi#L3~qx>.|o|<f4z2G+<$P&=|yN+/1yH6Yl~)HV2a?h_I3ixqaMG%bd{d`Od7n' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

define('FS_METHOD','direct');

