# WordPress Scratch

[![Build Status](https://travis-ci.org/i30/wp-scratch.svg?branch=master)](https://travis-ci.org/i30/wp-scratch)
[![Latest Stable Version](https://poser.pugx.org/i30/wp-scratch/v/stable)](https://packagist.org/packages/i30/wp-scratch)
[![Latest Unstable Version](https://poser.pugx.org/i30/wp-scratch/v/unstable)](https://packagist.org/packages/i30/wp-scratch)
[![License](https://poser.pugx.org/i30/wp-scratch/license)](https://packagist.org/packages/i30/wp-scratch)

A scalable WordPress project from scratch. Easy to deploy!

While working with WordPress, i feel unease to config virtual hosts, set up brand new WordPress installations, copy essential plugins... for each new project again and again.

With this, you can proxy static contents, databases, back-end and front-end into smaller servers. All of them use a same WordPress installation, it's really helpful in term of performance and maintainability. Moving your servers around or setting up load balancing becomes easier.

## Requirements

- [PHP][1] >= 5.6
- [MySQL][2] >= 5.6
- [WP-CLI][3] >= 0.24
- [Composer][4] >= 1.0

## Installation

1. Prepare your server block for [Nginx][5] or virtual host for [Apache][6]. You do not need to create MySQL database, it will be created while installing WordPress.

2. Run these two commands on your command line respectively:

  ```bash
  $ composer create-project i30/wp-scratch /path/to/project/directory
  $ cd /path/to/project/directory && ./install
  ```

3. Follow instructions to finish the installation. It's easy!

From now on, to add a new WordPress site, you just need to fire the `install` script again.

## Important Notes

- Since `$_SERVER['SERVER_NAME']` is used to determine which site will respond to requests, please make sure `SERVER_NAME` is configured properly. For Apache 2, remember to add `UseCanonicalName = On` in every virtual host.

- While working with multiple sites (not WordPress multisite), you might need to separate `UPLOADS` directory. Use this script as a must-use plugin:

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
    $basedir   = APP_ROOT . 'app/uploads';
    $customurl = WP_HOME . '/' . DB_NAME . '-uploads';
    $customdir = APP_ROOT . 'app/' . DB_NAME . '-uploads';

    $args['url']     = str_replace($baseurl, $customurl, $args['url']);
    $args['path']    = str_replace($basedir, $customdir, $args['path']);
    $args['baseurl'] = str_replace($baseurl, $customurl, $args['baseurl']);
    $args['basedir'] = str_replace($basedir, $customdir, $args['basedir']);

    return $args;
  }, PHP_INT_MAX);
  ```

## Contributing

Contribution is always welcome!


[1]: http://php.net
[2]: http://dev.mysql.com/downloads/mysql/
[3]: http://wp-cli.org
[4]: https://getcomposer.org
[5]: https://www.nginx.com
[6]: https://www.apache.org
