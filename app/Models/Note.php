<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $primarykey='note_id';
    protected $table='keepnotes';
    protected $Fillable=[
        'title','content'
    ];
public function student(){
    return $this->belongsTo(Students::class,'student_id');
}
}
