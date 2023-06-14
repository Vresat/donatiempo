<x-app-layout title="Cerrar Anuncio" meta-description="Cerrar Anuncio">
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-lg text-gray-700 font-semibold capitalize">Cerrar Anuncio</h2>
                <form class="w-full" action="{{route('deleteAd',$ad)}}" method="POST">
                    @csrf @method('DELETE')
                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-6 mt-4">
                    <div>
                            <label class="text-gray-700" for="nombre">Nombre</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text" name="name" value="{{$ad->name}}">
                        </div>

                        <div>
                            <label class="text-gray-700" for="anuncio">Anuncio</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" name="shortAd" value="{{$ad->shortBody()}}">
                        </div>

                    <div class="relative">
                        <label for="userToComment">Usuario que realizó la tarea</label>
                        <select class="appearance-none h-full rounded-l border block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="userToComment" required>
                            @foreach($usersToComent as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach    
                        </select>
                        @error('userToComment')
                            <small class="font-bold text-red-700">{{$message}}</small>
                        @enderror

                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                        
                        <div>
                            <label class="text-gray-700" for="body">Comentario</label>
                            <textarea class="form-textarea w-full mt-2 rounded-md focus:border-indigo-600" name="body" placeholder="Agrega un comentario sobre el usuario que realizo la tarea"></textarea>
                        </div>
                        @error('body')
                            <small class="font-bold text-red-700">{{$message}}</small>
                        @enderror
                        <label class="text-gray-700" for="rating">Puntua la experiencia con el usuario</label>
                        <select class="appearance-none h-full rounded-l border block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="rating" required>
                            <option value="1">Muy Mala</option>
                            <option value="2">Mala</option>
                            <option value="3">Buena</option>
                            <option value="4">Muy Buena</option>
                            <option value="5">Excelente</option>
                        </select>
                        @error('rating')
                            <small class="font-bold text-red-700">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="px-4 py-2 mr-2 ml-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700 disabled:opacity-20">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>