@extends('plantilla')
@section('content')

  
<div>          
	<a href="{{ route('plats.index') }}"> 
		Tornar
	</a>
</div>

<h2>Fitxa Plats</h2>

<div>
	<strong>Name:</strong>
	{{ $plat->Nom }}
</div>

<div>
	<strong> Ingredients</strong>
		<ul>
			@foreach($plat->ingredients as $ingred)
				<li>{{ $ingred->ingredient}}</li>
			@endforeach
		</ul>



</div>



@endsection