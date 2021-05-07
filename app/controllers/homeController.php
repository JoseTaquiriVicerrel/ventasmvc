<?php
namespace App\Controllers;

use Libs\Controller;

class HomeController extends Controller
{
  public function index()
  {
    $this->renderView("Home/index");
  }
  public function registro()
  {
    $this->renderView("Home/registro");
  }
}
