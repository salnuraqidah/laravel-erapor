<?php

namespace App\Http\Controllers;

use App\Sekolah;
use Illuminate\Http\Request;
use DB;

class SekolahController extends Controller
{
    public function index()
    {
        $ar_sekolah = DB::table('sekolah')->get();
        return view('sekolah.index', compact('ar_sekolah'));
    }
    public function create()
    {
        return view('sekolah.create');
    }
    public function edit($id)
    {
        $data = Sekolah::where('id', $id)->get();
        return view('sekolah.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        DB::table('sekolah')->where('id', $id)->update([
            'nama_sekolah' => $request->nama_sekolah,
            'kepala_sekolah' => $request->kepala_sekolah,
            'kota' => $request->kota,
            'alamat' => $request->alamat,
            'website' => $request->website,
            'telp' => $request->telp,
        ]);
        return redirect('/sekolah');
    }
}
