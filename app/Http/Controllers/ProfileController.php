<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = 'teling manis';
        return view('profile.index', compact('admin'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        try {
            if(empty($request->file('image'))){
                DB::table('users')->where('id', auth()->user()->id)->update([
                    'name' => $request->name,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request->password),
                    'email' => $request->email
                ]);
                DB::table('profils')->where('user_id', auth()->user()->id)->update([
                    'lokasi' => $request->lokasi,

                ]);
                return redirect('dashboard')->with('success', 'Data berhasil diupdate');

            }elseif($request->file('image')){
                $file = $request->file('image');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $tujuan_upload = 'images';
                $file->move($tujuan_upload, $file);
                DB::table('users')->where('id', auth()->user()->id)->update([
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'image' => $file_name
                ]);
                DB::table('profils')->where('user_id', auth()->user()->id)->update([
                    'lokasi' => $request->lokasi,

                ]);
                return redirect('dashboard')->with('success', 'Data berhasil diupdate');

            }
        } catch (\Exception $error) {
            return response()->json($error->getMessage());
        }
    }
    public function destroy($id)
    {
        //
    }
}
