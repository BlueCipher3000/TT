<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function sendemail(){
        $name = 'BATMINTON SHOP';
        $toEmail = 'bienngu2003@gmail.com';
        Mail::send('emails.registersuccess',compact('name','toEmail'),function($email)
        use($name,$toEmail)
        {
            $email->subject('DEMO');
            $email->to($toEmail,$name);
        });
    } public function sendemailforgotpassword(Request $request){
        $name = 'BATMINTON SHOP';
        Mail::send('emails.registersuccess',compact('name','toEmail'),function($email)
        use($request,$name)
        {
            $email->subject('DEMO');
            $email->to($request->email,$name);
        });
    }
}
