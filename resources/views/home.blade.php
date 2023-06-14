<x-app-layout title="Inicio" meta-description="Web economia colaborativa">
        <section class="w-full lg:w-2/3 md:w-2/3 flex flex-col items-center px-3">
            @foreach($ads as $ad)
           <x-users.add-item :$ad :$adsids/>
            @endforeach

            {{$ads->links()}}
           

        </section>
</x-app-layout>