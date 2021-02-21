<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\DeleteUserRequest;
use App\Http\Requests\Admin\Users\FetchUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    public function index(Request $request)
    {

        $data = User::select('id','name','user_name' , 'email')->orderBy('id' , 'desc')->paginate(20);
        if($request->ajax()){
//            $counter = 0;
//            if($request->page > $request->currentPage) {
//                $val = $request->counter * $request->currentPage;
//                $counter = $val+20;
//
//            }elseif ($request->page < $request->currentPage) {
//
//                $val = $request->counter / $request->currentPage;
//
//                $counter = $val-20;
//
//            }
            return View::make('Admin.Users.dataTable')->with(['data' => $data,
//                'counter' => $counter,
//                'currentPage' => $request->currentPage,
//                'newPage' => $request->page,
            ])->render();
        }
        return view('Admin.Users.show' , compact('data'));
    }

    public function store(StoreUserRequest $request) {
        $data = array();
        $user = new User();
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $saved = $user->save();
        if($saved){

            $data['status'] = true;
            $data['msg'] = "تم إضافة البيانات بنجاح";

        }else {
            $data['status'] = false;
            $data['msg'] = "خطأ لم يتم حفظ البيانات";
        }

        return $data;


    }

    public function fetchById(FetchUserRequest $request) {
        $id = $request->input('id');
        $user = User::where('id' ,$id)->first();
        return $user;


    }

    public function update(UpdateUserRequest $request , $id) {
        $id = $request->input('id');

//        Validator::make($request->all(), [
//            'email' => [
//                'required',
//                Rule::unique('users')->ignore($id),
//            ],
//        ]);
//        return $id;

//        Validator::make($data, [
//            'email' => [
//                'required',
//                Rule::unique('users')->ignore($id),
//            ],
//        ]);
        $data = array();
        $user = User::find($id);
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        if($request->password) {
            $user->password = Hash::make($request->password);

        }
        $saved = $user->save();
        if($saved){

            $data['status'] = true;
            $data['msg'] = "تم تعديل البيانات بنجاح";

        }else {
            $data['status'] = false;
            $data['msg'] = "خطأ لم يتم تعديل البيانات";
        }

        return $data;
    }

    public function delete(DeleteUserRequest $request) {
        $data = array();
        $id = $request->input('id');
        $user = User::where('id' ,$id)->delete();

        $data['status'] = true;
        $data['msg'] = "تم حذف البيانات بنجاح";

        return $data;
//        return $user;
    }

    public function addRole() {
        $role = Role::create(['name' => 'admin']);
    }

    public function addPermission() {
        $permission = Permission::create(['name' => 'edit users']);
    }

    public function givePermissionTo() {
        $role = Role::findByName('admin');
        $permission = Permission::where('name' , 'edit users')->first();


        $role->givePermissionTo($permission);
    }

    public function assignRole() {
        $user = User::where('id' , 2)->first();

        $user->assignRole('admin');

//        $user->givePermissionTo('add users');


    }
}
