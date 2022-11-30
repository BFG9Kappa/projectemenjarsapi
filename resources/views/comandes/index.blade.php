@extends('template')
@section('content')

<a class="btn btn-primary btn-sm" href="/comandes/create">Nova</a>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Preu</th>
        <th scope="col">Estat</th>
        <th scope="col" colspan="2">Operacions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($comandes as $comanda)
      <tr>
        <td>
          {{ $comanda -> id }}
        </td>
        <td>
          {{ $comanda -> preu }}
        </td>
        <td>
          {{ $comanda -> estat }}
        </td>
        <td>
          <a class="btn btn-primary" href="/comandes/edit/{{ $comanda -> id }}" role="button">Modificar</a>
        </td>
        <td>
          <a class="btn btn-danger" href="/comandes/destroy/{{ $comanda -> id }}" role="button">Esborrar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{ $comandes -> links('pagination::bootstrap-4') }}

@endsection