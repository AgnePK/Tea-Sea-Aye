<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tea;
use App\Models\Brand;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreController extends Controller
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

        $stores = Store::latest('updated_at')->paginate(2);
        return view('admin.stores.index')->with('stores', $stores);
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
        return view('admin.stores.create')->with('teas', $teas);
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

        $request->validate([
            'name' => 'required|max:50',
            'location' => 'required|max:250',
            'teas' => ['required', 'exists:teas,id']
            // 'brands' => ['required', 'exists:brands,id'],
        ]);

        $store = Store::create([
            'name' => $request->name,
            'location' => $request->location
        ]);

        $store->teas()->attach($request->teas);
        // $store->brands()->attach($request->brands);

        return to_route('admin.stores.index')->with('success', 'Store created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $stores = Store::with('teas')->get();
        // $teas = Tea::where('store_id', '=', $store->id)->get();
        // $stores = Store::where('tea_id', '=', $tea->id)->get();
        // $stores = Store::where('teas_id' "=" 'stores_id');

        return view('admin.stores.show')->with('store', $store)->with('stores', $stores);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        return view('admin.stores.edit')->with('store', $store);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $request->validate([
            'name' => 'required|max:50',
            'location' => 'required|max:250',
        ]);

        // This code updates/changes the info to whatever the user put in and saves it in the DB.
        $store->update([
            'name' => $request->name,
            'location' => $request->location
        ]);

        return to_route('admin.stores.show', $store)->with('success', 'Store updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $store->delete();

        return to_route('admin.stores.index', $store)->with('success', 'store deleted successfully');
    }
}
