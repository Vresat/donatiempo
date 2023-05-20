<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::query()->where('active', '=', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('home', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('ads.forms', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ad = new Ad;
        $ad->name = $request->input('name');
        $ad->body = $request->input('body');
        $ad->city = $request->input('city');
        $categories = Category::all();
        foreach ($categories as $category) {
            if ($category->name == $request->input('category')) {
                $ad->category_id = $category->id;
            }
        }
        $ad->active = true;
        $ad->user_id = Auth::user()->id;
        $ad->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        if (!$ad->active) {
            throw new NotFoundHttpException();
        }
        $next = Ad::query()
            ->where('active', '=', true)
            ->where('created_at', '<', $ad->created_at)
            ->orderBy('created_at', 'desc')
            ->limit(1)->first();

        $prev = Ad::query()
            ->where('active', '=', true)
            ->where('created_at', '>', $ad->created_at)
            ->orderBy('created_at', 'asc')
            ->limit(1)->first();
        return view('ad.view', compact('ad', 'prev', 'next'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        //
    }

    public function byCategory($category)
    {
        /* $ads = DB::table('ads')
            ->join('categories', 'categories.id', '=', 'ads.category_id')
            ->where('ads.category_id','=',$category->id)
            ->where('ads.active', '=', true)
            ->orderBy('ads.created_at','desc')
            ->paginate(5);
*/
        $ads = Ad::query()->select('ads.*')
                ->leftJoin('categories', 'ads.category_id', '=', 'categories.id')
                ->where('ads.category_id', '=', $category)
                ->where('ads.active', '=', true)
                ->orderBy('ads.created_at', 'desc')
                ->paginate(5);
                
            
        return view('home', compact('ads'));
    }
}
