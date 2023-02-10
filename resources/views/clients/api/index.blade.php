@extends('template')
@section('content')

<div>
    <h4>Crud</h4>
    <label for="nameInput">Nom</label>
    <input type="text" id="nameInput">
    <label for="lastnameInput">Cognoms</label>
    <input type="text" id="lastnameInput">
    <label for="adressInput">Direcció</label>
    <input type="text" id="adressInput">
    <label for="phoneInput">Telèfon</label>
    <input type="text" id="phoneInput">
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
                <th>Cognoms</th>
                <th>Direcció</th>
                <th>Teléfon</th>  
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
	const table = document.getElementById("taula");
	const divErrors = document.getElementById("errors");
	divErrors.style.display = "none";
    
	const clientNameInput = document.getElementById("nameInput");
    const clientSurnameInput = document.getElementById("lastnameInput");
    const clientAdressInput = document.getElementById("adressInput");
    const clientPhoneInput = document.getElementById("phoneInput");

	const saveButton = document.getElementById("saveButton");
	saveButton.addEventListener("click", onSave);
	const url = "http://localhost:8000/api/clients";

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

	async function updateData(event) { // canviar
		var newClient = {
			"nom" : clientNameInput.value,
            "cognoms" : clientSurnameInput.value,
            "direccio" : clientAdressInput.value,
            "telefon" : clientPhoneInput.value
		}
		try {
			const response = await fetch(url + "/" + selectedId,
            {
                method: 'PUT',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(newClient)
            })
			const data = await response.json();
			if(response.ok) {
				const nameid = document.getElementById("name" + data.data.id);
				const rowid = document.getElementById(data.data.id);

                rowid.childNodes[1].innerHTML = data.data.nom;
                rowid.childNodes[2].innerHTML = data.data.cognoms;
                rowid.childNodes[3].innerHTML = data.data.direccio;
                rowid.childNodes[4].innerHTML = data.data.telefon;

				//nameid.innerHTML = data.data.nom;
				//rowid.setAttribute("nom", data.data.nom);

				clientNameInput.value = "";
                clientSurnameInput.value = "";
                clientAdressInput.value = "";
                clientPhoneInput.value = "";

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
		var newClient = {
			"nom" : clientNameInput.value,
            "cognoms" : clientSurnameInput.value,
            "direccio" : clientAdressInput.value,
            "telefon" : clientPhoneInput.value
		}
		try {
			const response = await fetch(url,
            {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(newClient)
            })
			const data = await response.json();
			if(response.ok) {
				afegirFila(data.data);
			} else {
                showErrors(data.data);
			}
		} catch(error) {
			errors.innerHTML = "S'ha produit un error inesperat";
		}
	}

	function afegirFila(row) {
        const rowElement = document.createElement("tr");
		rowElement.setAttribute("id", row.id);
		rowElement.setAttribute("name", row.nom);
        rowElement.setAttribute("cognoms", row.cognoms);
        rowElement.setAttribute("direccio", row.direccio);
        rowElement.setAttribute("telefon", row.telefon);

		const idCell = document.createElement("td");
		idCell.textContent = row.id;
		const nameCell = document.createElement("td");
		nameCell.textContent = row.nom;
        const cognomsCell = document.createElement("td");
        cognomsCell.textContent = row.cognoms;
        const direccioCell = document.createElement("td");
        direccioCell.textContent = row.direccio;
        const telefonCell = document.createElement("td");
        telefonCell.textContent = row.telefon;

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
		rowElement.appendChild(nameCell);
        rowElement.appendChild(cognomsCell);
        rowElement.appendChild(direccioCell);
        rowElement.appendChild(telefonCell);
		rowElement.appendChild(operationsCell);
		taula.appendChild(rowElement);
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
        const cognoms = tr.getAttribute("cognoms");
        const direccio = tr.getAttribute("direccio");
        const telefon = tr.getAttribute("telefon");
		selectedId = tr.getAttribute("id");
		clientNameInput.value = nom;
        clientSurnameInput.value = cognoms;
        clientAdressInput.value = direccio;
        clientPhoneInput.value = telefon;
		console.log("Editant: " + selectedId + " " + nom + " " + cognoms + " " + direccio + " " + telefon);
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