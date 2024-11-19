<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Picture;
use App\Models\Category;
use App\Models\ArticlePicture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getArticles() {
        $articles = Article::all();
        $categories = Category::all();

        return view('home', compact('articles', 'categories'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = $request->input('categories');

        $articles = Article::when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($categories, function ($query, $categories) {
                return $query->whereHas('categories', function ($categoryQuery) use ($categories) {
                    $categoryQuery->whereIn('categories.id', $categories);
                })
                ->whereHas('categories', function ($countQuery) use ($categories) {
                    $countQuery->selectRaw('COUNT(*)')
                        ->havingRaw('COUNT(*) = ?', [count($categories)]);
                });
            })
            ->get();

        $categories = Category::all();

        return view('home', compact('articles', 'categories'));
    }

    public function create(){
        if (Auth::check() && Auth::user()->role !== 'professional') {
            return redirect()->route('home');
        }
        $categories = Category::all();
        return view('article.create', compact('categories'));
    }

    public function show($id){
        $article = Article::findOrFail($id);
        return view('article.detail', compact('article'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $article = Article::create([
            'account_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->has('categories')) {
            $article->categories()->attach($request->categories);
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $picture = Picture::create([
                    'pictureLink' => $path,
                ]);
                $article->pictures()->attach($picture->id);
            }
        }

        return redirect()->route('home')->with('success', 'Article created successfully!');
    }
}
