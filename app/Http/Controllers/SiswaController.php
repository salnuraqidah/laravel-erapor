<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use DB;
use Validator, File, Redirect, Response;
use PDF;
use Illuminate\Support\Facades\Hash;
//use App\Exports\BukuExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{

    public function index()
    {
        $ar_siswa = DB::table('siswa')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan_id')
            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->select('siswa.*', 'jurusan.nama AS jur', 'kelas.nama AS kls')
            ->get();
        return view('siswa.index', compact('ar_siswa'));
    }


    public function create()
    {
        return view('siswa.create');
    }


    public function store(Request $request)
    {
        $validasi = $request->validate([

            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        if (!empty($request->foto)) {
            $fileName = $request->nisn . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/siswa'), $fileName);
        } else {
            $fileName = '';
        }

        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->nama_depan . '_' . $request->nisn . '@student.com';
        $user->password = Hash::make('rahasia');
        $user->foto = $request->$fileName;
        $user->save();
        //$request->request->add(['user_id' => $user->id]);

        //$siswa = \App\Siswa::create($request->all());
        //$user_id = auth::user()->id;

        DB::table('siswa')->insert([
            //'user_id' => $request->request->add(['user_id' => $user->id]),
            'user_id' => $user->id,
            'jurusan_id' => $request->jurusan,
            'kelas_id' => $request->kelas,
            'nisn' => $request->nisn,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            //'email' => $request->email,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'gander' => $request->gander,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'foto' => $fileName,
        ]);
        return redirect('/siswa');
    }

    public function show($id)
    {
        $ar_siswa = DB::table('siswa')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan_id')
            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->select('siswa.*', 'jurusan.nama AS jurusan', 'kelas.nama AS kelas')
            ->where('siswa.id', '=', $id)
            ->get();
        return view('siswa.show', compact('ar_siswa'));
    }


    public function edit($id)
    {
        $data = Siswa::where('id', $id)->get();
        return view('siswa.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        $foto = DB::table('siswa')->select('foto')
            ->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFile = $f->foto;
        }
        if (!empty($request->foto)) {
            //hapus fisik foto lama di folder img
            File::delete(public_path('images/siswa/' . $namaFile));
            //proses upload file foto baru
            $request->validate([
                'foto' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);
            $fileName = $request->nisn . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/siswa'), $fileName);
        } else { //tidak ganti foto
            $fileName = $namaFile;
        }

        DB::table('siswa')->where('id', $id)->update([
            'jurusan_id' => $request->jurusan,
            'kelas_id' => $request->kelas,
            'nisn' => $request->nisn,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'gander' => $request->gender,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'foto' => $fileName,
        ]);
        return redirect('/siswa');
    }


    public function destroy($id)
    {
        $foto = DB::table('siswa')->select('foto')
            ->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFile = $f->foto;
        }
        File::delete(public_path('images/siswa/' . $namaFile));
        DB::table('siswa')->where('id', $id)->delete();
        return redirect('/siswa');
    }
}
