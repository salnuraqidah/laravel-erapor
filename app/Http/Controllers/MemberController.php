<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Member;
use Illuminate\Support\Facades\Hash;
use Validator, File, Redirect, Response;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_member = DB::table('users')->get();
        return view('member.index', compact('ar_member'));
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
    {
        if (!empty($request->foto)) {
            $fileName = $request->name . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/member'), $fileName);
        } else {
            $fileName = '';
        }

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
            'role' => 'admin',
        ]);
        return redirect('/member');
    }

    public function show($id)
    {
        $ar_member = DB::table('users')
            ->select('users.*')
            ->where('users.id', '=', $id)
            ->get();
        return view('member.show', compact('ar_member'));
    }

    public function edit($id)
    {
        $data = member::where('id', $id)->get();
        return view('member.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $foto = DB::table('users')->select('foto')
            ->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFile = $f->foto;
        }
        if (!empty($request->foto)) {
            //hapus fisik foto lama di folder img
            File::delete(public_path('images/member/' . $namaFile));
            //proses upload file foto baru
            $request->validate([
                'foto' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]);
            $fileName = $request->name . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/member'), $fileName);
        } else { //tidak ganti foto
            $fileName = $namaFile;
        }

        DB::table('users')->where('id', $id)->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'status' =>  $request->status,
                'foto' => $fileName,
            ]
        );
        return redirect('/member');
    }


    public function destroy($id)
    {
        $foto = DB::table('users')->select('foto')
            ->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFile = $f->foto;
        }
        File::delete(public_path('images/member/' . $namaFile));
        DB::table('users')->where('id', $id)->delete();
        return redirect('/member');
    }
}
