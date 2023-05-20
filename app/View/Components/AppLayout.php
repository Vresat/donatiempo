<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        $categories= DB::table('categories')
        ->select('categories.name')
        ->join('ads','ads.category_id','=','categories.id')
        ->selectRaw('categories.name, COUNT(*) AS total')
        ->groupBy('categories.name')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

        return view('layouts.app',compact('categories'));
    }
}
