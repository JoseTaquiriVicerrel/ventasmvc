<?php

namespace Libs;

use App\Controllers\HomeController;

class Core
{
  public function __construct()
  {
    //Capturamos la url
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    //quitamos el ultimo "/" de la url
    $url = rtrim($url, '/');
    //separamos y convertimos a array
    $url = explode('/', $url);
    
    // var_dump($url);
    //echo "<pre>", print_r($url), "</pre>";

    if (empty($url[0])) {
      //llamamos al controlador por defecto(Home)
      require_once '../app/controllers/homeController.php';
      (new HomeController())->index();
      return false;
    }
    //cuando el usuario especifique el controlador
    //Formamos la ruta del controlador

    $path_controller = '../app/controllers/' . $url[0] . 'Controller.php';
    if (file_exists($path_controller) && $url[0] != 'public' ) {
      //Creamos la instancia del controlador
      require_once $path_controller;
      $controller_name = '\\App\\Controllers\\' . $url[0] . 'Controller';
      $controller = new $controller_name();
      //si la cantidad de elementos es mayor o igual a 2 es decir se ha agregado parametros
      $size = count($url);
      if($size >= 2){
        if (method_exists($controller_name, $url[1])) {
          //verificar si existen parametros
          if ($size >= 3) {
            //al menos el usuario ha especificado un parametro
            //capturamos los parametros ingresados en un array "params"
            $params = [];
            for ($i=2; $i < $size ; $i++) { 
              array_push($params,$url[$i]);
            }
            // echo "<pre>", print_r($params), "</pre>";
            // var_dump($params);
            //Llamamos al contralador, su accion y le especificamos los parametros
            $controller->{$url[1]}($params);
          } else {
            //el usuario no ha especificado parametros entonces llamamos a la accion sin parametros
            $controller->{$url[1]}();
          }
        } else {
          //Error 404
          echo "No existe la accion especificada {$url[1]}";
        }
        
      }else{
        //cuando no se especifique la accion 
        //Iniciamos el metodo index
        $controller->index();
      }
    } else {
      //Error 404
      echo "El controlador {$url[0]} no existe";
    }
  }
}
