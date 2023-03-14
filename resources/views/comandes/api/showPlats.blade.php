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
            @csrf
	     	<div class="form-group">
                <label>Plats afegits:</label>
                <select multiple id="platsDetach" class="form-control" size="10" name="plats[]" >
                </select>
	    	</div>
	    	<input onClick="treurePlats()" class="btn btn-primary" type="submit" value="Treure plats">

    </div>
    <div class="col-sm">
        @csrf
        <div class="form-group">
            <label>Llista plats:</label>
            <select multiple id="platsAttach" class="form-control" size="20" name="plats[]"></select>
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

    const url = "http://localhost:8000/api/comandes/" + id + "/plats";

    const urlAssign = "http://localhost:8000/api/comandes/" + id + "/assignplats";
    const urlDetach = "http://localhost:8000/api/comandes/" + id + "/detachplats";


    async function loadIntoContainer() {
        const titol = document.getElementById("titol");
        titol.innerText = "Plats de comanda nº: " + id;
        // Extreure noms dels plats
        const response = await fetch(url);
        const json = await response.json();
        const plats = json.plats;
        const resta = json.resta;

        console.log(plats);
        console.log(resta);

        const platsDetach = document.getElementById("platsDetach");
        plats.forEach(plat=> {
            platsDetach.innerHTML += `<option value="${plat.id}">${plat.nom}</option>`
            //La misma instrucción pero con diferente sintaxis
            //platsAttach.innerHTML += '<option value="' + plat.id+'">'+plat.nom+'</option>'
        });

        const platsAttach = document.getElementById("platsAttach");
        resta.forEach(plat=> {
            platsAttach.innerHTML += `<option value="${plat.id}">${plat.nom}</option>`
            //La misma instrucción pero con diferente sintaxis
            //platsAttach.innerHTML += '<option value="' + plat.id+'">'+plat.nom+'</option>'
        });
    }

    async function afegirPlats() {
        const platsAttach = document.getElementById("platsAttach");
        const platsDetach = document.getElementById("platsDetach");
        var valors = [];
        for(var count = platsAttach.options.length - 1; count >= 0; count--) {
            if(platsAttach.options[count].selected == true) {
                valors.push(platsAttach.options[count].value);
                platsDetach.innerHTML += `<option value="${platsAttach.options[count].value}">${platsAttach.options[count].innerHTML}</option>`
                platsAttach.remove(count) // , null);
            }
        }
        //console.log(valors)
        let newPlats = {
            "plats": valors,
        }
        //console.log(newPlats)
        const response = await fetch(urlAssign, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(newPlats)
        });
        const data = await response.json();
        console.log(data);
    }

    async function treurePlats() {
        const platsAttach = document.getElementById("platsAttach");
        const platsDetach = document.getElementById("platsDetach");
        var valors = [];
        //iterate through each option of the listbox
        for(var count = platsDetach.options.length-1; count >= 0; count--) {
            if(platsDetach.options[count].selected == true) {
                valors.push(platsDetach.options[count].value);
                platsAttach.innerHTML += `<option value="${platsDetach.options[count].value}">${platsDetach.options[count].innerHTML}</option>`
                platsDetach.remove(count); // fix: add semicolon to end the statement
            }
        }
        //console.log(valors)
        let removedPlats = {
            "plats": valors,
        }
        //console.log(removedPlats)
        const response = await fetch(urlDetach, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(removedPlats)
        });
        const data = await response.json();
        console.log(data);
    }

    loadIntoContainer()

</script>

@endsection
