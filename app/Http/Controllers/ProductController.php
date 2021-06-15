<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        function rupiah($m)
        {
            $rupiah = "Rp " . number_format($m, 0, ",", ".") . ",-";
            return $rupiah;
        }

        $category = DB::table('category')->where('role_id', auth()->user()->role_id)->get();
        if ($request->ajax()) {
            $data = DB::table('product')->join('category', 'category.id', 'product.category_id')
                ->where('product.role_id', auth()->user()->role_id)
                ->select([
                    'product.*',
                    'category.category',
                ])
                ->get();
            return DataTables::of($data)
                ->addColumn('image', function ($data) {
                    $image = rupiah($data->price);
                    return $image;
                })
                ->addColumn('price', function ($data) {
                    $harga = rupiah($data->price);
                    return $harga;
                })
                ->addColumn('action', function ($data) {

                    $button = '<a href="/product/edit/' . $data->id . '" class="btn btn-primary ">Edit</a>';
                    $button .= '<button onclick="confirmationDelte(' . $data->id . ')" type="button" id="' . $data->id . '" class="btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['action', 'price', 'image'])
                ->make(true);
        }
        return view('product.index', compact('category'));
    }

    public function create(Request $request)
    {
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        DB::table('product')
            ->insert([
                'role_id' => auth()->user()->role_id,
                'category_id' => $request->category_id,
                'product' => $request->product,
                'brand' => $request->brand,
                'price' => $request->price,
                'time_act' => $request->time_act,
                'time_exp' => $request->time_exp,
                'image' => $new_name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        $id = DB::getPdo()->lastInsertId();
        DB::table('barcode_products')
            ->insert([
                'item_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect()->route('product')->with('success', 'Product Added');
    }

    public function edit($id)
    {
        $data = DB::table('product')->leftJoin('category', 'category.id', 'product.category_id')->where('product.id', $id)->select('product.*', 'category.category')->first();
        $category = DB::table('category')->get();
        return view('product.edit', compact('data', 'category'));
    }

    public function update(Request $request, $id)
    {
        if (empty($request->file('image'))) {
            DB::table('product')
                ->where('id', $id)
                ->update([
                    'category_id' => $request->category_id,
                    'product' => $request->product,
                    'brand' => $request->brand,
                    'price' => $request->price,
                    'time_act' => $request->time_act,
                    'time_exp' => $request->time_exp,
                ]);
            return redirect()->route('product')->with('success', 'Product Updated');
        } elseif ($request->file('image')) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            DB::table('product')
                ->where('id', $id)
                ->update([
                    'category_id' => $request->category_id,
                    'product' => $request->product,
                    'brand' => $request->brand,
                    'price' => $request->price,
                    'time_act' => $request->time_act,
                    'time_exp' => $request->time_exp,
                    'image' => $new_name,
                ]);
            return redirect()->route('product')->with('success', 'Product Updated');
        }

    }

    public function delete($id)
    {
        $data = DB::table('product')
            ->where('id', $id)
            ->delete();
        DB::table('barcode_products')
            ->where('item_id', $id)
            ->delete();

        return redirect()->route('product')->with('success', 'Product has been deleted');
    }
}
