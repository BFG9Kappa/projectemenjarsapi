@extends('template')
@section('content')

<form method="POST" action="/plats/store">
@csrf
<h4>Afegir plat</h4>
  <div class="form-group">
    <label for="inputNom">Nom</label>
    <input type="text" class="form-control" id="inputNom" name="nom">
  </div>
  <div class="form-group">
	<label for="inputPreu">Preu</label>
	<input type="text" class="form-control" id="inputPreu" name="preu">
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