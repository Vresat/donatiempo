<x-app-layout>
    <section class="w-full md:w-2/3 flex flex-col items-stretch px-3">
        <article class="flex flex-col shadow my-4">
            <a href="" class="hover:opacity-75">
                <img src="{{$ad->image}}">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <a href="{{route('by-category',$ad)}}" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$ad->category->name}}</a>
                <p class="text-3xl font-bold hover:text-gray-700 pb-4">{{$ad->name}}</p>
                <p class="text-sm pb-8">
                    Por <strong class="font-semibold hover:text-gray-800">{{$ad->user->name}}</strong>, Publicado el {{$ad->getFormattedDate()}}
                </p>
                <p class="pb-3 py-2">{{$ad->body}}</p>
            </div>
            @auth
            @if($senderNotification!=NULL)
            @include('user.ad.message')
            @else
            @include('user.ad.messages')
            @endif
            @endauth
        </article>
        <div class="w-full flex pt-6">
            <div class="w-1/2">
                @if($prev)
                <a href="{{route('view',$prev)}}" class="w-1/2 bg-white shadow hover:shadow-md text-left">
                    <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i> Anterior</p>
                    <p class="pt-2">{{$prev->name}}</p>
                </a>
                @endif
            </div>
            <div class="w-1/2">
                @if($next)
                <a href="{{route('view',$next)}}" class="w-1/2 bg-white shadow hover:shadow-md text-right">
                    <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Siguiente <i class="fas fa-arrow-right pl-1"></i></p>
                    <p class="pt-2">{{$next->name}}</p>
                </a>
                @endif
            </div>
        </div>

        <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
            <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                <img src="{{$ad->user->avatar}}" class="object-cover mx-1 rounded-full shadow h-20 w-20 ">
            </div>
            <div class="flex-1 flex flex-col justify-center md:justify-start">
                <p class="font-semibold text-2xl">{{$ad->user->name}}</p>

                @if(!$ad->user->comments()->isEmpty())
                <div x-data="{rating:'{{$ad->user->rating()}}' }" class="pt-2">
                    <ul class="flex justify-left">
                        <template x-for="i in 5">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" x-bind:fill="(i<=rating) ? 'blue' : 'none'" x-bind:stroke="(i>=rating) ? 'blue' : 'none'" class="mr-1 h-5 w-5 text-warning">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                </svg>
                            </li>
                        </template>
                    </ul>
                </div>
                <p class="pt-1">Ultimos comentarios</p>
                
                <div class="flex flex-row justify-start">
                @foreach($ad->user->comments() as $comment)
                    <div class="w-1/2">
                        <div class="m-4 block rounded-lg bg-white p-6 shadow-lg dark:bg-neutral-800 dark:shadow-black/20">
                            <div class="md:flex md:flex-row">
                                <div class="mx-auto mb-6 flex w-16 items-center justify-center md:mx-0 md:w-16 lg:mb-0">
                                    <img src="{{$ad->user->userComment($comment)->avatar}}" class="rounded-full shadow-md dark:shadow-black/30" alt="avatar" />
                                </div>
                                <div class="md:ml-6">
                                    <p class="mb-6 font-light text-neutral-500 dark:text-neutral-300">
                                        {{$comment->body}}
                                    </p>
                                    <p class="mb-2 text-xl font-semibold text-neutral-800 dark:text-neutral-200">
                                        {{$ad->user->userComment($comment)->name}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                    @if($ad->user->facebook!=NULL)
                    <a class="" href="$ad->user->facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    @endif
                    @if($ad->user->instagram!=NULL)
                    <a class="pl-4" href="$ad->user->instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($ad->user->twitter!=NULL)
                    <a class="pl-4" href="$ad->user->twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    @endif
                    @if($ad->user->linkedin!=NULL)
                    <a class="pl-4" href="$ad->user->linkedin">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-app-layout>