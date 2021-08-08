<?php

namespace App\Controllers;
use Libs\Controller;
use App\Daos\CategoriaDAO;
use stdClass;

use App\Models\CategoriaModel;
use GUMP;

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
    $valid_datos = $this->valida($_POST);
    $data = $valid_datos['data'];
    $status = $valid_datos['status'];
    if($status === true){
      $obj = [
      'IdCateg' => isset($_POST['id']) ?$_POST['id'] : 0,
      'Nombre' => isset($_POST['nombre']) ? $_POST['nombre'] : '',
      'Descripcion' => isset($_POST['descripcion']) ? $_POST['descripcion'] : '',
      'Estado' => $_POST['Estado'] === "on" ? true : false
      ];
      if ($obj['IdCateg']>0) {
        $response = $this->dao->update($obj);
        // echo json_encode($_POST);
      }else{
        $response = $this->dao->create($obj);
        // echo json_encode($obj);
      }

      if($response){
        $response = [
          'success' => 1,
          'message' => 'Categoria guardada correctamente',
          'redirect' => URL . 'categoria/index'
        ];
      }else{
        $response = [
          'success' => 0,
          'message' => 'Error:Algo sucedio al guardar datos',
          'redirect' => ''
        ];
      }
    }else{
      $response = [
        'success' => -1,
        'message' => $data,
        'redirect' => ''
      ];
    }
    
    echo json_encode($response);

  }

  public function delete()
  {
    $id = $_POST['id'];
    if($id>0){
      $this->dao->delete($id);
    }
    echo json_encode($_POST);
  }
  public function valida($datos)
  {
    $gump = new GUMP('es');
    $gump->validation_rules([
      'nombre' => 'required|min_len,6',
      'descripcion' => 'min_len,5|max_len,10'
    ] );
    $valid_datos = $gump->run($datos);
    if($gump->errors()){
      $response = [
        'status' => false,
        'data' => $gump->get_errors_array()
      ];
    }else{
      $response = [
        'status' => true,
        'data' => $valid_datos
      ];
    }
    return $response;
  }

}
