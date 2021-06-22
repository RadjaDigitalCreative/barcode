<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $company = DB::table('companies')->where('role_id', auth()->user()->role_id)->count();
        $brand = DB::table('brand')->where('role_id', auth()->user()->role_id)->count();
        $barcode = DB::table('barcode_products')->join('product', 'barcode_products.item_id', 'product.id')->where('product.role_id', auth()->user()->role_id)->count();
        return view('dashboard', compact('company', 'brand', 'barcode'));
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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
