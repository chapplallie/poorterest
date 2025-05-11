@extends ('layouts.app')

@section('content')
<div class="container">
<form action="{{ route('todo_store') }}" method="post" enctype="multipart/form-data" class="w-100 mx-auto mt-4 p-4 bg-white rounded shadow">
    @csrf

    <!-- Title -->
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input 
            type="text" 
            name="title" 
            id="title"
            class="form-control" 
            required 
            maxlength="90"
            placeholder="Entrez le titre"
        />
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description (optionnel)</label>
        <textarea 
            name="description" 
            id="description"
            class="form-control" 
            rows="4"
            placeholder="Ajoutez une description"
        ></textarea>
    </div>

    <!-- Media File -->
    <div class="mb-3">
        <label for="media" class="form-label">Fichier média (image ou vidéo)</label>
        <input 
            type="file" 
            name="media" 
            id="media"
            class="form-control" 
            accept=".jpeg,.png,.jpg,.gif,.svg,.mp4,.mov"
            required
        />
    </div>

    <!-- Size -->
    <div class="mb-3">
        <label class="form-label">Taille de l'image</label>
        <div class="form-check">
            <input 
                type="radio" 
                id="small" 
                name="size" 
                value="small" 
                class="form-check-input" 
                checked
            />
            <label for="small" class="form-check-label">Petite</label>
        </div>
        <div class="form-check">
            <input 
                type="radio" 
                id="medium" 
                name="size" 
                value="medium" 
                class="form-check-input"
            />
            <label for="medium" class="form-check-label">Moyenne</label>
        </div>
        <div class="form-check">
            <input 
                type="radio" 
                id="large" 
                name="size" 
                value="large" 
                class="form-check-input"
            />
            <label for="large" class="form-check-label">Grande</label>
        </div>
    </div>

    <!-- Category -->
    <div class="mb-3">
        <label for="category" class="form-label">Catégorie</label>
        <input 
            type="text" 
            name="category" 
            id="category"
            class="form-control" 
            required
            placeholder="Entrez la catégorie"
        />
    </div>

    <!-- Submit Button -->
    <div class="text-center">
        <button 
            type="submit" 
            class="btn btn-primary"
        >
            Envoyer
        </button>
    </div>
</form>
</div>
@endsection