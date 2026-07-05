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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->ajax() || $request->wantsJson()){
            return response()->json(Auth::user());
        }
        return view('profile');
    }

    public function profileEdit(Request $request){
        
        $user = Auth::user(); // Get the currently authenticated user
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'tel' => ['nullable','integer','max:9223372036854775807'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);
        $user_update=User::findOrFail($user->id);     
        $user_update->username = strip_tags($request->input('username'));
        $user_update->email = strip_tags($request->input('email'));
        $user_update->phone = $request->filled('tel') ? strip_tags($request->input('tel')) : null;
        $user_update->city = $request->filled('city') ? strip_tags($request->input('city')) : null;
        $user_update->country = $request->filled('country') ? strip_tags($request->input('country')) : null;
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