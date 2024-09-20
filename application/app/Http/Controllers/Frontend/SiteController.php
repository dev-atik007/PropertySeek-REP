<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function templates()
    {
        $pageTitle = 'Template';
        return view('templates.home', compact('pageTitle'));
    }
}
