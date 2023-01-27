@extends('template')
@section('content')

<div>
    <h4>Crud</h4>
    <label for="nameInput">Nom</label>
    <input type="text" id="nameInput">
    <label for="preuInput">Preu</label>
    <input type="text" id="preuInput">
    <label for="estatInput">Estat</label>
    <input type="text" id="estatInput">
    <button class="btn btn-primary btn-sm" id="saveButton">Desar</button>
    <br/>
    <br/>
</div>

<div id="errors" class="alert alert-danger" role="alert"></div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Preu</th>
                <th>Estat</th>
            </tr>
        </thead>
        <tbody id="taula">
        </tbody>
    </table>
</div>

<script type="text/javascript">

    const table = document.getElementById('taula');
    const divErrors = document.getElementById('errors');
	divErrors.style.display = "none"    

    const comandaNameInput = document.getElementById('nameInput');
    const comandaPreuInput = document.getElementById('preuInput');
    const comandaEstatInput = document.getElementById('estatInput');

    const saveButton = document.getElementById('saveButton');
    saveButton.addEventListener('click', saveData);
    const url = 'http://127.0.0.1:8000/api/comandes/';

    function showErrors(errors) {
        divErrors.style.display = "block"
        divErrors.innerHTML = "";
        const ul = document.createElement("ul")
        for(const error of errors) {				
                const li = document.createElement("li");				
                li.textContent = error;				
                ul.appendChild(li);			
        }
        divErrors.appendChild(ul)
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
                addRow(data.data);
            } else {
                showErrors(data.data)
            }
        } catch (error) {
            error.innerHTML = "S'ha produit un error inesperat" 
        }
    }

    function addRow(row) {
        const rowElement = document.createElement("tr");
        rowElement.setAttribute('id', row.id);
        const idCell = document.createElement("td");
        idCell.textContent = row.id;
        const nomCell = document.createElement("td");
        nomCell.textContent = row.nom;

        const preuCell = document.createElement("td");
        preuCell.textContent = row.preu;

        const estatCell = document.createElement("td");
        estatCell.textContent = row.estat;

        const operationsCell = document.createElement("td");
        const deleteButton = document.createElement("button");
        deleteButton.innerHTML = "Esborrar";
        deleteButton.addEventListener('click', deleteRow);
        operationsCell.appendChild(deleteButton);
        rowElement.appendChild(idCell);
        rowElement.appendChild(nomCell);

        rowElement.appendChild(preuCell);
        rowElement.appendChild(estatCell);

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
            console.log('error xarxa');
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

                const preuCell = document.createElement("td");
                preuCell.textContent = row.preu;

                const estatCell = document.createElement("td");
                estatCell.textContent = row.estat;

                const operationsCell = document.createElement("td");
                const deleteButton = document.createElement("button");
                deleteButton.innerHTML = "Esborrar";
                deleteButton.addEventListener('click', deleteRow);
                operationsCell.appendChild(deleteButton);
                rowElement.appendChild(idCell);
                rowElement.appendChild(nomCell);

                rowElement.appendChild(preuCell);
                rowElement.appendChild(estatCell);
                rowElement.appendChild(operationsCell);
                table.appendChild(rowElement);
            }
        } catch (error) {
            errors.innerHTML = "No es pot accedir a la base de dades"
        }
    }

    loadIntoTable(url);

</script>

@endsection