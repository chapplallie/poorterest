<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class MediaController extends Controller
{
    // Afficher la liste des médias
    public function index(Request $request)
    {
        $categories = Category::all();
    
        // Fetch medias, filtered by category if a category_id is provided
        $medias = Media::with('category')
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->get();
    
        return view('welcome', compact('categories', 'medias'));
    }
    // Afficher le formulaire de création
    public function createMedia()
    {
        $categories = Category::all(); 
        return view('createMedia', compact('categories'));
    }

    // Enregistrer un nouveau média
    public function uploadMedia(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'media' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov|max:20000',
            'description' => 'nullable|string',
            'title' => 'required|string|max:90',
            'size' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $path = $request->file('media')->store('medias', 'public');

        Media::create([
            'media' => $path ,
            'description' => $request->description,
            'title' => $request->title,
            'size' => $request->size,
            'userId' => $request->user()->id,
            'category_id' => $request->category_id,
            'status' => 'active',
        ]);

        return redirect()->route('profile')->with('success', 'Média enregistré avec succès');
    }

    // Modifier un média
    public function editMedia(Media $media)
    {
        $media = Media::find($media->id);
        return view('editMedia', compact('media'));
    }

    public function updateMedia(Request $request, Media $media)
    {
        $request->validate([
            'description' => 'nullable|string',
            'title' => 'required|string|max:255',
            'size' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $media->image);
            $path = $request->file('image')->store('medias', 'public');
            $media->image = $path;
        }

        $media->update($request->only(['description', 'title', 'size', 'category']));
        return redirect()->route('profile/medias')->with('success', 'Média mis à jour');
    }

    public function updateMediaSize(Request $request, $id)
    {
        $request->validate([
            'size' => 'required|string|in:small,medium,large',
        ]);

        $media = Media::findOrFail($id);
        $media->update(['size' => $request->size]);

        return redirect()->back()->with('success', 'Taille mise à jour avec succès.');
    }

    // Supprimer un média
    public function destroyMedia(Media $media)
    {
        Storage::delete('public/' . $media->image);
        $media->delete();
        return redirect()->route('medias.index')->with('success');
    }

    // Modération (Désactiver certains contenus)
    public function moderate(Media $media, Request $request)
    {
        $media->update([
            'status' => $request->status,
        ]);
        return redirect()->route('medias.index')->with('success');
    }

    // Obtenir les médias d'un utilisateur par ID de l'utilisateur
    public function getUserMedia()
    {
        $userId = Auth::id();
        $medias = Media::where('userId', $userId)->get();
        return view('userMedia', compact('medias'));
    }
}
