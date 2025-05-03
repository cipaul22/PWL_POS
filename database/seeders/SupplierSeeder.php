<?php
 
 namespace Database\Seeders;
 
 use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\DB;
 
 class SupplierSeeder extends Seeder
 {
     public function run()
     {
         $data = [
             [
                 'supplier_id' => 1,
                 'supplier_kode' => 'SUP001',
                 'supplier_nama' => 'PT. Sumber Makmur',
                 'supplier_alamat' => 'Jl. Raya No. 1, Jakarta'
             ],
             [
                 'supplier_id' => 2,
                 'supplier_kode' => 'SUP002',
                 'supplier_nama' => 'CV. Berkah Jaya',
                 'supplier_alamat' => 'Jl. Sudirman No. 12, Bandung'
             ],
             [
                 'supplier_id' => 3,
                 'supplier_kode' => 'SUP003',
                 'supplier_nama' => 'UD. Sejahtera',
                 'supplier_alamat' => 'Jl. Merdeka No. 45, Surabaya'
             ],
             [
                 'supplier_id' => 4,
                 'supplier_kode' => 'SUP004',
                 'supplier_nama' => 'PT. Abadi Sentosa',
                 'supplier_alamat' => 'Jl. Diponegoro No. 22, Medan'
             ],
             [
                 'supplier_id' => 5,
                 'supplier_kode' => 'SUP005',
                 'supplier_nama' => 'Toko Sukses',
                 'supplier_alamat' => 'Jl. Imam Bonjol No. 9, Semarang'
             ],
             [
                 'supplier_id' => 6,
                 'supplier_kode' => 'SUP006',
                 'supplier_nama' => 'CV. Mandiri Sejahtera',
                 'supplier_alamat' => 'Jl. Gajah Mada No. 3, Yogyakarta'
             ],
             [
                 'supplier_id' => 7,
                 'supplier_kode' => 'SUP007',
                 'supplier_nama' => 'UD. Karya Abadi',
                 'supplier_alamat' => 'Jl. Kartini No. 7, Malang'
             ],
             [
                 'supplier_id' => 8,
                 'supplier_kode' => 'SUP008',
                 'supplier_nama' => 'PT. Sinar Baru',
                 'supplier_alamat' => 'Jl. Dipatiukur No. 15, Makassar'
             ],
             [
                 'supplier_id' => 9,
                 'supplier_kode' => 'SUP009',
                 'supplier_nama' => 'Toko Jaya Makmur',
                 'supplier_alamat' => 'Jl. Teuku Umar No. 17, Denpasar'
             ],
             [
                 'supplier_id' => 10,
                 'supplier_kode' => 'SUP010',
                 'supplier_nama' => 'CV. Cahaya Terang',
                 'supplier_alamat' => 'Jl. Ahmad Yani No. 20, Palembang'
             ],
         ];
 
         DB::table('m_suppliers')->insert($data);
     }
 }