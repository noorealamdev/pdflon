<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        // Retrieving models
        $user = User::find($id);

        return view('backend.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {

        //dd($request->all());
        // Form validation
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'profile_photo_path' => 'image|mimes:jpeg,jpg,png|max:300',
        ]);

        // Get user
        $user = User::find($id);

        // Get All Request
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($request->hasFile('profile_photo_path')){

            // Get image file
            $profile_photo_path = $request->file('profile_photo_path');

            // Folder path
            $folder ='uploads/';

            // Make image name
            $profile_photo_path_name =  time().'-'.$profile_photo_path->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$user->profile_photo_path));

            // Upload image
            $profile_photo_path->move($folder, $profile_photo_path_name);

            $user->profile_photo_path = $profile_photo_path_name;

        }

        // Update user
        $user->save();

        return redirect()->back()->with(['msg' => 'Updated Successfully', 'type' => 'success']);
    }

    /**
     * Display a change-password view.
     *
     */
    public function change_password_edit()
    {
        $user = User::first();
        return view('backend.profile.change-password', compact('user'));
    }

    /**
     * Update password.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function change_password_update(Request $request)
    {
        // Get All Request
        $input = $request->all();

        // User ID
        $id = Auth::id();

        // Current password
        $current_password = Auth::User()->password;

        if(Hash::check($input['current_password'], $current_password))
        {
            // Form validation
            $request->validate([
                'password' => ['required', 'string', 'confirmed'],
            ]);

            // Update password
            User::find($id)->update([
                'password' => Hash::make($input['password']),
            ]);

            return redirect()->route('profile.change_password_edit')->with(['msg' => 'Updated Successfully', 'type' => 'success']);

        } else{
            return redirect()->route('profile.change_password_edit')->with(['msg' => 'Password does not match', 'type' => 'danger']);
        }
    }
}
