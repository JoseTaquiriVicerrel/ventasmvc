<?php

namespace App\Controllers;

use Libs\Controller;
use App\Daos\CategoriaDAO;
use stdClass;

class CategoriaController extends Controller
{
  public function __construct()
  {
    $this->loadDirectoryTemplate('categoria');
    $this->loadDAO('categoriaDAO');
  }

  public function index()
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'POST':
        $estado = $_POST['Estado'] === 'true' ? true : false;;
        $data = $this->dao->getAll($estado);
        echo json_encode($data);
        break;
      case 'GET':
      default:
        $data = $this->dao->getAll(true);
        echo $this->templates->render(
          'index',
          [
            'categorias' => $data
          ]
        );
        break;
    }
  }

  public function detail($params = null)
  {
    $id = isset($params[0]) ? $params[0] : 0;
    $data = $this->dao->get($id);
    echo $this->templates->render('detail', ['data' => $data]);
  }

  public function save()
  {
    $obj = new  stdClass();

    $obj->ID = isset($_POST['id']) ? $_POST['id'] : 0;
    $obj->Nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $obj->Descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

    if (isset($_POST['Estado'])) {
      if ($_POST['Estado'] == 'on') {
        $obj->Estado = true;
      } else {
        $obj->Estado = false;
      }
    } else {
      $obj->Estado = false;
    }

    if ($obj->ID > 0) {
      $this->dao->update($obj);
    } else {
      $this->dao->create($obj);
    }
    // header('Location:'. URL . 'categoria');
    echo json_encode($_POST);
  }

  public function delete()
  {
    $id = $_POST['id'];
    if ($id > 0) {
      $this->dao->delete($id);
    }
    echo json_encode($_POST);
    //header('Location:' . URL . 'categoria');
  }
}
