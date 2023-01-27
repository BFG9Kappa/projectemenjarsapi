@extends('template')
@section('content')

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
        <th scope="col">Cognoms</th>
        <th scope="col">Direccio</th>
        <th scope="col">Telefon</th>
        <th scope="col" colspan="2">Operacions</th>
      </tr>
    </thead>
    <tbody id="taula">
    </tbody>
  </table>
</div>

<script>
    const table = document.getElementById('taula');

    //const comandaNameInput = document.getElementById('comandaNameInput');
    //const saveButton = document.getElementById('saveButton');
    //saveButton.addEventListener('click', saveComanda);

    const url = 'http://127.0.0.1:8000/api/clients/';

    /*
    async function saveComanda(event) {
        let newComanda = {
            "nom": comandaNameInput.value
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
                addRows(data.data);
            }
        } catch (error) {
            //
        }
    }
    */

    function addRows(row) {
        const rowElement = document.createElement("tr");
        rowElement.setAttribute('id', row.id);
        const idCell = document.createElement("td");
        idCell.textContent = row.id;
        const nomCell = document.createElement("td");
        nomCell.textContent = row.nom;
        const operationsCell = document.createElement("td");
        const deleteButton = document.createElement("button");
        deleteButton.innerHTML = "Esborrar";
        deleteButton.addEventListener('click', deleteComanda);
        operationsCell.appendChild(deleteButton);
        rowElement.appendChild(idCell);
        rowElement.appendChild(nomCell);
        rowElement.appendChild(operationsCell);
        table.appendChild(rowElement);
    }

    async function deleteComanda(event) {
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
                const operationsCell = document.createElement("td");
                const deleteButton = document.createElement("button");
                deleteButton.innerHTML = "Esborrar";
                deleteButton.addEventListener('click', deleteComanda);
                operationsCell.appendChild(deleteButton);
                rowElement.appendChild(idCell);
                rowElement.appendChild(nomCell);
                rowElement.appendChild(operationsCell);
                table.appendChild(rowElement);
            }
        } catch (error) {
            //
        }
    }

    loadIntoTable(url);

</script>

@endsection