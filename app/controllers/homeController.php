<?php 

class HomeController
{
  public function index()
  {
    require_once '../app/views/home/index.phtml';
  }
  public function registro()
  {
    echo "Pagina de registro";
  }
}
