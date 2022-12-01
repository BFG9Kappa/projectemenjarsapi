@extends('template')
@section('content')

<form method="POST" action="/comandes/store">
@csrf
<h4>Afegir comanda</h4>
  <div class="form-group">
    <label for="inputPreu">Preu</label>
    <input type="text" class="form-control" id="inputPreu" name="preu">
    <label for="inputEstat">Estat</label>
    <input type="text" class="form-control" id="inputEstat" name="estat">
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