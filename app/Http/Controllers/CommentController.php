<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show()
    {
        return Comments::all()->orderBy('created_at', 'desc')->paginate(5);
    }
    // Comments store.
    public function store(Request $request)
    {
        $input['from_user'] = $request->user()->id;
        $input['on_recipe'] = $request->input('on_recipe');
        $input['body'] = $request->input('body');
        $slug = $request->input('slug');
        Comments::create($input);
        return redirect($slug)->with('message', 'Комментарий опубликован.');
    }
}