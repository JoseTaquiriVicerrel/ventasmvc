<?php

namespace App\Controllers;
use Libs\Controller;
use App\Daos\CategoriaDAO;
use stdClass;

use App\Models\CategoriaModel;

class CategoriaController extends Controller
{
  public function __construct() {
    $this->loadDirectoryTemplate('categoria');
    $this->loadDAO('categoriaDAO');
  }

  public function index()
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'POST':
        $estado = $_POST['Estado'] === 'true' ? true : false; ;
        $data = $this->dao->getAll($estado);
        echo json_encode($data);
        break;
      case 'GET':
      default:
        $data = $this->dao->getall(true);
        echo $this->templates->render('index',
        [
          'data' => $data
          ]);
          break;
    }
  }

  public function detail($params = null){
    $id = isset($params[0]) ? $params[0] : 0 ;
    $data = $this->dao->get($id);
    echo $this->templates->render('detail', ['data' => $data]);
  }

  public function save()
  {
    $obj = [
      'IdCateg' => isset($_POST['id']) ?$_POST['id'] : 0,
      'Nombre' => isset($_POST['nombre']) ? $_POST['nombre'] : '',
      'Descripcion' => isset($_POST['descripcion']) ? $_POST['descripcion'] : '',
      'Estado' => $_POST['Estado'] === "on" ? true : false
    ];

    if ($obj['IdCateg']>0) {
      $this->dao->update($obj);
      echo json_encode($_POST);
    }else{
      $this->dao->create($obj);
      echo json_encode($obj);
    }
  }

  public function delete()
  {
    $id = $_POST['id'];
    if($id>0){
      $this->dao->delete($id);
    }
    echo json_encode($_POST);
  }

}
