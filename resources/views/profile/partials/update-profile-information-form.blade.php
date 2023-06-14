<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
            <div class="w-full mt-2">
                <x-input-label class="mt-2" for="facebook" :value="__('Facebook')" />
                <div class="relative h-10 w-full min-w-[200px]">
                    <div class="absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center text-indigo-500">
                        <i class="fab fa-facebook" aria-hidden="true"></i>
                    </div>
                    <input title="facebook" class="w-full border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2.5 peer border border-blue-gray-200 bg-transparent !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 focus:border-2 focus:border-indigo-500 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="facebook" value="{{old('facebook',$user->facebook)}}" placeholder="Facebook"/>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
            </div>
            <div class="w-full mt-2">
                <x-input-label for="instagram" :value="__('Instagram')" />
                <div class="relative h-10 w-full min-w-[200px]">
                    <div class="absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center text-indigo-500">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                    </div>
                    <input title="instagram" class="w-full border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2.5 peer border border-blue-gray-200 bg-transparent !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 focus:border-2 focus:border-indigo-500 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="instagram" value="{{old('instagram',$user->instagram)}}" placeholder="Instagram"/>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
            </div>
            <div class="w-full mt-2">
                <x-input-label for="twitter" :value="__('Twitter')" />
                <div class="relative h-10 w-full min-w-[200px]">
                    <div class="absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center text-indigo-500">
                        <i class="fab fa-twitter" aria-hidden="true"></i>
                    </div>
                    <input title="twitter" class="w-full border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2.5 peer border border-blue-gray-200 bg-transparent !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 focus:border-2 focus:border-indigo-500 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="twitter" value="{{old('twitter',$user->twitter)}}" placeholder="Twitter"/>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
            </div>
            <div class="w-full mt-2">
                <x-input-label for="linkedin" :value="__('Linkedin')" />
                <div class="relative h-10 w-full min-w-[200px]">
                    <div class="absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center text-indigo-500">
                        <i class="fab fa-linkedin" aria-hidden="true"></i>
                    </div>
                    <input title="linkedin" class="w-full border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2.5 peer border border-blue-gray-200 bg-transparent !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 focus:border-2 focus:border-indigo-500 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" name="linkedin" value="{{old('linkedin',$user->linkedin)}}" placeholder="linkedin"/>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
            </div>
            <div>
                @if($user->avatar!=NULL)
                <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                <img src="{{$user->avatar}}" alt="Avatar_usuario" class="object-cover mx-1 rounded-full shadow h-20 w-20 ">
                </div>
                @endif
            <label class="text-gray-700" for="avatar">Imagen Avatar</label>
            <input title="avatar" class="form-input w-full mt-2 rounded-md focus:border-indigo-600" type="file" name="avatar" accept="image/*" placeholder="{{old('avatar',$user->avatar)}}">
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
           

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
