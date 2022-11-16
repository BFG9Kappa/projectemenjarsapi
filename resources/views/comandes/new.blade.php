@extends('template')
@section('content')

<form method="POST" action="/comandes/save">
@csrf
<h4>Afegir comanda</h4>
  <div class="form-group">
    <label for="inputNom">Nom</label>
    <input type="text" class="form-control" id="id" name="nom">
  </div>
  <div class="form-group">
    <label for="inputNom">Preu</label>
    <input type="text" class="form-control" id="preu" name="preu">
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