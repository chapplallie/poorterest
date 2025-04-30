<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    // Afficher la liste des médias
    public function index()
    {
        $medias = Media::all();
        return view('welcome', compact('medias'));
    }

    // Afficher le formulaire de création

    public function createMedia()
    {
        return view('createMedia');
    }

    // Enregistrer un nouveau média
    public function uploadMedia(Request $request)
    {
        $request->validate([
            'media' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov|max:20000',
            'description' => 'nullable|string',
            'title' => 'required|string|max:90',
            'size' => 'required|string',
            'category' => 'required|string',
        ]);

        $path = $request->file('media')->store('medias', 'public');

        Media::create([
            'media' => $path ,
            'description' => $request->description,
            'title' => $request->title,
            'size' => $request->size,
            'userId' => $request->user()->id,
            'category' => $request->category,
            'status' => 'active',
        ]);

        return redirect()->route('profile')->with('success', 'Média ajouté avec succès');
    }

    // Modifier un média
    public function editMedia(Media $media)
    {
        return view('medias.edit', compact('media'));
    }

    public function updateCard(Request $request, Media $media)
    {
        $request->validate([
            'description' => 'nullable|string',
            'title' => 'required|string|max:255',
            'size' => 'required|string',
            'category' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $media->image);
            $path = $request->file('image')->store('medias', 'public');
            $media->image = $path;
        }

        $media->update($request->only(['description', 'title', 'size', 'category']));
        return redirect()->route('medias.index')->with('success', 'Média mis à jour');
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
