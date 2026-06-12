<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $query = Jurusan::withCount(['mahasiswa', 'matakuliah']);

        if ($request->filled('search')) {
            $query->where('nama_jurusan', 'like', '%' . $request->search . '%')
                  ->orWhere('akreditasi', 'like', '%' . $request->search . '%');
        }

        $jurusan = $query->latest()->paginate(10)->withQueryString();
        return view('jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'akreditasi'   => 'required|in:A,B,C',
        ]);

        Jurusan::create($request->only('nama_jurusan', 'akreditasi'));

        return redirect()->route('jurusan.index')
                         ->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'akreditasi'   => 'required|in:A,B,C',
        ]);

        $jurusan->update($request->only('nama_jurusan', 'akreditasi'));

        return redirect()->route('jurusan.index')
                         ->with('success', 'Jurusan berhasil diperbarui!');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')
                         ->with('success', 'Jurusan berhasil dihapus!');
    }

    // ==================== EXPORT METHODS ====================

    // EXPORT CSV untuk Jurusan
    public function exportCsv()
    {
        $fileName = "jurusan.csv";
        $headers = [
            "Content-Type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=" . $fileName,
        ];
        
        $callback = function () {
            $file = fopen("php://output", "w");
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            fputcsv($file, [
                "ID",
                "Nama Jurusan",
                "Akreditasi",
                "Jumlah Mahasiswa",
                "Jumlah Matakuliah",
            ], ";");
            
            $jurusan = Jurusan::withCount(['mahasiswa', 'matakuliah'])->get();
            foreach ($jurusan as $item) {
                fputcsv($file, [
                    $item->id_jurusan,
                    $item->nama_jurusan,
                    $item->akreditasi,
                    $item->mahasiswa_count,
                    $item->matakuliah_count,
                ], ";");
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    // PRINT PDF untuk Jurusan
    public function print()
    {
        $jurusan = Jurusan::withCount(['mahasiswa', 'matakuliah'])->get();
        return view('jurusan.print', compact('jurusan'));
    }

    // EXPORT EXCEL (XLS) untuk Jurusan
    public function exportExcel()
    {
        $jurusan = Jurusan::withCount(['mahasiswa', 'matakuliah'])->get();

        return response()
            ->view('jurusan.excel', compact('jurusan'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename=jurusan.xls');
    }
}