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

    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="bg-white shadow-2xl rounded-2xl w-full max-w-lg p-10">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3c0 1.295.829 2.387 2 2.816V16h2v-2.184c1.171-.429 2-1.521 2-2.816zM5 20h14M12 4v1m0 4v1m6-5h1m-1 6h1m-7-6H9m0 6H8"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-red-500 bg-clip-text text-transparent">
                    Lupa Password
                </h2>
                <p class="text-sm text-gray-600 mt-2">Masukkan email Anda untuk menerima link reset password</p>
            </div>

            <!-- Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                                  class="input-focus-effect block mt-1 w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Button -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                        Kembali ke Login
                    </a>
                    <x-primary-button class="btn-primary text-white px-6 py-3 rounded-lg shadow">
                        Kirim Link Reset
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
