@extends('admin._layouts.master')
@section('body')

<article class="w-full flex flex-col shadow my-4">

    <div class="hover:opacity-75">
        <img src="{{$ad->image}}">
    </div>
    <div class=" bg-white flex flex-col justify-start p-6">
        <p class="text-blue-700 text-sm font-bold uppercase pb-4">{{$ad->category->name}}</p>
        <p class="text-3xl font-bold hover:text-gray-700 pb-4">{{$ad->name}}</p>
        <p class="text-sm pb-8">
            Por
        <p class="font-semibold hover:text-gray-800">{{$ad->user->name}}</p>, Publicado el {{$ad->getFormattedDate()}}
        </p>
        <p class="pb-3 py-2">{{$ad->body}}</p>
        <a href="{{route('adminIndex')}}" class="w-full font-bold text-sm uppercase rounded text-blue-700 hover:bg-blue-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">Volver</a>
        @if($ad->active)
        <a href="{{route('adminActDes',$ad)}}" class="w-full font-bold text-sm uppercase rounded bg-white text-orange-700 hover:bg-orange-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">Desactivar</a>
        @else
        <a href="{{route('adminActDes',$ad)}}" class="w-full font-bold text-sm uppercase rounded bg-white text-green-700 hover:bg-green-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">Activar</a>
        @endif
    </div>
</article>

@endsection