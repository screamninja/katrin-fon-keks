<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

class MyCalcController extends Controller
{
    public function index()
    {
        $first = Input::get('first', 0);
        $second = Input::get('second', 0);
        $group1 = Input::get('group1', false);

        $res = false;
        if ($group1)  {
            switch ($group1) {
                case 'add' :
                    $res = $first + $second;
                    break;
                case 'subtract' :
                    $res = $first - $second;
                    break;
                case 'times' :
                    $res = $first * $second;
                    break;
                case 'divide' :
                    $res = $first / $second;
                    break;
            }
        }

        return view('mycalc.index')->with('res', $res);
    }
}
