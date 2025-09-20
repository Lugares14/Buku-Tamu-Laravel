<x-guest-layout>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; 
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-focus-effect:focus {
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
            transform: translateY(-2px);
        }

        .input-focus-effect {
            transition: all 0.3s ease;
        }

        .input-focus-effect:hover {
            border-color: rgb(249 115 22);
        }

        .btn-primary {
            background: linear-gradient(135deg, #f97316, #ea580c, #dc2626);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ea580c, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }
    </style>

    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="glass-effect shadow-2xl rounded-2xl w-full max-w-md p-12 animate-fade-in-up">
            <!-- Header -->
            <div class="text-center mb-10">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-5 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-red-500 bg-clip-text text-transparent mb-2">
                    Login Admin
                </h2>
               
            </div>

            <!-- Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 mb-2" />
                    <x-text-input id="email"
                                  class="input-focus-effect block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required
                                  autofocus
                                  autocomplete="username"
                                  placeholder="admin@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700 mb-2" />
                    <x-text-input id="password"
                                  class="input-focus-effect block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
                                  type="password"
                                  name="password"
                                  required
                                  autocomplete="current-password"
                                  placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Button -->
                <div class="space-y-4">
                    <x-primary-button class="btn-primary w-full justify-center py-3 rounded-lg shadow-lg text-sm font-medium text-white">
                        {{ __('Log in') }}
                    </x-primary-button>

                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="text-sm text-orange-600 hover:text-orange-800 underline" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>
