<x-guest-layout>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* ⛔ no scroll */
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-red-500 bg-clip-text text-transparent">
                    Verifikasi Email
                </h2>
                <p class="text-sm text-gray-600 mt-2">
                    Terima kasih sudah mendaftar! Silakan cek email Anda dan klik link verifikasi sebelum melanjutkan.
                </p>
            </div>

            <!-- Status -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm text-center">
                    ✉️ Link verifikasi baru sudah dikirim ke email Anda.
                </div>
            @endif

            <!-- Actions -->
            <div class="flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="btn-primary text-white px-6 py-3 rounded-lg shadow">
                        Kirim Ulang Email
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="text-sm text-gray-600 hover:text-gray-900 underline">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
