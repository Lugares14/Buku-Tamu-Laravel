<x-guest-layout>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }
        .input-focus-effect:focus {
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.15);
            transform: translateY(-2px);
        }
        .input-focus-effect {
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(90deg, #f97316, #dc2626);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #ea580c, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3);
        }
    </style>

    <div class="h-screen flex items-center justify-center px-6 bg-gray-100">
        <div class="bg-white shadow-2xl rounded-2xl w-full max-w-lg p-10">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3c0 1.295.829 2.387 2 2.816V16h2v-2.184c1.171-.429 2-1.521 2-2.816zM5 20h14M12 4v1m0 4v1m6-5h1m-1 6h1m-7-6H9m0 6H8" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-red-500 bg-clip-text text-transparent">
                    Reset Password
                </h2>
                <p class="text-sm text-gray-600 mt-2">Silakan masukkan password baru Anda</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                                  class="input-focus-effect block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm 
                                         focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
                                  type="email"
                                  name="email"
                                  :value="old('email', $request->email)"
                                  required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password Baru')" />
                    <x-text-input id="password"
                                  class="input-focus-effect block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm 
                                         focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input id="password_confirmation"
                                  class="input-focus-effect block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm 
                                         focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
                                  type="password"
                                  name="password_confirmation"
                                  required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="btn-primary text-white px-6 py-3 rounded-lg shadow">
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
