<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/15/21, 1:06 AM
 */

namespace App\Service;

use Illuminate\Support\Facades\DB;

class ProductService
{
    public function all($request)
    {
        return $user = DB::table('product')->where('role_id', $request->role_id)->orderBy('id', 'DESC')->get();
    }

    public function get($request)
    {
        return $user = DB::table('product')->where('id', $request->id)->first();
    }

    public function store($request)
    {
        if (empty($request->file('image'))) {
            $user = DB::table('product')->insert([
                'role_id' => $request->role_id,
                'category_id' => $request->category_id,
                'product' => $request->product,
                'brand' => $request->brand,
                'price' => $request->price,
                'purchase_price' => $request->purchase_price,
                'status' => $request->status,
                'stock' => $request->stock,
                'unit' => $request->unit,
                'time_act' => $request->time_act,
                'time_exp' => $request->time_exp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } elseif ($request->file('image')) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $user = DB::table('product')->insert([
                'role_id' => $request->role_id,
                'category_id' => $request->category_id,
                'product' => $request->product,
                'brand' => $request->brand,
                'price' => $request->price,
                'purchase_price' => $request->purchase_price,
                'status' => $request->status,
                'stock' => $request->stock,
                'unit' => $request->unit,
                'time_act' => $request->time_act,
                'time_exp' => $request->time_exp,
                'image' => $new_name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return $user;
    }

    public function update($request)
    {
        if (empty($request->file('image'))) {
            $user = DB::table('product')->where('id', $request->id)->update([
                'role_id' => $request->role_id,
                'category_id' => $request->category_id,
                'product' => $request->product,
                'brand' => $request->brand,
                'price' => $request->price,
                'purchase_price' => $request->purchase_price,
                'status' => $request->status,
                'stock' => $request->stock,
                'unit' => $request->unit,
                'time_act' => $request->time_act,
                'time_exp' => $request->time_exp,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } elseif ($request->file('image')) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $user = DB::table('product')->where('id', $request->id)->insert([
                'role_id' => $request->role_id,
                'category_id' => $request->category_id,
                'product' => $request->product,
                'brand' => $request->brand,
                'price' => $request->price,
                'purchase_price' => $request->purchase_price,
                'status' => $request->status,
                'stock' => $request->stock,
                'unit' => $request->unit,
                'time_act' => $request->time_act,
                'time_exp' => $request->time_exp,
                'image' => $new_name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return $user;
    }

    public function delete($request)
    {
        return $user = DB::table('product')->where('id', $request->id)->delete();
    }
}
