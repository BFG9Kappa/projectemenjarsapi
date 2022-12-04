@extends('template')
@section('content')

<a class="btn btn-primary btn-sm" href="{{ route('comandes.index') }}">Tornar</a>
<br/>
<br/>
<div>
    <ul class="list-group">
		<li class="list-group-item active">Comanda nº {{ $comanda->id }}</li>
        @foreach($comanda->plat as $plat)
			<li class="list-group-item">{{ $plat->nom }}</li>
		@endforeach
	</ul>
</div>

@endsection