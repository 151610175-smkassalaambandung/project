<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    //
    protected $fillable = ['id','name'];

    public function siswas()
    {
    	return $this->hasOne('App\Siswa');
    }
}
