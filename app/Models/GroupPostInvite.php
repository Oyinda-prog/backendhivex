<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPostInvite extends Model
{
    use HasFactory;
    protected $table = 'group_post_invites';
    protected $primaryKey = 'grouppostinvites_id';
    protected $fillable = [
        'inviter_id', 'invitee_id', 'uniquenumber'
    ];
    public function group(){
        return $this->belongsTo(Group::class,'uniquenumber','uniquenumber');
    }
    public function grouppost(){
        return $this->belongsTo(GroupPost::class,'uniquenumber','uniquenumber');
    }

}
