<?php
 
 namespace Database\Seeders;
 
 use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\DB;
 
 class PenjualanSeeder extends Seeder
 {
     /**
      * Run the database seeds.
      */
     public function run(): void
     {
         $data = [
             [
                 'penjualan_id' => 1,
                 'user_id' => 1,
                 'pembeli' => 'Muhammad Rosyid',
                 'penjualan_kode' => 'PJ001',
                 'penjualan_tanggal' => '2024-02-01',
             ],
             [
                 'penjualan_id' => 2,
                 'user_id' => 2,
                 'pembeli' => 'Naufal Gajendra',
                 'penjualan_kode' => 'PJ002',
                 'penjualan_tanggal' => '2024-02-02',
             ],
             [
                 'penjualan_id' => 3,
                 'user_id' => 3,
                 'pembeli' => 'Keysha Arindra',
                 'penjualan_kode' => 'PJ003',
                 'penjualan_tanggal' => '2024-02-03',
             ],
             [
                 'penjualan_id' => 4,
                 'user_id' => 1,
                 'pembeli' => 'Joshepine Antonia',
                 'penjualan_kode' => 'PJ004',
                 'penjualan_tanggal' => '2024-02-04',
             ],
             [
                 'penjualan_id' => 5,
                 'user_id' => 2,
                 'pembeli' => 'Lavina',
                 'penjualan_kode' => 'PJ005',
                 'penjualan_tanggal' => '2024-02-05',
             ],
             [
                 'penjualan_id' => 6,
                 'user_id' => 3,
                 'pembeli' => 'Randa Heru',
                 'penjualan_kode' => 'PJ006',
                 'penjualan_tanggal' => '2024-02-06',
             ],
             [
                 'penjualan_id' => 7,
                 'user_id' => 1,
                 'pembeli' => 'Jaden Natha',
                 'penjualan_kode' => 'PJ007',
                 'penjualan_tanggal' => '2024-02-07',
             ],
             [
                 'penjualan_id' => 8,
                 'user_id' => 2,
                 'pembeli' => 'Pandya Cahya',
                 'penjualan_kode' => 'PJ008',
                 'penjualan_tanggal' => '2024-02-08',
             ],
             [
                 'penjualan_id' => 9,
                 'user_id' => 3,
                 'pembeli' => 'Marga Reta',
                 'penjualan_kode' => 'PJ009',
                 'penjualan_tanggal' => '2024-02-09',
             ],
             [
                 'penjualan_id' => 10,
                 'user_id' => 1,
                 'pembeli' => 'Hifna Jua',
                 'penjualan_kode' => 'PJ010',
                 'penjualan_tanggal' => '2024-02-10',
             ],
         ];
         DB::table('t_penjualans')->insert($data);
     }
 }