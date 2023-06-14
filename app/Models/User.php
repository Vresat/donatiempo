<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Type\Integer;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   public function ads(){
        return $this->hasMany(Ad::class);
   }

   public function chatSenders(){
        return $this->hasMany(ChatAd::class,'sender_id','id');
   }

   public function chatAdressers(){
    return $this->hasMany(ChatAd::class,'adresser_id','id');
  }
  
  public function commentsDoes(){
    return $this->hasMany(Comment::class,'userDo_id','id');
  }
  public function commentsReceives(){
    return $this->hasMany(Comment::class,'userReceive_id','id');
  }
  
  public function rating():int{
    $ratings=0;
    $comments=$this->commentsReceives;
    foreach($comments as $comment){
      $ratings=$ratings + $comment->rating;
    }
    $numRatings=$this->commentsReceives->count();
    $media=$ratings/$numRatings;
    return $media;
  }
  public function comments():Collection{

    $comments=Comment::select('*')->where('userReceive_id',$this->id)->orderBy('created_at','desc')->limit(2)->get();
    
    return $comments;
  }
  public function userComment($comment):User{

    $user=User::select('name','avatar')->where('id',$comment->userDo_id)->first();
    return $user;
  } 
}
