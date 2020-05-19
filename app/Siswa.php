<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['jurusan_id', 'kelas_id', 'nisn', 'nama', 'email', 'alamat', 'kontak', 'gander', 'tempat_lahir', 'tanggal_lahir', 'foto', 'user_id'];

    public function matpel()
    {
        return $this->belongsToMany(Matpel::class)->withPivot(['nilai']);
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }
    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan');
    }

    public function test()
    {
        $total = 0;
        foreach ($this->matpel as $matpel) {
            $total = $total + $matpel->pivot->nilai;
        }
        return $total;
    }
    public function matpel_baru()
    {
        return $this->belongsToMany(Matpel::class)->withPivot('created_at');
    }
    public function test2()
    {

        $update = 0;
        foreach ($this->matpel_baru as $matpel) {
            $update = $matpel->pivot->created_at;
            //$update = Carbon::now();
            //$update = false;
        }
        return $update;
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
