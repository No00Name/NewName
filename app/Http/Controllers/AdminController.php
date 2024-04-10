<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Advertisement;
use App\Models\Categorie;

class AdminController extends Controller
{
    public function index(){
        $title = "Панель администраторов";
        $posts = User::orderBy('id')->get();
        foreach ($posts as $post) {
            $ban = $post->Banet == 1 ? "Забанен": "Незабанен";
            $post->ban = $ban;
        }
        return view('admin.admin', compact('posts', 'title'));
    }

    public function create($id)
    {
        $title = 'Редактирование данных пользователя';
        $user_id = $id;
        $user = User::find($id);
        return view('admin.create', compact('title','user_id', 'user'));
    }
    public function store(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'Username'=>'required',
            'Email'=>'required|email',
            'password'=>'required',
            'UserPhoto'=> 'nullable|image',
        ]);

        if ($request->hasFile('UserPhoto')){
            $folder = date('Y-m-d');
            $avatar = $request->file('UserPhoto')->store("public/images/{$folder}");
            $image = str_replace('public/', '', $avatar);
        }
        $user->update([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'password' =>Hash::make($request->password),
            'UserPhoto'=>$image ?? $user->UserPhoto,
        ]);
        
        return redirect()->route('admin.index');
        
    }
    public function ban($id)
    {
        $title = "Панель администраторов";
        $post = User::find($id);
        
        if ($post) {
        $post->Banet = $post->Banet == 1 ? 0:1;
        $post->save();
        }
        $posts = User::orderBy('id')->get();
        foreach ($posts as $post) {
            $ban = $post->Banet == 1 ? "Забанен": "Незабанен";
            $post->ban = $ban;
        }
        return view('admin.admin', Compact('posts', 'title'));
    }

    public function press($id)
    {
        $title = "Домашняя страница";
        $post = Advertisement::find($id);
        if ($post) {
        $post->Public = $post->Public == 1 ? 0:1;
        $post->save();
        }
        $posts = Advertisement::where('Public', 1)->orderBy('id','desc')->paginate(6);
        $image = 'storage/images/2024-03-03/1675314034_mykaleidoscope-ru-p-dom-s-panoramnimi-oknami-v-lesu-oboi-14.jpg';
        return view('home', compact('title', 'posts', 'image'));
    }
}
