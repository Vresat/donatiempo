<nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
        <a href="#" class="md:hidden text-base font-bold uppercase text-center flex justify-center items-center" @click="open = !open">
            Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>

    <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-between text-sm font-bold uppercase mt-0 px-6 py-2">
            <div>
                <a href="{{route('home')}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Inicio</a>
                <a href="{{route('about')}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Cantactanos</a>
            </div>
            <div>
                <form :class="open ? 'hidden':''"class="flex flex-grow sm:flex sm:items-center" method="POST" action="{{route('orderBy')}}">
                    @csrf
                <label class="text-gray-700 mr-5" for="city">Filtrar por Ciudad</label>
                        <select class="form-input w-full mt-2 rounded-md focus:border-indigo-600" name="city">
                            @foreach($cities as $city)
                            <option value='{{$city->city}}'>{{$city->city}}</option>
                            @endforeach
                            <option value='all'selected>Todas</option>
                        </select>
                        <label class="text-gray-700 ml-6 mr-5" for="city">Filtrar por Categoria</label>
                        <select class="form-input w-full mt-2 rounded-md focus:border-indigo-600" name="category">
                            @foreach($categories as $category)
                            <option value='{{$category->id}}'>{{$category->name}}</option>
                            @endforeach
                            <option value='0'selected>Todas</option>
                        </select>
                        <div>
                        <button class="ml-5 px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Filtrar</button>
                        </div>
                </form>
            </div>
            <div>
                @auth
                @if(auth()->user()->is_admin)
                <a href="{{route('adminIndex')}}" class="inline-flex items-start px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-blue-800 bg-blue hover:bg-blue-800 hover:text-white focus:outline-none transition ease-in-out duration-150">
                    <svg enable-background="new 0 0 48 48" height="24px" id="Layer_4" version="1.1" viewBox="0 0 48 48" width="48px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <rect fill="currentColor" height="29.498" width="21.07" y="-0.033" />
                            <rect fill="currentColor" height="29.498" width="21.07" x="26.93" y="18.535" />
                            <rect fill="currentColor" height="13.695" width="21.07" x="26.93" y="-0.033" />
                            <rect fill="currentColor" height="13.695" width="21.07" y="34.338" />
                        </g>
                    </svg>
                    Administración</a>
                @endif
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @if(isset($notification) && $notification!=0)
                    <x-users.notification :$notification/>
                    @endif
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-blue-800 bg-blue hover:bg-blue-800 hover:text-white focus:outline-none transition ease-in-out duration-150">

                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('ads.forms')">
                                {{ __('Crear Anuncio') }}
                            </x-dropdown-link>
                            @if(Auth::user()->ads->count()>0)
                            <x-dropdown-link :href="route('user.table')">
                                {{ __('Ver Anuncios') }}
                            </x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <a href="{{route('login')}}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Login</a>
            <a href="{{route('register')}}" class="bg-blue-400 text-white rounded py-2 px-4 mx-2">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>