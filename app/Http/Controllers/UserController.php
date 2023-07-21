<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        dd($request->all());
    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('users.edit')->with('user', $user);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required',
            'img'=> 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            ]);

        $user=User::where('id',$id)->first();
        if(isset($request->img)){
            $imgName=time().'.'.$request->img->extension();
            $request->img->move(public_path('users'),$imgName);
            $user->img=$imgName;
        }

     
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();
    
        return back()->withSuccess('Profil mis à jour avec succès !');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'password' => 'required|string',
        'newpassword' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Mot de passe actuel incorrect.']);
    }

    $user->update([
        'password' => Hash::make($request->newpassword),
    ]);

    return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès.');
}
   
}
