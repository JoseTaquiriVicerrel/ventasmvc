<?php

use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
  protected $table = 'categorias';
  protected $primaryKey = 'IdCateg';
  // public $timestamps = false;
  protected $filable = ['IdCateg','Nombre','Descripcion','Estado'];
}
