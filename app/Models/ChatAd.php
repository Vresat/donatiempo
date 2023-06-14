<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatAd extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $cast=[
        'created_at'=>'datetime'
    ];

    public function ad() : BelongsTo
    {
        return $this->belongsTo(Ad::class,'id','ad_id');
    }
    public function senders() : HasMany
    {
        return $this->hasMany(User::class,'id','sender_id');
    }
    public function adressers() : HasMany
    {
        return $this->hasMany(User::class,'id','adresser_id');
    }
    

}
