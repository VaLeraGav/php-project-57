<?php

namespace App\Http\Controllers;


class LabelController extends Controller
{
    public function index()
    {
        return view('labels.index');
    }
}
