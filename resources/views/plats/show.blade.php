@extends('template')
@section('content')

<div>
	<ul class="list-group">
		<li class="list-group-item active">{{ $plat->nom }}</li>
		@foreach($plat->ingredient as $ingredient)
			<li class="list-group-item">{{ $ingredient->nom }}</li>
		@endforeach
	</ul>
</div>

@endsection