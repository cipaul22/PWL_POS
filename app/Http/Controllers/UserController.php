<?php
namespace App\Http\Controllers;
 
 use App\Models\m_user;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 
 class UserController extends Controller
 {
     public function index()
     {   
        $data=[
            'level_id'=>2,
            'username'=>'manager_tiga',
            'nama'=>'Manager 3',
            'password'=>Hash::make('12345')
        ];
        m_user::create($data);

         $user = m_user::all();
         return view('user', ['data' => $user]);
     }
     
 }