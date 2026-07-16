<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPost extends Model
{
    use HasFactory;
    protected $primaryKey = 'grouppost_id';
    protected $table = 'group_posts';
    protected $fillable = [
        'content', 'student_id', 'group_id', 'role', 'uniquenumber'
    ];
    
    public function grouppostinvite(){
        return $this->hasMany(GroupPostInvite::class,'uniquenumber','uniquenumber');
    }
    public function group(){
        return $this->belong(Group::class,'uniquenumber','uniquenumber');
    }
}
