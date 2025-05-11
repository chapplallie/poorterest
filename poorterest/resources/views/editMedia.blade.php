
@extends ('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le Média</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('media.update', $media->id) }}" enctype="multipart/form-data" class="h-full">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label for="title">Titre</label>
            <input 
                type="text" 
                name="title" 
                class="form-control" 
                value="{{ old('title', $media->title) }}" 
                required 
                maxlength="90"
            >
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description">Description (optionnel)</label>
            <textarea 
                name="description" 
                class="form-control" 
                rows="3"
            >{{ old('description', $media->description) }}</textarea>
        </div>

        <!-- Media File -->
        <div class="mb-3">
            <label for="media">Fichier média actuelle</label>
            @if (Str::endsWith($media->media, ['.jpg', '.jpeg', '.png', '.gif', '.svg']))
                <img src="{{ asset('storage/' . $media->media) }}" 
                    alt="Current Media" 
                    class="img-thumbnail mb-3" 
                    style="max-width: 200px;">
            @elseif (Str::endsWith($media->media, ['.mp4', '.mov']))
                <video controls class="mb-3" style="max-width: 200px;">
                    <source src="{{ asset('storage/' . $media->media) }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de cette vidéo.
                </video>
            @else
                <p class="text-muted">Aucun média disponible ou format non supporté.</p>
            @endif

            <input 
                type="file" 
                name="media" 
                class="form-control" 
                accept=".jpeg,.png,.jpg,.gif,.svg,.mp4,.mov"
            >
        </div>

        <!-- Size -->
        <div class="mb-3">
            <label for="size">Taille de l'image</label>
            <div>
                <input type="radio" id="small" name="size" value="small" {{ old('size', $media->size) == 'small' ? 'checked' : '' }}>
                <label for="small">Petite</label>
            </div>
            <div>
                <input type="radio" id="medium" name="size" value="medium" {{ old('size', $media->size) == 'medium' ? 'checked' : '' }}>
                <label for="medium">Moyenne</label>
            </div>
            <div>
                <input type="radio" id="large" name="size" value="large" {{ old('size', $media->size) == 'large' ? 'checked' : '' }}>
                <label for="large">Grande</label>
            </div>
        </div>

        <!-- Category -->
        <div class="mb-10">
        <label for="category" class="form-label">Catégorie</label>
        <select 
            name="category_id" 
            id="category" 
            class="form-control mb-10" 
            required
        >
            <option value="" disabled selected>Choisissez une catégorie</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

        <!-- Submit Button -->
        <button type="submit" class="mt-200 btn btn-primary" style="margin-top: 3rem;">Mettre à jour</button>
    </form>

</div>
@endsection