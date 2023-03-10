<!-- Hacer un fetch json de plats, y mostrat las dos listas attach y detach-->

@extends('template')
@section('content')

<a class="btn btn-primary btn-sm" href="{{ url('taulacomandes') }}">Tornar</a>
<h4>Plats de comanda nº:</h4>
<h4 id="proba"></h4>
<h4 id="llistat"></h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>

        </ul>
    </div>
@endif

<div class="row">
    <div class="col-sm">
     	<form method='POST' action="">
            @csrf
	     	<div class="form-group">
                <label>Plats afegits:</label>
                <select multiple id="platsDetac" size="10" name="plats[]" class="form-control">
                </select>
	    	</div>
	    	<input class="btn btn-primary" type="submit" value="Treure plats">
    	</form>
    </div>
    <div class="col-sm">
    	<form method='POST' action="">
             @csrf
      		<div class="form-group">
    		<label>Llista plats:</label>
    		<select multiple id="platsAtac" class="form-control" size="20" name="plats[]">
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
    const id = window.location.pathname.slice(window.location.pathname.lastIndexOf('/')+1);
    console.log(id)

    const url = 'http://localhost:8000/api/comandes/'+id+'/plats'
    const url2 = 'http://localhost:8000/api/plats'
    const url3 = 'http://localhost:8000/api/comandes/'+id+'/plats'


//var async = require('asyncawait/async');
//var await = require('asyncawait/await');


async function loadIntoContainer() {
		try {
			const response = await fetch(url);
            const totsPlats = await fetch('url platos')
			const json = await response.json();
            const plats= json.plats;

            //el numero de comanda
            const l = document.getElementById("proba");
            l.innerText = id;

            //els noms dels plats dins de la comanda
            console.log(plats)
            //nom.innerText= plats.nom;

            const llistat = document.getElementById("llistat");
                plats.forEach(plat=> {
                    llistat.innerText += '#' + plat.nom
                });

        }
		catch(error) {
			error.innerHTML = "No es pot accedir a la base de dades";
		}
	}

    async function loadIntoContainer2() {
		try {

            //els noms dels plats
            const response = await fetch(url2);
            // const totsElsPlats = await fetch('url platos2')
            const json = await response.json();
            const plats= json.data.data;

            console.log(plats)

            const platsAtac = document.getElementById("platsAtac");
                plats.forEach(plat=> {
                    platsAtac.innerHTML += `<option value="${plat.id}">${plat.nom}</option>`
                    //La misma instrucción pero con diferente sintaxis
                    //platsAtac.innerHTML += '<option value="' + plat.id+'">'+plat.nom+'</option>'
                });

        }
		catch(error) {
			error.innerHTML = "No es pot accedir a la base de dades";
		}
	}

    async function loadIntoContainer3() {
		try {

            //els noms dels plats
            const response = await fetch(url3);
            // const totsElsPlats = await fetch('url platos2')
            const json = await response.json();
            const plats2= json.plats2;

            console.log(plats)

            const platsDetac = document.getElementById("platsDetac");
                plats2.forEach(plat=> {
                    platsDetac.innerHTML += `<option value="${plat.id}">${plat.nom}</option>`
                    //La misma instrucción pero con diferente sintaxis
                    //platsAtac.innerHTML += '<option value="' + plat.id+'">'+plat.nom+'</option>'
                });

        }
		catch(error) {
			error.innerHTML = "No es pot accedir a la base de dades";
		}
	}

    loadIntoContainer()
    loadIntoContainer2()
    loadIntoContainer3()

</script>

@endsection
