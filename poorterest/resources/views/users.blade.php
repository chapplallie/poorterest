@extends ('layouts.app')

@section('content')

<div class="container">
    <h2>Gestion des utilisateurs</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Email</th>
                <th class="text-center">Rôle</th>
                <th class="text-center">Actif</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->active ? 'Oui' : 'Non' }}</td>
                    <td>
                        <!-- Actions pour gérer les utilisateurs -->
                         
                        <div class="d-flex justify-content-evenly">
                            <a href="{{ route('users.edit', $user->id) }}"><button class="btn btn-outline-warning">Modifier</button></a>
                            
                            <form action="{{ route('profile.deactivate', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir désactiver le compte ?');">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Déactiver</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
