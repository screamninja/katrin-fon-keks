<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Recipe;
use App\Tag;

class RecipeController extends Controller
{

    public function cookbook()
    {
        $title = 'Рецепты от Катрин';
        $recipes = Recipe::where('privacy', 1)->orderBy('created_at', 'desc')->get();
        return view('pages.cookbook')
            ->withTitle($title)
            ->withRecipes($recipes);
    }

    public function create(Request $request)
    {
        if ($request->user()->isAdmin()) {
            return view('apps.cookbook.create');
        }
        return redirect('/cookbook');
    }

    public function store(Request $request)
    {
        $recipe = new Recipe();
        $recipe->author_id = Auth::user()->id;
        $recipe->title = $request->get('title');
        $recipe->body = $request->get('body');
        // TODO прописать теги
//        $theme = new Tag();
//        $themes = $request->get('themes');
//        $recipe->themes = $theme->makeBitwise($themes);
        $recipe->slug = str_slug($recipe->title);
        if ($request->has('publish_private')) {
            $recipe->privacy = 0;
            $message = 'Рецепт успешно сохранён приватно!';
        } else {
            $recipe->privacy = 1;
            $message = 'Рецепт успешно опубликован!';
        }
        $recipe->save();
        return redirect('/' . $recipe->slug)->withMessage($message);
    }

    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        // TODO прописать страницу 404
        if (!$recipe) {
            return redirect('/')->withErrors('Запрошенная страница не найдена!');
        }
        // TODO прописать теги
//        if ($recipe->themes) {
//            $themeObj = new Tag();
//            $themes = $themeObj->getBitwise($recipe->themes);
//        } else {
//            $themes = ['Без темы'];
//        }
        return view('apps.cookbook.show')->withRecipe($recipe)->withTags($tags);
    }

    public function edit(Request $request, $slug)
    {
        $recipe = Recipe::where('slug', $slug)->first();
        // TODO прописать теги
//        if ($recipe->themes) {
//            $themeObj = new Tag();
//            $themes = $themeObj->getBitwise($recipe->themes);
//        } else {
//            $themes = ['Без темы'];
//        }
        if ($recipe && ($request->user()->id === $request->user()->isAdmin()))
            return view('apps.cookbook.edit')->with('recipe', $recipe)->with('tags', $tags);
        return redirect('cookbook/');
    }

    public function update(Request $request)
    {
        $recipe_id = $request->input('recipe_id');
        $recipe = Recipe::find($recipe_id);
        if ($recipe && ($recipe->author_id === $request->user()->isAdmin())) {
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
            $theme = new Tag();
            $themes = $request->get('themes');
            $recipe->themes = $theme->makeBitwise($themes);
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
            return redirect($landing)->withMessage($message);
        }

        return redirect('cookbook/')->withErrors('У вас нет достаточных прав!');
    }

    public function destroy(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        if ($recipe && ($recipe->author_id === $request->user()->isAdmin())) {
            $recipe->delete();
            $data['message'] = 'Рецепт успешно удалён!';
        } else {
            $data['errors'] = 'У вас нет достаточных прав для удаления рецепта!';
        }
        return redirect('cookbook/')->with($data);
    }
}
