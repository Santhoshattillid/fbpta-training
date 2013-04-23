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
//define('DB_NAME', 'nema_FBPTA');
define('DB_NAME', 'nema_FBPTA');

/** MySQL database username */
//define('DB_USER', 'nema_12');
define('DB_USER', 'root');

/** MySQL database password */
//define('DB_PASSWORD', 'Zudzsk5g');
define('DB_PASSWORD', '');

/** MySQL hostname */
//define('DB_HOST', 'db144d.pair.com');
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
define('AUTH_KEY', 'MSC7CAGy8wVFiJ2atYsuwrrxzy4BAagL7wKjYcnPcpVcJn6nFp9dDSgwky5NFjTr');
define('SECURE_AUTH_KEY', 'ZE7YXcisAZGkzF4muX7cx5dMuftVDkZXanAZJ5Kc64MqPTpSKKgNPPurhJWq6zbR');
define('LOGGED_IN_KEY', 'jv8qe5Wgxu7SP4eEjMYUiVBkH6FY6ux4GcQ9ZCa4sbJ4Rj9whq7vePfSwPmVMSAP');
define('NONCE_KEY', 'bBpSN7tpQYdyFL7jfxKnqjcdEeLg7BgJ8t9vEWVzkLHKCGEEyuYTpyNQtEJrujEn');
define('AUTH_SALT', 'MMABU8BTtLDeWkrkk29VxLCCZFuLFFZwjJzCKYT5kY8euhGCmF9KWDJ9ehqJDwmP');
define('SECURE_AUTH_SALT', 'vfSXwuMTkXXSBZiiUqeaxjUxvMfKzxCYZ6pNEJp2stnzykKjrz2sLMECC2ELH2ZB');
define('LOGGED_IN_SALT', 'kBNWuXjYmBicZYwA97KLEjaxk2iHFW5gqPWeqNuajWyr4XB2mbNkn3VCt25graeu');
define('NONCE_SALT', 'Liq58XF7LShJn5gSVUJN6svTm39Nz2zMip2uedtRG7xGUi5qnDcDwnKF5KZDAZpL');

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

/** enable wp-super-cache */
//define('WP_CACHE', true); //Added by WP-Cache Manager

/** enable direct filesystem access for theme/plugin installs */
define('FS_METHOD', 'direct');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
