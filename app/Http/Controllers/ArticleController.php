<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticlePicture;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getArticles() {
        $articles = Article::all();

        return view('home', compact('articles'));
    }
}
