<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(Request $request){
        $user = User::where('name',$request->name)->first();
        
        // Thử đăng nhập
        if ($user) {//kiểm tra tài khoản
            if($request->password==$user->password){
                if($user->role == 1){
                    return view('admin.quantri');
                }
                else{
                    //trang user
                }
            }else{
                return redirect()->route('login')->withErrors(['login' => 'Sai tài khoản hoặc mật khẩu!']);
            }
        }else{
            return redirect()->route('login')->withErrors(['login' => 'Sai tài khoản hoặc mật khẩu!']);
        }

    }

}
