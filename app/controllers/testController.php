<?php

namespace App\Controllers;

use Libs\Controller;

class TestController extends Controller
{
  public function __construct() {
    $this->loadDirectoryTemplate('test');
  }
  public function index()
  {
    echo $this->templates->render('index');
  }

  public function suma($params = null)
  {
    $num1 = isset($_POST['num1']) ? $_POST['num1'] : 0 ;
    $num2 = isset($_POST['num2']) ? $_POST['num2'] : 0 ;
    $rpta = $num1 + $num2;

    echo $this->templates->render('suma',[
      'num1' => $num1,
      'num2' => $num2,
      'rpta' => $rpta
      ]);

  }
}
