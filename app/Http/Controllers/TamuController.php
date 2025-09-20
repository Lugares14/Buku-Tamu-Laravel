<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage; 

class TamuController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'instansi' => 'nullable',
            'keperluan' => 'required',
            'foto' => 'required'
        ]);

               if ($request->foto) {
        $image = str_replace('data:image/png;base64,', '', $request->foto);
        $image = str_replace(' ', '+', $image);
        $imageName = 'tamu_' . time() . '.png';

        Storage::disk('public')->put("foto_tamu/{$imageName}", base64_decode($image));
    }

    Tamu::create([
        'nama' => $request->nama,
        'instansi' => $request->instansi,
        'keperluan' => $request->keperluan,
        'foto' => 'foto_tamu/' . $imageName,
    ]);

        return redirect()->route('tamu.form')->with('success', 'Data berhasil dikirim!');
    }

    public function indexAdmin(Request $request)
    {
        $query = Tamu::query();

        // Filter berdasarkan kata kunci pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                ->orWhere('instansi', 'like', "%$search%")
                ->orWhere('keperluan', 'like', "%$search%");
            });
        }

        // ✅ Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $tamus = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.daftar_tamu', compact('tamus'));
    }



    public function edit($id)
    {
        $tamu = Tamu::findOrFail($id);
        return view('admin.tamu.edit', compact('tamu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'instansi' => 'nullable',
            'keperluan' => 'required',
        ]);

        $tamu = Tamu::findOrFail($id);
        $tamu->update($request->all());

        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tamu = Tamu::findOrFail($id);
        $tamu->delete();

        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil dihapus.');
    }

}
