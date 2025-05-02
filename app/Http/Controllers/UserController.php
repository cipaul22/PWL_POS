<?php
namespace App\Http\Controllers;
 
 use App\Models\m_user;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 
 class UserController extends Controller
 {
     public function index()
     {   
         $user = m_user::findOr(20,['username','nama'],function(){
            abort(404);
         });
         return view('user', ['data' => $user]);
     }
     
 }