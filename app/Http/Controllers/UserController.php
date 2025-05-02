<?php
namespace App\Http\Controllers;
 
 use App\Models\m_user;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 
 class UserController extends Controller
 {
     public function index()
     {   
         $user = m_user::where('username','manager9')->firstOrFail();
         return view('user', ['data' => $user]);
     }
     
 }