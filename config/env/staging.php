<?php
/**
 * Debugging
 *
 * @see  https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * Error logging
 *
 * @see  https://codex.wordpress.org/Editing_wp-config.php#Configure_Error_Logging
 */
// @ini_set('error_reporting', E_ALL);
// @ini_set('log_errors', 1);
// @ini_set('display_errors', '0');
// @ini_set('error_log', APP_ROOT . 'storage/' . $_SERVER['SERVER_NAME'] . '/logs/error.log');

/**
 * Disable theme and plugin editor
 *
 * @see  https://codex.wordpress.org/Editing_wp-config.php#Disable_the_Plugin_and_Theme_Editor
 */
define('DISALLOW_FILE_EDIT', true);

/**
 * Disable theme|plugin update and installation
 *
 * @see  https://codex.wordpress.org/Editing_wp-config.php#Disable_Plugin_and_Theme_Update_and_Installation
 */
define('DISALLOW_FILE_MODS', true);
