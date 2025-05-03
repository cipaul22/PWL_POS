<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\m_level;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];
        $activeMenu = 'level'; // Set menu yang sedang aktif

        $level = m_level::all();

        return view('level.index', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $levels = m_level::query()->select('level_id', 'level_kode', 'level_nama');

        // Filter berdasarkan level_id jika ada
        if ($request->filled('level_id')) {
            $levels->where('level_id', $request->level_id);
        }

        return DataTables::of($levels)
            ->addIndexColumn() // Menambahkan kolom index otomatis
            ->addColumn('aksi', function ($level) {
                return '
                    <a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> 
                    <a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> 
                    <form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">Hapus</button>
                    </form>
                ';
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi mengandung HTML
            ->make(true);
    }
}