<?php

namespace App\Http\Controllers;

use App\Posts;
use App\User;
use Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostFromRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{

    // Show last posts on main page.
    public function index()
    {
        // Take 5 posts from Db, active and last.
        $posts = Posts::where('active', 1)->orderBy('created_at', 'desc')->paginate(5);
        // Page title.
        $title = 'Последние посты';
        // Return home.blade.php from resources/views.
        return view('pages.home')->withPosts($posts)->withTitle($title);
    }

    // Create post.
    public function create(Request $request)
    {
        // If user can post (author or admin) return view for creat post.
        if ($request->user()->canPost()) {
            return view('posts.create');
        }
        return redirect('/')->withErrors('У вас нет достаточных прав для написания поста.');
    }

    // Posts store.
    public function store(Request $request)
    {
        $post = new Posts();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->slug = str_slug($post->title);
        $post->author_id = Auth::user()->id;
        if ($request->has('save')) {
            $post->active = 0;
            $message = 'Пост успешно сохранён.';
        } else {
            $post->active = 1;
            $message = 'Пост успешно опубликован.';
        }
        $post->save();
        return redirect('edit/' . $post->slug)->withMessage($message);
    }

    // Show post.
    public function show($slug)
    {
        $post = Posts::where('slug', $slug)->first();
        if (!$post) {
            return redirect('/')->withErrors('Запрошенная страница не найдена.');
        }
        $comments = $post->comments;
        return view('posts.show')->withPost($post)->withComments($comments);
    }

    // Update post.
    public function update(Request $request)
    {
        $post_id = $request->input('post_id');
        $post = Posts::find($post_id);
        if ($post && ($post->author_id === $request->user()->id || $request->user()->is_admin())) {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Posts::where('slug', $slug)->first();
            if ($duplicate) {
                if ($duplicate->id !== $post_id) {
                    return redirect('edit/' . $post->slug)->withErrors('Название уже существует.')->withInput();
                }
                $post->slug = $slug;
            }
            $post->title = $title;
            $post->body = $request->input('body');
            if ($request->has('save')) {
                $post->active = 0;
                $message = 'Пост успешно сохранён.';
                $landing = 'edit/' . $post->slug;
            } else {
                $post->active = 1;
                $message = 'Пост успешно обновлён.';
                $landing = $post->slug;
            }
            $post->save();
            return redirect($landing)->withMessage($message);
        }

        return redirect('/')->withErrors('У вас нет достаточных прав.');
    }

    // Delete post.
    public function destroy(Request $request, $id)
    {
        //
        $post = Posts::find($id);
        if ($post && ($post->author_id === $request->user()->id || $request->user()->is_admin())) {
            $post->delete();
            $data['message'] = 'Пост успешно удалён';
        } else {
            $data['errors'] = 'У вас нет достаточных прав для удаления поста.';
        }
        return redirect('/')->with($data);
    }
}
