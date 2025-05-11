@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestion des médias</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Titre</th>
                <th>Taille</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medias as $media)
                <tr>
                    <td>{{ $media->id }}</td>
                    <td>{{ $media->user->name }}</td>
                    <td>{{ $media->title }}</td>
                    <td>{{ $media->size }}</td>
                    <td>
                        <form action="{{ route('admin.media.updateSize', $media->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="size" class="form-control">
                                <option value="small" {{ $media->size == 'small' ? 'selected' : '' }}>Small</option>
                                <option value="medium" {{ $media->size == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="large" {{ $media->size == 'large' ? 'selected' : '' }}>Large</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
