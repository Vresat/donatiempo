@extends('admin._layouts.master')

@section('body')
    <h3 class="text-gray-700 text-3xl font-medium">Contacto</h3>
    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <p class="px-2">Nombre: {{$notification->data['name']}}</p>
                <p class="px-2">Email: {{$notification->data['email']}}</p>
                <p class="px-2">Asunto: {{$notification->data['asunto']}}</p>
                <p class="px-2">Solicitud: {{$notification->data['help']}}</p>
            </div>
        </div>
    </div>
@endsection