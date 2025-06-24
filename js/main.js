// Se ejecuta cuando todo el contenido HTML de la página ha sido cargado
document.addEventListener('DOMContentLoaded', function () {
    const dataTableBody = document.getElementById('data-table-body'); // Referencia al cuerpo de la tabla

    // Función asíncrona para cargar y mostrar los datos
    async function loadData() {
        try {
            // Limpiar el contenido actual de la tabla mientras se cargan nuevos datos
            dataTableBody.innerHTML = '<tr><td colspan="6">Cargando datos...</td></tr>';

            // Realizar la solicitud a tu script PHP que devuelve JSON
            // La ruta sigue siendo la misma si main.js está en js/ y consultas.php en php/
            const response = await fetch('php/consultas.php');

            // Verificar si la respuesta es exitosa (código 200)
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }

            const data = await response.json(); // Parsear la respuesta como JSON

            // Limpiar la tabla de nuevo antes de insertar los datos reales
            dataTableBody.innerHTML = '';

            // Manejar los posibles mensajes de error o "no hay datos" que pueda enviar consultas.php
            if (data.error) {
                const row = dataTableBody.insertRow();
                const cell = row.insertCell();
                cell.colSpan = 6; // Ocupar todas las columnas
                cell.textContent = `Error al cargar datos: ${data.error}`;
                cell.classList.add('error-message');
            } else if (data.mensaje) {
                const row = dataTableBody.insertRow();
                const cell = row.insertCell();
                cell.colSpan = 6;
                cell.textContent = data.mensaje;
                cell.classList.add('no-data-message');
            } else {
                // Si hay datos, iterar sobre ellos y crear las filas de la tabla
                data.forEach(item => {
                    const row = dataTableBody.insertRow(); // Crea una nueva fila <tr>

                    // Crea las celdas <td> y asigna el texto desde el objeto 'item'
                    row.insertCell().textContent = item.id;
                    row.insertCell().textContent = item.date;
                    row.insertCell().textContent = item.time;
                    row.insertCell().textContent = item.value;

                    // Interpretación del valor para la columna "Acción"
                    const actionCell = row.insertCell();
                    if (item.value === 1) {
                        actionCell.textContent = "Luces Encendidas";
                        actionCell.style.color = "green";
                    } else if (item.value === 0) {
                        actionCell.textContent = "Luces Apagadas";
                        actionCell.style.color = "red";
                    } else {
                        actionCell.textContent = `Valor desconocido (${item.value})`;
                    }

                    // Columna para "Tiempo Total": Este valor no está en la DB, requeriría cálculo.
                    row.insertCell().textContent = 'N/A';
                });
            }
        } catch (error) {
            // Manejar errores de red o de parsing de JSON
            console.error('Error al cargar los datos:', error);
            const row = dataTableBody.insertRow();
            const cell = row.insertCell();
            cell.colSpan = 6;
            cell.textContent = `Error de red o formato de datos: ${error.message}`;
            cell.classList.add('error-message');
        }
    }

    // Llama a la función para cargar los datos cuando la página esté lista
    loadData();

    // Opcional: Si quieres que la tabla se actualice automáticamente cada cierto tiempo (ej. cada 30 segundos)
    // setInterval(loadData, 30000); // 30000 ms = 30 segundos
});