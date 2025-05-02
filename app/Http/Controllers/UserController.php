<?php
namespace App\Http\Controllers;
 
 use App\Models\m_user;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 
 class UserController extends Controller
 {
     public function index()
     {   
        $count = m_user::where('level_id',2)->count();
        
         return view('user',compact ('count'));
     }
     
 }