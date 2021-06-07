<?php

namespace App\Controllers;
use Libs\Controller;
use App\Daos\CategoriaDAO;
use stdClass;

class CategoriaController extends Controller
{
  public function __construct() {
    $this->loadDirectoryTemplate('categoria');
    $this->loadDAO('categoriaDAO');
  }

  public function index()
  {
    $data = $this->dao->getAll(true);
    echo $this->templates->render('index',
    [
      'categorias' => $data
    ]);
  }

  public function detail($params = null){
    $id = isset($params[0]) ? $params[0] : 0 ;
    $data = $this->dao->get($id);
    echo $this->templates->render('detail', ['data' => $data]);
  }

  public function save()
  {
    $obj = new  stdClass();

    $obj->ID = isset($_POST['id']) ?$_POST['id'] : 0;
    $obj->Nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $obj->Descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    
    if(isset($_POST['Estado'])){
      if ($_POST['Estado']== 'on') {
        $obj->Estado = true;
      }else{
        $obj->Estado = false;
      }
    }else{
      $obj->Estado = false;
    }

    if ($obj->ID>0) {
      $this->dao->update($obj);
    }else{
      $this->dao->create($obj);
    }
    header('Location:'. URL . 'categoria');
  }

  public function delete()
  {
    
  }

}
