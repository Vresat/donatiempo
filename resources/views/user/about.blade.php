<x-app-layout title="Acerca de nosotros" meta-description="contacto con administración">
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-lg text-gray-700 font-semibold capitalize">Contacta con nosotros</h2>
                <form action="{{route('storeAbout')}}" method="POST">
                    @csrf
                        <div>
                            <label class="text-gray-700" for="name">Nombre</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text" name="name" value="{{old('name')}}" required>
                            @error('name')
                            <small class="font-bold text-red-700">{{$message}}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700" for="email">Email</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="email" name="email" value="{{old('email')}}" required>
                            @error('email')
                            <small class="font-bold text-red-700">{{$message}}</small>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700" for="asunto">Asunto</label>
                            <input class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="text" name="asunto" value="{{old('asunto')}}" required>
                            @error('asunto')
                            <small class="font-bold text-red-700">{{$message}}</small>
                            @enderror
                        </div>

                        <div>
                            <label class="text-gray-700" for="body">En que podemos ayudarte</label>
                            <textarea class="form-textarea w-full mt-2 rounded-md focus:border-indigo-600" name="body" required>{{old('body')}}</textarea>
                            @error('body')
                            <small class="font-bold text-red-700">{{$message}}</small>
                            @enderror
                        </div>
                    <div class="flex justify-end mt-4">
                        <button class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>