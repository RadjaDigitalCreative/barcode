<?php

namespace App\Http\Controllers;

use App\BarcodeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use QrCode;

class BarcodeProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('barcode_products')->join('product', 'product.id', 'barcode_products.item_id')
                ->join('category', 'category.id', 'product.category_id')
                ->join('brand', 'brand.id', 'product.brand_id')
                ->where('product.role_id', auth()->user()->role_id)
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
        return view('barcode_generator.index');
    }

    public function generate($id)
    {
        $barcode_number = rand(0, 999999999);
        DB::table('barcode_products')
            ->where('id', $id)
            ->update(['barcode_number' => $barcode_number]);
        return redirect()->route('barcode-generator.index')->with('success', 'Barcode Berhasil di Buat');
    }
    public function generate_qr($id)
    {
        $qr_code = bin2hex(random_bytes(20));
        DB::table('barcode_products')
            ->where('id', $id)
            ->update(['qr_code' => $qr_code]);
        return redirect()->route('barcode-generator.index')->with('success', 'QR Code Berhasil di Buat');
    }
}
