<?php

namespace App\Http\Controllers;

use Validator, File, Redirect, Response;
use App\Jurusan;
use Illuminate\Http\Request;
use DB;

class JurusanController extends Controller
{

    public function index()
    {
        $ar_jurusan = DB::table('jurusan')->get();
        return view('jurusan.index', compact('ar_jurusan'));
    }


    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'kode' => 'required|unique:jurusan|max:10',
                'nama' => 'required|max:45',
            ],
            [
                'kode.required' => 'Kode Jurusan wajib diisi!!',
                'kode.unique' => 'Kode Sudah Ada!!',
                'kode.max' => 'Kode Jurusan maksimal 10 karakter!!',
                'nama.required' => 'Nama Jurusan wajib diisi!!',
                'nama.max' => 'Nama Jurusan maksimal 45 karakter!!',
            ]
        );
        DB::table('jurusan')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);
        return redirect('/jurusan');
    }

    public function edit($id)
    {
        $data = Jurusan::where('id', $id)->get();
        return view('jurusan.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $validasi = $request->validate(
            [
                'kode' => 'required|max:10',
                'nama' => 'required|max:45',
            ],
            [
                'kode.required' => 'Kode Jurusan Wajib diisi!!',
                'kode.max' => 'Kode Jurusan maksimal 10 karakter!!',
                'nama.required' => 'Nama Jurusan wajib diisi!!',
                'nama.max' => 'Nama Jurusan maksimal 45 karakter!!',
            ]
        );
        DB::table('jurusan')->where('id', $id)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);
        return redirect('/jurusan');
    }


    public function destroy($id)
    {
        DB::table('jurusan')->where('id', $id)->delete();
        return redirect('/jurusan');
    }
}
