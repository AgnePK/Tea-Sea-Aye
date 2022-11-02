<?php

namespace App\Http\Controllers;

use App\Models\Tea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTeaRequest;   
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
        //This will show all the teas i have in the DB, it will show them by the latest update (recent first) and only show max 5 on page 1
        $teas = Tea::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        // dd($teas);
        return view('teas.index')->with('teas', $teas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //directs click to the create.blade.php page
        return view('teas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validating all the input fields and adding custom lengths
        $request->validate([
            'name' => 'required|max:50',
            'brand' => 'required|max:50',
            'description' => 'required|max:500',
            'price' => 'required|max:15',
            'tea_img' => 'file|image',
            'location' => 'required|max:120'
        ]);
        $tea_img = $request->file('tea_img');
        $extention = $tea_img->getClientOriginalExtension();

        //Changed the date formar to day-month-year
        $filename = date('d-m-Y') . '_' . $request->input('name') . '.'. $extention;

        //saying where to store the new images 
        $path = $tea_img->storeAs('public/images', $filename);

        //creating (well... adding) a new tea
        Tea::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'tea_img' => $filename,
            'location' => $request->location,
            'user_id' => Auth::id()
        ]);

        return to_route('teas.index')->with('success','Note created successfully');
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
        $tea = Tea::where('id', $tea->id)->where('user_id',Auth::id())->firstOrFail();
        return view('teas.show')->with('tea', $tea);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tea $tea)
    {
        if($tea->user_id != Auth::id()) {
            return abort(403);
        }
        return view('teas.edit')->with('tea', $tea);
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
        if($tea->user_id != Auth::id()) {
            return abort(403);
        }
        $request->validate([
            'name' => 'required|max:50',
            'brand' => 'required|max:50',
            'description' => 'required|max:500',
            'price' => 'required|max:15',
            'tea_img' => 'file|image',
            'location' => 'required|max:120'
        ]);    
        $tea_img = $request->file('tea_img');
        $extention = $tea_img->getClientOriginalExtension();

        $filename = date('d-m-Y') . '_' . $request->input('name') . '.'. $extention;

        $path = $tea_img->storeAs('public/images', $filename);
        $tea->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request-> price,
            'tea_img' =>$filename,
            'location' => $request-> location
        ]);

        return to_route('teas.show', $tea)->with('success','Tea updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tea $tea)
    {
        if($tea->user_id != Auth::id()) {
            return abort(403);
        }

        $tea->delete();

        return to_route('teas.index', $tea)->with('success','Tea deleted successfully');
    
    }
}
