<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    use HasFactory;
    protected $table='followers';
    protected $primaryKey='id';

    public function student(){
        return $this->belongsTo(Students::class,'follower_id');
    }
    public function post(){
        return $this->belongsToMany(Posts::class,'follower_id');
    }
      public function follower()
    {
        return $this->belongsTo(Students::class, 'follower_id');
    }

    public function following()
    {
        return $this->belongsTo(Students::class, 'following_id');
    }
}
