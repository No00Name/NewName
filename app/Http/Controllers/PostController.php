<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    

    public function show(){
        $title = "About page";
        return view('about', compact('title'));
        
    }

    public function create(){
        $title = "Create page";
        $category = Categorie::pluck('CategoryName', 'id')->all();
        return view('create', compact('title', 'category')); 
    }

    
    public function store(Request $request){
        $user = Auth::user();
        $this->validate($request,[
            'Category_id' => 'required|integer',
            'Title' => 'required|min:1|max:100',
            'Description' => 'required',
            'AdPhoto' => 'nullable|image',
        ],
        
        [
            'Title.required' => "Заполните все поле Название",
            'Description.required' => "Заполните все поле Контент",
            'Category_id.required' => "Заполните все поле Категория",
            'Title.min' => "Слишком мало символов",
            'Title.max' => "Слишком много символов",
        ]);
        if ($request->hasFile('AdPhoto')){
            $folder = date('Y-m-d');
            $picturs = $request->file('AdPhoto')->store("public/post/($folder)");
            $image = str_replace('public/', '', $picturs);
        }
        
        $post = Advertisement::create([
            'User_id' => $user->id,
            'Category_id' =>$request->Category_id,
            'Title' => $request->Title,
            'Description' => $request->Description,
            'AdPhoto'=>$image ?? null,
        ]);
        return redirect()->route('home'); 
    }
}
