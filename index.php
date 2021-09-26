<?php

declare(strict_types=1);

//namespace App;

// autoloading
spl_autoload_register(function (string $classNamespace) {
  $path = "src/" . $classNamespace . '.php';
  $path = str_replace(
    ["\\", "App/"],
    ["/", ""],
    $path
  );
  //var_dump($path);
  require_once($path);
});

require_once("src/Utils/debug.php");
$configuration = require_once("config/config.php");


use App\Controller\AbstractController;
use App\Controller\HomeController;
use App\Controller\WasteController;
use App\Controller\ContactController;
use App\Request;
use App\Exception\AppException;
use App\Exception\ConfigurationException;


$request = new Request($_GET, $_POST, $_SERVER); // tworzę nowy obiekt i przekazuje zmienne super globalne

try {
  //$controller = new Controller($request);
  //$controller->run();
  AbstractController::initConfiguration($configuration);
  // dump($request);

  //dump($_GET);
  $module = $request->getParam("module");

  switch ($module) {
    case 'contacts':
      (new ContactController($request))->run();
      break;
    case 'waste':
      (new WasteController($request))->run();
      break;
    default:
      (new HomeController($request))->run();

      break;
  }

  //(new NoteController($request))->run();


} catch (ConfigurationException $e) {
  //mail('xxx@xxx.com', 'Errro', $e->getMessage());
  echo '<h1>Wystąpił błąd w aplikacji</h1>';
  echo 'Problem z applikacją, proszę spróbować za chwilę.';
} catch (AppException $e) {
  echo '<h1>Wystąpił błąd w aplikacji</h1>';
  echo '<h3>' . $e->getMessage() . '</h3>';
} catch (\Throwable $e) {
  echo '<h1>Wystąpił błąd w aplikacji</h1>';
  dump($e);
}
