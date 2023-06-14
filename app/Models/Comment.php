<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function commentsDo(){
        return $this->belongsTo(User::class,'userDo_id','id');
      }
      public function commentsReceive(){
        return $this->belongsTo(User::class,'userReceive_id','id');
      }
      public function shortBody():string{
        return Str::words(strip_tags($this->body),6);
    }
}
