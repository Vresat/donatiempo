<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try{
        $category= Category::get();
        }catch(\Exception){
            abort(404);
        }
        return view('home',['category'=>$category]);
    }

    public function create()
    {
        try{
            $categories= Category::get();
            }catch(\Exception){
                abort(404);
            }
        return view('admin.category',['categories'=>$categories]);
    }

    
    public function store(Request $request)
    {
        try{
        $category=new Category();
        $category->name=$request->input('name');
        $category->active=true;
        $category->save();
        }catch(\Exception $e){
            abort(404);
        }
        return to_route('adminCategory')->with('status','Categoria Creada!!');
    }

    public function actDesactivar(Category $category)
    {
        try{
        if($category->active){ 
            $category->active=false; 
            Ad::where('category_id',$category->id)->update(['active'=>'0']);
        }else{    
            $category->active=true;
            Ad::where('category_id',$category->id)->update(['active'=>'1']);
        }
        $category->save();
        }catch(\Exception $e){
            abort(404);
        }
        return to_route('adminCategory')->with('status','Categoria Modificada!!');
    }

}
