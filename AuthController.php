<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Note;
use Hash;
  
class AuthController extends Controller
{ 
  public function home()
    {
        return view('home');
    }  
      
    public function index()
    {
        return view('auth.login');
    }  
      
   
   
    public function postLogin(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->only('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Redirect back if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->only('email'));
        }
    
        // Attempt to authenticate user
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        
        if (Auth::attempt($credentials, $remember)) {
            
            return redirect()->intended(route('dashboard'))->with('success', 'You have successfully logged in.');
        } else {
           
            return redirect()->back()->withInput($request->only('email'))->with('error', 'Either email/password is incorrect.');
        }
    }
    
    
    public function registration()
    {
        return view('auth.registration');
    }
      
   
   
        public function postRegistration(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
    
            $data = $request->all();
            $check = $this->create($data);
    
            return redirect("/user/login")->withSuccess('Great! You have Successfully Registration ');
          
        }
    
    
    public function dashboard()
    {
        if(Auth::check()){
            $user = auth()->user();
            return view('dashboard', compact('user'));
        }
  
        return redirect("/")->withSuccess('Opps! You do not have access');
    }
    

    
   
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
   
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('');
    }


   
}
