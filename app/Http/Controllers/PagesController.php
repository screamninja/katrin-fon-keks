<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function blog()
    {
        return view('pages.blog');
    }
}
