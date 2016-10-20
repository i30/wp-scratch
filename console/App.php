<?php namespace Console;
/**
 * App
 */
final class App extends \WP_CLi_Command
{
  /**
   * Get current app
   *
   * ## EXAMPLE
   *
   * $ wp app -c
   *
   * @subcommand  -c
   */
  function _current()
  {
    $config = file_get_contents(APP_ROOT . 'wp-cli.yml');

    preg_match('/^url:.+/m', $config, $matches);

    echo str_replace('url: ', '', $matches[0]) . "\n";
  }

  /**
   * List all available apps
   *
   * ## EXAMPLE
   *
   *  $ wp app -l
   *
   * @subcommand  -l
   */
  function _list()
  {
    $files = new \DirectoryIterator(APP_ROOT . 'config');

    foreach ($files as $file) {
      $name = $file->getFilename();
      if ( $file->isDot() || $file->isDir() ) continue;
      echo str_replace('.php', '', $name) . "\n";
    }
  }

	/**
	 * Switch app
	 *
	 * ## OPTIONS
	 *
	 * <site>
	 *  : Host name of the site which you want to switch to.
	 *
   * ## EXAMPLE
   *
	 *  $ wp app -s example.com
   *
   * @subcommand  -s
	 */
  function _switch($args)
  {
    $site  = $args[0];
    $sites = [];
    $files = new \DirectoryIterator(APP_ROOT . 'config');

    foreach ($files as $file) {
      $name = $file->getFilename();
      if ( $file->isDot() || $file->isDir() ) continue;
      $sites[] = str_replace('.php', '', $name);
    }

    if ( !in_array($site, $sites) ) \WP_CLI::error('Invalid app! Nothing to switch.');

    $config = file_get_contents(APP_ROOT . 'wp-cli.yml');
    $config = preg_replace('/^url:.+/m', 'url: ' . $site, $config);

    if ( file_put_contents(APP_ROOT . 'wp-cli.yml', $config) ) {
      \WP_CLI::success('Switched to ' . $site);
    } else {
      \WP_CLI::error('Unable to switch. Please make sure wp-cli.yml is editable!');
    }
  }
}
