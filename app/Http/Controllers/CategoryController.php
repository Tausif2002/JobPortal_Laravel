<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\category;

class CategoryController extends Controller
{
    //
    public function index($id){
        $jobs=Job::where('category_id',$id)->get();
        $categoryName=category::where('id',$id)->first();
        return view('jobs.jobs-category',compact('jobs','categoryName'));
    }
}
