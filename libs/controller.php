<?php

class Controller{

  public function renderView(string  $view, $params = null)
  {
    require_once "../app/views/{$view}.phtml";
  }
}