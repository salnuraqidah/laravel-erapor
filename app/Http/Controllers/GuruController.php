<?php

namespace App\Http\Controllers;

use App\Guru;
use Illuminate\Http\Request;
use DB;
use Validator, File, Redirect, Response;
use PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{

    public function index()
    {
        $ar_guru = DB::table('guru')->get();
        return view('guru.index', compact('ar_guru'));
    }


    public function create()
    {
        return view('guru.create');
    }


    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nip' => 'required|unique:guru|max:30',
                'nama_depan' => 'required|max:100',
                'nama_belakang' => 'required|max:255',
                'pendidikan' => 'required|max:45',
                'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
            ],
            [
                'nip.required' => 'NIP Guru wajib diisi!!',
                'nip.unique' => 'NIP Guru sudah ada!!',
                'nip.max' => 'NIP Guru maksimal 30 karakter!!',
                'nama_depan.required' => 'Nama Depan Guru wajib diisi!!',
                'nama_depan.max' => 'Nama Depan Guru maksimal 100 karakter!!',
                'nama_belakang.required' => 'Nama Belakang Guru wajib diisi!!',
                'nama_belakang.max' => 'Nama Belakang Guru maksimal 255 karakter!!',
                'pendidikan.required' => 'Pendidikan wajib diisi!!',
                'pendidikan.max' => 'Pendidikan maksimal 45 karakter!!',
                'foto.image' => 'ekstensi file yang boleh hanya jpg,jpeg,png',
                'foto.max' => 'ukuran file foto terlalu besar,max:2048',
            ]
        );
        if (!empty($request->foto)) {
            $fileName = $request->nip . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/guru'), $fileName);
        } else {
            $fileName = '';
        }
        $user = new \App\User;
        $user->role = 'guru';
        $user->name = $request->nama_depan;
        $user->email = $request->nama_depan . '_' . $request->nip . '@staff.com';
        $user->password = Hash::make('rahasia');
        $user->save();

        DB::table('guru')->insert([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'pendidikan' => $request->pendidikan,
            'foto' => $fileName,
        ]);
        return redirect('/guru');
    }

    public function show($id)
    {
        $ar_guru = DB::table('guru')
            ->where('guru.id', '=', $id)
            ->get();
        return view('guru.show', compact('ar_guru'));
    }


    public function edit($id)
    {
        $data = Guru::where('id', $id)->get();
        return view('guru.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $validasi = $request->validate(
            [
                'nip' => 'required|max:30',
                'nama_depan' => 'required|max:100',
                'nama_belakang' => 'required|max:255',
                'pendidikan' => 'required|max:45',
                'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
            ],
            [
                'nip.required' => 'NIP Guru wajib diisi!!',
                'nip.max' => 'NIP Guru maksimal 30 karakter!!',
                'nama_depan.required' => 'Nama Depan Guru wajib diisi!!',
                'nama_depan.max' => 'Nama Depan Guru maksimal 100 karakter!!',
                'nama_belakang.required' => 'Nama Belakang Guru wajib diisi!!',
                'nama_belakang.max' => 'Nama Belakang Guru maksimal 255 karakter!!',
                'pendidikan.required' => 'Pendidikan wajib diisi!!',
                'pendidikan.max' => 'Pendidikan maksimal 45 karakter!!',
                'foto.image' => 'ekstensi file yang boleh hanya jpg,jpeg,png',
                'foto.max' => 'ukuran file foto terlalu besar,max:2048',
            ]
        );
        $foto = DB::table('guru')->select('foto')
            ->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFile = $f->foto;
        }
        if (!empty($request->foto)) {
            //hapus fisik foto lama di folder img
            File::delete(public_path('images/guru/' . $namaFile));
            //proses upload file foto baru
            $request->validate([
                'foto' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);
            $fileName = $request->nip . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/guru'), $fileName);
        } else { //tidak ganti foto
            $fileName = $namaFile;
        }

        DB::table('guru')->where('id', $id)->update([
            'nip' => $request->nip,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'pendidikan' => $request->pendidikan,
            'foto' => $fileName,
        ]);
        //tambah 11 mei
        if (Auth::user()->role == 'guru') {
            return redirect('/guru' . '/' . $id);
        } else {
            return redirect('/guru');
        }
    }


    public function destroy($id)
    {
        $foto = DB::table('guru')->select('foto')
            ->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFile = $f->foto;
        }
        File::delete(public_path('images/guru/' . $namaFile));
        DB::table('guru')->where('id', $id)->delete();
        return redirect('/guru');
    }
}
