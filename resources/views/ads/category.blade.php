<x-app-layout title="Crear categoria" meta-description="Categoria">
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-lg text-gray-700 font-semibold capitalize">Crear Categoria</h2>
                
                <form action="{{route('category.store')}}" method="POST">
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
            </div>
        </div>
    </div>
</x-app-layout>