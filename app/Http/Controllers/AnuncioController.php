<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::query()->select('*')->orderBy('created_at','desc')
        ->paginate(5);
    return view('admin.tables', compact('ads'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ad $ad)
    {
        return view('admin.show',['ad'=>$ad]);
    }

    public function actDesactivar(Ad $ad)
    {
        try{
        $ad->active ? $ad->active=false : $ad->active=true;    
        $ad->save();
        }catch(\Exception $e){
            abort(404);
        }
        return to_route('adminIndex');
    }
   
    public function users()
    {
        try{
        $users = User::query()->select()->orderBy('created_at','desc')
        ->paginate(5);
        }catch(Exception){
            abort(404);
        }
    return view('admin.index', compact('users'));
    }

    public function showUser(User $user)
    {
        return view('admin.form',['user'=>$user]);
    }

    public function about(){
        return view('user.about');
    }
    
    public function storeUser(Request $request,User $user)
    {
        
        $request->validate([
            'name' => ['required','alpha_num:ascii'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'admin' => ['required','boolean'],
            'activo' => ['required','boolean'],
        ]);
        try{
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_admin = $request->input('admin');
        if($request->input('activo')==0){
            $user->active = $request->input('activo');
            $user->ads()->update(['active'=>'0']);
        }else{
            $user->active = $request->input('activo');
            $user->ads()->update(['active'=>'1']);
        }
        $user->save();
        session()->flash('status', 'Usuario Editado!!');
    }catch(\Exception $e){
        abort(404);
    }
        return to_route('adminIndex');
    }

}
