<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    //
    public function index(){
        $forums = Forum::all();
        return view('forum.forum', compact('forums'));
    }
}
