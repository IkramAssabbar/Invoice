<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('users.edit')->with('user', $user);
    }
    
    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        if ($request->hasFile('profile_photo')) {
            $img= $request->file('img_upload');
            $imgPath = $img->store('public/profiles');
            $user->img = $imgPath;
        }
        $user->save();
    
        return redirect()->route('users.edit', ['user' => $user->id])->with('success', 'Profil mis à jour avec succès !');
    }
    

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /*public function password(Request $request){
        
        $request->validate([
        'password'=> 'required min:6|max: 100',
        'newpassword'=> 'required min:6 |max:100',
        ]);
        $user=auth()->user() ;
        if(Hash::check($request->password, $user->password)){

            $user->update([
               'password'=>bcrypt ($request->newpassword)
        ]);
        
        return redirect()->back()->with('success', 'Password successfully updated.');
    }else
    {
        return redirect()->back()->with('error', 'Old password does not catch');
    }
    
}*/

    public function updatePassword(Request $request,$id)
    {
        dd($request->all());
       /* $request->validate([
            'newpassword' => 'required|string|min:8|confirmed',
        ]);

        // Récupérez l'administrateur authentifié
       
        $admin=User::where('id',$id)->first();

        // Mettez à jour le mot de passe de l'administrateur avec le nouveau mot de passe haché
        $admin->update([
            'password' => Hash::make($request->input('newpassword')),
        ]);

        return back()->withSuccess('Profil mis à jour avec succès !');*/
    }

    
   
}
