<aside class="w-full md:w-1/3 flex flex-col items-center px-3">
    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <h4 class="text-xl font-semibold pb-5">Categorias</p>
        @foreach($categories as $category)
        <a href="{{route('by-category',$category->id)}}" class="w-full font-bold text-sm uppercase rounded hover:bg-blue-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4">
            {{$category->name}} ({{$category->total}})
        </a>
        @endforeach
    </div>
    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <p class="text-xl font-semibold pb-5">Acerca de Nosotros</p>
        <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
            Conocenos
        </a>
    </div>
</aside>