<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
  protected $table = 'mapel';

  public function getUser()
  {
  	return $this->belongsTo('App\User', 'id_user');
  }
}
