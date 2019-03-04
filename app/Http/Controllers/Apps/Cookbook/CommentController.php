<?php

namespace App\Http\Controllers\Apps\Cookbook;

use App\Recipe;
use App\Comments;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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
