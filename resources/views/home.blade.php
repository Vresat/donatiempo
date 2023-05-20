<x-app-layout>
        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">
            @foreach($ads as $ad)
           <x-add-item :ad="$ad"></x-add-item>
            @endforeach

            {{$ads->links()}}
           

        </section>
</x-app-layout>