<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    //
    public function index(){
        return view('forgotpassword.submittoken');
    }
    public function submit_token_to_email(Request $request){//gui token đến email
        $token = Str::random(10);
        $user = User::where('email','LIKE',$request->email)->first();//lưu token vưa tao vao user
        $user->update([
            'token' => $token,
        ]);
        $sendemail = Mail::send('emails.codesubmitform',compact('user'), function($email) 
        use($user)
        {
            $email->subject('BATMINTON SHOP - MÃ XÁC NHẬN');
            $email->to($user->email);
        });
        if($sendemail){
            return redirect()->route('forgotpassword.confirmcode',['user'=>$user]);
            //sau khi hiển thị thành công thì show form nhập mã (hàm confirmcode())
        }
    }
    public function forgotpassword(User $user){//hien thi form tao moi mat khau
        return view('forgotpassword.passwordresetform',compact('user'));
    }

    public function confirmcode(User $user){//show form xác nhập mã
        return view('forgotpassword.confirmcode',compact('user'));
    }

    public function check_confirmation_code(Request $request,User $user){//kiem tra ma khi nhan nut xac nhan
        if($request->code === $user->token){
            return redirect()->route('forgotpassword.forgotpassword',['user'=>$user]);
        }else{
            return back()->with('error', 'Mã xác nhận không đúng!');
            //hien thi lỗi
        }
    }
    public function resetpassword(Request $request,User $user){//update mật khẩu và kiểm tra mật khẩu xem đúng không
        if($request->password === $request->password_confirmation){
            $user->update([
                'password' => $request->password,
            ]);
            return redirect()->route('login.index');
        }else{
            return back()->with('error', 'Mật khẩu xác nhận không đúng!');
        }
    }
}
