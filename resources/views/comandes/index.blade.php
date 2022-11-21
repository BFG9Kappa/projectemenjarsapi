@extends('template')
@section('content')

<a class="btn btn-primary btn-sm" href="/comandes/new">Nova</a>

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
      @foreach($comandes as $comanda)
      <tr>
        <td>{{ $comanda -> id }}
        </td>
        <td>{{ $comanda -> nom }}
        </td>
        <td>
          <a class="btn btn-primary" href="/comandes/update/{{ $comanda -> id }}" role="button">Modificar</a>
        </td>
        <td>
          <a class="btn btn-danger" href="/comandes/delete/{{ $comanda -> id }}" role="button">Esborrar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{ $comandes -> links('pagination::bootstrap-4') }}

@endsection