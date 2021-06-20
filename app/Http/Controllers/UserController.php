<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $get_roles = DB::table('roles')->get();
        $get_company = DB::table('companies')
        ->where('id', Auth::user()->company_id)
        ->first();
        return view('user.index', [
            'roles' => $get_roles,
            'company' => $get_company
        ]);
    }
    public function notification()
    {
        $terbayar = DB::table('users')->get();
        $konfirmasi = DB::table('users')->get();
        $belum_bayar = DB::table('users')->get();
        return view('user.notification', compact('terbayar', 'konfirmasi', 'belum_bayar'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' =>'required|email',
            'password' => 'required',
            'jabatan' => 'required',
        ]);

        $new_user = DB::table('users')->insertGetId([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'company_id' => Auth::user()->company_id
        ]);

        DB::table('user_roles')->insert([
            'user_id' => $new_user,
            'role_id' => $request->get('jabatan')
        ]);

        DB::table('profils')->insert([
            'user_id' => $new_user,
            'lokasi' => $request->get('lokasi')
        ]);

        return redirect()->route('user-payment.index')->with('success','Berhasil Menambah Pengguna Baru');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
