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
    const table = document.getElementById('taula');
    const divErrors = document.getElementById('errors');
	divErrors.style.display = "none";
    const clientNameInput = document.getElementById('nameInput');
    const clientLastnameInput = document.getElementById('lastnameInput');
    const clientAdressInput = document.getElementById('adressInput');
    const clientPhoneInput = document.getElementById('phoneInput');
    const saveButton = document.getElementById('saveButton');
    saveButton.addEventListener('click', saveData);
    const url = 'http://127.0.0.1:8000/api/clients/';

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
    
    async function saveData(event) {
        let newClient = {
            "nom": clientNameInput.value,
            "cognoms": clientLastnameInput.value,
            "direccio": clientAdressInput.value,
            "telefon": clientPhoneInput.value
        }
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(newClient)
            });
            const data = await response.json();
            if (response.ok) {
                addRow(data.data);
            } else {
                showErrors(data.data);
            }
        } catch (error) {
            error.innerHTML = "S'ha produit un error inesperat";
        }
    }

    function addRow(row) {
        const rowElement = document.createElement("tr");
        rowElement.setAttribute('id', row.id);
        const idCell = document.createElement("td");
        idCell.textContent = row.id;
        const nomCell = document.createElement("td");
        nomCell.textContent = row.nom;
        const cognomsCell = document.createElement("td");
        cognomsCell.textContent = row.cognoms;
        const direccioCell = document.createElement("td");
        direccioCell.textContent = row.direccio;
        const telefonCell = document.createElement("td");
        telefonCell.textContent = row.telefon;
        const operationsCell = document.createElement("td");
        const deleteButton = document.createElement("button");
        deleteButton.classList.add('btn', 'btn-danger');
        deleteButton.innerHTML = "Esborrar";
        deleteButton.addEventListener('click', deleteRow);
        operationsCell.appendChild(deleteButton);
        rowElement.appendChild(idCell);
        rowElement.appendChild(nomCell);
        rowElement.appendChild(cognomsCell);
        rowElement.appendChild(direccioCell);
        rowElement.appendChild(telefonCell);
        rowElement.appendChild(operationsCell);
        table.appendChild(rowElement);
    }

    async function deleteRow(event) {
        try {
            const id = event.target.closest('tr').id;
            const response = await fetch(url + id, {
                method: 'DELETE'
            });
            const json = await response.json();
            if (response.ok) { 
                const row = document.getElementById(id);
                row.remove();
            } else {
                console.log('Error esborrant');
            }
        } catch (error) {
            console.log('Error xarxa');
        }
    }

    async function loadIntoTable(url) {
        try {
            const response = await fetch(url);
            const json = await response.json();
            const rows = json.data;
            for (let row of rows) {
                const rowElement = document.createElement("tr");
                rowElement.setAttribute('id', row.id);
                const idCell = document.createElement("td");
                idCell.textContent = row.id;
                const nomCell = document.createElement("td");
                nomCell.textContent = row.nom;
                const cognomsCell = document.createElement("td");
                cognomsCell.textContent = row.cognoms;
                const direccioCell = document.createElement("td");
                direccioCell.textContent = row.direccio;
                const telefonCell = document.createElement("td");
                telefonCell.textContent = row.telefon;
                const operationsCell = document.createElement("td");
                const deleteButton = document.createElement("button");
                deleteButton.classList.add('btn', 'btn-danger');
                deleteButton.innerHTML = "Esborrar";
                deleteButton.addEventListener('click', deleteRow);
                operationsCell.appendChild(deleteButton);
                rowElement.appendChild(idCell);
                rowElement.appendChild(nomCell);
                rowElement.appendChild(cognomsCell);
                rowElement.appendChild(direccioCell);
                rowElement.appendChild(telefonCell);
                rowElement.appendChild(operationsCell);
                table.appendChild(rowElement);
            }
        } catch (error) {
            errors.innerHTML = "No es pot accedir a la base de dades";
        }
    }

    loadIntoTable(url);

</script>

@endsection