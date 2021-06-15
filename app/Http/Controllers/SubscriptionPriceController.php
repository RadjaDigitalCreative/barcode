<?php

namespace App\Http\Controllers;

use App\SubscriptionPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionPriceController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('subscription_prices')
                ->where('user_id', Auth::id())
                ->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="confirmationDelte(' . $data->id . ')" type="button" id="' . $data->id . '" class="btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('subscription_price.index');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jumlah_bulan' => 'required|numeric',
            'harga_total' => 'required|numeric'
        ]);
        DB::table('subscription_prices')->insert([
            'user_id' => Auth::id(),
            'month' => $request->get('jumlah_bulan'),
            'price' => $request->get('harga_total')
        ]);

        return redirect()->route('subcription-price.index')->with('success', 'Berhasil Membuat Harga Baru');
    }


    public function show(SubscriptionPrice $subscriptionPrice)
    {
        //
    }

    public function edit(SubscriptionPrice $subscriptionPrice)
    {
        //
    }

    public function update(Request $request, SubscriptionPrice $subscriptionPrice)
    {
        //
    }

    public function destroy(SubscriptionPrice $subscriptionPrice)
    {
        //
    }

    public function delete($id)
    {
        $data = DB::table('subscription_prices')
            ->where('id', $id)
            ->delete();

        return redirect()->route('subcription-price.index')->with('success', 'Berhasil Menghapus Harga ');
    }
}
