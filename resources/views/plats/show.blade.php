@extends('template')
@section('content')

<div>
	<strong>Plat:</strong>
	{{ $plat->nom }}
</div>
<div>
	<strong>Ingredients:</strong>
	<ul>
		@foreach($plat->ingredient as $ingredient)
		<li>
            {{ $ingredient->nom }}
			{{ $ingredient->quantitat }}
        </li>
        @endforeach
	</ul>
</div>

@endsection