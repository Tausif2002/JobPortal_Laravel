<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\job;
use App\Models\company;
use App\Models\category;
use Auth;
use App\Http\Requests\JobPostRequest;

class JobController extends Controller
{
    public function __construct(){
        $this->middleware(['employer','verified'],['except'=>array('index','show','apply','alljobs')]);
    }

    public function index(){
        $jobs=job::latest()->limit(10)->where('status',1)->get();
        $categories=category::with('jobs')->paginate(10);
        
        $companies=Company::get()->random(12);
        return view('welcome',compact('jobs','companies','categories'));

    }

    public function show($id,Job $job){

        $jobRecommendations = $this->jobRecommendations($job);

        return view('jobs.show',compact('job','jobRecommendations'));
    }

    public function jobRecommendations($job){
        $data = [];
        
        $jobsBasedOnCategories = Job::latest()->where('category_id',$job->category_id)
                             ->whereDate('last_date','>',date('Y-m-d'))
                             ->where('id','!=',$job->id)
                             ->where('status',1)
                             ->limit(6)
                             ->get();
        array_push($data,$jobsBasedOnCategories);
                           
        $jobBasedOnCompany = Job::latest()
                                ->where('company_id',$job->company_id)
                                ->whereDate('last_date','>',date('Y-m-d'))
                                ->where('id','!=',$job->id)
                                ->where('status',1)
                                ->limit(6)
                                ->get();
            array_push($data,$jobBasedOnCompany);

        $jobBasedOnPosition= Job::where('position','LIKE','%'.$job->position.'%')                 ->where('id','!=',$job->id)
                                ->where('status',1)
                                ->limit(6);
            array_push($data,$jobBasedOnPosition);

       $collection  = collect($data);
       $unique = $collection->unique("id");
       $jobRecommendations =  $unique->values()->first();
       return $jobRecommendations;
    }
    public function create(){
        
        return view('jobs.create');
    }

    public function myjob(){

        $jobs=Job::where('user_id',auth()->user()->id)->get();

        return view('jobs.myjob',compact('jobs'));
    }

    public function edit($id){
        $job=Job::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id){
        $job=Job::findOrFail($id);
        $job->update($request->all());
        return redirect()->back()->with('message',"Job updated successfully");

    }

    public function applicant(){
        $applicants=Job::has('users')->where('user_id',auth()->user()->id)->get();
        return view('jobs.applicants',compact('applicants'));
    }

    public function store(JobPostRequest $request){
        
        $user_id=auth()->user()->id;
        $company=Company::where('user_id',$user_id)->first();
        $company_id=$company->id;
        Job::create([
            'user_id'=>$user_id,
            'company_id'=>$company_id,
            'title'=>request('title'),
            'slug'=>str_slug(request('title')),
            'description'=>request('description'),
            'roles'=>request('role'),
            'job_type'=>request('type'),
            'category_id'=>request('category'),
            'position'=>request('position'),
            'address'=>request('address'),
            'status'=>request('status'),
            'last_date'=>request('last_date'),
            'number_of_vacancy'=>request('number_of_vacancy'),
            'gender'=>request('gender'),
            'experience'=>request('experience'),
            'salary'=>request('salary')

        ]);

        return redirect()->back()->with('message',"Job created successfully");
    }


    public function apply(Request $request,$id){
        $jonId=Job::find($id);
        $jonId->users()->attach(Auth::user()->id);
        return redirect()->back()->with('message',"Application sent successfully");
    }

    public function alljobs(Request $request){

         
     //front search
     $search = $request->get('search');
     $address = $request->get('address');
     if($search && $address){
        $jobs = Job::where('position','LIKE','%'.$search.'%')
                 ->orWhere('title','LIKE','%'.$search.'%')
                 ->orWhere('job_type','LIKE','%'.$search.'%')
                 ->orWhere('address','LIKE','%'.$address.'%')
                 ->paginate(20);

         return view('jobs.alljobs',compact('jobs'));

     }



        $keyword=$request->get('title');
        $type=$request->get('job_type');
        $category=$request->get('category_id');
        $address=$request->get('address');
        
        if( $keyword){
            $jobs=job::where('title','like','%'.$keyword.'%')->paginate(10);
            
            return view('jobs.alljobs',compact('jobs'));
        }
        if($type){
            $jobs=job::where('job_type',$type)->paginate(10);
            return view('jobs.alljobs',compact('jobs'));
        }
        if($category){
            $jobs=job::where('category_id',$category)->paginate(10);
            return view('jobs.alljobs',compact('jobs'));
        }
        if( $address){
            $jobs=job::where('address','like','%'.$address.'%')->paginate(10);
            
            return view('jobs.alljobs',compact('jobs'));
        }
        else{
        $jobs=job::latest()->paginate(10);
        return view('jobs.alljobs',compact('jobs'));
        }
    }
}
