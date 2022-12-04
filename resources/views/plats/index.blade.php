@extends('template')
@section('content')

@if(Auth::check() && Auth::user()->is_admin)
<a class="btn btn-primary btn-sm" href="{{ route('plats.create') }}">Nou</a>
@endif

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
        <th scope="col">Preu</th>
        @guest
        <th scope="col"></th>
        @endguest
        @if(Auth::check() && !Auth::user()->is_admin)
        <th scope="col"></th>
        @endif
        @if(Auth::check() && Auth::user()->is_admin)
        <th scope="col" colspan="4">Operacions</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($plats as $plat)
      <tr>
        <td>
          {{ $plat->id }}
        </td>
        <td>
          {{ $plat->nom }}
        </td>
        <td>
          {{ $plat->preu }}€
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('plats.show', $plat->id) }}" role="button">Mostrar</a>
        </td>
        @if(Auth::check() && Auth::user()->is_admin)
        <td>
          <a class="btn btn-primary" href="{{ route('plats.editingredients', $plat->id) }}" role="button">Ingredients</a>
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('plats.edit', $plat->id) }}" role="button">Modificar</a>
        </td>
        <td>
          <a class="btn btn-danger" href="{{ route('plats.destroy', $plat->id) }}" role="button">Esborrar</a>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{ $plats -> links('pagination::bootstrap-4') }}

@endsection