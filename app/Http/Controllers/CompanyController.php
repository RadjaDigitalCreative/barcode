<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('companies')->where('role_id', auth()->user()->role_id) ->get();
            try {
                return DataTables::of($data)
                    ->addColumn('action', function ($data) {
                        $button = '<a href="' . route ('company.edit', $data->id) . '" class="btn btn-primary ">Edit</a>';
                        $button .= '<button onclick="confirmationDelte(' . $data->id . ')" type="button" id="' . $data->id . '" class="btn btn-danger">Hapus</button>';

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
            }
        }
        return view('company.index');
    }

    public function create(Request $request)
    {
        DB::table('companies')
            ->insert([
                'role_id' => auth()->user()->role_id,
                'name_perusahaan' => $request->company,
                'alamat' => $request->location,
                'lokasi' => $request->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect()->route('company')->with('success', 'Company Added');
    }

    public function edit($id)
    {
        $data = DB::table('companies')->where('id', $id)->first();
        return view('company.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        DB::table('companies')->where('id', $id)
            ->update([
                'name_perusahaan' => $request->name_perusahaan,
                'alamat' => $request->alamat,
                'lokasi' => $request->lokasi,
            ]);
        return redirect()->route('company')->with('success', 'Category updated');
    }

    public function delete($id)
    {
        DB::table('companies')
            ->where('id', $id)
            ->delete();

        return redirect()->route('company')->with('success', 'Company has been deleted');
    }
}
