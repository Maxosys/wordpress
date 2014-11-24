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
define('DB_NAME', 'wordpress91');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '$r,2)Upb_gCm.bhW1=VQE@!{|l?bXy{T4n$$MK/7l-7nxkS`awH+o-Gc& Mr}+j2');
define('SECURE_AUTH_KEY',  '1%RvK[Oo<m&(rBxd4N]{3 olvX80eTQ>i*|5(WUG!P<,NR,H924T^><Fj#ak6{^Y');
define('LOGGED_IN_KEY',    '*<V9&S2fj g!t)l>Sb8]Y_vsbtlfAEqe`9`|d+noPZ?}yUk%.@<sX5[3z+^/|}VB');
define('NONCE_KEY',        'X&+A-<[R2Sf!N6dvsCN8Ga/$t1{8 M}4.-Zo259yNKc|qw-jTyvFSuV2o6jf:re7');
define('AUTH_SALT',        'c#m `z/4>DG!EpN)u[@g@#bt`NK:So]l<Zq^%U>=70[V#[n$a*9fylT~u>^r7Yv_');
define('SECURE_AUTH_SALT', 'RLUm6$p{_Gcp5@K-#7_Y/wx4!w^dW=Pp9?Ky|KI4HvAG^:u)SCwqKr4i8ZwO G+#');
define('LOGGED_IN_SALT',   '|.bns6Ew{#]SO~pwc[jk<u(WGsWOPg;4Vva,@sd@WGkOD`08>BETc<ijqoe!-/}Y');
define('NONCE_SALT',       '5}`|2.ywN$G6j$[|S%jh6PC}.cc}Q)=t?T7I[yt06bk0eH$9F]AlhML,a5L%ZDML');

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
