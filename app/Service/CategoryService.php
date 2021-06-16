<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/15/21, 12:45 AM
 */

namespace App\Service;

use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function all($request)
    {
        return $user = DB::table('category')->where('role_id', $request->role_id)->orderBy('id', 'DESC')->get();
    }

    public function get($request)
    {
        return $user = DB::table('category')->where('id', $request->id)->first();
    }

    public function store($request)
    {
        return $user = DB::table('category')->insert([
            'role_id' => $request->role_id,
            'category' => $request->category,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function update($request)
    {
        return $user = DB::table('category')
            ->where('id', $request->id)
            ->update([
                'category' => $request->category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }

    public function delete($request)
    {
        return $user = DB::table('category')->where('id', $request->id)->delete();
    }
}
