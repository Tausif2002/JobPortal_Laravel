<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable=['user_id','company_id','title','slug','description','category_id','roles','position','address','job_type','status','last_date','number_of_vacancy','experience','gender'.'salary'];

    use HasFactory;
    public function getRouteKeyName(){
        return 'slug';
    }

    public function company(){
        return $this->belongsTo('App\Models\company');
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimeStamps();
    }

    public function checkApplication(){
       return \DB::table('job_user')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
    }

    public function favourites(){
        return $this->belongsToMany(User::class)->withTimeStamps();
    }

    public function checkSaved(){
        return \DB::table('favourites')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
     }


}
