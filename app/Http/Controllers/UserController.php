<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFromRequest;
use Illuminate\Http\Request;
use App\User;
use App\Posts;

class UserController extends Controller
{
    // Вывод активных постов отдельного пользователя
    public function userPosts($id)
    {
        //
        $posts = Posts::where('author_id', $id)->where('active', 1)->orderBy('created_at', 'desc')->paginate(5);
        $title = User::find($id)->name;
        return view('pages.blog')->with('posts', $posts)->with('title', $title);
    }

    // Вывод всех постов отдельного пользователя
    public function userPostsAll(Request $request)
    {
        //
        $user = $request->user();
        $posts = Posts::where('author_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        $title = $user->name;
        return view('pages.blog')->with('posts', $posts)->with('title', $title);
    }

    // Вывод черновиков постов текущего активного пользователя
    public function userPostsDraft(equest $request)
    {
        //
        $user = $request->user();
        $posts = Posts::where('author_id', $user->id)->where('active', 0)->orderBy('created_at', 'desc')->paginate(5);
        $title = $user->name;
        return view('pages.blog')->with('posts', $posts)->with('title', $title);
    }

    // Author profile
    public function profile(Request $request, $id)
    {
        $data['user'] = User::find($id);
        if (!$data['user']) {
            return redirect('/');
        }
        if ($request->user() && $data['user']->id === $request->user()->id) {
            $data['author'] = true;
        } else {
            $data['author'] = null;
        }
        $data['comments_count'] = $data['user']->comments->count();
        $data['posts_count'] = $data['user']->posts->count();
        $data['posts_active_count'] = $data['user']->posts->where('active', '1')->count();
        $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
        $data['latest_posts'] = $data['user']->posts->where('active', '1')->take(5);
        $data['latest_comments'] = $data['user']->comments->take(5);
        return view('admin.profile', $data);
    }
}
