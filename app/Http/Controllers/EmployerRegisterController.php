<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Hash;

class EmployerRegisterController extends Controller
{
    //
    public function employerRegister(){

        $user= User::create([
            
            'email' => request('email'),
            'user_type'=>request('user_type'),
            'password' => Hash::make(request('password')),
        ]);

        company::create([
            'user_id'=>$user->id,
            'cname'=>request('cname'),
            'slug'=>str_slug(request('cname')),
            
        ]);
        return redirect()->to('login')->with('message','lease verify your email by clicking the link send to your email address');
    }
}
