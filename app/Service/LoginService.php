<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/16/21, 8:13 PM
 */

namespace App\Service;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginService
{

    public function login($request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = DB::table('users')
                ->where('email', '=', $credentials)
                ->first();
            return $user;
        }
    }

    public function register($request)
    {
        $user = DB::table('users')
            ->where('email', '=', $request->email)
            ->first();
        if ($user == FALSE) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = rand();
            $user->save();

            DB::table('user_roles')
                ->insert([
                    'user_id' => $user->id,
                    'role_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            DB::table('profils')
                ->insert([
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            return $user;
        }
    }
}
