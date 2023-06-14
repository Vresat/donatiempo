@extends('admin._layouts.master')

@section('body')
    <div class="mt-8">
        <h2 class="text-gray-600">Categorias</h2>
        
        <div class="mt-6">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                                <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha de creación</th>
                                <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                                <th class="px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$category->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{$category->getFormattedDate()}}</p>
                                </td>
                                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                                    <span class="relative inline-block px-3 py-1 font-semibold rounded-full text-white {{$category->active ? 'bg-green-900' : 'bg-orange-900'}}">{{$category->active ? 'Activo' : 'Desactivado'}}
                                    </span>
                                </td>
                                <td class="px-2 py-2 border-b border-gray-200 bg-white text-sm">
                                @if($category->active)
                                    <a href="{{route('adminCategoryActDes',$category)}}" class="font-bold text-sm uppercase rounded bg-white text-orange-700 hover:bg-orange-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">Desactivar</a>
                                @else
                                    <a href="{{route('adminCategoryActDes',$category)}}" class="font-bold text-sm uppercase rounded bg-white text-green-700 hover:bg-green-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">Activar</a>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">

                <h2 class="text-lg text-gray-700 font-semibold capitalize">Crear Categoria</h2>
                
                <form action="{{route('adminCategory.store')}}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-6 mt-4">
                        <div>
                            <label class="text-gray-700" for="nombre de categoria">Nombre de la nueva categoria</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text" name="name">
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Guardar</button>
                    </div>
                </form>
                <a href="{{route('adminIndex')}}" class="w-full font-bold text-sm uppercase rounded text-blue-700 hover:bg-blue-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">Volver</a>
            </div>
        </div>
    </div>
@endsection