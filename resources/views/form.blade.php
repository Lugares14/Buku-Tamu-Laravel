<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-animate {
            background: linear-gradient(-45deg, #ff9a76, #ff6a00, #ff4e50, #f9d423, #ffa726, #ff7043);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
            position: relative;
        }
        .bg-animate::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 75px 75px, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 100px 100px, 50px 50px;
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
        }
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 0% 100%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(5px) rotate(-1deg); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-slide-in-right { animation: slideInRight 0.6s ease-out; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .aspect-4-3 { aspect-ratio: 4 / 3; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 md:p-6 ">
    <div class="glass-effect p-6 md:p-8 rounded-2xl shadow-2xl w-full max-w-7xl animate-fade-in">
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-500 bg-clip-text text-transparent mb-2">
                📖 Form Buku Tamu
            </h1>
            <p class="text-gray-600 text-sm">Silahkan isi data dan ambil foto Anda</p>
        </div>

        {{-- Alert success / error --}}
        @if(session('success'))
            <div class="mb-6">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
                    <span class="text-xl mr-2">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form id="guestForm" action="{{ route('tamu.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            @csrf
            <input type="hidden" name="foto" id="fotoInput">

            <!-- Kolom Kiri: Input Form -->
            <div class="space-y-6">
                <div class="bg-gradient-to-br from-orange-50 to-red-50 p-6 rounded-xl border border-orange-100">
                    <h3 class="text-lg font-semibold text-orange-800 mb-4 flex items-center">
                        <span class="text-xl mr-2">👤</span>
                        Data Pengunjung
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" id="nama" name="nama" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 hover:border-orange-300"
                                   placeholder="Masukkan nama lengkap">
                        </div>

                        <div>
                            <label for="instansi" class="block text-sm font-medium text-gray-700 mb-2">Instansi/Perusahaan</label>
                            <input type="text" id="instansi" name="instansi"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 hover:border-orange-300"
                                   placeholder="Nama instansi/perusahaan">
                        </div>

                        <div>
                            <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-2">Keperluan Kunjungan</label>
                            <textarea id="keperluan" name="keperluan" rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 hover:border-orange-300 resize-none"
                                      placeholder="Jelaskan tujuan kunjungan Anda"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-orange-500 via-orange-600 to-red-500 hover:from-orange-600 hover:via-orange-700 hover:to-red-600 text-white font-bold px-6 py-4 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl active:scale-95 flex items-center justify-center space-x-2">
                    <span class="text-xl"></span>
                    <span>Simpan Data Kunjungan</span>
                </button>
            </div>

            <!-- Kolom Tengah: Kamera -->
            <div class="space-y-4">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                    <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">Kamera Live</h3>
                    
                    <div class="relative mb-4">
                        <video id="video" autoplay muted
                               class="w-full border-2 border-blue-200 rounded-xl aspect-4-3 bg-black shadow-lg object-cover"></video>
                        <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full animate-pulse flex items-center space-x-1">
                            <div class="w-2 h-2 bg-white rounded-full animate-ping"></div>
                            <span>LIVE</span>
                        </div>
                    </div>

                    <canvas id="canvas" class="hidden"></canvas>

                    <button type="button" id="captureBtn"
                            class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold px-4 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl active:scale-95 flex items-center justify-center space-x-2">
                        <span class="text-xl">📸</span>
                        <span>Ambil Foto</span>
                    </button>
                </div>
            </div>

            <!-- Kolom Kanan: Preview Foto -->
            <div class="space-y-4">
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl border border-green-100">
                    <h3 class="text-lg font-semibold text-green-800 mb-4 flex items-center">Preview Foto</h3>
                    
                    <div id="previewContainer" class="border-2 border-dashed border-gray-300 rounded-xl aspect-4-3 flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 mb-4 overflow-hidden">
                        <div id="placeholderText" class="text-gray-500 text-center p-4">
                            <p class="text-base font-medium">Foto akan tampil di sini</p>
                            <p class="text-sm text-gray-400 mt-2">Klik "Ambil Foto" untuk memulai</p>
                        </div>
                        <img id="preview" class="hidden w-full h-full object-cover">
                    </div>
                    
                    <button type="button" id="retakeBtn" 
                            class="hidden w-full bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition-all duration-300 transform hover:scale-105 active:scale-95 flex items-center justify-center space-x-2">
                        <span class="text-lg">🔄</span>
                        <span>Ambil Ulang</span>
                    </button>
                </div>

                <div id="photoStatus" class="hidden bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm flex items-center">
                    <span class="text-lg mr-2">✅</span>
                    <span>Foto berhasil diambil dan siap disimpan!</span>
                </div>
            </div>
        </form>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureBtn = document.getElementById('captureBtn');
        const preview = document.getElementById('preview');
        const placeholderText = document.getElementById('placeholderText');
        const retakeBtn = document.getElementById('retakeBtn');
        const guestForm = document.getElementById('guestForm');
        const photoStatus = document.getElementById('photoStatus');
        const fotoInput = document.getElementById('fotoInput');
        
        let photoData = null;

        // Akses webcam
        navigator.mediaDevices.getUserMedia({ 
            video: { width: { ideal: 1280 }, height: { ideal: 720 }, facingMode: "user" } 
        })
        .then(stream => { video.srcObject = stream; })
        .catch(err => {
            console.error("Tidak bisa akses kamera:", err);
            document.getElementById('previewContainer').innerHTML = `
                <div class="text-red-500 text-center p-6">
                    <div class="text-6xl mb-3">❌</div>
                    <p class="text-base font-medium">Kamera tidak dapat diakses</p>
                    <p class="text-sm text-red-400 mt-2">Pastikan browser memiliki izin kamera</p>
                </div>`;
        });

        // Ambil foto
        captureBtn.addEventListener('click', () => {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            photoData = canvas.toDataURL('image/png');
            fotoInput.value = photoData;

            placeholderText.classList.add('hidden');
            preview.src = photoData;
            preview.classList.remove('hidden');
            retakeBtn.classList.remove('hidden');
            photoStatus.classList.remove('hidden');

            captureBtn.innerHTML = `<span class="text-xl">✅</span><span>Foto Tersimpan</span>`;
        });

        // Ulang foto
        retakeBtn.addEventListener('click', () => {
            photoData = null;
            fotoInput.value = '';
            preview.classList.add('hidden');
            placeholderText.classList.remove('hidden');
            retakeBtn.classList.add('hidden');
            photoStatus.classList.add('hidden');
            captureBtn.innerHTML = `<span class="text-xl">📸</span><span>Ambil Foto</span>`;
        });

        // Validasi submit
        guestForm.addEventListener('submit', (e) => {
            if (!fotoInput.value) {
                e.preventDefault();
                alert('Harap ambil foto terlebih dahulu!');
            }
        });
    </script>
</body>
</html>
