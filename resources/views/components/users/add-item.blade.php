<article class="w-full flex flex-col shadow my-4">
                <a href="{{route('view',$ad)}}" class="max-w-lg hover:opacity-75">
                    <img src="{{$ad->image}}">
                </a>
                
                <div class="bg-white flex flex-col justify-start p-6">
                    @isset($adsids)
                    @if(in_array($ad->id,$adsids))
                    <div class="mt-1 mb-1 flex justify-end bg-blu">
                    <label for="check" alt="anuncio respondido">
                    <svg name="check" height="20px" version="1.1" viewBox="0 0 20 20" width="20px" xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g fill="#0000FF" id="Core" transform="translate(-44.000000, -86.000000)"><g id="check-circle" transform="translate(44.000000, 86.000000)"><path d="M10,0 C4.5,0 0,4.5 0,10 C0,15.5 4.5,20 10,20 C15.5,20 20,15.5 20,10 C20,4.5 15.5,0 10,0 L10,0 Z M8,15 L3,10 L4.4,8.6 L8,12.2 L15.6,4.6 L17,6 L8,15 L8,15 Z" id="Shape"/></g></g></g></svg>
                    </label>
                    </div>
                    @endif
                    @endisset
                    <a href="{{route('by-category',$ad->category->id)}}" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$ad->category->name}}</a>
                    
                    
                    <a href="{{route('view',$ad)}}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$ad->name}}</a>
                    <p class="text-sm pb-3">
                        By <a href="{{route('view',$ad)}}" class="font-semibold hover:text-gray-800">{{$ad->user->name}}</a>, Publicado el {{$ad->getFormattedDate()}}</p>
                    <a href="{{route('view',$ad)}}" class="pb-6">{{$ad->shortBody()}}</a>
                    <a href="{{route('view',$ad)}}" class="uppercase text-gray-800 hover:text-black">Ir al anuncio <i class="fas fa-arrow-right"></i></a>
                </div>
</article>