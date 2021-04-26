<?php

class TestController
{
  public function index()
  {
    echo "Pagina de inicio:Prueba", PHP_EOL;
  }

  public function mostrar()
  {
    echo "Listado de clientes", PHP_EOL;
  }

  public function saludo(?array $params = null)
  {
    // if (is_null($params)) {
    //   echo "No se especifico el nombre";
    //   return false;
    // }else{
    //   echo "Holas {$params[0]}";
    // }
    echo isset($params) ? "Holas $params[0] " : "No se especifico el nombre";
  }

  public function suma($params = null)
  {
    $num1 = isset($params[0]) ? $params[0] : 0;
    $num2 = isset($params[1]) ? $params[1] : 0;
    $rpta = $num1 + $num2;
    echo "La suma {$num1} + {$num2} = {$rpta}";
  }
}
