<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class UserController extends Controller
{
    public function create()
    {
        $title = 'Регистрация';
        return view('user.create', compact('title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'Username'=>'required',
            'Email'=>'required|email|unique:users',
            'password'=>'required',
            'UserPhoto'=> 'nullable|image',
        ]);

    if ($request->hasFile('UserPhoto')){
        $folder = date('Y-m-d');
        $avatar = $request->file('UserPhoto')->store("public/images/{$folder}");
        $image = str_replace('public/', '', $avatar);
    }
   

        $user = User::create([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'password' =>Hash::make($request->password),
            'UserPhoto'=>$image ?? null,
        ]);

        session()->flash('success', 'Регистрация пройдена!');
        Auth::login($user);
        
        return redirect()->route('home');
        
    }

    public function LoginCreate()
    {
        $title = 'Авторизация';
        return view('user.login.create', compact('title'));
    }

    public function LoginStore(Request $request)
    {
        $request->validate([
            'Email'=>'required|email',
            'password'=>'required',
        ]);
        if (Auth::attempt([
            'Email' => $request->Email,
            'password' =>$request->password,
        ])) {
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Некоректный Логин или Пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
