@extends('template')
@section('content')

<div>
    <h4>Crud</h4>
    <label for="nameInput">Nom</label>
    <input type="text" id="nameInput">
    <button class="btn btn-primary btn-sm" id="saveButton">Desar</button>
</div>
<br>

<div id="errors" class="alert alert-danger" role="alert"></div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Operacions</th>
            </tr>
        </thead>
        <tbody id="taula">
        </tbody>
    </table>
</div>

<nav class="mt-2">
	<ul id="pagination" class="pagination">
	</ul>
</nav>


<script type="text/javascript">
    var rows = [];
	var operation = "inserting";
	var selectedId;

	const pagination = document.getElementById("pagination");

	const table = document.getElementById("taula");
	const divErrors = document.getElementById("errors");
	divErrors.style.display = "none";
	const ingredientNameInput = document.getElementById("nameInput");
	const saveButton = document.getElementById("saveButton");
	saveButton.addEventListener("click", onSave);

	const url = "http://localhost:8000/api/ingredients";

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
		var newIngredient = {
			"nom" : ingredientNameInput.value
		}
		try {
			const response = await fetch(url + "/" + selectedId,
            {
                method: 'PUT',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(newIngredient)
            })
			const data = await response.json();
			if(response.ok) {
				const nameid = document.getElementById("name" + data.data.id); // cuadrat input
				const rowid = document.getElementById(data.data.id);

                //rowid.childNodes[1].innerHTML = data.data.nom; // Metode alternatiu al de sota
				nameid.innerHTML = data.data.nom;
				rowid.setAttribute("nom", data.data.nom);

				ingredientNameInput.value = "";
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
		var newIngredient = {
			"nom" : ingredientNameInput.value
		}
		try {
			const response = await fetch(url,
            {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(newIngredient)
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
		rowElement.setAttribute("name", row.nom); // pasa update
		const idCell = document.createElement("td");
		idCell.textContent = row.id;
		const nameCell = document.createElement("td");
		nameCell.setAttribute("id", "name" + row.id); // Comentar si es usa la sintaxis alternativa
		nameCell.textContent = row.nom; // mostra taula
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
		selectedId = tr.getAttribute("id");
		ingredientNameInput.value = nom;
		console.log("Editant: " + selectedId + " " + nom);
		console.log(row);
	}
	
	async function loadIntoTable(url) {
		try {
			const response = await fetch(url);
			const json = await response.json();
			rows = json.data.data;
			const links = json.data.links;
			var i = 0;
			for(const row of rows) {				
				afegirFila(row);
			}
			afegirLinks(links);
		}
		catch(error) {
			errors.innerHTML = "No es pot accedir a la base de dades";
		}
	}

	function afegirLinks(links) {
        for(const link of links) {
            afegirBoto(link);
        }
    }

	function afegirBoto(link) {
        const pagLi = document.createElement("li");
        pagLi.classList.add("page-item");

		if(link.url == null)
			pagLi.classList.add("disabled");
		if(link.active == true)
			pagLi.classList.add("active");

        const pagAnchor = document.createElement("a");
        pagAnchor.innerHTML = link.label;
        pagAnchor.addEventListener("click", function(event) { paginate(link.url) });
        pagAnchor.classList.add("page-link");
        pagAnchor.setAttribute("href", "#");
        pagLi.appendChild(pagAnchor);
        pagination.appendChild(pagLi);
	}

	function paginate(url) {
		pagination.innerHTML = "";
		taula.innerHTML = "";
		loadIntoTable(url);
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
