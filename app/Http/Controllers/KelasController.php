<?php

namespace App\Http\Controllers;

use Validator, File, Redirect, Response;
use App\Kelas;
use Illuminate\Http\Request;
use DB;

class KelasController extends Controller
{
    public function index()
    {
        $ar_kelas = DB::table('kelas')->get();
        return view('kelas.index', compact('ar_kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nama' => 'required|max:10',
            ],
            [
                'nama.required' => 'Nama Kelas wajib diisi!!',
                'nama.max' => 'Nama Kelas maksimal 10 karakter!!',
            ]
        );
        DB::table('kelas')->insert([
            'nama' => $request->nama,
        ]);
        return redirect('/kelas');
    }


    public function edit($id)
    {
        $data = Kelas::where('id', $id)->get();
        return view('kelas.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate(
            [
                'nama' => 'required|max:10',
            ],
            [
                'nama.required' => 'Nama Kelas wajib diisi!!',
                'nama.max' => 'Nama Kelas maksimal 10 karakter!!',
            ]
        );
        DB::table('kelas')->where('id', $id)->update([
            'nama' => $request->nama,
        ]);
        return redirect('/kelas');
    }


    public function destroy($id)
    {
        DB::table('kelas')->where('id', $id)->delete();
        return redirect('/kelas');
    }
}
