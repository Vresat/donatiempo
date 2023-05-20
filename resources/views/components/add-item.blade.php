<article class="w-full flex flex-col shadow my-4">
                <!-- Article Image -->
                <a href="{{route('view',$ad)}}" class="hover:opacity-75">
                    <img src="$ad->image">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    
                    <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$ad->category->name}}</a>
                    
                    
                    <a href="{{route('view',$ad)}}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$ad->name}}</a>
                    <p href="#" class="text-sm pb-3">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{$ad->user->name}}</a>, Publicado el {{$ad->getFormattedDate()}}</p>
                    <a href="{{route('view',$ad)}}" class="pb-6">{{$ad->shortBody()}}</a>
                    <a href="{{route('view',$ad)}}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                </div>
</article>