<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Brand::query();
            return DataTables::of($query)
                ->addColumn('action', function ($brand) {
                    return '
                    <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-yellow-500 border border-yellow-500 rounded-md select-none ease hover:bg-yellow-800 focus:outline-none focus:shadow-outline" 
                        href="' . route('admin.brands.edit', $brand->id) . '">
                        Edit
                    </a>
                    <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.brands.destroy', $brand->id) . '" method="POST">
                    <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Delete
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name'] . '-' . Str::lower(Str::random(5)));
        Brand::create($data);
        return redirect()->route('admin.brands.index')->with('success', 'Brand has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
       return view('admin.brands.edit', [
           'brand' => $brand
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name'] . '-' . Str::lower(Str::random(5)));
        $brand->update($data);
        return redirect()->route('admin.brands.index')->with('success', 'Brand has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand has been deleted');
    }
}
