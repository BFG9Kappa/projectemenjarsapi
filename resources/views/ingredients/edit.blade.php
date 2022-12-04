@extends('template')
@section('content')

<form method="POST" action="{{ route('ingredients.update', $ingredient->id) }}">
@csrf
<h4>Modificar ingredient</h4>
  <div class="form-group">
    <label for="inputNom">Nom</label>
    <input type="text" class="form-control" id="inputNom" name="nom" value="{{ old('nom', $ingredient -> nom) }}">
  </div>
  <input class="btn btn-primary" type="submit" value="Guardar">
</form>

@if($errors->any())
	<ul>
		@foreach($errors->all() as $error)
		<li>
			{{ $error }}
		</li>
		@endforeach
	</ul>
@endif

@endsection