# WordPress Scratch

[![Latest Stable Version](https://poser.pugx.org/i30/wp-scratch/v/stable)](https://packagist.org/packages/i30/wp-scratch)
[![Latest Unstable Version](https://poser.pugx.org/i30/wp-scratch/v/unstable)](https://packagist.org/packages/i30/wp-scratch)
[![License](https://poser.pugx.org/i30/wp-scratch/license)](https://packagist.org/packages/i30/wp-scratch)

A  WordPress project from scratch.

## Requirements

- [PHP][1] >= 5.5
- [MySQL][2] >= 5.5
- [WP-CLI][3] >= 0.24
- [Composer][4] >= 1.0

## Installation

1. Prepare your server server block for [Nginx][5] or virtual host for [Apache][6]. You do not need to create MySQL database, it will be created while installing WordPress.

2. Run these two commands on your command line respectively:

  ```bash
  $ composer create-project i30/wp-scratch /path/to/project/directory
  $ cd /path/to/project/directory && ./install
  ```

3. Follow instructions to finish the installation. It's easy!

## Important Notes

- Since `$_SERVER['SERVER_NAME']` is used to determine which site will respond to requests, please make sure `SERVER_NAME` is configured properly. For Apache 2, remember to add `UseCanonicalName = On` in every virtual host.

- While working with multiple sites (not WordPress multisite), you might need to separate `UPLOADS` directory. You can use this script as a must-use plugin:

  ```php
  /**
   * Plugin Name: Custom Uploads Directory
   * Version:     1.0.0
   * Description: Create custom uploads directory base on the DB_NAME constant.
   * Author:      i30
   * AUthor URI:  https://i30.github.io
   * License:     GPL v3+
   */
  add_filter('upload_dir', function($args)
  {
    $baseurl   = WP_HOME . '/uploads';
    $basedir   = APP_ROOT . 'public/uploads';
    $customurl = WP_HOME . '/' . DB_NAME . '_uploads';
    $customdir = APP_ROOT . 'public/' . DB_NAME . '_uploads';

    $args['url']     = str_replace($baseurl, $customurl, $args['url']);
    $args['path']    = str_replace($basedir, $customdir, $args['path']);
    $args['baseurl'] = str_replace($baseurl, $customurl, $args['baseurl']);
    $args['basedir'] = str_replace($basedir, $customdir, $args['basedir']);

    return $args;
  }, PHP_INT_MAX);
  ```

## Contributing

Contribution is always welcome!


[1]: https://secure.php.net
[2]: http://dev.mysql.com/downloads/mysql/
[3]: http://wp-cli.org
[4]: https://getcomposer.org
[5]: https://www.nginx.com
[6]: https://www.apache.org
