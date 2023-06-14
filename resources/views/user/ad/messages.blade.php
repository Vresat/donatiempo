
<div class="container mx-auto shadow-lg rounded-lg">
    <div class="px-5 py-5 flex justify-between items-center bg-blue-700 border-b-2">
        <h3 class="font-bold text-white">Mensajes</h3>
    </div>
    @if(!is_null($messageAds))
        @if(Auth::user()->id == $ad->user_id)
    <div class="w-full px-5 flex flex-col justify-between">
        @foreach($messageAds as $messageAd)
        <div x-data="{ open: false }">
        
            <img src="{{App\Models\User::find($messageAd[0]->sender_id)->avatar}}" class="object-cover mx-1 rounded-full shadow h-8 w-8 mt-2">
            
            <button @click="open = ! open" class="rounded-[10px] p-2 mt-2 mb-1 text-blue-800 border-4 border-blue-800 font-extrabold ">{{App\Models\User::find($messageAd[0]->sender_id)->name}}</button>
            <div x-show="open" @click.outside="open = false" class="flex flex-col mt-5">
                @foreach($messageAd as $messages)
                <div class="flex {{$messages->sender_id==Auth::user()->id ? 'justify-end':'justify-start'}} mb-4">
                    <div class="mr-2 py-3 px-4 {{$messages->sender_id==Auth::user()->id ? 'bg-blue-400' : 'bg-gray-400' }} rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                        {{$messages->body}}
                    </div>
                </div>
                @endforeach
                @if(Auth::check())
                <x-users.chat-form :$ad :$messageAd/>
                @endif
            </div>
        </div>
        @endforeach
    </div>
        @else
    <div class="w-full px-5 flex flex-col justify-between">
        <div class="flex flex-col mt-5">
            @foreach($messageAds as $messages)
            <div class="flex {{$messages->sender_id==Auth::user()->id ? 'justify-end':'justify-start'}} mb-4">
                <div class="mr-2 py-3 px-4 {{$messages->sender_id==Auth::user()->id ? 'bg-blue-400' : 'bg-gray-400' }} rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                    {{$messages->body}}
                </div>
            </div>
            @endforeach
        </div>
            @if(Auth::check())
            <x-users.chat-form :$ad/>
            @endif
        @endif
    @else
        @if((Auth::check()) && (auth()->user()->id != $ad->user_id))
        <x-users.chat-form :$ad/>
        @endif
        @endif
    
</div>