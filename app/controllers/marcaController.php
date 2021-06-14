<?php

namespace App\Controllers;

use Libs\Controller;
use App\Daos\MarcasDAO;
use stdClass;

class MarcaController extends Controller
{
  public function __construct()
  {
    $this->loadDirectoryTemplate('marca');
    $this->loadDAO('marcasDAO');
  }

  public function index()
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'POST':
        $data = $this->dao->getAll();
        echo json_encode($data);
        break;
      case 'GET':
      default:
        $data = $this->dao->getAll();
        echo $this->templates->render(
          'index',
          [
            'data' => $data
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
    $obj->Descripcion = isset($_POST['decripcion']) ? $_POST['decripcion'] : '';

    if ($obj->ID > 0) {
      $this->dao->update($obj);
    } else {
      $this->dao->create($obj);
    }
    echo json_encode($_POST);
  }

  public function delete()
  {
    $id = $_POST['id'];
    if ($id > 0) {
      $this->dao->delete($id);
    }
    echo json_encode($_POST);
  }
}
