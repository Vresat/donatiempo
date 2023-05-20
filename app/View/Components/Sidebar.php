<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\View\View;

class Sidebar extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        $categories= DB::table('categories')
                    ->select('categories.name','categories.id')
                    ->join('ads','ads.category_id','=','categories.id')
                    ->selectRaw('categories.name, COUNT(*) AS total')
                    ->groupBy('categories.id','categories.name')
                    ->orderByDesc('total')
                    ->get();

        return view('components.sidebar',compact('categories'));
    }
}
