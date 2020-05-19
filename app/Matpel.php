<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matpel extends Model
{
    protected $table = 'matpel';

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class);
    }
}
