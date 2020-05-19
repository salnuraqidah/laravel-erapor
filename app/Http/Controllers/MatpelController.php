<?php

namespace App\Http\Controllers;

use App\Matpel;
use Illuminate\Http\Request;
use DB;
use Validator, File, Redirect, Response;
use PDF;
//use App\Exports\BukuExport;
use Maatwebsite\Excel\Facades\Excel;


class MatpelController extends Controller
{

    public function index()
    {
        $ar_matpel = DB::table('matpel')
            ->join('guru', 'guru.id', '=', 'matpel.guru_id')
            ->select('matpel.*', 'guru.nama_depan as nama_depan', 'guru.nama_belakang as nama_belakang')
            ->get();
        return view('matpel.index', compact('ar_matpel'));
    }


    public function create()
    {
        return view('matpel.create');
    }


    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'kode' => 'required|unique:matpel|max:10',
                'nama' => 'required|max:45',
                'kkm' => 'required|numeric',
                'guru' => 'required',
            ],
            [
                'kode.required' => 'Kode Mata Pelajaran wajib diisi!!',
                'kode.unique' => 'Kode Guru sudah ada!!',
                'kode.max' => 'Kode Mata Pelajaran maksimal 10 karakter!!',
                'nama.required' => 'Nama Mata Pelajaran wajib diisi!!',
                'nama.max' => 'Nama Mata Pelajaran maksimal 45 karakter!!',
                'kkm.required' => 'KKM wajib diisi!!',
                'guru.required' => 'Kode Mata Pelajaran wajib dipilih!!',
            ]
        );

        DB::table('matpel')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kkm' => $request->kkm,
            'guru_id' => $request->guru,
        ]);
        return redirect('/matpel');
    }


    public function show($id)
    {
        $ar_matpel = DB::table('matpel')
            ->join('guru', 'guru.id', '=', 'matpel.guru_id')
            ->select('matpel.*', 'guru.nama_depan', 'guru.nama_belakang')
            ->where('matpel.id', '=', $id)
            ->get();
        return view('matpel.show', compact('ar_matpel'));
    }


    public function edit($id)
    {
        $data = Matpel::where('id', $id)->get();
        return view('matpel.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $validasi = $request->validate(
            [
                'kode' => 'required|max:10',
                'nama' => 'required|max:45',
                'kkm' => 'required|numeric',
                'guru' => 'required',
            ],
            [
                'kode.required' => 'Kode Mata Pelajaran wajib diisi!!',
                'kode.max' => 'Kode Mata Pelajaran maksimal 10 karakter!!',
                'nama.required' => 'Nama Mata Pelajaran wajib diisi!!',
                'nama.max' => 'Nama Mata Pelajaran maksimal 45 karakter!!',
                'kkm.required' => 'KKM wajib diisi!!',
                'guru.required' => 'Kode Mata Pelajaran wajib dipilih!!',
            ]
        );
        DB::table('matpel')->where('id', $id)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kkm' => $request->kkm,
            'guru_id' => $request->guru,
        ]);
        return redirect('/matpel');
    }


    public function destroy($id)
    {
        DB::table('matpel')->where('id', $id)->delete();
        return redirect('/matpel');
    }
}
