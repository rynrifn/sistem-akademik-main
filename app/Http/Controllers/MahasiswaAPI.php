<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaApi extends Controller
{
    /**
     * GET /api/mahasiswa
     * Menampilkan semua data mahasiswa
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diambil',
            'data' => $mahasiswa
        ], 200);
    }

    /**
     * GET /api/mahasiswa/{id}
     * Menampilkan data mahasiswa berdasarkan ID
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('jurusan')->find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diambil',
            'data' => $mahasiswa
        ], 200);
    }

    /**
     * POST /api/mahasiswa
     * Menambahkan data mahasiswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim'         => 'required|string|max:20|unique:mahasiswa,nim',
            'nama'        => 'required|string|max:255',
            'id_jurusan'  => 'required|exists:jurusan,id_jurusan',
        ]);

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_jurusan' => $request->id_jurusan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa berhasil ditambahkan',
            'data' => $mahasiswa
        ], 201);
    }

    /**
     * PUT /api/mahasiswa/{id}
     * Mengupdate data mahasiswa berdasarkan ID
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nim'        => 'required|string|max:20|unique:mahasiswa,nim,' . $id . ',id_mahasiswa',
            'nama'       => 'required|string|max:255',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_jurusan' => $request->id_jurusan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa berhasil diperbarui',
            'data' => $mahasiswa->fresh('jurusan')
        ], 200);
    }

    /**
     * DELETE /api/mahasiswa/{id}
     * Menghapus data mahasiswa berdasarkan ID
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa berhasil dihapus'
        ], 200);
    }
}