<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    //
    protected $table = 'gurus';
    protected $fillable = ['nip','user_id', 'pelajaran_id','foto'];
    protected $visible = ['nip','user_id', 'pelajaran_id','foto'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
