<p>Dios<p>
<!-- Hacer un fetch json de plats, y mostrat las dos listas attach y detach-->

@extends('template')
@section('content')

<script type="text/javascript">

//var async = require('asyncawait/async');
//var await = require('asyncawait/await');


async function loadIntoContainer() {
		try {
			const response = await fetch(url);
			const json = await response.json();
            const plats= json.data;
            nom.innerText= plats.nom;

        }
		catch(error) {
			error.innerHTML = "No es pot accedir a la base de dades";
		}
	}

    loadIntoContainer()

</script>
@endsection
