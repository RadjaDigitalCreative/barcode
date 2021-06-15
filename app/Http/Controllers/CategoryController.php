<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('category')->where('role_id', auth()->user()->role_id)->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {

                    $button = '<a href="/category/edit/' . $data->id . '" class="btn btn-primary ">Edit</a>';
                    $button .= '<button onclick="confirmationDelte(' . $data->id . ')" type="button" id="' . $data->id . '" class="btn btn-danger">Hapus</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('category.index');
    }

    public function create(Request $request)
    {
        DB::table('category')
            ->insert([
                'category' => $request->category,
                'role_id' => auth()->user()->role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect()->route('category')->with('success', 'Category Added');
    }

    public function edit($id)
    {
        $data = DB::table('category')->where('id', $id)->first();
        return view('category.edit', compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::table('category')->where('id', $id)
            ->update([
                'category' => $request->category,
            ]);
        return redirect()->route('category')->with('success', 'Category updated');
    }

    public function delete($id)
    {
        $data = DB::table('category')
            ->where('id', $id)
            ->delete();

        return redirect()->route('category')->with('success', 'Category has been deleted');
    }
}
