<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // ==================== CRUD METHODS ====================
    
    public function index(Request $request)
    {
        $query = Mahasiswa::with('jurusan');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nim', 'like', '%' . $request->search . '%');
            });
        }

        $mahasiswa = $query->latest()->paginate(10)->withQueryString();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('mahasiswa.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'         => 'required|string|max:20|unique:mahasiswa,nim',
            'nama'        => 'required|string|max:255',
            'id_jurusan'  => 'required|exists:jurusan,id_jurusan',
        ]);

        Mahasiswa::create($request->only('nim', 'nama', 'id_jurusan'));

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $jurusan = Jurusan::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusan'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim'        => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id_mahasiswa . ',id_mahasiswa',
            'nama'       => 'required|string|max:255',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ]);

        $mahasiswa->update($request->only('nim', 'nama', 'id_jurusan'));

        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Mahasiswa berhasil diperbarui!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Mahasiswa berhasil dihapus!');
    }

    // ==================== EXPORT METHODS ====================

    // EXPORT CSV
    public function exportCsv()
    {
        $fileName = "mahasiswa.csv";
        $headers = [
            "Content-Type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=" . $fileName,
        ];
        
        $callback = function () {
            $file = fopen("php://output", "w");
            // Tambahkan BOM agar karakter UTF-8 terbaca baik di Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            // Header kolom
            fputcsv($file, [
                "ID",
                "NIM",
                "Nama",
                "Jurusan",
            ], ";");
            
            $mahasiswa = Mahasiswa::with('jurusan')->get();
            foreach ($mahasiswa as $item) {
                fputcsv($file, [
                    $item->id_mahasiswa,
                    $item->nim,
                    $item->nama,
                    $item->jurusan->nama_jurusan ?? "",
                ], ";");
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    // PRINT PDF (menampilkan view untuk di-print)
    public function print()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();
        return view('mahasiswa.print', compact('mahasiswa'));
    }

    // EXPORT EXCEL (XLS)
    public function exportExcel()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();

        return response()
            ->view('mahasiswa.excel', compact('mahasiswa'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename=mahasiswa.xls');
    }
}