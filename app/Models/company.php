<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;

    protected $fillable= [
        'cname','user_id','slug','address','phone','website','logo','cover_photo','slogan','description'
    ];

    public function getRouteKeyName(){
        return 'slug';
    }
    
    public function jobs(){
        return $this->hasMany('App\Models\job');
    }
}
