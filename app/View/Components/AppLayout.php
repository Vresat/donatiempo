<?php

namespace App\View\Components;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function __construct(
        public string $title='',
        public string $metaDescription='',
    ) {}
    public function render()
    {
        try{
        $categories= Category::query()
        ->select('categories.name','categories.id')
        ->where('categories.active','1')
        ->join('ads','ads.category_id','=','categories.id')
        ->selectRaw('categories.name, COUNT(*) AS total')
        ->groupBy('categories.name','categories.id')
        ->orderByDesc('total')
        ->get();
        if(Auth::check()){
            $notification=auth()->user()->unreadNotifications->count();
        }else $notification=null;
        $cities=DB::table('ads')->select('city')->distinct()->get();
        }catch(\Exception $e){
            abort(404);
        }

        return view('layouts.app',compact('categories','notification','cities'));
    }
}
