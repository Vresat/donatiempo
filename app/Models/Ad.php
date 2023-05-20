<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Ad extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $cast=[
        'created_at'=>'datetime'
    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function shortBody():string{
        return Str::words(strip_tags($this->body),4);
    }

    public function getFormattedDate()
    {
        return $this->created_at->format('j F Y');

    }
}
