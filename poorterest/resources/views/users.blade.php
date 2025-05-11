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
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actif</th>
                <th>Actions</th>
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
                         
                        <a href="{{ route('users.edit', $user->id) }}"><button>M</button></a>
                     
                        <form action="{{ route('profile.deactivate', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir désactiver le compte ?');">
                        @csrf
                        @method('DELETE')
                            <button type="submit">Déactiver</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
