
@extends ('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le Média</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('media.update', $media->id) }}" enctype="multipart/form-data">
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
            <label for="media">Fichier média (image ou vidéo)</label>
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
        <div class="mb-3">
            <label for="category">Catégorie</label>
            <input 
                type="text" 
                name="category" 
                class="form-control" 
                value="{{ old('category', $media->category) }}" 
                required
            >
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
    <hr>
</div>
@endsection