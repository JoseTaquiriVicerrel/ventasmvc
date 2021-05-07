<?php

namespace Libs;
class Controller{
  protected $templates;

  public function loadDirectoryTemplate(string $directory)
  {
    $this->templates = new \League\Plates\Engine(MAINPATH . 'app/views/' . $directory);
    $this->templates->setFileExtension("phtml");
  }
}