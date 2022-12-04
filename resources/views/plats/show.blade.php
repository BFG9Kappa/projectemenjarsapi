@extends('template')
@section('content')

<a class="btn btn-primary btn-sm" href="{{ route('plats.index') }}">Tornar</a>
<br/>
<br/>
<div>
	<ul class="list-group">
		<li class="list-group-item active">{{ $plat->nom }}</li>
		@foreach($plat->ingredient as $ingredient)
			<li class="list-group-item">{{ $ingredient->nom }}</li>
		@endforeach
	</ul>
</div>

@endsection