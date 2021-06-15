<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrintBarcodeController extends Controller
{
    public function index($id)
    {
        $get_barcode = DB::table('barcode_products')->where('id', $id)->first();
        return view('barcode_generator.print_barcode.index', [
            'bracode_data' => $get_barcode
        ]);
    }

    public function print_setting (Request $request, $id)
    {
        DB::table('barcode_products')
        ->where('id',$id)
        ->update([
            'amount' => $request->get('amount'),
            'print_amount' => $request->get('print_amount')
        ]);
        return redirect()->route('print.barcode',$id)->with('success','seting pencetakan berhasil');
    }

    public function print_data($id)
    {
        $get_barcode = DB::table('barcode_products')->where('id', $id)->first();
        return view('barcode_generator.print_barcode.print.index',['data' => $get_barcode]);
    }
}
