<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index(){
        return view('register.register');
    }
    public function createaccout(Request $request){
        $image = $request->file('img');
        $imgName = $image->getClientOriginalName(); 
        if($request->role == 1){
            $image->move(public_path('storage'), $imgName);
        }else{
            $image->move(public_path('storage/imgusers'), $imgName);
        }
        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'img' => $imgName,
            'role' => $request->role,
            'statu' => $request->statu,
        ]);
        if($user){
            //chuyen den form cua user
            // return redirect()->route('qlkhachhang.index');
            return redirect()->route('email.sendemail');
        }else{
            echo "Không thành công";
        }
    }
}
