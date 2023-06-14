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
        try{
        $categories= Category::query()
                    ->select('categories.id','categories.name')
                    ->where('categories.active','1')
                    ->join('ads','ads.category_id','=','categories.id')
                    ->selectRaw('categories.name, COUNT(*) AS total')
                    ->groupBy('categories.id','categories.name')
                    ->orderByDesc('total')
                    ->get();
        }catch(\Exception $e){
            abort(404);
        }        
        return view('components.sidebar',compact('categories'));
    }
}
