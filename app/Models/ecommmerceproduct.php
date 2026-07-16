<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ecommmerceproduct extends Model
{
    use HasFactory;
    // protected $fillable=['description','price','name'];
    // protected $primaryKey='product_id';
    // protected $foreignKey='commerceseller_id';

    public function keepnotes(){
        return $this->hasmany(keepnote::class,'student_id');
    }
}
