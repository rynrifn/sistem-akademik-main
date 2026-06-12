<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = Matakuliah::with('jurusan');

        if ($request->filled('search')) {
            $query->where('nama_matakuliah', 'like', '%' . $request->search . '%');
        }

        $matakuliah = $query->latest()->paginate(10)->withQueryString();
        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        $jurusan = Jurusan::all();
        return view('matakuliah.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:255',
            'sks'             => 'required|integer|min:1|max:6',
            'id_jurusan'      => 'required|exists:jurusan,id_jurusan',
        ]);

        Matakuliah::create($request->only('nama_matakuliah', 'sks', 'id_jurusan'));

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Matakuliah berhasil ditambahkan!');
    }

    public function edit(Matakuliah $matakuliah)
    {
        $jurusan = Jurusan::all();
        return view('matakuliah.edit', compact('matakuliah', 'jurusan'));
    }

    public function update(Request $request, Matakuliah $matakuliah)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:255',
            'sks'             => 'required|integer|min:1|max:6',
            'id_jurusan'      => 'required|exists:jurusan,id_jurusan',
        ]);

        $matakuliah->update($request->only('nama_matakuliah', 'sks', 'id_jurusan'));

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Matakuliah berhasil diperbarui!');
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')
                         ->with('success', 'Matakuliah berhasil dihapus!');
    }

    // ==================== EXPORT METHODS ====================

    // EXPORT CSV untuk Matakuliah
    public function exportCsv()
    {
        $fileName = "matakuliah.csv";
        $headers = [
            "Content-Type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=" . $fileName,
        ];
        
        $callback = function () {
            $file = fopen("php://output", "w");
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            fputcsv($file, [
                "ID",
                "Nama Matakuliah",
                "SKS",
                "Jurusan",
            ], ";");
            
            $matakuliah = Matakuliah::with('jurusan')->get();
            foreach ($matakuliah as $item) {
                fputcsv($file, [
                    $item->id_matakuliah,
                    $item->nama_matakuliah,
                    $item->sks,
                    $item->jurusan->nama_jurusan ?? '',
                ], ";");
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    // PRINT PDF untuk Matakuliah
    public function print()
    {
        $matakuliah = Matakuliah::with('jurusan')->get();
        return view('matakuliah.print', compact('matakuliah'));
    }

    // EXPORT EXCEL (XLS) untuk Matakuliah
    public function exportExcel()
    {
        $matakuliah = Matakuliah::with('jurusan')->get();

        return response()
            ->view('matakuliah.excel', compact('matakuliah'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename=matakuliah.xls');
    }
}