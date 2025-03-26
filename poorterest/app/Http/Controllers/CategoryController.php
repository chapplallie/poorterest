<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Ajouter une catégorie.
     */
    public function store(Request $request)
    {
        // Valider la catégorie
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        // Créer la catégorie
        $category = Category::create([
            'name' => $request->name,
            'status' => 'active',
        ]);

        return response()->json([
            'message' => 'Catégorie ajoutée',
            'category' => $category
        ], 201);
    }

    /**
     * Désactiver une catégorie.
     */
    public function deactivate($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Catégorie non trouvée'], 404);
        }

        $category->update(['status' => 'deactivated']);

        return response()->json(['message' => 'Catégorie désactivée']);
    }
}

