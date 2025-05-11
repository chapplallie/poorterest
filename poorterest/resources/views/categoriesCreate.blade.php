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

<form method="POST" action="{{ url('/categories') }}">
    @csrf
    <div class="mb-3">
        <label for="title">Nom de la catégorie</label>
        <input type="text" name="title" id="title">
    </div>
   <div class="mb-3">
     <label for="description">Déscription</label>
     <textarea name="description" id="description"></textarea>
   </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

@endsection