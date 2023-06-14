<x-app-layout title="Crear Anuncio" meta-description="Crear Anuncio">
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-lg text-gray-700 font-semibold capitalize">Editar Anuncio</h2>
                <form action="{{route('ads.update',$ad)}}" method="POST">
                    @csrf @method('PATCH')
                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-6 mt-4">
                    <div class="relative">
                        <select class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="category">
                            @foreach($categories as $category)
                            <option>{{ $category->name }}</option>
                            @endforeach
                            <option></option>
                        </select>
                        @error('category')
                            <small class="font-bold text-red-700">{{$message}}</small>
                        @enderror

                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                        <div>
                            <label class="text-gray-700" for="ciudad">Ciudad</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text" name="city" value="{{old('city',$ad->city)}}">
                            @error('city')
                            <small class="font-bold text-red-700">{{$message}}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700" for="nombre">Nombre</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text" name="name" value="{{old('name',$ad->nombre)}}">
                            @error('name')
                            <small class="font-bold text-red-700">{{$message}}</small>
                            @enderror
                        </div>

                        <div>
                            <label class="text-gray-700" for="anuncio">Anuncio</label>
                            <textarea class="form-textarea w-full mt-2 rounded-md focus:border-indigo-600" name="body">{{old('body',$ad->body)}}</textarea>
                            @error('body')
                            <small class="font-bold text-red-700">{{$message}}</small>
                            @enderror
                            
                        </div>
                        <label class="text-gray-700" for="anuncio">Estado</label>
                        <select class="form-input w-full mt-2 rounded-md focus:border-indigo-600" name="activo">
                            <option value=1>Activar</option>
                            <option value=0>Desactivar</option>
                        </select>

                        <div>
                            <label class="text-gray-700" for="imagen">Imagen</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="file" name="image" accept="image/*">
                        </div>
                    </div>

                    <div class="flex justify-between mt-4">
                        <a href="#" class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Cerrar Anuncio</a>
                        <button class="px-4 py-2 mr-2 ml-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>