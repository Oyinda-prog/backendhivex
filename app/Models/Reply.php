<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
     protected $primarykey='id';
    protected $table='replies';
    protected $Fillable=[
        'content','post_id','comment_id','student_id'
    ];
    public function comment(){
        return $this->belongsTo(Comments::class,'comment_id');
    }
    public function post(){
        return $this->belongsTo(Posts::class,'post_id');
    }
    public function student(){
        return $this->belongsTo(Students::class,'student_id');
    }

}
