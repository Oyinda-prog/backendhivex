<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Students extends Model
{
    use HasFactory;
    protected $fillable=[
        'fullname','email','password'
    ];
//     public function setPasswordAttribute($value)
// {
//     $this->attributes['password'] = bcrypt($value);
// }

    protected $primaryKey='student_id';
    protected $table='students_table';
    
 
    public function keepnotes(){
        return $this->hasMany(keepnote::class,'student_id');
    }
    public function posts(){
        return $this->hasMany(Posts::class,'student_id');
    }
    public function followers(){
        return $this->hasMany(Followers::class,'follower_id');
    }
    // public function comments(){
    //     return $this->hasMany(Comments::class,'student_id');
    // }
    
}
