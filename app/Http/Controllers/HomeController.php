<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin')){
            $home = 'admin.teas.index';
        }
        else if ($user->hasRole('user')){
            $home = 'users.teas.index';
        }
        return redirect()->route($home);
    }

    public function brandIndex(Request $request)
    {

        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin')){
            $home = 'admin.brands.index';
        }
        else if ($user->hasRole('user')){
            $home = 'user.brands.index';
        }
        return redirect()->route($home);
    }

}
