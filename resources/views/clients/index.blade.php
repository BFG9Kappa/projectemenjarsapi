@extends('template')
@section('content')

<a class="btn btn-primary btn-sm" href="{{ route('clients.create') }}">Nou</a>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
        <th scope="col">Cognoms</th>
        <th scope="col">Direccio</th>
        <th scope="col">Telefon</th>
        <th scope="col" colspan="2">Operacions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($clients as $client)
      <tr>
        <td>{{ $client -> id }}
        </td>
        <td>
            {{ $client -> nom }}
        </td>
        <td>
            {{ $client -> cognoms }}
        </td>
        <td>
            {{ $client -> direccio }}
        </td>
        <td>
            {{ $client -> telefon }}
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('clients.edit', $client->id) }}" role="button">Modificar</a>
        </td>
        <td>
          <a class="btn btn-danger" href="{{ route('clients.destroy', $client->id) }}" role="button">Esborrar</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{ $clients -> links('pagination::bootstrap-4') }}

@endsection