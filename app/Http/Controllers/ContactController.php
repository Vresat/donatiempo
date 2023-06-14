<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailable;
use App\Models\User;
use App\Notifications\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('user.about');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'asunto' => 'required',
            'body' => 'required',
        ]);
        $contacto = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'asunto' => $request->input('asunto'),
            'body' => $request->input('body'),
        ];
        try {
            $admin = User::select('id', 'email')->where('is_admin', '1')->first();
            $admin->notify(new ContactNotification($contacto));
            //$correo=new ContactMailable($request->all());
            //Mail::to($admin->email)->send($correo);
        } catch (\Exception $e) {
            abort(404);
        }
        return to_route('home')->with('status', 'Mensaje enviado con exito');
    }
    public function show($notification)
    {
        try {
            $notification = auth()->user()->notifications->find($notification);
            auth()->user()->notifications->find($notification)->delete();
        } catch (\Exception $e) {
            abort(404);
        }
        return view('admin.contact', compact('notification'));
    }
}
