@extends('template')
@section('content')

<form method="POST" action="/comandes/save">
@csrf
<h4>Afegir comandes</h4>
  <div class="form-group">
    <label for="inputNom">Referencia</label>
    <input type="text" class="form-control" id="inputNom" name="nom">
    <label for="inputNom">Preu</label>
    <input type="text" class="form-control" id="inputNom" name="preu">
    <label for="inputNom">Estat</label>
    <input type="text" class="form-control" id="inputNom" name="estat">
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