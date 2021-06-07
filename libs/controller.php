<?php

namespace Libs;
class Controller{
  protected $templates;
  protected $dao;

  public function loadDirectoryTemplate(string $directory)
  {
    $this->templates = new \League\Plates\Engine(MAINPATH . 'app/views/' . $directory);
    $this->templates->setFileExtension("phtml");
  }

  public function loadDAO(string $daoName)
  {
    $classDAO = 'App\\Daos\\' . $daoName;
    $this->dao = new $classDAO();
  }

}