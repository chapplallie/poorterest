@extends ('layouts.app')

@section('content')

<div class="container">
    <h2>Gestion des catégories</h2>

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
                <th>Déscription</th>
                <th>Actif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->status === 'active' ? 'Oui' : 'Non' }}</td>
                    <td>
                        @if ($category->status === 'active')
                            <form action="{{ route('categories.deactivate', ['id' => $category->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir désactiver la catégorie ?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-secondary">Désactiver</button>
                            </form>
                        @else
                            <form action="{{ route('categories.activate', ['id' => $category->id]) }}" method="POST" onsubmit="return confirm('Voulez-vous activer cette catégorie ?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Activer</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            <a href="{{ route('categories.create')}}"><button class="btn btn-primary mb-3">Créer une catégorie</button></a>
        </tbody>
    </table>

</div>

@endsection