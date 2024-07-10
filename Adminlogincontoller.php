<?php
  
namespace App\Http\Controllers\admin;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\Admin;
use Hash;
use DB;
use App\Models\User;
class Adminlogincontoller extends Controller
    
{   
    public function showLoginForm()
    {
        // dd(Admin::all());
        return view('admin.login'); // Create a view for admin login form
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
          
            return redirect()->intended('/admin/dashboard'); // Redirect to admin dashboard  
        }

     
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout(); // Logout admin
        return redirect('/admin/login'); // Redirect to admin login page
    }


    

}