<?php 
namespace App\Controllers;
use Libs\Controller;

class OperacionesController extends Controller {

  public function index()
  {
    return 'Bienvenido';
  }
  public function suma(int $n1, int $n2) : int{
    return $n1 + $n2;
  }
}