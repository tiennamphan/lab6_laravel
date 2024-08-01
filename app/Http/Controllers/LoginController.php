<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function login(){
     return view('login');
    }

    public function listAccount()
    {
        $users = User::paginate(5);
        // dd($users);
        return view('Admin/listAccount', compact('users'));
    }

    public function edit()
    {
        if (isset(Auth::user()->fullname)) {
            return view('user/detail', compact('user'));
        } else {
            return redirect()->route('login');
        }
        $user = Auth::user();
        // dd($user);
        return view('user/edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->except('avatar');
        $old_img = $user->avatar;
        $data['avatar'] = $old_img;
        if ($request->hasFile('avatar')) {
            $path_image = $request->file('avatar')->store('avatars');
            $data['avatar'] = $path_image;
        }

        // dd($data);
        $user->update($data);

        if ($request->hasFile('image')) {
            if (file_exists('storage/' . $old_img)) {
                unlink('storage/' . $old_img);
            }
        }

        return redirect()->back()->with('message', 'Update Data Success!!!');
    }



    public function toChange()
    {
        if (isset(Auth::user()->fullname)) {
            return view('user/detail', compact('user'));
        } else {
            return redirect()->route('login');
        }
        $user = Auth::user();
        // dd($user);
        return view('user/changePass', compact('user'));
    }

    public function changePass(Request $request, User $user)
    {
        $data = $request->except('oldPassword', 'rePassword');
        $old_img = $user->avatar;
        $data['avatar'] = $old_img;
        // dd(Auth::user()->password);
        if (Hash::check($request->oldPassword, Auth::user()->password)) {
            if ($request->password == $request->rePassword) {
                $data['password'] = bcrypt($request->password);
                $user->update($data);
                return redirect()->back()->with('message', 'Change Password Success!!!');
                } else {
                    return redirect()->back()->with('error', 'Password Not Match!!!');
                    }
                    } else {
                        return redirect()->back()->with('error', 'Old Password Not Match!!!');
                        }

        // $user->update($data);


        return redirect()->back()->with('message', 'Update Data Success!!!');

        dd($data);
        // $user->update($data);

    }

    public function postLogin(Request $request){
        $data = $request->only(['email','password']);
        if(Auth::attempt($data)){
            return redirect()->route('account.list');
        }
        else{
            return redirect()->back()->with('errorLogin','Login Failed!!!');
            
        }
    }

    public function register(){
        return view('register');
    }

    public function postRegister(Request $request){
        $data = $request->all();
        User::query()->create($data);
        return redirect()->route('login')->with('message','Register Success!!!');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function detail()
    {
        $user = Auth::user();
        // dd($user);
        if(isset(Auth::user()->fullname)){
            return view('user/detail', compact('user'));
        }
        else{
            return redirect()->route('login');
        }

    }

    public function setAble(Request $request, User $user){
        // $id = $request->only('id');
        // $user = User::find($id);
        // dd($user->id);
        // $user->update(['active' => '0']);

        // if($user->active == 1){
        //     $user->update(['active' => 0]);
        // }
        // if($user->active == 0){
        //     $user->update(['active' => 1]);
        // }


        $data = $request->except('image');

        // $data['image'] = $old_img;
        if ($data['active'] == 0) {
            $data['active'] = 1;
            $user->update($data);
        }
        elseif ($data['active'] == 1) {
            $data['active'] = 0;
            $user->update($data);
        }

        // $post->update($data);

        return redirect()->route('account.list');
    }
}
