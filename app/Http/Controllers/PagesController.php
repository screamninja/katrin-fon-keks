<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function cookbook()
    {
        return view('pages.cookbook');
    }
}
