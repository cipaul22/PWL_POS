<?php

namespace App\Http\Controllers;

use App\Models\m_user;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = m_user::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ]
        );
        $user->username = 'manager303';

        $user->save();

        $user->wasChanged();
        $user->wasChanged('username');
        $user->wasChanged('nama');
        $user->wasChanged(['nama', 'username']);
        dd($user->wasChanged(['nama', 'username']));
    }
}