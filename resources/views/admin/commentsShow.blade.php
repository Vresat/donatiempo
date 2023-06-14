@extends('admin._layouts.master')
@section('body')

<article class="w-full flex flex-col shadow my-4">
    <div class=" bg-white flex flex-col justify-start p-6">
        <p class="text-blue-700 text-sm font-bold uppercase pb-4">Nombre de usuario que hace el comentario</p>
        <p class="text-blue-700 text-sm font-bold uppercase pb-4">{{$comment->commentsDo->name}}</p>
        <p class="font-bold pb-4">Email: {{$comment->commentsDo->email}}</p>
        <p class="pb-3 py-2">Comentario:</p>
        <p class="text-blue-700 text-sm font-bold pb-3 py-2">{{$comment->body}}</p>
        <p class="pb-3 py-2">Rating realizado sobre {{$comment->commentsReceive->name}}:</p>
        <p class="text-blue-700 text-sm font-bold pb-3 py-2 ml-20">{{$comment->rating}}</p>
        
        
        @if($comment->active)
        <a href="{{route('adminCommentEdit',$comment)}}" class="w-full font-bold text-sm uppercase rounded bg-white text-orange-700 hover:bg-orange-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">Desactivar</a>
        @else
        <a href="{{route('adminCommentEdit',$comment)}}" class="w-full font-bold text-sm uppercase rounded bg-white text-green-700 hover:bg-green-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">Activar</a>
        @endif
        <a href="{{route('adminIndex')}}" class="w-full font-bold text-sm uppercase rounded text-blue-700 hover:bg-blue-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">Volver</a>
    </div>
</article>

@endsection