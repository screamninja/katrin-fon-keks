<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeFromRequest;
use Illuminate\Http\Request;
use App\User;
use App\Recipe;

class UserController extends Controller
{
    // Вывод активных рецептов отдельного пользователя
    public function userRecipes($id)
    {
        //
        $recipes = Recipes::where('author_id', $id)->where('privacy', 1)->orderBy('created_at', 'desc')->paginate(5);
        $title = User::find($id)->name;
        return view('pages.cookbook')->with('recipes', $recipes)->with('title', $title);
    }

    // Вывод всех рецептов отдельного пользователя
    public function userRecipesAll(Request $request)
    {
        //
        $user = $request->user();
        $recipes = Recipes::where('author_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        $title = $user->name;
        return view('pages.cookbook')->with('recipes', $recipes)->with('title', $title);
    }

    // Вывод приватных рецептов текущего активного пользователя
    public function userRecipesDraft(Request $request)
    {
        //
        $user = $request->user();
        $recipes = Recipes::where('author_id', $user->id)->where('privacy', 0)->orderBy('created_at', 'desc')->paginate(5);
        $title = $user->name;
        return view('pages.cookbook')->with('recipes', $recipes)->with('title', $title);
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
        $data['recipes_count'] = $data['user']->recipes->count();
        $data['recipes_privacy_count'] = $data['user']->recipes->where('privacy', '1')->count();
        $data['recipes_draft_count'] = $data['recipes_count'] - $data['recipes_privacy_count'];
        $data['latest_recipes'] = $data['user']->recipes->where('privacy', '1')->take(5);
        $data['latest_comments'] = $data['user']->comments->take(5);
        return view('admin.profile', $data);
    }
}
