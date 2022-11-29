@extends('template')
@section('content')

<form method="POST" action="/comandes/update/{{ $comanda -> id}}">
@csrf
<h4>Modificar comanda</h4>
  <div class="form-group">
    <label for="inputPreu">Preu</label>
    <input type="text" class="form-control" id="inputPreu" name="preu" value="{{ old('prue', $comanda -> preu) }}">
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