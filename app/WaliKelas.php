<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $table = 'wali_kelas';

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }
    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan');
    }
}
