<header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">

    @if(session('status'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="w-full pl-3 py-1 bg-green-200 text-white">
        {{session('status')}}
    </div>
    @endif
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <div class="flex items-center">
        <a href="{{route('home')}}" class="flex items-center px-2 py-2 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600 rounded-md">
            <svg height="32" viewBox="0 0 48 48" width="48" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                <path d="M20 40V28h8v12h10V24h6L24 6 4 24h6v16z" stroke="currentColor" />
                <path d="M0 0h48v48H0z" fill="none" />
            </svg>
            Aplicación
        </a>
    </div>
    @if(auth()->user()->unreadNotifications->count()!=0)
    <div class="flex items-end">
        <div x-data="{ notificationOpen: false}" class="relative">
            <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="rgb(29,78,216)" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9" stroke="rgb(29,78,216)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="bg-blue-700 text-white font-bold rounded-full pl-1 pr-1">{{auth()->user()->unreadNotifications->count()}}</span>
            </button>

            <div x-cloak x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

            <div x-cloak x-show="notificationOpen" class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-lg shadow-xl w-80" style="width:20rem;">
                @foreach(auth()->user()->unreadNotifications as $notification)
                @if(str_contains($notification->type,'NewUserNotification'))
                <a href="{{route('adminEditUser',$notification->data['id'])}}" class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600">
                    <p class="mx-2 text-sm">
                        <span class="font-bold pr-1">{{$notification->data['name']}}</span>ha sido activado el <span class="font-bold text-indigo-400 pr-1 pl-1">{{$notification->data['created_at']}}</span>
                    </p>
                </a>
                @elseif(str_contains($notification->type,'NewAdNotification'))
                <a href="{{route('adminShow',$notification->data['ad_id'])}}" class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600">
                    <img class="object-cover w-8 h-8 mx-1 rounded-full" src="{{$notification->data['name']['avatar']}}" alt="avatar">
                    <p class="mx-2 text-sm">
                        <span class="font-bold pr-1">el anuncio {{$notification->data['ad_name']}}</span>ha sido creado por <span class="font-bold text-indigo-400 pr-1 pl-1">{{$notification->data['name']['name']}}</span>{{$notification->data['created_at']}}
                    </p>
                </a>
                @elseif(str_contains($notification->type,'ContactNotification'))
                <a href="{{route('adminContact',$notification)}}" class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600">
                    <p class="mx-2 text-sm">
                        <span class="font-bold pr-1">Tiene un nuevo mensaje de contacto de {{$notification->data['name']}}</span>
                    </p>
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <div x-data="{ dropdownOpen: false }" class="relative">
        <button @click="dropdownOpen = ! dropdownOpen" class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
            <img class="object-cover w-full h-full" src="{{auth()->user()->avatar}}" alt="avatar">
        </button>

        <div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"></div>

        <div x-cloak x-show="dropdownOpen" class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
</header>