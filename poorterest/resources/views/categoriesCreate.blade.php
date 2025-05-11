@extends ('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="container mt-4">
    <div class="w-100 mx-auto p-4 bg-white rounded shadow">
        <div class="card-body">
            <h4 class="card-title mb-4">Créer une nouvelle catégorie</h4>

            <form method="POST" action="{{ url('/categories') }}">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Nom de la catégorie</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</div>

@endsection