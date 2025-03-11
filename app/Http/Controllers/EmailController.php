<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function sendemail(){
        $name = 'BATMINTON SHOP';
        $toEmail = 'nguyenhoang23504@gmail.com';
        Mail::send('emails.registersuccess',compact('name','toEmail'),function($email)
        use($name,$toEmail)
        {
            $email->subject('DEMO');
            $email->to($toEmail,$name);
        });
    }
}
