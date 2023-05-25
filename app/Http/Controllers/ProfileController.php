<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index($id)
    {
        $data = Profile::where('users_id',$id)->get();
        
        return view('user.contents.profile.index', compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'phone' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'photo' => 'image',
        ]);

        Profile::create([
            'users_id' => auth()->user()->id,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'photo' => $request->file('photo')->store('photo-profile'),
        ]);

        return redirect('/profile'.'/'.auth()->user()->id);
    }

    public function update(Request $request){

        // dd($request);
        if ($request->photo) {
            
        $request->validate([
            'phone' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
            'photo' => 'image',
        ]);

        Profile::where('users_id',auth()->user()->id)->update([
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'photo' => $request->file('photo')->store('photo-profile')
        ]);

        Storage::delete($request->photo);
        } else {
            
        $request->validate([
            'phone' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',
        ]);

        Profile::where('users_id',auth()->user()->id)->update([
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
        ]);

        }

        return redirect('/profile'.'/'.auth()->user()->id);
    }
}
