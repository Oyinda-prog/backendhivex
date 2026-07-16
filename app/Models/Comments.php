<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $primaryKey='id';
    
    public function post(){
        return $this->belongsTo(Posts::class,'post_id');
    }
    public function student(){
        return $this->belongsTo(Students::class,'student_id');
    }
    public function replies(){
        return $this->hasMany(Reply::class,'comment_id');
    }
}
