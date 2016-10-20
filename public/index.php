<?php
/**
 * Tell WordPress to load themes
 *
 * @var  bool
 */
define('WP_USE_THEMES', true);

/**
 * Start WordPress application
 *
 * @var  resource
 */
require __DIR__ . '/wordpress/wp-blog-header.php';
