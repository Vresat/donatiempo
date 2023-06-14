<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $cast=[
        'created_at'=>'datetime'
    ];
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }
    public function getFormattedDate()
    {
        return $this->created_at->format('j F Y');

    }
}
