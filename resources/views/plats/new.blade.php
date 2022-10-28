@extends('template')
@section('content')

<form method="POST" action="/plats/save">
	<h4>Afegir nou plat</h4>
	@csrf
	Nom:
	<input type="text" name="name" value="{{ old('name') }}">
    <br>
    Preu:
    <input type="text" name="preu" value="{{ old('preu') }}">
    <br>
	<input type="submit" value="Save">
</form>

@endsection