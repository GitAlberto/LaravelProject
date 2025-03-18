<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class CategoryController extends Controller
    {
        public function index()
    {
        $categories = Category::all();
        $events = Event::paginate(5);
        return redirect()->route('categories.index')->with('message', 'Événement ajouté avec succès !');

       // return view('gestion-categories.listCats', compact('categories','events'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('gestion-categories.OneCat', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        $category = Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'La cagégorie a bien été créée');;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category);
    }

    public function create()
    {
        
        return view('gestion-categories.createCat'); 
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(['message' => 'Catégorie supprimée']);
    }
}
