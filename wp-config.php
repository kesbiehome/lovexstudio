<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'lovexstudio' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '0D1wBjhovr2uhU3l1jlHmtny8STvTcbDO3xfAFtpSeQH2TP3xOEhWLlTUYZ9BFci' );
define( 'SECURE_AUTH_KEY',  'cjRljTYKw7oxBaAKoPPTk6P0FAxMTOlNJhnmy2UAqC3eMZY1uVza6lhC9goV3k9F' );
define( 'LOGGED_IN_KEY',    'T3BkfIyzUU4rFMlEntFDwcctdFO8s1vfGGLiM72iXJZUxTAwdQHmizW6pmlffjru' );
define( 'NONCE_KEY',        'LJoJzpcFBE6UmIuj4yPCCz8WLzMUKoF48ZnjnOhKuY42OotLySJoYZKG042iAE55' );
define( 'AUTH_SALT',        '7SjcSOuU7eZkBV0kvJi9T3SeOwrpPQQJLA35TCs14AWHjmvOXDtykQSAzeZcdOu7' );
define( 'SECURE_AUTH_SALT', 'iRwjbZy7lxWL14DdHSZOr0Ff2Md1EgGNkLGfrJEFCpdwKv0fF0Zl8SzJMfR0pnYY' );
define( 'LOGGED_IN_SALT',   'FQMPS3GyULfL2uwQAt1HRu1peRE5bUxdnQywmt23cnCLFf4p1KoYo6oZrRsQIgMC' );
define( 'NONCE_SALT',       'V3BkKdqTXoxsB3XX7rvWoiPx8LXmqe5VYw9fmwMNQlB1gouVB0XVbsubZAoFfppR' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
