<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tamu</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #f97316;
            margin-bottom: 15px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
            font-size: 12px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        thead th {
            background: linear-gradient(to right, #f97316, #ef4444);
            color: white;
            font-weight: bold;
            text-align: center;
        }
        th, td {
            padding: 8px;
        }
        tbody tr:nth-child(even) {
            background: #f9fafb;
        }
        td img {
            border-radius: 6px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.15);
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>📋 Daftar Tamu</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Keperluan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarTamu as $index => $tamu)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">
                    @if($tamu->foto)
                        <img src="{{ public_path('storage/' . $tamu->foto) }}" width="50">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $tamu->nama }}</td>
                <td>{{ $tamu->instansi }}</td>
                <td>{{ $tamu->keperluan }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($tamu->created_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
