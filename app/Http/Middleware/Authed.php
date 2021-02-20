<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class Authed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $user = new User();
        if(Auth::check()){

            return $next($request);








        }
//        return 'hello';

        return redirect('/login');

//        $users = new User();
//        if(Auth::check()){
//            $user = Auth::user();
//            $data['status'] = 1;
//            $data['data'] = $user;
//            $data['message'] = 'success_auth';
//            //return redirect('ajax/dept');
//            return $next($request);
//        }
//        else {
////            $data['status'] = 0;
////            $data['errors'] = ['invailed_auth_data' => 'invailed_auth_data'];
//            return redirect('/myView/login');
//        }
    }
}
