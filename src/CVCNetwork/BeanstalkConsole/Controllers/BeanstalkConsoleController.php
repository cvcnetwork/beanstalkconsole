<?php namespace CVCNetwork\BeanstalkConsole\Controllers;

use Pheanstalk_Pheanstalk as Pheanstalk;

class BeanstalkConsoleController extends \BaseController {

  /*
  |--------------------------------------------------------------------------
  | Default Home Controller
  |--------------------------------------------------------------------------
  |
  | You may wish to use controllers instead of, or in addition to, Closure
  | based routes. That's great! Here is an example controller method to
  | get you started. To route to this controller, just add the route:
  |
  |	Route::get('/', 'HomeController@showWelcome');
  |
  */

  public function showConsole() {
    if (!\Auth::check()) {
      return;
    }

    $console = new \CVCNetwork\BeanstalkConsole\BeanstalkConsole();
    $errors = $console->getErrors();
    $tplVars = $console->getTplVars();
    extract($tplVars);

    if (!isset($tubes)) {
      $tubes = array();
      $tubesStats = array();
    }

    if (empty($peek)) {
      $peek = array();
    }

    $path = \Config::get('beanstalkconsole.consolePath', 'beanstalk');

    return \View::make('CVCNetwork\BeanstalkConsole::index',
      array(
        'server' => $server,
        'action' => $action,
        'count' => $count,
        'tube' => $tube,
        'config' => $config,
        'tubes' => $tubes,
        'tubesStats' => $tubesStats,
        'console' => $console,
        'errors' => $errors,
        'peek' => $peek,
        'path' => $path,
        'assetsPath' => \Config::get('beanstalkconsole.assetsPath', '/'), //Assume the package is published under public
      ));

  }

}