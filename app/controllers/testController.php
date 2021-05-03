<?php

namespace App\Controllers;

use Libs\Controller;

class TestController extends Controller
{
  public function index()
  {
    $this->renderView("test/index");
  }

  public function mostrar()
  {
    echo "Listado de clientes", PHP_EOL;
  }

  public function saludo(?array $params = null)
  {
    $nombre = '';
    if (is_null($params)) {
      $nombre == isset($_POST['nombre']) ? null : '';
    }else{
      $nombre == isset($params[0])? $params[0] : '';
    }
    $data = [
      'nombre'=> $nombre
    ];
    $this->renderView('test/saludo');
    // echo isset($params) ? "Holas $params[0] " : "No se especifico el nombre";
  }

  public function suma($params = null)
  {
    // $num1 = isset($params[0]) ? $params[0] : 0;
    // $num2 = isset($params[1]) ? $params[1] : 0;
    $num1 = isset($_POST['num1']) ? $_POST['num1'] : 0 ;
    $num2 = isset($_POST['num2']) ? $_POST['num2'] : 0 ;
    $rpta = $num1 + $num2;
    $params = [
      'num1' => $num1,
      'num2' => $num2,
      'rpta' => $rpta
    ];
    //echo "La suma {$num1} + {$num2} = {$rpta}";
    //require_once '../app/views/test/suma.phtml';
    $this->renderView("test/suma", $params);
  }
}
