<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\ChatAd;
use App\Models\Comment;
use App\Models\MensajeChat;
use App\Models\Message;
use App\Models\MessageAd;
use App\Models\User;
use App\Notifications\NewAdNotification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Storage;


class AdController extends Controller
{

    public function check()
    {

        if (Auth::check()) {
            try {
                $chats = Auth::user() ? Auth::user()->chatSenders : NULL;
                if ($chats = NULL) {
                    foreach ($chats as $chat) {
                        $adsids[] = $chat->ad_id;
                    }
                } else {
                    $adsids = null;
                }
            } catch (\Exception $exception) {
                abort(404);
            }
        } else $adsids = null;

        return $adsids;
    }

    public function index()
    {
        try {
            $ads = Ad::query()->where('active', '=', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
            $adsids = $this->check();
        } catch (\Exception $exception) {
            abort(404);
        }
        return view('home', compact('ads', 'adsids'));
    }

    public function create()
    {
        try {
            $categories = Category::select('*')->where('active', '1')->get();
        } catch (\Exception $e) {
            abort(404);
        }
        return view('user.forms', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','alpha_num:ascii'],
            'body' => ['required'],
            'city' => ['required','alpha_num:ascii'],
            'category' => ['required','alpha_num:ascii'],
            'image' => 'nullable|image|max:2048',
        ]);
        try {
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
            $ad->active = 1;
            if (!$request->file('image') == NULL) {
                $image = $request->file('image')->store('public/images');
                $img = Storage::url($image);
                $ad->image = $img;
            }
            $ad->user_id = Auth::user()->id;
            $ad->save();
            $admin = User::select('id', 'email')->where('is_admin', '1')->first();
            $admin->notify(new NewAdNotification($ad->id));
            session()->flash('status', 'Anuncio Creado!!');
            $adsids = $this->check();
        } catch (\Exception $e) {
            abort(404);
        }
        return to_route('home')->with($adsids);
    }


    public function show(Ad $ad, $senderNotification = null)
    {
        try {
            if ($senderNotification != null) {
                foreach (auth()->user()->unreadNotifications as $notification) {
                    if ($notification->data['sender_id'] == $senderNotification) {
                        $notification->delete();
                    }
                }
            }

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

            if (auth()->user() != NULL && Auth::user()->id == $ad->user_id) {
                $chatAds = ChatAd::select('*')->where('ad_id', '=', $ad->id)->get();
                if ($chatAds->count() > 0) {
                    if ($senderNotification == NULL) {
                        $senders = [];
                        foreach ($chatAds as $chatAd) {
                            if (in_array($chatAd->sender_id, $senders) != true && $chatAd->sender_id != Auth::user()->id) {
                                $senders[] = $chatAd->sender_id;
                            }
                        }
                        foreach ($senders as $sender) {
                            $messageAds[] = ChatAd::select('chat_ads.*')
                                ->where('ad_id', '=', $ad->id)
                                ->where(function ($query) use ($sender) {
                                    $query->where('sender_id', '=', $sender)
                                        ->orWhere('adresser_id', '=', $sender);
                                })->orderBy('created_at')->get();
                        }
                    } else {
                        $messageAds = ChatAd::select('chat_ads.*')
                            ->where('ad_id', '=', $ad->id)
                            ->where(function ($query) use ($senderNotification) {
                                $query->where('sender_id', '=', $senderNotification)
                                    ->orWhere('adresser_id', '=', $senderNotification);
                            })->orderBy('created_at')->get();
                    }
                } else {
                    $messageAds = NULL;
                }
            } else {
                if (auth()->user() != NULL) {
                    $messageAds = ChatAd::select('*')->where('ad_id', '=', $ad->id)
                        ->where(function ($query) {
                            $query->where('sender_id', '=', Auth::user()->id)
                                ->orWhere('adresser_id', '=', Auth::user()->id);
                        })->orderBy('created_at')->get();

                    if ($messageAds->count() == 0) {
                        $messageAds = NULL;
                    }
                } else {
                    $messageAds = NULL;
                }
            }
        } catch (\Exception $e) {
            abort(404);
        }
        return view('user.ad.view', compact('ad', 'prev', 'next', 'messageAds', 'senderNotification'));
    }

    public function edit(Ad $ad)
    {
        try {
            $categories = Category::all();
        } catch (\Exception $e) {
            abort(404);
        }
        return view('user.editar', ['ad' => $ad, 'categories' => $categories]);
    }


