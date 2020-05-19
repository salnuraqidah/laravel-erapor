<?php

namespace App\Http\Controllers;

use App\Semester;
use Illuminate\Http\Request;
use DB;


class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_semester = DB::table('semester')->get();
        return view('semester.index', compact('ar_semester'));
    }

    public function create()
    {
        return view('semester.create');
    }
    public function edit($id)
    {
        $data = Semester::where('id', $id)->get();
        return view('semester.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        DB::table('semester')->where('id', $id)->update([
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
        ]);
        return redirect('/semester');
    }
}
