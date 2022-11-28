@extends('template')
@section('content')

<form method="POST" action="/comandes/save">
@csrf
<h4>Afegir comanda</h4>
  <div class="form-group">
    <label for="inputPreu">Preu</label>
    <input type="text" class="form-control" id="inputPreu" name="preu">
    <!--
    Select Estat
    Select Client
    -->
  </div>
  <input class="btn btn-primary" type="submit" value="Guardar">
</form>

@endsection