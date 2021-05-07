<?php
namespace App\Controllers;

use Libs\Controller;

class HomeController extends Controller
{
  public function __construct() {
    $this->loadDirectoryTemplate('home');
  }

  public function index()
  {
    echo $this->templates->render('index');
  }
}
