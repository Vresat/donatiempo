<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Models\Ad;
use App\Models\ChatAd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create(Request $request, Ad $ad)
    {
        $request->validate([
            'body' => ['required'],
            'adresser'=>['required'],
        ]);
        try{
        $chat = new ChatAd();
        User::find($request->input('adresser'))!=NULL ?
            $chat->adresser_id = $request->input('adresser') : abort(404);
        $chat->sender_id= Auth::user()->id;
        $chat->ad_id = $ad->id;
        $chat->body = $request->input('body');
        $chat->save();
        self::make_chat_notification($chat,$chat->adresser_id);
        session()->flash('status', 'mensaje Enviado!!');
        }catch(\Exception $e){
            abort(404);
        }
        return to_route('home');
    }
    static public function make_chat_notification(ChatAd $chat){
        event(new ChatEvent($chat));

    }
}
