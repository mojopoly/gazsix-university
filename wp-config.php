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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/aSlt5uAFwRJNS9jaE3nYHGpQrJw9UouANQXA4PmBtdmB+4TesV9jVynItTbzEVgIZGME6cqCN3zqOhGuRXpLA==');
define('SECURE_AUTH_KEY',  '73Co55FhDHiIDTft0608EJdiq5SlQRrXdaygDBjKGdxqa0UP2/7U3ZcEWwAt7dYXA1ISxl/joNN6NbPTkJGrzA==');
define('LOGGED_IN_KEY',    'JFZ1T1ObIh+DUw2SN+BLmjiFkbHQTU6vR2BaWKsvwgx7VBrfYYPUTddrtXGdC1EQNydcCsRS8f0xGwqStFEh1w==');
define('NONCE_KEY',        'NFNHah6OSDZA3lCSMW4rT98eHmwDyfW5JdlaWxw7ti8d3sWA84G0Cs6apxftt71hJWcWj9wospZa47ZEGjxKfw==');
define('AUTH_SALT',        '89h1V1ROe0YWMXTHu6CkNpoUhNz+WNRYJqTRxj16fpH2ZAGnwQU49gjyYb+doTVshNOjWfjhQZdcVsS/dhsDAg==');
define('SECURE_AUTH_SALT', 'Bo2R4L6MgK280kogdDZXoo8J/vSKLyT2XM6ZLZQp0D7SIpjMaYWODtLe1nu9scCKLOnBgpkAkGcDGT7O/ii9qA==');
define('LOGGED_IN_SALT',   'Lf5w6N1g2Ke8aV1S8wbKFcVqmqZUGbPC8uteAh+8gYCkSmKDCTTMlWytr4tMoactAtKn9qvyrZU9u2qUYp+yiQ==');
define('NONCE_SALT',       'Vk9HDLIOUNH4AX+/Gr+Pj69Dagf0AHC/i8qPS3u3Iqei08Bej07q2vbfi4zwHouzZsy1RMxQ+d1zHxz4vPoJ6g==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
