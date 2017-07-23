<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //

    protected $fillable = ['nis','name','jeniskelamin','alamat','kelas_id','jurusan_id'];
    
    public function kelas()
    {
    	return $this->belongsTo('App\Kelas');
    }

    public function jurusan()
    {
    	return $this->belongsTo('App\Jurusan');
    }
}
