<?php

namespace App\Http\Controllers;

use App\Models\Elements;
use App\Models\Icons;
use App\Models\Shapes;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function store (Request $request) {
        $template = new Template();

        $template->user_id = auth()->user()->id;

        $template->json = $request->json;
        $template->image = $request->image;
        $template->name = $request->name;

        $template->save();

        return 'pdf saved';
    }


    public function edit($id)
    {
        $user = auth()->user();
        $templates = Template::all();
        $template = Template::find($id);
        $icons = Icons::all();
        $shapes = Shapes::all();

        return view('tool.edit', compact('template', 'templates', 'user', 'icons', 'shapes'));

    }



    public function update(Request $request, $id)
    {

        $template = Template::find($id);

        $template->user_id = auth()->user()->id;
        $template->json = $request->json;
        $template->image = $request->image;
        $template->name = $request->name;

        $template->save();

        return 'pdf updated';
    }


    public function destroy($id)
    {
        $template = Template::find($id);
        $template->delete();

        return redirect()->route('dashboard')->with(['msg' => 'Deleted Successfully', 'type' => 'success']);
    }

}
