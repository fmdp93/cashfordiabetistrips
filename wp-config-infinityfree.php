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
define( 'DB_NAME', 'if0_35298649_matrixsystem');

/** MySQL database username */
define( 'DB_USER', 'if0_35298649');

/** MySQL database password */
define( 'DB_PASSWORD', 'REnRz2NDG2b');

/** MySQL hostname */
define( 'DB_HOST', 'sql306.infinityfree.com');

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '4709409a96d9f25e3585c87d04559fb87f2c687d');
define( 'SECURE_AUTH_KEY',  'ee26e59554c3e591406fffc56d46aa45485effd3');
define( 'LOGGED_IN_KEY',    '4aabca804e47a8cb9910779d60daeadddce7094d');
define( 'NONCE_KEY',        'ea186f3fff85766d1ae336e804f9cc3b05ae1298');
define( 'AUTH_SALT',        '35a3c8bf8ce984fe0a1ce355f1b49e24cebba23d');
define( 'SECURE_AUTH_SALT', 'd0bfd134dd0d071190087261b359c7ba88cd46ab');
define( 'LOGGED_IN_SALT',   '9cef7e309b4992e1cc5f9044811d7d553ac062de');
define( 'NONCE_SALT',       '3f37c01bf808e40f9ba7f0a48ad20348f7176181');

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

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
