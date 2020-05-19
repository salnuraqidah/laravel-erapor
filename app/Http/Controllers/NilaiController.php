<?php

namespace App\Http\Controllers;

use App\Nilai;
use Illuminate\Http\Request;
use DB;
use App\Siswa;
use Carbon\Carbon;
use Validator, File, Redirect, Response;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class NilaiController extends Controller
{

    public function index()
    {
        $data_siswa = \App\Siswa::all();

        return view('nilai.index', ['data_siswa' => $data_siswa]);
    }

    public function create()
    {

        return view('nilai.create');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                //'siswa' => 'required',
                //'matpel' => 'required',
                'nilai' => 'required',
                'predikat' => 'required',
            ],
            [
                'nilai.required' => 'Nilai wajib diisi!!',
                'predikat.required' => 'Predikat wajib diisi!!',
            ]
        );
        if (count($request->matpel) > 0) {
            foreach ($request->matpel as $item => $v) {
                $data2 = array(
                    'siswa_id' => $request->siswa,
                    'matpel_id' => $request->matpel[$item],
                    'nilai' => $request->nilai[$item],
                    'predikat_id' => $request->predikat[$item],
                    //'updated_at' => Carbon::now(),
                );
                DB::table('matpel_siswa')->insert($data2);
            }
        }

        return redirect('/nilai')->with('success', 'Data berhasil disimpan, Silahkan Cek Detail Nilai');
    }


    public function show($id)
    {
        $siswa = \App\Siswa::find($id);
        $ar_nilai = DB::table('matpel_siswa')
            ->join('siswa', 'siswa.id', '=', 'matpel_siswa.siswa_id')
            ->join('matpel', 'matpel.id', '=', 'matpel_siswa.matpel_id')
            ->join('predikat', 'predikat.id', '=', 'matpel_siswa.predikat_id')
            ->select('matpel_siswa.*', 'matpel.nama AS matpel', 'predikat.nama AS predikat')
            ->where('siswa_id', '=', $id)->get();
        return view('nilai.show', ['ar_nilai' => $ar_nilai, 'siswa' => $siswa]);
        //return view('nilai.show', compact('ar_nilai'));
    }


    public function edit($id)
    {
        $data = Nilai::where('id', $id)->get();

        return view('nilai.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $validasi = $request->validate(
            [
                //'siswa' => 'required',
                //'matpel' => 'required',
                'nilai' => 'required',
                'predikat' => 'required',
            ],
            [
                'nilai.required' => 'Nilai wajib diisi!!',
                'predikat.required' => 'Predikat wajib diisi!!',
            ]
        );
        $siswa = \App\Siswa::find($id);
        DB::table('matpel_siswa')->where('id', $id)->update([
            //'siswa_id' => $request->siswa,
            //'matpel_id' => $request->matpel,
            'nilai' => $request->nilai,
            'predikat_id' => $request->predikat,
            //  'updated_at' => Carbon::now(),
        ]);
        return redirect('/nilai')->with('success_edit', 'Nilai berhasil diedit, Silahkan Cek Detail Nilai');
    }


    public function destroy($id)
    {
        DB::table('matpel_siswa')->where('id', $id)->delete();
        return redirect()->back();
    }
    public function generatePDF($id)
    {
        $sekolah = \App\Sekolah::all();
        $walas = \App\WaliKelas::all();
        $siswa = \App\Siswa::find($id);
        $ar_nilai = DB::table('matpel_siswa')
            ->join('siswa', 'siswa.id', '=', 'matpel_siswa.siswa_id')
            ->join('matpel', 'matpel.id', '=', 'matpel_siswa.matpel_id')
            ->join('predikat', 'predikat.id', '=', 'matpel_siswa.predikat_id')
            ->select(
                'matpel_siswa.*',
                'siswa.nama_depan AS siswa_depan',
                'siswa.nama_belakang AS siswa_belakang',
                'matpel.kkm',
                'matpel.nama AS matpel',
                'predikat.nama AS predikat'
            )
            ->where('siswa_id', '=', $id)->get();
        $pdf = PDF::loadView('nilai.pdfrapor', [
            'ar_nilai' => $ar_nilai,
            'siswa' => $siswa,
            'sekolah' => $sekolah,
            'walas' => $walas
        ]);
        $fileName =  $siswa['nama_depan'] . '_' . $siswa['nisn'] . '.' . 'pdf';
        return $pdf->download($fileName);
    }
}
