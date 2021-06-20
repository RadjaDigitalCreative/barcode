<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('brand')
                ->where('role_id', auth()->user()->role_id)
                ->get();
            try {
                return DataTables::of($data)
                    ->addColumn('brand', function ($data) {
                        $button = '<a href="' . route ('brand.barcode_generator', $data->id) . '" class=" btn btn-dark">' . $data->brand . '</a>';
                        return $button;
                    })
                    ->addColumn('action', function ($data) {
                        $button = '<a href="' . route('brand.edit', $data->id) . '" class="btn btn-primary ">Edit</a>';
                        $button .= '<button onclick="confirmationDelte(' . $data->id . ')" type="button" id="' . $data->id . '" class="btn btn-danger">Hapus</button>';
                        return $button;
                    })
                    ->addColumn('whatsapp', function ($data) {
                        $button = '<a target="_blank" href="https://api.whatsapp.com/send?phone=+62' . $data->number . '&text=Halo" class=" btn btn-success"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a>';
                        return $button;
                    })
                    ->addColumn('number_hp', function ($data) {
                        $button = '+62' . $data->number . '';
                        return $button;
                    })
                    ->rawColumns(['action', 'whatsapp', 'number_hp', 'brand'])
                    ->toJson();
            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }
        }
        return view('brand.index');
    }
    public function barcode_generator(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('barcode_products')->join('product', 'product.id', 'barcode_products.item_id')
                ->join('category', 'category.id', 'product.category_id')
                ->join('brand', 'brand.id', 'product.brand_id')
                ->where('product.role_id', auth()->user()->role_id)
                ->where('product.brand_id', 4)
                ->select([
                    'barcode_products.*',
                    'product.product',
                    'brand.brand',
                    'category.category',
                ])
                ->get();
            try {
                return DataTables::of($data)
                    ->addColumn('barcode', function ($data) {
                        if ($data->barcode_number) {
                            return view('barcode_generator.generator_action.barcode', ['data' => $data]);
                        } else {
                            $button = '<a href="' . route ('barcode.generator', $data->id) . '" class="btn btn-primary">Buat Barcode</a>';
                            return $button;
                        }
                    })
                    ->addColumn('QR', function ($data) {
                        if ($data->qr_code) {
                            return view('barcode_generator.generator_action.qr', ['data' => $data]);
                        } else {
                            $button = '<a href="' . route ('qr.generator', $data->id) . '" class="btn btn-primary">Buat QR Code</a>';
                            return $button;
                        }
                    })
                    ->rawColumns(['barcode', 'QR'])
                    ->toJson();
            } catch (\Exception $e) {

            }
        }
        return view('barcode_generator.filter');
    }
    public function store(Request $request)
    {
        DB::table('brand')
            ->insert([
                'brand' => $request->brand,
                'number' => $request->number,
                'role_id' => auth()->user()->role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect()->route('brand')->with('success', 'Brand Added');
    }

    public function edit($id)
    {
        $data = DB::table('brand')
            ->where('id', $id)
            ->first();
        return view('brand.edit', compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::table('brand')
            ->where('id', $id)
            ->update([
                'brand' => $request->brand,
                'number' => $request->number,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect()->route('brand')->with('success', 'Brand Updated');
    }

    public function delete($id)
    {
        DB::table('brand')
            ->where('id', $id)
            ->delete();

        return redirect()->route('brand')->with('success', 'Brand has been deleted');
    }

}
