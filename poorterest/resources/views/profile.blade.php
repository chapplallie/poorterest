@extends ('layouts.app')

@section('content')
<div class="container">
    <h2>Mon Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}" class="w-100 mx-auto mb-5 p-4 bg-white rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password">Nouveau mot de passe (laisser vide si inchangé)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
 
    <!-- Visible si l'utilisateur est admin -->

    @if(auth()->user()->isAdmin())

    <div class="w-100 mx-auto mb-5 p-4 bg-white rounded shadow">
        <h2 class="m-3">Tableau de bord d'admin</h2>
        
        <a href="{{ route('users')}}"><button class="btn btn-info m-3">Gérer les utilisateurs</button></a>
        <a href="{{ route('categories')}}"><button class="btn btn-warning">Gérer les catégories</button></a>
    </div>

    @endif

    <!-- Désactivation du compte  -->
    
    <div class="w-100 mx-auto p-4 bg-light border rounded">
        <p>Vous pouvez désactiver votre compte ici. Cette action est irréversible.</p>
        <form action="{{ route('profile.deactivate', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir désactiver votre compte ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">Désactiver le compte</button>
        </form>
        </div>
</div>
@endsection
