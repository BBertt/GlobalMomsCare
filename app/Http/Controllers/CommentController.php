<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        $content = $request->input('comment');

        Comment::create([
            'account_id' => Auth::id(),
            'forum_id' => $id,
            'content' => $content,
        ]);

        $forum = Forum::with(['comments', 'pictures', 'account'])->findOrFail($id);
        return view('forum.detail', compact('forum'));
    }

    public function delete($id, $forumid){
        $comment=Comment::findOrFail($id);
        $comment->delete();
        $forum = Forum::with(['comments', 'pictures', 'account'])->findOrFail($forumid);
        return view('forum.detail', compact('forum'));
    }

}
