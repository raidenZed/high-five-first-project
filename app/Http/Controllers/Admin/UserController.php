<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authed');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = User::all();
        return view('Admin.Users.show' , compact('data'));
    }

    public function store(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->save();
        $data = User::all();
        return View::make('Admin.Users.dataTable')->with('data' , $data)->render();

    }

    public function fetchById(Request $request) {
        $id = $request->input('id');
        $user = User::where('id' , $id)->first();

        return $user;
    }
}
