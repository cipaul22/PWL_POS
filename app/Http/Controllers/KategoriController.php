<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Models\m_kategori;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{


    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];
        $activeMenu = 'kategori'; // Set menu yang sedang aktif

        $kategori = m_kategori::all();

        return view('kategori.index', compact('breadcrumb', 'page', 'kategori', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $kategoris = m_kategori::query()->select('kategori_id', 'kategori_kode', 'kategori_nama');

        // Filter berdasarkan kategori_id jika ada
        if ($request->filled('kategori_id')) {
            $kategoris->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($kategoris)
            ->addIndexColumn() // Menambahkan kolom index otomatis
            ->addColumn('aksi', function ($kategori) {
                return '
                    <a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> 
                    <a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> 
                    <form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">Hapus</button>
                    </form>
                ';
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi mengandung HTML
            ->make(true);
    }

    // public function index(KategoriDataTable $dataTable)
    // {
    //     return $dataTable->render('kategori.index');
    // }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        m_kategori::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori
        ]);
        return redirect('/kategori');
    }

    public function edit($id){
        $kategori = m_kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = m_kategori::findOrFail($id);
        $kategori->update([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diedit');
    }

    public function destroy($id)
    {
        $kategori = m_kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}