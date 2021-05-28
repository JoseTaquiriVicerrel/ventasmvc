<?php

namespace App\Controllers;
use Libs\Controller;
use App\Daos\CategoriaDAO;

class CategoriaController extends Controller
{
  public function __construct() {
    $this->loadDirectoryTemplate('categoria');
  }

  public function index()
  {
    $data = (new CategoriaDAO())->getAll();
    echo $this->templates->render('index',
    [
      'data' => $data
    ]
  );
  }

}
