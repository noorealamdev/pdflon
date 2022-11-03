<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $templates = Template::where("user_id", "=", 1)->get();

        return view('frontend.index', compact('templates'));
    }
}
