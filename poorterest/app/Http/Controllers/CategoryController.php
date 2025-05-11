<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Afficher toutes les catégories.
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories', compact('categories'));
    }
    /**
     * Afficher le formulaire de création de catégorie.
     */
    public function create()
    {
        return view('categoriesCreate');
    }
    
    /**
     * Ajouter une catégorie.
     */
    public function store(Request $request)
    {
        // Valider la catégorie
        $request->validate([
            'title' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:1000',
        ]);

        // Créer la catégorie
        $category = Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'active',
        ]);

        return redirect()->route('categories')->with('success', 'Catégorie ajoutée avec succès.');
    }

    /**
     * Désactiver une catégorie.
     */
    public function deactivate($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Catégorie non trouvée.');
        }

        $category->update(['status' => 'deactivated']);

        return redirect()->back()->with('success', 'Catégorie désactivée.');
    }

    public function activate ($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Catégorie non trouvée.');
        }

        $category->update(['status' => 'active']);

        return redirect()->back()->with('success', 'Catégorie activée.');
    }
}

