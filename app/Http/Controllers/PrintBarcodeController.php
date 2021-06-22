<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class PrintBarcodeController extends Controller
{
    public function index($id)
    {
        $get_barcode = DB::table('barcode_products')
            ->join('product', 'product.id', 'barcode_products.item_id')
            ->join('category', 'category.id', 'product.category_id')
            ->join('brand', 'brand.id', 'product.brand_id')
            ->select([
                'barcode_products.*',
                'product.product',
                'product.license',
                'product.time_exp',
                'product.time_act',
                'brand.brand',
            ])
            ->where('barcode_products.id', $id)->first();

        return view('barcode_generator.print_barcode.index', [
            'bracode_data' => $get_barcode,
            'qr_data' => $get_barcode
        ]);
    }

    public function index2($id)
    {
        $get_barcode = DB::table('barcode_products')->where('id', $id)->first();
        return view('barcode_generator.print_qr.index', [
            'qr_data' => $get_barcode
        ]);
    }

    public function print_setting(Request $request, $id)
    {
        DB::table('barcode_products')
            ->where('id', $id)
            ->update([
                'amount' => $request->get('amount'),
                'barcode_wide' => $request->get('barcode_wide'),
                'barcode_height' => $request->get('barcode_height')
            ]);
        return redirect()->route('print.barcode', $id)->with('success', 'seting pencetakan berhasil');
    }
    public function print_setting2(Request $request, $id)
    {
        DB::table('barcode_products')
            ->where('id', $id)
            ->update([
                'amount_qr' => $request->get('amount_qr'),
                'qr_wide' => $request->get('qr_wide'),
            ]);
        return redirect()->route('print.barcode', $id)->with('success', 'seting pencetakan berhasil');
    }
    public function print_data($id)
    {
        $get_barcode = DB::table('barcode_products')
            ->join('product', 'product.id', 'barcode_products.item_id')
            ->join('category', 'category.id', 'product.category_id')
            ->join('brand', 'brand.id', 'product.brand_id')
            ->select([
                'barcode_products.*',
                'product.product',
                'product.license',
                'product.time_exp',
                'product.time_act',
                'brand.brand',
            ])->where('barcode_products.id', $id)->first();
        return view('barcode_generator.print_barcode.print.index', ['bracode_data' => $get_barcode]);
    }
    public function print_data_qr($id)
    {
        $get_barcode = DB::table('barcode_products')
            ->join('product', 'product.id', 'barcode_products.item_id')
            ->join('category', 'category.id', 'product.category_id')
            ->join('brand', 'brand.id', 'product.brand_id')
            ->select([
                'barcode_products.*',
                'product.product',
                'product.license',
                'product.time_exp',
                'product.time_act',
                'brand.brand',
            ])->where('barcode_products.id', $id)->first();
        return view('barcode_generator.print_qr.print.index', ['qr_data' => $get_barcode]);
    }
    public function print_pdf_barcode($id)
    {
        $get_barcode = DB::table('barcode_products')
            ->join('product', 'product.id', 'barcode_products.item_id')
            ->join('category', 'category.id', 'product.category_id')
            ->join('brand', 'brand.id', 'product.brand_id')
            ->select([
                'barcode_products.*',
                'product.product',
                'product.license',
                'product.time_exp',
                'product.time_act',
                'brand.brand',
            ])->where('barcode_products.id', $id)->first();
        return view('barcode_generator.print_barcode.print.index', ['bracode_data' => $get_barcode]);
    }
    public function print_data_barcode($id)
    {
        $get_barcode = DB::table('barcode_products')
            ->join('product', 'product.id', 'barcode_products.item_id')
            ->join('category', 'category.id', 'product.category_id')
            ->join('brand', 'brand.id', 'product.brand_id')
            ->select([
                'barcode_products.*',
                'product.product',
                'product.license',
                'product.time_exp',
                'product.time_act',
                'brand.brand',
            ])->where('barcode_products.id', $id)->first();

        $pdf = PDF::loadview('barcode_generator.print_barcode.pdf.index',['bracode_data' => $get_barcode]);
        return $pdf->download('barcode.pdf');
    }
}
