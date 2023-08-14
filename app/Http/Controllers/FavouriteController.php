<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    //

    public function saveJob($id){
        $joId=Job::find($id);
        $joId->favourites()->attach(auth()->user()->id);
        return redirect()->back();

    }

    public function unsaveJob($id){
        $joId=Job::find($id);
        $joId->favourites()->detach(auth()->user()->id);
        return redirect()->back();
        
    }
}
