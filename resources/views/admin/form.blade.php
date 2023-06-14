@extends('admin._layouts.master')

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">Editar Usuario</h2>

            <form action="{{route('adminStoreUser',$user)}}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-6 mt-4">
                    <div>
                        <label class="text-gray-700" for="ciudad">Nombre</label>
                        <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text" name="name" value="{{$user->name}}" required>                    </div>
                    <div>
                        <label class="text-gray-700" for="nombre">Email</label>
                        <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="email" name="email" value="{{$user->email}}" required>
                    </div>
                    <div>
                        <label class="text-gray-700" for="nombre">Administrador</label>
                        <select class="form-input w-full mt-2 rounded-md focus:border-indigo-600" name="admin" required>
                            <option value='1'>Activar</option>
                            <option value='0' selected>Desactivar</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-gray-700" for="anuncio">Estado</label>
                        <select class="form-input w-full mt-2 rounded-md focus:border-indigo-600" name="activo" required>
                            <option value='1' selected>Activar</option>
                            <option value='0'>Desactivar</option>
                        </select>
                        <div class="flex justify-end mt-4">
                            <button class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Guardar</button>
                        </div>
            </form>
        </div>
    </div>
</div>
@endsection