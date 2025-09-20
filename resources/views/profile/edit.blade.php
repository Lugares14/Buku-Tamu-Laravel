@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow space-y-6">
    <h1 class="text-2xl font-bold text-blue-600">Edit Profil</h1>

    {{-- Notifikasi --}}
    @if(session('status') === 'profile-updated')
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded">
            Profil berhasil diperbarui!
        </div>
    @endif

    {{-- Form Edit Nama & Email --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="block font-medium text-sm">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                   required
                   class="w-full mt-1 border border-gray-300 rounded px-3 py-2 shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label for="email" class="block font-medium text-sm">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                   required
                   class="w-full mt-1 border border-gray-300 rounded px-3 py-2 shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <div class="text-right">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>

    <hr class="border-t my-6">

    {{-- Form Ubah Password --}}
    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-semibold text-gray-700">Ubah Password</h2>

        <div>
            <label for="current_password" class="block text-sm font-medium">Password Saat Ini</label>
            <input type="password" name="current_password" id="current_password" required
                   class="w-full mt-1 border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium">Password Baru</label>
            <input type="password" name="password" id="password" required
                   class="w-full mt-1 border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="w-full mt-1 border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="text-right">
            <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-2 rounded">
                Perbarui Password
            </button>
        </div>
    </form>

    <hr class="border-t my-6">

    {{-- Form Hapus Akun --}}
    <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4" onsubmit="return confirm('Yakin ingin menghapus akun? Ini tidak bisa dibatalkan!')">
        @csrf
        @method('DELETE')

        <h2 class="text-lg font-semibold text-red-600">Hapus Akun</h2>

        <div>
            <label for="password" class="block text-sm font-medium">Konfirmasi Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full mt-1 border border-red-300 rounded px-3 py-2 focus:border-red-500">
        </div>

        <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-semibold">
            Hapus Akun
        </button>
    </form>
</div>
@endsection
