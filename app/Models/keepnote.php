<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keepnote extends Model
{
    use HasFactory;
    protected $table="keepnotes";
    protected $primaryKey = 'id';
    

   protected $fillable = [
        'title',
        'description',
        'student_id'
    ];

    public function student(){
        return $this->belongsTo(Students::class,'student_id');
    }
}
