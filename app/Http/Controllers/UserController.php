<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profile;
use storage\public;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware(['seeker','verified']);
    }

    public function index(){
        return view('profile.index');
    }

    public function store(Request $request){
        $this->validate($request,[
            'address'=>'required',
            'bio'=>'required|min:20',
            'experience'=>'required|min:20',
            'phone_number'=>'required|numeric|digits:10',
        ]);
        $user_id=auth()->user()->id;
        profile::where('user_id',$user_id)->update([

            'address'=>request('address'),
            'experience'=>request('experience'),
            'bio'=>request('bio'),
            'phone_no'=>request('phone_number'),
        ]);
        return redirect()->back()->with('message',"profile updated successfully");
    }

    public function coverletter(Request $request){
        $this->validate($request,[
            'cover_letter'=>'required|mimes:pdf,doc,docx|max:2000'
        ]);
        $user_id=auth()->user()->id;
        $cover=$request->file('cover_letter');
        if ($cover!=Null)
           { $cover=$request->file('cover_letter')->store('public/files');

            profile::where('user_id',$user_id)->update([

                'cover_letter'=>$cover
            ]);

            return redirect()->back()->with('message',"Cover letter updated successfully");
        }
        return redirect()->back()->with('warning',"Please select a file");

       
            

    }

    public function resume(Request $request){
        $this->validate($request,[
            'resume'=>'required|mimes:pdf,doc,docx|max:2000'
        ]);
        $user_id=auth()->user()->id;
        $resume=$request->file('resume');
        if ($resume!=NULL)
        {
            $resume=$request->file('resume')->store('public/files');

            profile::where('user_id',$user_id)->update([

                'resume'=>$resume
            ]);

            return redirect()->back()->with('message',"Resume updated successfully");
        }
        return redirect()->back()->with('warning',"Please select a file");

    }

    public function avatar(Request $request){
        $this->validate($request,[
            'avatar'=>'required|mimes:png,jpeg,jpg|max:2000'
        ]);
        $user_id=auth()->user()->id;
        if($request->hasfile('avatar')){
            $file=$request->file('avatar');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('uploads/avatar/',$filename);

            profile::where('user_id',$user_id)->update([

                'avatar'=>$filename,
            ]);
            return redirect()->back()->with('message',"profile picture updated successfully");

        }
    }
    
}


