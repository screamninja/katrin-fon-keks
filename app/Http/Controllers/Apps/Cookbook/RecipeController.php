<?php

namespace App\Http\Controllers\Apps\Cookbook;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecipeFromRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Recipe;

class RecipeController extends Controller
{

    // Show last recipes on main page
    public function cookbook()
    {
        // Take 5 recipes from Db, active and last
        $recipes = Recipe::where('privacy', 1)->orderBy('created_at', 'desc')->paginate(5);
        // Page title
        $title = 'Рецепты от Катрин';
        // Return cookbook.blade.php from resources/views/apps/cookbook
        return view('pages.cookbook')->withRecipes($recipes)->withTitle($title);
    }

    // Create recipe
    public function create(Request $request)
    {
        // If user can publish recipe (author or admin) return view for creat recipe
        if ($request->user()->canPublish()) {
            return view('apps.cookbook.create');
        }
        return redirect('/cookbook')->withErrors('У вас нет достаточных прав для написания рецептов!');
    }

    // Recipes store
    public function store(RecipeFromRequest $request)
    {
        $recipe = new Recipe();
        $recipe->author_id = Auth::user()->id;
        $recipe->title = $request->get('title');
        $recipe->body = $request->get('body');
        $recipe->themes = $request->get('themes');
        $recipe->slug = str_slug($recipe->title);
        if ($request->has('save')) {
            $recipe->privacy = 0;
            $message = 'Рецепт успешно сохранён приватно!';
        } else {
            $recipe->privacy = 1;
            $message = 'Рецепт успешно опубликован!';
        }
        $recipe->save();
        return redirect('cookbook/edit/' . $recipe->slug)->withMessage($message);
    }

    // Show recipe
    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        if (!$recipe) {
            return redirect('cookbook/')->withErrors('Запрошенная страница не найдена!');
        }
        $comments = $recipe->comments;
        return view('apps.cookbook.show')->withRecipe($recipe)->withComments($comments);
    }

    // Edit recipe
    public function edit(Request $request, $slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        if ($recipe && ($request->user()->id === $recipe->author_id || $request->user()->isAdmin()))
            return view('apps.cookbook.edit')->with('recipe', $recipe);
        return redirect('cookbook/')->withErrors('у вас нет достаточных прав!');
    }

    // Update recipe
    public function update(Request $request)
    {
        $recipe_id = $request->input('recipe_id');
        $recipe = Recipe::find($recipe_id);
        if ($recipe && ($recipe->author_id === $request->user()->id || $request->user()->isAdmin())) {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Recipe::where('slug', $slug)->first();
            if ($duplicate) {
                if ($duplicate->id != $recipe_id) {
                    return redirect('cookbook/edit/' . $recipe->slug)->withErrors('Такое название уже существует!')->withInput();
                }
                $recipe->slug = $slug;
            }
            $recipe->title = $title;
            $recipe->body = $request->input('body');
            if ($request->has('save')) {
                $recipe->privacy = 0;
                $message = 'Рецепт успешно сохранён приватно!';
                $landing = 'cookbook/edit/' . $recipe->slug;
            } else {
                $recipe->privacy = 1;
                $message = 'Рецепт успешно обновлён!';
                $landing = $recipe->slug;
            }
            $recipe->save();
            return redirect($landing)->withMessage($message);
        }

        return redirect('cookbook/')->withErrors('У вас нет достаточных прав!');
    }

    // Delete recipe
    public function destroy(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        if ($recipe && ($recipe->author_id === $request->user()->id || $request->user()->isAdmin())) {
            $recipe->delete();
            $data['message'] = 'Рецепт успешно удалён!';
        } else {
            $data['errors'] = 'У вас нет достаточных прав для удаления рецепта!';
        }
        return redirect('cookbook/')->with($data);
    }
}
