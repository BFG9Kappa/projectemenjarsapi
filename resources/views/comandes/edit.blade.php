@extends('template')
@section('content')

<form method="POST" action="{{ route('comandes.update', $comanda->id) }}">
@csrf
<h4>Modificar comanda</h4>
  <div class="form-group">
  	<label for="inputNom">Nom</label>
    <input type="text" class="form-control" id="inputNom" name="nom" value="{{ old('nom', $comanda -> nom) }}">
	<label for="inputPreu">Preu</label>
    <input type="text" class="form-control" id="inputPreu" name="preu" value="{{ old('preu', $comanda -> preu) }}">
	<label for="estat">Estat</label>
	<select class="form-select" aria-label="Default select example" name="estat">
		<option value="En proces" @if( old('estat',$comanda->estat) == "En proces") selected @endif >En proces</option>
		<option value="Enviat" @if( old('estat',$comanda->estat) == "Enviat") selected @endif >Enviat</option>
		<option value="Rebut" @if( old('estat',$comanda->estat) == "Rebut") selected @endif >Rebut</option>
	</select>
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