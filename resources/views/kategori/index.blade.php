@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title ?? 'Daftar Kategori' }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('kategori/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kategori ID</th>
                        <th>Kategori Kode</th>
                        <th>Kategori Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <!-- Bisa ditambahkan CSS tambahan di sini jika diperlukan -->
@endpush

@push('js')
    <script defer>
        $(document).ready(function () {
            var dataLevel = $('#table_kategori').DataTable({
                processing: true, // Tambahkan loading indicator
                serverSide: true, 
                ajax: {
                    url: "{{ url('kategori/list') }}",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }, // Menambahkan CSRF Token ke headers
                    dataType: "json"
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "kategori_id", orderable: true, searchable: true },
                    { data: "kategori_kode", orderable: true, searchable: true },
                    { data: "kategori_nama", orderable: true, searchable: true },
                    { data: "aksi", orderable: false, searchable: false, className: "text-center" }
                ],
                language: {
                    processing: "Memproses data...",
                    zeroRecords: "Tidak ada data yang tersedia",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                }
            });

            // Filter berdasarkan kategori_id (jika ada dropdown filter)
            $('#kategori_id').on('change', function() {
                dataKategori.ajax.reload();
            });
        });
    </script>
@endpush