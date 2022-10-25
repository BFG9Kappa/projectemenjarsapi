@extends('template')
@section('content')


@foreach($clients as $client)
    {{ $client -> id }}
    {{ $client -> nom }}
    {{ $client -> cognoms }}
    {{ $client -> direccio }}
    {{ $client -> telefon }}
@endforeach


@endsection