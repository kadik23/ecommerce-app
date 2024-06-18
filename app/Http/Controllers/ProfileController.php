<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use photos;
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('profile');
        return response()->json(Auth::user()); 
    }

    public function profileEdit(Request $request){
        
        $user = Auth::user(); // Get the currently authenticated user
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'tel' => ['integer','max:9223372036854775807'],
        ]);
        $user_update=User::findOrFail($user->id);     
        $user_update->username = strip_tags($request->input('username'));
        $user_update->email = strip_tags($request->input('email'));
        $user_update->phone = strip_tags($request->input('tel'));
        $user_update->city = strip_tags($request->input('city'));
        $user_update->country = strip_tags($request->input('country'));
        $user_update->save();
    
    return redirect()->route('dash.myprofile');

    }

    public function pictureEdit(Request $request){
        $user = Auth::user(); // Get the currently authenticated user
        $image_update=User::findOrFail($user->id); 
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
         // save photo in folder
        $file_name = $this->save_photo($request->image,'profiles');

        $image_update->profileImage=$file_name;    
        $image_update->save();
    
        return redirect()->route('dash.myprofile');
    }
}

