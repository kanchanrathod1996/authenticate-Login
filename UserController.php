<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function all_records()
    {
      

        $all_records = User::all();
        return view('auth.all_records',compact('all_records'));
    }


    public function edit()
    {
        $id = auth()->user()->id;   //auth user 
        $user = User::find($id); // Fetch user data by ID
        return view('auth.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$request->user_id,
            'gender' => 'required|in:Male,Female',
            'language' => 'nullable|array',
            'state' => 'required',
            'city' => 'required|string|max:255',
            'pincode' => 'nullable|string|max:10',
            'contact' => 'nullable|string|max:15',
            'image' => 'nullable|image|max:2048', // 2MB max size for image
        ]);
    
        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            // Update user record with new image path
            $validatedData['image'] = $imageName;
        }
    
        // Update user record
        $user = User::find($request->user_id);
        if (!$user) {
            return redirect()->route('edit.user')->with('error', 'User not found.');
        }
        $user->update($validatedData);
    
        return redirect()->route('all.records')
                         ->with('message', 'User details updated successfully.')
                         ->with('alert-class', 'alert-success');
    }
}

