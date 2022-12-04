@extends('template')
@section('content')

<form method="POST" action="{{ route('plats.update', $plat->id) }}">
@csrf
<h4>Modificar plat</h4>
  <div class="form-group">
    <label for="inputNom">Nom</label>
    <input type="text" class="form-control" id="inputNom" name="nom" value="{{ old('nom', $plat -> nom) }}">
  </div>
  <div class="form-group">
    <label for="inputPreu">Preu</label>
    <input type="text" class="form-control" id="inputPreu" name="preu" value="{{ old('preu', $plat -> preu) }}">
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