<?php

namespace App\Http\Controllers;

use App\BarcodeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BarcodeProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('barcode_products')->join('product', 'product.id', 'barcode_products.item_id')
                ->where('product.role_id', auth()->user()->role_id)
                ->select([
                    'barcode_products.*',
                    'product.product',
                ])
                ->get();
            try {
                return DataTables::of($data)
                    ->addColumn('barcode', function ($data) {
                        if ($data->barcode_number) {
                            return view('barcode_generator.generator_action.barcode', ['data' => $data]);
                        } else {
                            $button = '<a href="/barcode-generator/generate/' . $data->id . '" class="btn btn-primary">Buat Barcode</a>';
                            return $button;
                        }
                    })
                    ->rawColumns(['barcode'])
                    ->toJson();
            } catch (\Exception $e) {

            }
        }
        return view('barcode_generator.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(BarcodeProduct $barcodeProduct)
    {
        //
    }

    public function edit(BarcodeProduct $barcodeProduct)
    {
        //
    }

    public function update(Request $request, BarcodeProduct $barcodeProduct)
    {
        //
    }

    public function destroy(BarcodeProduct $barcodeProduct)
    {
        //
    }

    public function generate($id)
    {
        $barcode_number = rand(0, 999999999);
        $barcode_genererator = DB::table('barcode_products')
            ->where('id', $id)
            ->update(['barcode_number' => $barcode_number]);
        return redirect()->route('barcode-generator.index')->with('success', 'Barcode Berhasil di Buat');
    }
}
