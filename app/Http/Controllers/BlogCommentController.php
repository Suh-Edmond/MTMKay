<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\BlogComments;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function createComment(Request $request)
    {
        $blog_id = $request['id'];
        $validData = $request->validate([
            'name' => 'required|string|max:60',
            'email' => 'required|email',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:700'
        ]);

        BlogComment::create([
            'blog_id' => $blog_id,
            'name' => $validData['name'],
            'email' => $validData['email'],
            'subject' => $validData['subject'],
            'message' => $validData['message'],
        ]);

        return redirect()->back();

    }
}
