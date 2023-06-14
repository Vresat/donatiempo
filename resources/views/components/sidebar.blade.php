<aside class="w-full md:w-1/3 flex flex-col items-center px-3">
        <div class="bg-white shadow flex flex-col items-center my-4 p-6">
            <p class="text-xl font-semibold pb-5">Categorias</p>
        @foreach($categories as $category)
            <a href="{{route('by-category',$category->id)}}" class="w-full font-bold text-sm uppercase rounded hover:bg-blue-700 hover:text-white flex items-center justify-center px-2 py-3 mt-4 {{ (str_contains(Request::fullUrl(),'category') ? substr(Request::fullUrl(),-1)==$category->id : '') ? 'bg-blue-700 text-white' : '' }}">
            {{$category->name}} ({{$category->total}})
            </a>
        @endforeach
         </div>
</aside>