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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'xploratory-new2_db' );

/** MySQL database username */
define( 'DB_USER', 'xploratory-new2_user' );

/** MySQL database password */
define( 'DB_PASSWORD', '9R7m6K2y' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('WP_HOME', 'http://'.$_SERVER['HTTP_HOST']);
define('WP_SITEURL', 'http://'.$_SERVER['HTTP_HOST']);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'P.*f nr-,+.3T(_Q-5y46iOsOuZ8gf<WA TXN2@-<7`4 APfT0Wl5n%zZNvbU$fR' );
define( 'SECURE_AUTH_KEY',  '5v_#N7AJ[A+eP79.,r@CJ&2MbC|3MQx[msz.w{L!T.931a<}UI}zywSnaz+Ll/eO' );
define( 'LOGGED_IN_KEY',    'u:W0iBHu#rnUK$.La,<+mwu{&8/ASwfM&x89_g@eO<bZ}HR7=XC%K+D11?__5Q{V' );
define( 'NONCE_KEY',        '&1Bflzhw8HZYQN6(K~l?ody.Ejl>#3(Ll1YU3c*8KpKPwH@,,StvaI$$diOVzhDM' );
define( 'AUTH_SALT',        'bQ1T(*46+2QH>mmJ94!Ae@}iA~C?bj>M]Z7r2Cbo|W1fzB*kOT_,;Sg|#2:a?+P_' );
define( 'SECURE_AUTH_SALT', 'heX[`@E_0)<XRf1Il+ys:Oyq#22eqtu9m{6zf-U3Ob O^zge+R2`^[eBtS5oD ($' );
define( 'LOGGED_IN_SALT',   '@Nh#da$c [6-78iz?A`%?Smk},`.H@nn<0_FCJW+rm{<o[idr[}#ug?h<4fJt|@g' );
define( 'NONCE_SALT',       ']6f2^@?>a;SZ,S;$Y^LMYgb:^q%xsqGIX?$$;XDLV4oQpfu)P0s5s,Rv_tKesF$[' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
