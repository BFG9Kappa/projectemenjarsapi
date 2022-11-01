@extends('template')
@section('content')

<a href="/plats/new">Nou</a>
<a class="btn btn-primary btn-sm" href="/plats/new">Nou</a>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
        <th scope="col">Preu</th>
        <th scope="col" colspan="3">Operacions</th>
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
          <a class="btn btn-primary" href="#" role="button">Ingredients</a>
        </td>
        <td>
          <a class="btn btn-primary" href="plats/update/{{ $plat -> id }}" role="button">Modificar</a>
        </td>
        <td>
          <a class="btn btn-danger" href="/plats/delete/{{ $plat -> id }}" role="button">Esborrar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Afegir paginacio -->

@endsection