<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use App\Models\BarangModel;
 use Yajra\DataTables\Facades\DataTables;
 use App\Models\KategoriModel;
use App\Models\m_barang;
use App\Models\m_kategori;
use App\Models\m_user;

 class BarangController extends Controller
 {
 
     public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Barang',
             'list' => ['Home', 'Barang']
         ];
 
         $page = (object) [
             'title' => 'Daftar barang yang terdaftar dalam sistem'
         ];
         $activeMenu = 'barang'; // Set menu yang sedang aktif
 
         $kategori = m_kategori::all();
 
         return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
     }
 
     // Ambil data barang dalam bentuk JSON untuk DataTables
     public function list(Request $request)
     {
         $barangs = m_barang::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
             ->with('kategori');
             // ->orderBy('barang_id', 'asc'); // Urutkan berdasarkan barang_id
         
         if ($request -> level_id) {
             $barangs->where('kategori_id', $request->kategori_id);
         }
 
         return DataTables::of($barangs)
             ->addIndexColumn() // Menambahkan kolom index otomatis
             ->addColumn('aksi', function ($barang) {
                 return '
                     <a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> 
                     <a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> 
                     <form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">
                         ' . csrf_field() . method_field('DELETE') . '
                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">Hapus</button>
                     </form>
                 ';
             })
             ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi mengandung HTML
             ->make(true);
     }
 
     public function foodBeverage(){
         return view('POS.foodBeverage');
     }
     public function beautyHealth(){
         return view('POS.beautyHealth');
     }
 
     public function homeCare(){
         return view('POS.homeCare');
     }
 
     public function babyKid(){
         return view('POS.babyKid');
     }
 }