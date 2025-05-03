<?php
 
 namespace App\Http\Controllers;

use App\Models\m_supplier;
use Illuminate\Http\Request;
 use App\Models\SupplierModel;
 use Yajra\DataTables\Facades\DataTables;
 
 class SupplierController extends Controller
 {
     public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Supplier',
             'list' => ['Home', 'Supplier']
         ];
 
         $page = (object) [
             'title' => 'Daftar supplier yang terdaftar dalam sistem'
         ];
         $activeMenu = 'supplier'; // Set menu yang sedang aktif
 
         $supplier = m_supplier::all();
 
         return view('supplier.index', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
     }
 
     public function list(Request $request)
     {
         $suppliers = m_supplier::query()->select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat');
 
         // Filter berdasarkan supplier_id jika ada
         if ($request->filled('supplier_id')) {
             $suppliers->where('supplier_id', $request->supplier_id);
         }
 
         return DataTables::of($suppliers)
             ->addIndexColumn() // Menambahkan kolom index otomatis
             ->addColumn('aksi', function ($supplier) {
                 return '
                     <a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> 
                     <a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> 
                     <form class="d-inline-block" method="POST" action="' . url('/supplier/' . $supplier->supplier_id) . '">
                         ' . csrf_field() . method_field('DELETE') . '
                         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">Hapus</button>
                     </form>
                 ';
             })
             ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi mengandung HTML
             ->make(true);
     }
 }