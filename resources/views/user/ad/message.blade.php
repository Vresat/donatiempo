
<div class="container mx-auto shadow-lg rounded-lg mt-2">
    
<div class="px-5 py-5 flex justify-between items-center bg-blue-700 border-b-2">
        <h3 class="font-bold text-white">Mensajes</h3>
    </div>
    @if(!is_null($messageAds))
        @if(Auth::user()->id == $ad->user_id)
            <div class="w-full px-5 flex flex-col justify-between">
             @foreach($messageAds as $messages)
                <div class="flex {{$messages->sender_id==Auth::user()->id ? 'justify-end':'justify-start'}} mb-4">
                    <div class="mr-2 mt-2 py-3 px-4 {{$messages->sender_id==Auth::user()->id ? 'bg-blue-700' : 'bg-gray-500' }} rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                        {{$messages->body}}
                    </div>
                </div>
            @endforeach
            </div>
            @if(Auth::check())
                <x-users.chat-form :$ad :$messageAds :$senderNotification></x-add-item>
            @endif
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
                    <x-users.chat-form :$ad></x-add-item>
                @endif
        @endif
    @else
        @if(Auth::check())
            <x-users.chat-form :$ad></x-add-item>
        @endif
    @endif
    
</div>