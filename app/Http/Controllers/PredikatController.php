<?php

namespace App\Http\Controllers;

use App\Predikat;
use Illuminate\Http\Request;
use DB;

class PredikatController extends Controller
{

    public function index()
    {
        $ar_predikat = DB::table('predikat')->get();
        return view('predikat.index', compact('ar_predikat'));
    }

    public function create()
    {
        return view('predikat.create');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nama' => 'required|max:5',
            ],
            [
                'nama.required' => 'Nama wajib diisi!!',
                'nama.max' => 'Nama maksimal 5 karakter!!',
            ]
        );
        DB::table('predikat')->insert([
            'nama' => $request->nama,
        ]);
        return redirect('/predikat');
    }


    public function edit($id)
    {
        $data = Predikat::where('id', $id)->get();
        return view('predikat.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate(
            [
                'nama' => 'required|max:5',
            ],
            [
                'nama.required' => 'Nama wajib diisi!!',
                'nama.max' => 'Nama maksimal 5 karakter!!',
            ]
        );
        DB::table('predikat')->where('id', $id)->update([
            'nama' => $request->nama,
        ]);
        return redirect('/predikat');
    }


    public function destroy($id)
    {
        DB::table('predikat')->where('id', $id)->delete();
        return redirect('/predikat');
    }
}
