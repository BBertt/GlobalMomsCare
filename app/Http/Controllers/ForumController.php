<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    //
    public function index(){
        $forums = Forum::all();
        $categories = Category::all();
        return view('forum.forum', compact('forums', 'categories'));
    }

    public function create(){
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $categories = Category::all();
        return view('forum.create', compact('categories'));
    }
}