    public function update(Request $request, Ad $ad)
    {

        $request->validate([
            'name' => ['required','alpha_num:ascii'],
            'body' => ['required'],
            'city' => ['required','alpha_num:ascii'],
            'category' => ['required','alpha_num:ascii'],
        ]);
        try {
            $ad->name = $request->input('name');
            $ad->body = $request->input('body');
            $ad->city = $request->input('city');
            $categories = Category::all();
            foreach ($categories as $category) {
                if ($category->name == $request->input('category')) {
                    $ad->category_id = $category->id;
                }
            }
            $ad->active = $request->input('activo');
            $ad->user_id = Auth::user()->id;
            $ad->save();
            session()->flash('status', 'Anuncio Editado!!');
        } catch (\Exception $e) {
            abort(404);
        }
        return to_route('user.table');
    }


    public function destroy(Request $request, Ad $ad)
    {
        $request->validate([
            'body' => ['required'],
            'userToComment' => ['required'],
            'rating' => ['required','digits:1'],
        ]);
        try {
            $comment = new Comment();
            $comment->body = $request->input('body');
            $comment->rating = $request->input('rating');
            $comment->userDo_id = $ad->user_id;
            $comment->userReceive_id = $request->input('userToComment');
            $comment->save();
            $ad->delete();
        } catch (\Exception $e) {
            abort(404);
        }
        return to_route('user.table')->with('status', 'anuncio eliminado');
    }

    public function deleteAd(Ad $ad)
    {
        $mensaje = '';
        if (auth()->user()->id == $ad->user_id) {
            $ad->delete();
            $mensaje = 'Anuncio eliminado';
        } else {
            $mensaje = 'No tiene permiso para eliminar el anuncio';
        }
        return to_route('user.table')->with('status', $mensaje);
    }

    public function byCategory(Category $category)
    {
        try {
            $ads = Ad::query()->select('ads.*')
                ->leftJoin('categories', 'ads.category_id', '=', 'categories.id')
                ->where('ads.category_id', '=', $category->id)
                ->where('ads.active', '=', true)
                ->orderBy('ads.created_at', 'desc')
                ->paginate(5);
            $adsids = $this->check();
        } catch (\Exception $e) {
            abort(404);
        }
        return view('home', compact('ads', 'adsids'));
    }
    public function table()
    {
        $ads = Ad::select('*')->where('user_id', '=', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.ad.table', compact('ads'));
    }
    public function close(Ad $ad)
    {
        $arrayUsers = [];
        try {
            $users = $ad->chatAds()->select('sender_id', 'adresser_id')->get();
            foreach ($users as $user) {
                if (!in_array($user->sender_id, $arrayUsers)) {
                    $user->sender_id == $ad->user_id ?: $arrayUsers[] = $user->sender_id;
                }
                if (!in_array($user->adresser_id, $arrayUsers)) {
                    $user->adresser_id == $ad->user_id ?: $arrayUsers[] = $user->adresser_id;
                }
            }
            foreach ($arrayUsers as $user) {
                $usersToComent[] = User::select('id', 'name')->find($user);
            }
        } catch (\Exception $e) {
            abort(404);
        }
        return view('user.close', compact('usersToComent', 'ad'));
    }

    public function filterAd(Request $request)
    {
        $request->validate([
            'city' => ['nullable','alpha_num:ascii'],
            'category' => ['nullable','numeric'],
        ]);
        $city=$request->input('city')!='all' ? $request->input('city') : ''  ;
        $category=$request->input('category')!=0 ? $request->input('category') : ''  ;
        if($city=='' && $category==''){
            return self::index();   
        }elseif($city=='' && $category!=''){
            $ads = Ad::select('*')->where('active', '1')
            ->where('category_id',$category)->orderBy('created_at', 'desc')->paginate(5);
        }elseif($city!=''&& $category==''){
            $ads = Ad::select('*')->where('active', '1')
                                    ->where('city',$city)->orderBy('created_at', 'desc')->paginate(5);
        }else{
            $ads = Ad::select('*')->where('active', '1')
                                    ->where('category_id',$category)
                                    ->where('city',$city)->orderBy('created_at', 'desc')->paginate(5);
        }
        if($request->input('city')==NULL && $request->input('category')==NULL){
            return to_route('home')->with('status','No se han encontrado coincidencias');
         }
         $adsids = $this->check();
         $mensaje= $ads->count()>0 ? 'Mostrando resultados busqueda': 'no se han encontrado coincidencias';
         session()->flash('status', $mensaje);
         return view('home',compact('ads','adsids'));
    }
}
