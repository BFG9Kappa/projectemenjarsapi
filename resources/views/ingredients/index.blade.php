@extends('template')
@section('content')

<a href="/ingredients/new">Nou</a>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
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
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection