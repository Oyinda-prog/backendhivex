<?php

namespace App\Models;

use App\Http\Controllers\GroupPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $primaryKey='group_id';
    protected $fillable=['student_id','uniquenumber'];
    public function grouppost(){
        return $this->hasMany(GroupPost::class,'uniquenumber','uniquenumber');
    }
     public function grouppostinvite(){
        return $this->hasMany(GroupPostInvite::class,'uniquenumber','uniquenumber');
    }
    // public function likes(){
    //     return $this->hasMany(Likes::class,'post_id');
    // }
    // public function followers(){
    //     return $this->hasMany(Followers::class,'follower_id');
    // }
    // public function replies(){
    //     return $this->hasMany(Reply::class,'post_id');
    // }
}
