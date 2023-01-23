<!DOCTYPE html>
    <head>
    </head>
    <body>
        CRUD COMANDAS    
        <div>
            <input type="text" id="comandaNameInput"><!DOCTYPE html>
            <button id="saveButton">Save</button>
        </div>
        <table>
            <thead>
               <tr>
                <th>id</th>
                <th>Nom</th>
               </tr>
            </thead>
            <tbody id="taula">
          

            </tbody>
        </table>
    </body>
</html>
<script type="text/javascript">
            //console.log('hola');

            const table = document.getElementById('taula')
            const comandaNameInput = document.getElementById('comandaNameInput')
            const saveButton = document.getElementById('saveButton')
            saveButton.addEventListener('click', saveComanda)
           
            const url = 'http://127.0.0.1:8000/api/comandes/';

            async function saveComanda(event){
                console.log('desar');
                var newComanda = {
                    "nom" : comandaNameInput.value
                }

                try{
                    const response = await fetch(url,
                        { method: 'POST',
                            headers: {
                                'Content-type': 'application/json',
                                'Accept' : 'application/json'
                            },
                            body: JSON.stringify(newComanda)
                        }
                      )
                      const data = await response.json();
                      if(response.ok){
                        afegirFila(data.data); 



                      }

                    }
                catch(error){

                }

            }
           
            function afegirFila(row){
                const rowElement = document.createElement("tr");
                        rowElement.setAttribute('id', row.id)
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
           
            async function deleteComanda(event){

                //console.log(id);
                //console.log(event.target.parentNode.parentNode.id);
                //console.log(event.target.closest('tr').id);

                try {
                    const id = event.target.closest('tr').id
                    response = await fetch(url+''+id, { method: 'DELETE'})
                    const json = await response.json();
                    if(response.ok){ //codi 200,...
                        const row = document.getElementById(id)
                        row.remove()
                    }
                        else{
                        console.log('Error esborrant')

                        }
                    }

                 catch(error){
                    console.log('error xarxa')
                 }   

            }
             
            async function loadIntoTable(url){

                try{

                    const response = await fetch(url);
                    const json = await response.json();

                    const rows = json.data;
                    //console.log(rows)
                    //const table = document.getElementById('taula');
                  
                    for (var row of rows){
                       
                        const rowElement = document.createElement("tr");
                        rowElement.setAttribute('id', row.id)
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
                }
                catch (error){


            }
        }

            loadIntoTable(url);


        </script>
