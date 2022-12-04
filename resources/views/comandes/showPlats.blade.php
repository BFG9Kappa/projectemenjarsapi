@extends('template')
@section('content')

<a class="btn btn-primary btn-sm" href="{{ route('comandes.index') }}">Tornar</a>
<h4>Plats de comanda nº {{ $comanda->id }}</h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-sm">
     	<form method='POST' action="{{ route('comandes.detachplats', $comanda->id) }}">
            @csrf
	     	<div class="form-group">
                <label>Plats afegits:</label>
                <select multiple size="10" name="plats[]" class="form-control">
	    		@foreach($comanda->plat as $plat) {
                    <option value="{{ $plat->id }}">
                        {{ $plat->nom }}
                    </option>
	            @endforeach
                </select>
	    	</div>
	    	<input class="btn btn-primary" type="submit" value="Treure plats">
    	</form>
    </div>
    <div class="col-sm">
    	<form method='POST' action="{{ route('comandes.assignplats', $comanda->id) }}">
             @csrf
      		<div class="form-group">
    		<label>Llista plats:</label>
    		<select multiple class="form-control" size="20" name="plats[]">
                @foreach($plats as $plat) {
                    <option value="{{ $plat->id }}">
                        {{ $plat->nom }}
                    </option>
                @endforeach
    		</select>
    		</div>
    		<input class="btn btn-primary" type="submit" value="Afegir plats">
    	</form>
    </div>
  </div>

@if (session('success'))
  <div class="alert alert-success">
     <p>{{ session('success') }}</p>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
@endif

@endsection