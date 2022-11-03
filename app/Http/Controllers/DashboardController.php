<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $templates = Template::where("user_id", "=", $user->id)->get();

        return view('backend.dashboard.index', compact('templates'));
    }
}
