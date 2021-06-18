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
                    ->addColumn('action', function ($data) {
                        $button = '<a href="' . route ('brand.edit', $data->id) . '" class="btn btn-primary ">Edit</a>';
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
                    ->rawColumns(['action', 'whatsapp', 'number_hp'])
                    ->toJson();
            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }
        }
        return view('brand.index');
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
