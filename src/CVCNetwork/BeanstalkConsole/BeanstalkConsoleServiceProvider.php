<?php namespace CVCNetwork\BeanstalkConsole;

use Illuminate\Support\ServiceProvider;

class BeanstalkConsoleServiceProvider extends ServiceProvider {

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = false;

  /**
   * Bootstrap the application events.
   *
   * @return void
   */
  public function boot() {
    $this->package('cvcnetwork/beanstalkconsole');

    $path = \Config::get('beanstalkconsole.consolePath', 'beanstalkconsole');

    \View::addNamespace('CVCNetwork\BeanstalkConsole', __DIR__ . '/views');

    //Setup routes
    \Route::get($path, 'CVCNetwork\BeanstalkConsole\Controllers\BeanstalkConsoleController@showConsole');
    \Route::post($path, 'CVCNetwork\BeanstalkConsole\Controllers\BeanstalkConsoleController@showConsole');
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register() {
  }

}