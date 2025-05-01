<?php
namespace App\Http\Controllers;
 
 use App\Models\m_user;
 use Illuminate\Http\Request;
 
 class UserController extends Controller
 {
     public function index()
     {
         $user = m_user::all();
         return view('user', ['data' => $user]);
     }
 }