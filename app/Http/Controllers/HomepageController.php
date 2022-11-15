<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Creation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index()
    {
        return view('homepage.index', [
            'active' => 'creation',
            'categories' => Category::all()
        ]);
    }
    public function creation(Creation $id)
    {
        // dd($id);
        return view('homepage.creation', [
            'active' => 'creation',
            'creation' => $id,
            'creations' => Creation::all(),
            'categories' => Category::all()
        ]);
    }
    public function allCreation()
    {
        $allCreations = Creation::leftJoin('categories', 'creations.category_id', '=', 'categories.id')->select('categories.name as categories_name', 'creations.*')->paginate(6);
        $web_design = Creation::leftJoin('categories', 'creations.category_id', '=', 'categories.id')->select('categories.name as categories_name', 'creations.*')->where('categories.name', 'Web Design')->get();
        $app_design = Creation::leftJoin('categories', 'creations.category_id', '=', 'categories.id')->select('categories.name as categories_name', 'creations.*')->where('categories.name', 'App Design')->get();
        $ui_ux = Creation::leftJoin('categories', 'creations.category_id', '=', 'categories.id')->select('categories.name as categories_name', 'creations.*')->where('categories.name', 'UI/UX')->get();
        $desktop = Creation::leftJoin('categories', 'creations.category_id', '=', 'categories.id')->select('categories.name as categories_name', 'creations.*')->where('categories.name', 'Desktop')->get();

        return view('homepage.allCreation', [
            'active' => 'allCreation',
            // 'creations' => $allCreations,
            'web_designs' => $web_design,
            'app_designs' => $app_design,
            'ui_uxs' => $ui_ux,
            'desktops' => $desktop,
            'categories' => Category::all()
        ]);
    }
    public function myCreation()
    {
        return view('homepage.myCreation', [
            'active' => 'myCreation',
            'categories' => Category::all()
        ]);
    }
    public function addCreation()
    {
        return view('homepage.addCreation', [
            'active' => 'addCreation',
            'categories' => Category::all()
        ]);
    }

    public function createCreation(Request $request)
    {
        // dd($request->all());
        Creation::create([
            'title' => $request->title,
            'creator' => $request->creator,
            'technology' => $request->technology,
            'description' => $request->description,
            'category_id' => $request->category,
            'link_website' => $request->link_website,
            'source_code' => $request->source_code,
            'image' => $request->file('image')->store('creation-images'),
            'user_id' =>  $request->user,
            'status' => '1'
        ]);

        return redirect('addCreation');
    }
}
