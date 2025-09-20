@extends('layouts.app')

@section('title', 'Daftar Tamu')

@section('content')
<div class="space-y-6">
    <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-red-500 bg-clip-text text-transparent">
        📋 Daftar Tamu
    </h2>

    <!-- Form Pencarian + Tanggal -->
    <div class="glass-effect p-4 rounded-xl shadow-md">
        <form method="GET" action="{{ route('tamu.index') }}" class="flex flex-wrap items-center gap-3">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari tamu..." 
                   class="px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition w-48">

            <input type="date" name="tanggal" value="{{ request('tanggal') }}" 
                   class="px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">

            <button type="submit" 
                    class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-lg shadow hover:from-orange-600 hover:to-red-600 transition">
                🔍 Cari
            </button>

            @if(request('search') || request('tanggal'))
                <a href="{{ route('tamu.index') }}" 
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    ♻️ Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Tabel Tamu -->
    <div class="overflow-x-auto glass-effect rounded-xl shadow-lg">
        <table class="min-w-full table-auto rounded-xl overflow-hidden">
            <thead class="bg-gradient-to-r from-orange-500 to-red-500 text-white text-sm uppercase">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">Instansi</th>
                    <th class="p-3 text-left">Waktu</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white/90 text-gray-700">
                @forelse($tamus as $index => $tamu)
                    <tr class="hover:bg-orange-50 transition">
                        <td class="p-3">{{ $tamus->firstItem() + $index }}</td>
                        <td class="p-3 font-semibold">{{ $tamu->nama }}</td>
                        <td class="p-3">
                            @if($tamu->foto)
                                <img src="{{ asset('storage/' . $tamu->foto) }}" 
                                     class="w-14 h-14 object-cover rounded-lg shadow">
                            @else
                                <span class="text-gray-400 text-xs">Tidak ada</span>
                            @endif
                        </td>
                        <td class="p-3">{{ $tamu->instansi }}</td>
                        <td class="p-3 text-sm text-gray-600">
                            {{ $tamu->created_at->format('d-m-Y H:i') }}
                        </td>
                        <td class="p-3 space-x-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('tamu.edit', $tamu->id) }}" 
                               class="inline-block bg-blue-500 text-white text-xs px-3 py-1.5 rounded-lg shadow hover:bg-blue-600 transition">
                                 Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('tamu.destroy', $tamu->id) }}" 
                                  method="POST" class="inline-block" 
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white text-xs px-3 py-1.5 rounded-lg shadow hover:bg-red-600 transition">
                                     Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" 
                            class="p-6 text-center text-gray-500">
                            Tidak ada data tamu.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Navigasi Pagination -->
    <div class="mt-4">
        {{ $tamus->withQueryString()->links() }}
    </div>
</div>
@endsection
