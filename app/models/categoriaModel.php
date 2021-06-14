<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
  protected $table = 'categorias';
  protected $primaryKey = 'IdCateg';
  public $timestamps = true;
  protected $fillable = ['Nombre','Descripcion','Estado'];
}
