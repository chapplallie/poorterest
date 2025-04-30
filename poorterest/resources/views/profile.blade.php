@extends ('layouts.app')

@section('content')
<div class="container">
    <h2>Mon Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
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
    <hr>

    <!-- Désactivation du compte  -->

    <form action="{{ route('profile.deactivate') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir désactiver votre compte ?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Désactiver le compte</button>

    </form>
</div>
@endsection
