
<div class="py-5 mt-2">
            <form action="{{route('sendMessage',$ad)}}" method="POST">
                @csrf
                <input class="w-full bg-gray-300 py-5 px-3 rounded-xl" type="text" name="body" placeholder="Escribe tu mensaje aqui..." />
                <input type="hidden" name="adresser" value="{{isset($messageAd) ? $messageAd['0']->sender_id : (isset($senderNotification) ? $senderNotification : $ad->user_id)}}" />
                <div x-data={submit:true} class="flex justify-end mt-4">
                    <button @click="submit=false" :class="submit ? '' : 'hidden'" class="px-4 py-2 bg-blue-400 text-gray-200 rounded-md hover:bg-indigo-500 focus:outline-none focus:bg-gray-700">Enviar</button>
                </div>
            </form>
</div>
