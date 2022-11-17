@extends('template')
@section('content')

yepa dos

<form method="POST" action="/comandes/save">
@csrf
<h4>Afegir aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h4>
  <div class="form-group">
    <label for="inputNom">Nom</label>
    <input type="text" class="form-control" id="inputNom" name="nom">
  </div>
  <input class="btn btn-primary" type="submit" value="Guardar">
</form>

@endsection