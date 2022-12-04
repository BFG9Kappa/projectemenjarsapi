@extends('template')
@section('content')

<a class="btn btn-primary btn-sm" href="{{ route('plats.index') }}">Tornar</a>
<h4>Ingredients de {{ $plat->nom }}</h4>

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
     	<form method='POST' action="{{ route('plats.detachingredients', $plat->id) }}">
            @csrf
	     	<div class="form-group">
                <label>Ingredients afegits:</label>
                <select multiple size="10" name="ingredients[]" class="form-control">
	    		@foreach($plat->ingredient as $ingredient) {
                    <option value="{{ $ingredient->id }}">
                        {{ $ingredient->nom }}
                    </option>
	            @endforeach
                </select>
	    	</div>
	    	<input class="btn btn-primary" type="submit" value="Treure ingredients">
    	</form>
    </div>
    <div class="col-sm">
    	<form method='POST' action="{{ route('plats.assigningredients', $plat->id) }}">
             @csrf
      		<div class="form-group">
    		<label>Llista ingredients:</label>
    		<select multiple class="form-control" size="20" name="ingredients[]">
                @foreach($ingredients as $ingredient) {
                    <option value="{{ $ingredient->id }}">
                        {{ $ingredient->nom }}
                    </option>
                @endforeach
    		</select>
    		</div>
    		<input class="btn btn-primary" type="submit" value="Afegir ingredients">
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