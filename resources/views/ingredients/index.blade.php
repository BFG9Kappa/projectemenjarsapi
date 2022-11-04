@extends('template')
@section('content')

<a href="/ingredients/new">Nou</a>
<a class="btn btn-primary btn-sm" href="/ingredients/new">Nou</a>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
        <th scope="col" colspan="2">Operacions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($ingredients as $ingredient)
      <tr>
        <td>
          {{ $ingredient->id }}
        </td>
        <td>
          {{ $ingredient->nom }}
        </td>
        <td>
          <a class="btn btn-primary" href="/ingredients/update/{{ $ingredient -> id }}" role="button">Modificar</a>
        </td>
        <td>
          <a class="btn btn-danger" href="/ingredients/delete/{{ $ingredient -> id }}" role="button">Esborrar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection