<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/16/21, 7:32 PM
 */

namespace App\Service;

use Illuminate\Support\Facades\DB;

class UserService
{
    public function all($request)
    {
        return $user = DB::table('users')->where('role_id', $request->role_id)->orderBy('id', 'DESC')->get();
    }

    public function get($request)
    {
        return $user = DB::table('users')->where('id', $request->id)->first();
    }

    public function store($request)
    {
    }

    public function update($request)
    {

    }

    public function delete($request)
    {
        return $user = DB::table('users')->where('id', $request->id)->delete();
    }
}
