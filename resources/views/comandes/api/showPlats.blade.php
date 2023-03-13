@extends('template')
@section('content')

<a class="btn btn-primary btn-sm" href="{{ url('taulacomandes') }}">Tornar</a>
<h4 id="titol"></h4>
<h4 id="llistat"></h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-sm">
     	<form method='POST'>
            @csrf
	     	<div class="form-group">
                <label>Plats afegits:</label>
                <select multiple id="platsDetach" size="10" name="plats[]" class="form-control">
                </select>
	    	</div>
	    	<input class="btn btn-primary" type="submit" value="Treure plats">
    	</form>
    </div>
    <div class="col-sm">
    	<form method='POST'>
            @csrf
      		<div class="form-group">
                <label>Llista plats:</label>
                <select multiple id="platsAttach" class="form-control" size="20" name="plats[]">
                </select>
    		</div>
    		<input class="btn btn-primary" type="submit" value="Afegir plats">
    	</form>
    </div>
</div>

@if (session('success'))
  <div class="alert alert-success">
     <p>{{ session('success') }}</p>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
@endif

<script type="text/javascript">
    const id = window.location.pathname.slice(window.location.pathname.lastIndexOf('/') + 1);

    const url = "http://localhost:8000/api/comandes/" + id + "/plats";
    const urlplats = "http://localhost:8000/api/plats"


    async function loadIntoContainer() {
        const titol = document.getElementById("titol");
        titol.innerText = "Plats de comanda nº " + id;

        // Llistat de plats
        const response = await fetch(urlplats);
        const json = await response.json();
        const plats = json.data.data;
        const platsAttach = document.getElementById("platsAttach");
        plats.forEach(plat=> {
            platsAttach.innerHTML += `<option value="${plat.id}">${plat.nom}</option>`
        });

        //els noms dels plats
        const response2 = await fetch(url);
        console.log(response2);
        const json2 = await response2.json(); // cambiar a response2
        console.log(json2);
        const plats2 = json2.data.data; // cambiar a json2
        // const totsElsPlats = await fetch('url platos2')


        const platsDetach = document.getElementById("platsDetach");
        plats2.forEach(plat=> {
            platsDetach.innerHTML += `<option value="${plat.id}">${plat.nom}</option>`
        });

    }

    loadIntoContainer();

</script>

@endsection
