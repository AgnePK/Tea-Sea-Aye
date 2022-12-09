<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tea;
use App\Models\Brand;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TeaController extends Controller
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
        //This will show all the teas i have in the DB, it will show them by the latest update (recent first) and only show max 5 on page 1
        // $teas = Tea::where('user_id', Auth::id())->latest('updated_at')->paginate(5);

        $teas = Tea::latest('updated_at')->paginate(5);
        // $teas = Tea::with('brand')->with('stores')->get();
        return view('admin.teas.index')->with('teas', $teas);
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

        $brands = Brand::all();
        $stores = Store::all();
        //directs click to the create.blade.php page
        return view('admin.teas.create')->with('brands', $brands)->with('stores', $stores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //     dd($request);

        $user = Auth::user();
        $user->authorizeRoles('admin');
        //validating all the input fields and adding custom lengths
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:500',
            'price' => 'required|max:15',
            'tea_img' => 'file|image',
            'location' => 'required|max:120',
            'brand_id' => 'required',
            'stores' => ['required', 'exists:stores,id']
        ]);
        $tea_img = $request->file('tea_img');
        $extention = $tea_img->getClientOriginalExtension();

        //Changed the date formar to day-month-year
        $filename = date('d-m-Y') . '_' . $request->input('name') . '.' . $extention;

        //saying where to store the new images 
        $path = $tea_img->storeAs('public/images', $filename);

        //creating (well... adding) a new tea
        $tea = Tea::create([
            //  'uuid' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'tea_img' => $filename,
            'location' => $request->location,
            'updated_at' => now(),
            'created_at' => now(),
            'brand_id' => $request->brand_id
            // 'user_id' => Auth::id()
        ]);

        $tea->stores()->attach($request->stores);

        return to_route('admin.teas.index')->with('success', 'Tea created successfully');
        // the "with" part makes a pop up notification to alert the user that they have successfully created a tea. 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tea $tea)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        // the uuid here is just calling each tea by their uuid instead of id, and then checks if the user is autherised.
        // $tea = Tea::where('uuid', $tea->uuid)->where('user_id', Auth::id())->firstOrFail();
        $teas = Tea::with('brand')->with('stores')->get();
        return view('admin.teas.show')->with('tea', $tea)->with('teas', $teas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tea $tea)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $brands = Brand::all();
        return view('admin.teas.edit')->with('tea', $tea)->with('brands', $brands);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tea $tea)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $request->validate([
            'name' => 'required|max:50',
            'brand_id' => 'required',
            'description' => 'required|max:500',
            'price' => 'required|max:15',
            'tea_img' => 'file|image',
            'location' => 'required|max:120'
        ]);
        // the bottom 4 lines of code is for adding an image
        $tea_img = $request->file('tea_img');
        $extention = $tea_img->getClientOriginalExtension();

        $filename = date('d-m-Y') . '_' . $request->input('name') . '.' . $extention;

        $path = $tea_img->storeAs('public/images', $filename);
        // This code updates/changes the info to whatever the user put in and saves it in the DB.
        $tea->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'description' => $request->description,
            'price' => $request->price,
            'tea_img' => $filename,
            'location' => $request->location
        ]);

        return to_route('admin.teas.show', $tea)->with('success', 'Tea updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tea $tea)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $tea->delete();

        return to_route('admin.teas.index', $tea)->with('success', 'Tea deleted successfully');
    }
}
