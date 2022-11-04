@extends('template')
@section('content')

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
        <th scope="col">Cognoms</th>
        <th scope="col">Direccio</th>
        <th scope="col">Telefon</th>
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
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection