<?php

namespace App\Http\Controllers;

use App\WaliKelas;
use Illuminate\Http\Request;
use DB;
use Validator, File, Redirect, Response;

class WaliKelasController extends Controller
{
    public function index()
    {
        $ar_walas = DB::table('wali_kelas')
            ->join('jurusan', 'jurusan.id', '=', 'wali_kelas.jurusan_id')
            ->join('kelas', 'kelas.id', '=', 'wali_kelas.kelas_id')
            ->select('wali_kelas.*', 'jurusan.nama AS jur', 'kelas.nama AS kls')
            ->get();
        return view('walikelas.index', compact('ar_walas'));
    }
    public function create()
    {
        return view('walikelas.create');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nip' => 'required|max:10',
            'nama' => 'required|max:45',
            'pendidikan' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        if (!empty($request->foto)) {
            $fileName = $request->nip . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/walikelas'), $fileName);
        } else {
            $fileName = '';
        }

        DB::table('wali_kelas')->insert([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'pendidikan' => $request->pendidikan,
            'foto' => $fileName,
            'jurusan_id' => $request->jurusan,
            'kelas_id' => $request->kelas,
        ]);
        return redirect('/walikelas');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = WaliKelas::where('id', $id)->get();
        return view('walikelas.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        if (!empty($request->foto)) {
            $fileName = $request->nip . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/walikelas'), $fileName);
        } else {
            $fileName = '';
        }
        $foto = DB::table('wali_kelas')->select('foto')
            ->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFile = $f->foto;
        }
        if (!empty($request->foto)) {
            File::delete(public_path('images/walikelas/' . $namaFile));
            $request->validate([
                'foto' => 'image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $fileName = $request->nip . '.' . $request->foto->extension();
            $request->cover->move(public_path('images/walikelas'), $fileName);
        } else {
            $fileName = $namaFile;
        }
        DB::table('wali_kelas')->where('id', $id)->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'pendidikan' => $request->pendidikan,
            'kelas_id' => $request->kelas,
            'jurusan_id' => $request->jurusan,
            'foto' => $fileName,
        ]);
        return redirect('/walikelas');
    }

    public function destroy($id)
    {
        $foto = DB::table('wali_kelas')->select('foto')
            ->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFile = $f->foto;
        }
        File::delete(public_path('images/walikelas/' . $namaFile));
        DB::table('wali_kelas')->where('id', $id)->delete();
        return redirect('/walikelas');
    }
}
