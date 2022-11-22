@extends('template')
@section('content')

yepa dos

<form method="POST" action="/comandes/save">
@csrf
<h4>Afegir comanda</h4>
  <div class="form-group">
    <label for="inputNom">Preu</label>
    <input type="text" class="form-control" id="inputPreu" name="preu">
    Select Estat
    Select Client
  </div>
  <input class="btn btn-primary" type="submit" value="Guardar">
</form>

@endsection