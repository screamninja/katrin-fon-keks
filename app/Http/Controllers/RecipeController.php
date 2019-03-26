<?php

namespace App\Http\Controllers;

use App\Comments;
//use App\Http\Requests\RecipeFromRequest;
//use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use Illuminate\Pagination\Paginator;
use App\Recipe;

class RecipeController extends Controller
{

    // Show last recipes on main page
    public function cookbook()
    {
        // Page title
        $title = 'Рецепты от Катрин';
        // Take 5 recipes from Db, not private and last
        $recipes = Recipe::where('privacy', 0)->orderBy('created_at', 'desc')->paginate(5);
        // Return cookbook.blade.php from resources/views/pages/cookbook
        return view('pages.cookbook')
            ->withTitle($title)
            ->withRecipes($recipes);
    }

    // Create recipe
    public function create(Request $request)
    {
        // If user can publish recipe (author or admin) return view for creat recipe
        if ($request->user()->canPublish()) {
            return view('apps.cookbook.create');
        }
        // TODO: настроить вывод ошибок
        return redirect('/cookbook')->withErrors('У вас нет достаточных прав для написания рецептов!');
    }

    // Recipes store
    public function store(Request $request)
    {
        $recipe = new Recipe();

        $recipe->author_id = Auth::user()->id;
        $recipe->title = $request->get('title');
        $recipe->body = $request->get('body');
        $recipe->tags = 1;
        $recipe->slug = str_slug($recipe->title);
        if ($request->has('publish_private')) {
            $recipe->privacy = 1;
            $message = 'Рецепт успешно сохранён приватно!';
        } else {
            $recipe->privacy = 0;
            $message = 'Рецепт успешно опубликован!';
        }
        $recipe->save();
        $tags = $request->get('tags');
        $recipe = Recipe::where('slug', $recipe->slug)->first();
        if (!$tags) {
            $recipe->tags()->attach(1);
        } else {
            $recipe->tags()->attach($tags);
        }
        return redirect('/' . $recipe->slug)->withMessage($message);
    }

    // Show recipe
    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)->get();
        if (!$recipe[0]) {
            return redirect('/')->withErrors('Запрошенная страница не найдена!');
        }
        $tags = $recipe[0]->tags;
        $comments = $recipe[0]->comments()->orderBy('created_at', 'desc');
        return view('apps.cookbook.show')->withRecipe($recipe[0])->withTags($tags)->withComments($comments);
    }

    // Edit recipe
    public function edit(Request $request, $slug)
    {
        $recipe = Recipe::where('slug', $slug)->get();
        $tags = $recipe[0]->tags;
        if ($recipe[0] && ($request->user()->id === $recipe[0]->author_id || $request->user()->isAdmin()))
            return view('apps.cookbook.edit')->withRecipe($recipe[0])->withTags($tags);
        return redirect('cookbook/')->withErrors('У вас нет достаточных прав!');
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
            $tags = $recipe->tags()->orderBy('name')->get();
            if ($request->has('publish_private')) {
                $recipe->privacy = 0;
                $message = 'Рецепт успешно сохранён приватно!';
                $landing = $recipe->slug;
            } else {
                $recipe->privacy = 1;
                $message = 'Рецепт успешно обновлён!';
                $landing = $recipe->slug;
            }
            $recipe->save();
            return redirect($landing)->withTags($tags)->withMessage($message);
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
