<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;

    public $successStatus = 200;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function username()
    {
        return 'email';
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    public function login(Request $request) {
        $data = array();

        $user = User::where('user_name', request('user_name'))->first();

        if (isset($user)) {
            if (Auth::guard('web')->attempt(['user_name' => request('user_name'),
                'password' => $request->password])) {

                $data['status'] = 1;
                $data['data'] = $user;
                $data['msg'] = 'تم تسجيل الدخول بنجاح';


            }else {
                $data['status'] = 0;
                $data['msg'] = 'الرجاء التأكد من البيانات المدخلة';
            }
        }else {
            $data['status'] = 0;
            $data['msg'] = 'الرجاء التأكد من البيانات المدخلة';
        }


        return $data;


    }


    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function register(Request $request) {
        $data = array();
        $userEmailCheck = User::where('email' , $request->email)->first();
        if(empty($userEmailCheck)) {
             User::create([
//                   'email' => $data['email'],
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => bcrypt($request->password),
//                'status' => 1,
            ]);

            $data['status'] = 1;
            $data['msg'] = "تم إنشاء الحساب بنجاح";
        }else {
            $data['status'] = 0;
            $data['statusMsg'] = "email_exist";
            $data['msg'] = "الإيميل موجود مسبقا";
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->to('/login');
    }
}
