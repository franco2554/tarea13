// front/dist/js/script.js
// Pagina del listado: pedir los autos y armar la tabla

const tablaAutos = document.querySelector("#tablaAutos");

async function cargarAutos() {
    const respuesta = await API.request("/vehiculos");

    if (respuesta.status !== "ok") {
        tablaAutos.innerHTML = `<tr><td colspan="6" class="text-center text-danger">${respuesta.message}</td></tr>`;
        return;
    }

    if (respuesta.vehiculos.length === 0) {
        tablaAutos.innerHTML = `<tr><td colspan="6" class="text-center text-muted">No hay autos cargados</td></tr>`;
        return;
    }

    tablaAutos.innerHTML = "";

    respuesta.vehiculos.forEach(auto => {
        const fila = document.createElement("tr");

        const badge = auto.estado === "Nuevo" ? "bg-success" : "bg-warning text-dark";

        fila.innerHTML = `
            <td>${auto.nombre_marca}</td>
            <td>${auto.modelo}</td>
            <td>${auto.anio}</td>
            <td>$ ${auto.precio}</td>
            <td><span class="badge ${badge}">${auto.estado}</span></td>
            <td><a href="dist/pages/auto.html?id=${auto.id_vehiculo}" class="btn btn-sm btn-outline-primary">Ver</a></td>
        `;

        tablaAutos.appendChild(fila);
    });
}

cargarAutos();
