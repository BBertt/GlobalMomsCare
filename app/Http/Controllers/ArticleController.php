<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticlePicture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getArticles() {
        $articles = Article::all();

        return view('home', compact('articles'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $articles = Article::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->get();

        return view('home', compact('articles'));
    }

    public function create(){
        if (Auth::check() && Auth::user()->role !== 'professional') {
            return redirect()->route('home');
        }
        return view('article.create');
    }

    public function show($id){
        $article = Article::findOrFail($id);
        return view('article.detail', compact('article'));
    }
}
