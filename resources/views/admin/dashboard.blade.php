@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen p-6 md:p-8">
    <div class="glass-effect p-6 md:p-8 rounded-2xl shadow-2xl w-full max-w-7xl mx-auto space-y-10">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-red-500 bg-clip-text text-transparent">
                    📊 Dashboard Admin
                </h2>
                <p class="text-sm text-gray-600">Ringkasan aktivitas tamu terbaru</p>
            </div>
            <a href="{{ route('profile.edit') }}"
               class="px-5 py-2.5 bg-gradient-to-r from-orange-500 via-orange-600 to-red-500 text-white rounded-lg shadow hover:from-orange-600 hover:to-red-600 transition">
                ✏️ Edit Profil
            </a>
        </div>

        <!-- Statistik (KPI Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Total Tamu -->
            <div class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-blue-700">Total Tamu</h2>
                    <span class="text-2xl">👥</span>
                </div>
                <p class="text-4xl font-extrabold text-blue-800 mt-2">
                    {{ \App\Models\Tamu::count() }}
                </p>
                <p class="text-sm text-gray-600 mt-1">Sejak awal sistem</p>
            </div>

            <!-- Tamu Hari Ini -->
            <div class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-green-50 to-emerald-100 border border-green-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-green-700">Tamu Hari Ini</h2>
                    <span class="text-2xl">📅</span>
                </div>
                <p class="text-4xl font-extrabold text-green-800 mt-2">
                    {{ \App\Models\Tamu::whereDate('created_at', now()->toDateString())->count() }}
                </p>
                <p class="text-sm text-gray-600 mt-1">{{ now()->format('d F Y') }}</p>
            </div>

            <!-- Tamu Bulan Ini -->
            <div class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-yellow-700">Tamu Bulan Ini</h2>
                    <span class="text-2xl">📈</span>
                </div>
                <p class="text-4xl font-extrabold text-yellow-800 mt-2">
                    {{ \App\Models\Tamu::whereMonth('created_at', now()->month)->count() }}
                </p>
                <p class="text-sm text-gray-600 mt-1">{{ now()->format('F Y') }}</p>
            </div>

            <!-- Export Data -->
            <!-- Export Data -->
            <div class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 text-center">
                <h2 class="text-lg font-semibold text-purple-700 mb-2">Export Data</h2>
                <a href="{{ route('tamu.export.pdf') }}" target="_blank"
                class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:from-purple-600 hover:to-indigo-700 transition mt-2 inline-block">
                    📄 Unduh PDF
                </a>
            </div>
        </div>

        <!-- Grafik -->
        <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-700">📈 Statistik Tamu</h2>
                <!-- Filter Periode -->
                <select class="px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm">
                    <option>7 Hari Terakhir</option>
                    <option>30 Hari Terakhir</option>
                    <option>Bulan Ini</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <canvas id="tamuLine" height="120"></canvas>
                </div>
                <div class="lg:col-span-1">
                    <canvas id="tamuPie" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($labels) !!};
    const counts = {!! json_encode($counts) !!};

    // Line chart (trend)
    const ctxLine = document.getElementById('tamuLine').getContext('2d');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Tamu',
                data: counts,
                borderColor: '#f97316',
                backgroundColor: 'rgba(249, 115, 22, 0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#f97316'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // Pie chart
    const ctxPie = document.getElementById('tamuPie').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Distribusi Tamu',
                data: counts,
                backgroundColor: [
                    '#f97316','#ef4444','#22c55e','#3b82f6','#a855f7','#eab308','#06b6d4'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endpush
