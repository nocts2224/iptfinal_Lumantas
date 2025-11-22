<?php

namespace App\Http\Controllers;

class StaticPageController extends Controller
{
    public function accountingBasics()
    {
        return view('static.accounting-basics');
    }
}
