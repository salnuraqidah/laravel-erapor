<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    //protected $table = 'nilai';
    protected $fillable = ['siswa_id', 'matpel_id', 'nilai', 'predikat_id'];
}
