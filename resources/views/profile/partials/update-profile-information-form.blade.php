<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Information du profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettre à jour les informations du profil.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- first name en français --}}
        <div>
            <x-input-label for="first_name" :value="__('Prénom')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        {{-- last name en français --}}
        <div>
            <x-input-label for="last_name" :value="__('Nom')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
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
        {{-- edit club text --}}
        <div>
            <x-input-label for="club" :value="__('Club')" />
            <x-text-input id="club" name="club" type="text" class="mt-1 block w-full" :value="old('club', $user->club)" required autocomplete="club" />
            <x-input-error class="mt-2" :messages="$errors->get('club')" />
            
        </div>

        {{-- license number --}}
        <div>
            <x-input-label for="license_number" :value="__('Numéro de Licence ')" />
            <x-text-input id="licence" name="licence" type="text" class="mt-1 block w-full" :value="old('licence', $user->licence)" required autocomplete="licence_number" />
            <x-input-error class="mt-2" :messages="$errors->get('licence')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Enregistrer.') }}</p>
            @endif
        </div>

        

    </form>
</section>
