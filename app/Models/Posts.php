<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $primaryKey='id';

    public function student(){
        return $this->belongsTo(Students::class,'student_id');
    }
    public function comments(){
        return $this->hasMany(Comments::class,'post_id');
    }
    public function likes(){
        return $this->hasMany(Likes::class,'post_id');
    }
    public function followers(){
        return $this->hasMany(Followers::class,'follower_id');
    }
    public function replies(){
        return $this->hasMany(Reply::class,'post_id');
    }
    
    
}
