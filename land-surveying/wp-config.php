<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

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
define( 'DB_NAME', 'calvadas_blog' );

/** MySQL database username */
define( 'DB_USER', 'calvadas_admin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'hFP&i#BHW,Wj' );

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
define( 'AUTH_KEY',         '/MQ^p1*90?<w=5M^8MYRI(vSkmBY*yMP<0>6fhSk^JK_izkY{nAr;] t~sg>Om+,' );
define( 'SECURE_AUTH_KEY',  'T1Gds7fXa3AsUftOn!_@j6$0W=7=GLA[hP@w)B;*Qs+V9+g6=VXPwIv.(D}]^M4l' );
define( 'LOGGED_IN_KEY',    '0s6u $FQ0/Y@mii^jib&wQGhr-QNhylRaV9jheM2GV_l1}]*&X1e5tlH3n*V.]Nm' );
define( 'NONCE_KEY',        '.DRol=>JW>>ugJSKW}@!E#?lau/0zj]0*$%<`}2r<V9m)zu&QeQyO~}ID`Sg~HNo' );
define( 'AUTH_SALT',        ' Cq3JWAU2>YEN[hYAQlyB-x*L.%/HJ^GvhK[g,<VfdciT+!eqX[79u.YW0bhhL5j' );
define( 'SECURE_AUTH_SALT', 'C,t 6M3Mx1%$gzs<r6g3+^ptRF`V@r2Y~S:MSkc0MD@vW,iEa_6B]c,3gFWJ3p3U' );
define( 'LOGGED_IN_SALT',   'Ui<yzf{l&90,>rSl2yJbpH3_S!MMq+V+7ubx,#@%-YcF2>;1Tu9q::jOR),$kno@' );
define( 'NONCE_SALT',       'wT=(;t~h!u[P6jp#*qR/1/$/R)7;nV;ZYW!((8.D+1?6L_`NlExZ39Hg*HluUXD5' );

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
