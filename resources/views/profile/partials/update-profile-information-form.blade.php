<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-white flex items-center gap-2">
            <i class="fas fa-id-card text-gold"></i>
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-slate-400">
            {{ __("Update your account's public name and primary email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        value="{{ old('name', Auth::user()->name) }}" required autofocus autocomplete="name" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email Input -->
            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-slate-300 ml-1">{{ __('Email Address') }}</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-slate-500 group-focus-within:text-gold transition-colors"></i>
                    </div>
                    <input id="email" name="email" type="email" 
                        class="w-full bg-primary-dark border border-slate-700 rounded-xl pl-10 pr-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent transition-all"
                        value="{{ old('email', Auth::user()->email) }}" required autocomplete="username" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                    <div class="mt-2 bg-yellow-500/10 border border-yellow-500/20 p-3 rounded-lg">
                        <p class="text-xs text-yellow-500">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="underline hover:text-yellow-400 font-bold ml-1 transition">
                                {{ __('Resend Verification') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-8 py-3 bg-gold text-primary-dark font-bold rounded-xl hover-bg-gold shadow-md hover:shadow-lg transform active:scale-95 transition-all flex items-center gap-2">
                <i class="fas fa-save"></i>
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 font-medium animate-pulse"
                ><i class="fas fa-check-circle mr-1"></i> {{ __('Changes saved successfully.') }}</p>
            @endif
        </div>
    </form>
</section>
