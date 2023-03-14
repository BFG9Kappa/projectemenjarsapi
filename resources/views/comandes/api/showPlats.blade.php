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
     	<form>
            @csrf
	     	<div class="form-group">
                <label>Plats afegits:</label>
                <select multiple id="platsDetac" class="form-control" size="10" name="plats[]" >
                </select>
	    	</div>
	    	<input class="btn btn-primary" type="submit" value="Treure plats">
    	</form>
    </div>
    <div class="col-sm">

             @csrf
      		<div class="form-group">
    		<label>Llista plats:</label>
    		<select multiple id="platsAtac" class="form-control" size="20" name="plats[]">
            </select>
    		</div>
    		<input onClick="afegirPlats()" class="btn btn-primary" type="submit" value="Afegir plats">

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

    // Extreure ID de la URL
    const id = window.location.pathname.slice(window.location.pathname.lastIndexOf('/') + 1);

    const url = 'http://localhost:8000/api/comandes/' + id + '/plats'
    const url2 = 'http://localhost:8000/api/plats'

    const url3 = 'http://localhost:8000/api/comandes/' + id + '/assignplats'

    //const url3 = 'http://localhost:8000/api/comandes/'+id+'/plats'

    //var async = require('asyncawait/async');
    //var await = require('asyncawait/await');

    async function loadIntoContainer() {
        const titol = document.getElementById("titol");
        titol.innerText = "Plats de comanda nº: " + id;
        // Seguir
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
            const response = await fetch(url);
            // const totsElsPlats = await fetch('url platos2')
            const json = await response.json();
            const plats= json.plats;

            const resta= json.resta;

            console.log(plats)

            const platsDetac = document.getElementById("platsDetac");
            plats.forEach(plat=> {
                platsDetac.innerHTML += `<option value="${plat.id}">${plat.nom}</option>`
                //La misma instrucción pero con diferente sintaxis
                //platsAtac.innerHTML += '<option value="' + plat.id+'">'+plat.nom+'</option>'
            });

            const platsAtac = document.getElementById("platsAtac");
            resta.forEach(plat=> {
                platsAtac.innerHTML += `<option value="${plat.id}">${plat.nom}</option>`
                //La misma instrucción pero con diferente sintaxis
                //platsAtac.innerHTML += '<option value="' + plat.id+'">'+plat.nom+'</option>'
            });
        }
		catch(error) {
			error.innerHTML = "No es pot accedir a la base de dades";
		}
	}

    async function afegirPlats() {

        var platsAtac = document.getElementById("platsAtac");
        const platsDetac = document.getElementById("platsDetac");

        var valors = [];
        //iterate through each option of the listbox
        for(var count= platsAtac.options.length-1; count >= 0; count--) {

            //if the option is selected, delete the option
            if(platsAtac.options[count].selected == true) {
                    valors.push(platsAtac.options[count].value);
                    platsDetac.innerHTML += `<option value="${platsAtac.options[count].value}">${platsAtac.options[count].innerHTML}</option>`
                            platsAtac.remove(count) // , null);

            }
        }

        console.log(valors)
        let newPlats = {
            "plats": valors,
        }
        console.log(newPlats)
        const response = await fetch(url3, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(newPlats)
            });
            const data = await response.json();
            console.log(data)

    }

    loadIntoContainer()

    //loadIntoContainer2()
    loadIntoContainer3()


</script>

@endsection
