@extends('template')
@section('content')

<div>
    <h4>Crud</h4>
    <label for="nameInput">Nom</label>
    <input type="text" id="nameInput">
    <label for="preuInput">Preu</label>
    <input type="text" id="preuInput">
    <label for="estatInput">Estat</label>
    <!--<input type="text" id="estatInput"> -->
    <select class="form-select" aria-label="Default select example" name="estatInput" id="estatInput">
		<option value="En proces" >En proces</option>
		<option value="Enviat" >Enviat</option>
		<option value="Rebut" >Rebut</option>
	</select>
    <button class="btn btn-primary btn-sm" id="saveButton">Desar</button>
</div>
<br/>

<div id="errors" class="alert alert-danger" role="alert"></div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Preu</th>
                <th>Estat</th>
                <th>Operacions</th>
            </tr>
        </thead>
        <tbody id="taula">
        </tbody>
    </table>
</div>

<script type="text/javascript">
    var rows = [];
	var operation = "inserting";
	var selectedId;
    const table = document.getElementById('taula');
    const divErrors = document.getElementById('errors');
	divErrors.style.display = "none";
    const comandaNameInput = document.getElementById('nameInput');
    const comandaPreuInput = document.getElementById('preuInput');
    const comandaEstatInput = document.getElementById('estatInput');

    const saveButton = document.getElementById('saveButton');
    saveButton.addEventListener('click', onSave);
    const url = 'http://127.0.0.1:8000/api/comandes';

    function showErrors(errors) {
        divErrors.style.display = "block";
        divErrors.innerHTML = "";
        const ul = document.createElement("ul");
        for(const error of errors) {
                const li = document.createElement("li");
                li.textContent = error;
                ul.appendChild(li);
        }
        divErrors.appendChild(ul);
    }

	function onSave(event) {
		if(operation == "inserting") saveData();
		if(operation == "editing") updateData();
	}

    async function updateData(event) {
		var newComanda = {
            "nom": comandaNameInput.value,
            "preu": comandaPreuInput.value,
            "estat": comandaEstatInput.value
		}
		try {
			const response = await fetch(url + "/" + selectedId,
            {
                method: 'PUT',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(newComanda)
            })
			const data = await response.json();
			if(response.ok) {
				const nameid = document.getElementById("name" + data.data.id); // cuadrat input
				const rowid = document.getElementById(data.data.id);

                rowid.childNodes[1].innerHTML = data.data.nom;
                rowid.childNodes[2].innerHTML = data.data.preu;
                rowid.childNodes[3].innerHTML = data.data.estat;

				comandaNameInput.value = "";
                comandaPreuInput.value = "";
                comandaEstatInput.value = "";
				
                operation = "inserting";
			} else {
                showErrors(data.data)
			}
		} catch(error) {
            errors.innerHTML = "S'ha produit un error inesperat";
			operation = "inserting";
		}
	}

    async function saveData(event) {
        let newComanda = {
            "nom": comandaNameInput.value,
            "preu": comandaPreuInput.value,
            "estat": comandaEstatInput.value
        }
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(newComanda)
            });
            const data = await response.json();
            if (response.ok) {
                afegirFila(data.data);
            } else {
                showErrors(data.data);
            }
        } catch (error) {
            error.innerHTML = "S'ha produit un error inesperat";
        }
    }

    function afegirFila(row) {
        const rowElement = document.createElement("tr");
        rowElement.setAttribute("id", row.id);
        rowElement.setAttribute("name", row.nom);
        rowElement.setAttribute("preu", row.preu);
        rowElement.setAttribute("estat", row.estat);
        
        const idCell = document.createElement("td");
        idCell.textContent = row.id;

        const nomCell = document.createElement("td");
        nomCell.textContent = row.nom;

        const preuCell = document.createElement("td");
        preuCell.textContent = row.preu;

        const estatCell = document.createElement("td");
        estatCell.textContent = row.estat;
 
        const operationsCell = document.createElement("td");
        const updateButton = document.createElement("button");
		updateButton.innerHTML = "Actualitzar";
        updateButton.classList.add("btn", "btn-primary");
		updateButton.addEventListener("click", function (event) { editData(event, row) } );
		operationsCell.appendChild(updateButton);

		const deleteButton = document.createElement("button");
        deleteButton.innerHTML = "Esborrar";
        deleteButton.addEventListener("click", deleteData);
        deleteButton.classList.add("btn", "btn-danger");
        operationsCell.appendChild(deleteButton);
        rowElement.appendChild(idCell);
        rowElement.appendChild(nomCell);
        rowElement.appendChild(preuCell);
        rowElement.appendChild(estatCell);
        rowElement.appendChild(operationsCell);
        table.appendChild(rowElement);
    }

	async function deleteData(event) {
		try {
			const id = event.target.closest("tr").id;
			response = await fetch(url + '/' + id, { method: 'DELETE'});
			const json = await response.json();
			if(response.ok) {
					const row = document.getElementById(id);
					row.remove();
                } else {
				divErrors.style.display = "block";
				errors.innerHTML = "No es pot esborrar";
			}
		} catch(error) {
			divErrors.style.display = "block";
			errors.innerHTML = "No es pot esborrar";
		}
	}

	async function editData(event, row) {
		operation = "editing";
		const tr = event.target.closest("tr");
		const nom = tr.getAttribute("name");
        const preu = tr.getAttribute("preu");
        const estat = tr.getAttribute("estat");
		selectedId = tr.getAttribute("id");
        comandaNameInput.value = nom;
        comandaPreuInput.value = preu;
        comandaEstatInput.value = estat;
		console.log("Editant: " + selectedId + " " + nom + " " + preu + " " + estat);
		console.log(row);
	}

    async function loadIntoTable(url) {
		try {
			const response = await fetch(url);
			const json = await response.json();
			rows = json.data;
			var i = 0;
			for(const row of rows) {				
				afegirFila(row);
			}
		}
		catch(error) {
			errors.innerHTML = "No es pot accedir a la base de dades";
		}
	}

    async function getToken() {
        try {
            const response = await fetch("http://localhost:8000/token");
            const json = await response.json();
            window.localStorage.setItem("token", json.token);
            console.log(json);
        } catch (error) {
            console.log("error");
        }
    }

    async function getUser() {
        try {
            const response = await fetch("http://localhost:8000/api/user");
            const json = await response.json();
            window.localStorage.setItem("token", json.token);
            console.log(json);
        } catch (error) {
            console.log("error");
        }
    }

    //getToken();
    //getUser();

    loadIntoTable(url);

</script>

@endsection