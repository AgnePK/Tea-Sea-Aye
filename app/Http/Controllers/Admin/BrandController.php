<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tea;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $brands = Brand::paginate(2);
        return view('admin.brands.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $teas = Tea::all();
        //directs click to the create.blade.php page
        return view('admin.brands.create')->with('teas', $teas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        //validating all the input fields and adding custom lengths
        $request->validate([
            'name' => 'required|max:50',
            'address' => 'required|max:250'
        ]);

        //creating (well... adding) a new brand
        Brand::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return to_route('admin.brands.index')->with('success', 'Note created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $teas = Tea::all();
        return view('admin.brands.show')->with('brand', $brand)->with('teas', $teas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        return view('admin.brands.edit')->with('brand', $brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {

        $user = Auth::user();
        $user->authorizeRoles('admin');

        $request->validate([
            'name' => 'required|max:50',
            'address' => 'required|max:250',
        ]);

        // This code updates/changes the info to whatever the user put in and saves it in the DB.
        $brand->update([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return to_route('admin.brands.show', $brand)->with('success', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
