<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class CompanyService
{
    public function all($request)
    {
        return $user = DB::table('companies')->where('role_id', $request->role_id)->orderBy('id', 'DESC')->get();
    }

    public function get($request)
    {
        return $user = DB::table('companies')->where('id', $request->id)->first();
    }

    public function store($request)
    {
        return $user = DB::table('companies')->insert([
            'role_id' => $request->role_id,
            'name_perusahaan' => $request->name_perusahaan,
            'alamat' => $request->alamat,
            'lokasi' => $request->lokasi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update($request)
    {
        return $user = DB::table('companies')
            ->where('id', $request->id)
            ->update([
                'name_perusahaan' => $request->name_perusahaan,
                'alamat' => $request->alamat,
                'lokasi' => $request->lokasi,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }

    public function delete($request)
    {
        return $user = DB::table('companies')->where('id', $request->id)->delete();
    }
}
