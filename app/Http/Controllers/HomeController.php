<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\User;

class HomeController extends Controller
{

    public function index(Request $request){
        $title = "Домашняя страница";
        $posts = Advertisement::where('Public', 1)->orderBy('id','desc')->paginate(6);
        $image = 'storage/images/2024-03-03/1675314034_mykaleidoscope-ru-p-dom-s-panoramnimi-oknami-v-lesu-oboi-14.jpg';
        return view('home', compact('title', 'posts', 'image'));
    }

    public function one(Request $request){
        $title = "Первая категория";
        $posts = Advertisement::where('Public', 1)->where('Category_id', 1)->orderBy('id','desc')->paginate(6);
        $image = 'storage/images/2024-03-03/фон.jpeg';
        return view('home', compact('title', 'posts', 'image'));
    }
    public function two(Request $request){
        $title = "Вторая категория";
        $posts = Advertisement::where('Public', 1)->where('Category_id', 2)->orderBy('id','desc')->paginate(6);
        $image = 'storage/images/2024-03-03/fon2.jpeg';
        return view('home', compact('title', 'posts', 'image'));
    }
    public function three(Request $request){
        $title = "Третья категория";
        $posts = Advertisement::where('Public', 1)->where('Category_id', 3)->orderBy('id','desc')->paginate(6);
        $image = 'storage/images/2024-03-03/fon2.jpeg';
        return view('home', compact('title', 'posts', 'image'));
    }
    public function four(Request $request){
        $title = "Четвёртая категория";
        $posts = Advertisement::where('Public', 1)->where('Category_id', 4)->orderBy('id','desc')->paginate(6);
        $image = 'storage/images/2024-03-03/fon2.jpeg';
        return view('home', compact('title', 'posts', 'image'));
    }
    public function five(Request $request){
        $title = "Пятая категория";
        $posts = Advertisement::where('Public', 1)->where('Category_id', 5)->orderBy('id','desc')->paginate(6);
        $image = 'storage/images/2024-03-03/fon2.jpeg';
        return view('home', compact('title', 'posts', 'image'));
    }
    
    public function press(Request $request){
        $title = "Принятие постов администратором";
        $posts = Advertisement::where('Public', 0)->orderBy('id','desc')->paginate(6);
        $image = 'storage/images/2024-03-03/fon2.jpeg';
        return view('home', compact('title', 'posts', 'image'));
    }

    public function search(Request $request){
        $title = "Домашняя страница";
        $image = 'storage/images/2024-03-03/fon2.jpe';
        $query = $request->input('query');
        $title = 'Результат поиска по запросу: ' . $query;
        if ($query) {
            $posts = Advertisement::where('Title', 'like', $query.'%')
                ->orWhereHas('Users', function($q) use ($query) {
                    $q->where('Username', 'like', $query.'%');
                })
                ->orderBy('id', 'desc')
                ->paginate(6);
        } else {
            $posts = Advertisement::where('Public', 1)->orderBy('id', 'desc')->paginate(6);
        }
    
        return view('home', compact('title', 'posts', 'image'));
    }

    // public function press_admin($id)
    // {
    //     $title = "Домашняя страница";
    //     $post = Advertisement::find($id);
    //     if ($post) {
    //     $post->Public = $post->Public == 1 ? 0:1;
    //     $post->save();
    //     }
    //     $posts = Advertisement::where('Public', 1)->orderBy('id','desc')->paginate(6);
    //     $image = 'storage/images/2024-03-03/1675314034_mykaleidoscope-ru-p-dom-s-panoramnimi-oknami-v-lesu-oboi-14.jpg';
    //     return view('home', compact('title', 'posts', 'image'));
    // }
    
    public function press_admin(Request $request)
    {
        $id = $request->input('id');
        $post = Advertisement::find($id);
        if ($post) {
            $post->update(['Public'=>$post->Public==1? 0:1]);
            return redirect()->route('home'); 
        }
    }





    


    
}
