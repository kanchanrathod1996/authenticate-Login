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


============================ogin.blade.php===========================
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet">
 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>

html,body { 
	height: 100%; 
}

.global-container{
	height:100%;
	display: flex;
	align-items: center;
	justify-content: center;
	background-color: #f5f5f5;
}

form{
	padding-top: 10px;
	font-size: 14px;
	margin-top: 30px;
}

.card-title{ font-weight:300; }

.btn{
	font-size: 14px;
	margin-top:20px;
}


.login-form{ 
	width:330px;
	margin:20px;
}

.sign-up{
	text-align:center;
	padding:20px 0 0;
}

.alert{
	margin-bottom:-30px;
	font-size: 13px;
	margin-top:20px;
}

    </style>
</head>
<body>
    


    <div class="global-container">
        <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Log in</h3>
            <div class="card-text">
                <!--
                <div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                <form action="{{route('admin.authenticate')}}" method="post">
                    @csrf   <!-- to error: add class "has-danger" -->
                 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" name="email"aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                     
                        <input type="password" class="form-control form-control-sm" name="password"id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    
                    <div class="sign-up">
                        Don't have an account? <a href="#">Create One</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    
</body>
</html>

============================================Dashboardcontoller.php==================================

<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Note;
use App\Models\Admin;
use App\Models\Page;
use Carbon\Carbon;
use Hash;

class Dashboardcontoller extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users (adjust query as needed)
        return view('admin.dashboard', compact('users'));
    }
    public function logout()
    {
        Auth::guard('admin')->logout(); // Logout admin
        return redirect('/admin/login'); // Redirect to admin login page
    }
    }
=========================Route==================================


Route::group(['prefix' => 'admin'],function(){
    
    route::group(['middleware' => 'admin.guest'],function(){
       
        Route::get('login', [Adminlogincontoller::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [Adminlogincontoller::class, 'login'])->name('admin.authenticate');
       
      
    });

    route::group(['middleware' => 'admin.auth'],function(){

        Route::get('/dashboard', [Dashboardcontoller::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [Dashboardcontoller::class, 'logout'])->name('admin.logout');
  });


});


