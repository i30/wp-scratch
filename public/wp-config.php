<?php
/**
 * Define base application path
 *
 * Since there's no pre-defined base application path, this constant might be handy.
 *
 * @var  string
 */
define('APP_ROOT', dirname(__DIR__) . '/');

/**
 * Validate any requests before booting up application
 *
 * Check if WordPress is being loaded correctly and if the requested host is a valid hostname.
 */
if ( !defined('ABSPATH') || !file_exists(APP_ROOT . 'config/' . $_SERVER['SERVER_NAME'] . '.php') ) {
  header('Bad Request', true, 400);
  exit('Unable to connect to server!');
}

/**
 * Load Composer autoloader
 *
 * This guy manages dependencies like a boss. Keep calm and enjoy the freedom!
 *
 * @var  resource
 */
require APP_ROOT . 'vendor/autoload.php';

/**
 * Load configurations
 *
 * Prepare configurations which will be used for setting up WordPress application.
 *
 * @var  resource
 */
require APP_ROOT . 'config/' . $_SERVER['SERVER_NAME'] . '.php';

/**
 * Add extra commands to WP-CLI
 *
 * Here come extra commands which are handy for you.
 */
if ( defined('WP_CLI') && WP_CLI ) {
  \WP_CLI::add_command('app', 'Console\\App');
}

/**
 * WordPress URL
 *
 * @see  https://codex.wordpress.org/Editing_wp-config.php#WordPress_address_.28URL.29
 *
 * @var  string
 */
define('WP_SITEURL', WP_HOME . '/wordpress');

/**
 * Define content URL
 *
 * @see  https://codex.wordpress.org/Editing_wp-config.php#Moving_wp-content_folder
 *
 * @var  string
 */
define('WP_CONTENT_URL', WP_HOME);

/**
 * Define content DIR
 *
 * @see  https://codex.wordpress.org/Editing_wp-config.php#Moving_wp-content_folder
 *
 * @var  string
 */
define('WP_CONTENT_DIR', APP_ROOT . 'public');

/**
 * Disable all automatic updates
 *
 * It's recommended to disable automatic updates, even in development environment.
 *
 * @see  https://codex.wordpress.org/Editing_wp-config.php#Disable_WordPress_Auto_Updates
 *
 * @var  bool
 */
define('AUTOMATIC_UPDATER_DISABLED', true);

/**
 * Set up WordPress environment
 *
 * Now, let the fun begin!
 *
 * @var  resource
 */
require ABSPATH . 'wp-settings.php';
