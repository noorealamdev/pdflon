<?php

namespace App\Http\Controllers;

use App\Models\Icons;
use App\Models\Shapes;
use App\Models\Template;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index (){

        $templates = Template::where("user_id", "=", 1)->get();
        $icons = Icons::all();
        $shapes = Shapes::all();

        return view('tool.index', compact('templates', 'icons', 'shapes'));
    }

}
