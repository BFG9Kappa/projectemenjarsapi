@extends('template')
@section('content')

<form method="POST" action="/clients/save">
@csrf
<h4>Afegir client</h4>
  <div class="form-group">
    <label for="inputNom">Nom</label>
    <input type="text" class="form-control" id="inputNom" name="nom">
    <label for="inputCognoms">Cognoms</label>
    <input type="text" class="form-control" id="inputCognoms" name="cognoms">
    <label for="inputDireccio">Direccio</label>
    <input type="text" class="form-control" id="inputDireccio" name="direccio">
    <label for="inputTelefon">Telefon</label>
    <input type="text" class="form-control" id="inputTelefon" name="telefon">
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