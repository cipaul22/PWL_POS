<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_user;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Models\m_level;


class UserController extends Controller
{

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];
        $activeMenu = 'user'; // Set menu yang sedang aktif

        $level = m_level::all();

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $users = m_user::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');
            // ->orderBy('user_id', 'asc'); // Urutkan berdasarkan user_id
        
        if ($request -> level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn() // Menambahkan kolom index otomatis
            ->addColumn('aksi', function ($user) {
                return '
                    <a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> 
                    <a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> 
                    <form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">Hapus</button>
                    </form>
                ';
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi mengandung HTML
            ->make(true);
    }

    // Menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah user baru'
        ];
        $level = m_level::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
{
    // Validasi data yang masuk
    $request->validate([
        'username' => 'required|string|min:3|unique:m_users,username',
        'nama' => 'required|string|max:100',
        'password' => 'required|min:5',
        'level_id' => 'required|integer',
    ]);

    // Buat user baru menggunakan Eloquent Mass Assignment
    m_user::create([
        'username' => $request->username,
        'nama' => $request->nama,
        'password' => Hash::make($request->password), // Gunakan Hash::make untuk enkripsi
        'level_id' => $request->level_id,
    ]);

    // Redirect dengan pesan sukses
    return redirect('/user')->with('success', 'Data user berhasil disimpan.');
}


public function destroy(string $id)
{
    $check = m_user::find($id);
    if (!$check) {
        return redirect('/user')->with('error', 'Data user tidak ditemukan');
    }
    
    try {
        m_user::destroy($id); // Hapus data user
        return redirect('/user')->with('success', 'Data user berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}


    // Menampilkan detail user
    public function show(string $id)
    {
        $user = m_user::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail user'
        ];
        $activeMenu = 'user'; // set menu yang sedang aktif

        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit user
    public function edit(string $id) 
{
    $user = m_user::find($id);
    $level = m_level::all();

    $breadcrumb = (object) [
        'title' => 'Edit User',
        'list' => ['Home', 'User', 'Edit']
    ];

    $page = (object) [
        'title' => 'Edit user'
    ];

    $activeMenu = 'user'; // set menu yang sedang aktif

    return view('user.edit', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'user' => $user,
        'level' => $level, // Perbaikan tanda kutip
        'activeMenu' => $activeMenu
    ]);
}



    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
{
    $request->validate([
        'username' => 'required|string|min:3|unique:m_users,username,' . $id . ',user_id',
        'nama' => 'required|string|max:100',
        'password' => 'nullable|min:5',
        'level_id' => 'required|integer'
    ]);

    // Ambil data user dari database
    $user = m_user::find($id);

    // Cek apakah user ditemukan
    if (!$user) {
        return redirect('/user')->with('error', 'User tidak ditemukan');
    }

    // Update data user
    $user->update([
        'username' => $request->username,
        'nama' => $request->nama,
        'password' => $request->password ? bcrypt($request->password) : $user->password,
        'level_id' => $request->level_id
    ]);

    return redirect('/user')->with('success', 'Data user berhasil diubah');
}


    // public function index()
    // {
    //     $user = m_user::with('level')->get();
    //     return view('user', ['data' => $user]);
    // }

    public function user()
    {
        return view('POS.user');
    }

    public function tambah()
    {
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        m_user::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);

        return redirect('/user');
    }

    public function ubah($id)
    {
        $user = m_user::find($id);
        return view('user_ubah', ['data' => $user]);
    }
    public function ubah_simpan($id, Request $request)
    {

        $user = m_user::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = m_user::find($id);
        $user->delete();
        return redirect('/user');
    }
}