<?php
namespace App\Http\Controllers;
 
 use App\Models\m_user;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 
 class UserController extends Controller
 {
     public function index()
     {   
        $user = m_user::firstOrNew(
            [
                'username'=>'manager33',
                'nama'=>'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ],
        );
        $user->save();
        return view('user',['data'=>$user]);
     }
     
 }