<?php
/**
 * Copyright (c) 2021.
 * Dinokhan
 * 6/16/21, 7:50 PM
 */

namespace App\Service;

use Illuminate\Support\Facades\DB;

class BarcodeService
{
    public function all($request)
    {
        return $user = DB::table('barcode_products')->join('product', 'product.id', 'barcode_products.item_id')
            ->where('product.role_id', $request->role_id)
            ->select([
                'barcode_products.*',
                'product.product',
            ])
            ->get();
    }

    public function get($request)
    {
        return $user = DB::table('barcode_products')->join('product', 'product.id', 'barcode_products.item_id')
            ->where('barcode_products.id', $request->id)
            ->select([
                'barcode_products.*',
                'product.product',
            ])
            ->first();
    }

    public function store($request)
    {
        $barcode_number = rand(0, 999999999);
        return $user = DB::table('barcode_products')
            ->where('id', $request->id)
            ->update(['barcode_number' => $barcode_number]);
    }

    public function update($request)
    {

    }

    public function delete($request)
    {
        return $user = DB::table('users')->where('id', $request->id)->delete();
    }
}
