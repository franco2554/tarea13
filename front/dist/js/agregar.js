// front/dist/js/agregar.js
// Pagina para cargar un auto nuevo, la marca sale de la base

const formNuevo = document.querySelector("#formNuevo");
const inputMarca = document.querySelector("#marca");

async function cargarMarcas() {
    const respuesta = await API.request("/marcas");

    respuesta.marcas.forEach(marca => {
        const opcion = document.createElement("option");
        opcion.value = marca.id_marca;
        opcion.textContent = marca.nombre_marca;
        inputMarca.appendChild(opcion);
    });
}

formNuevo.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (!formNuevo.checkValidity()) {
        formNuevo.classList.add("was-validated");
        return;
    }

    const datos = {
        id_marca: inputMarca.value,
        modelo: document.querySelector("#modelo").value.trim(),
        anio: document.querySelector("#anio").value,
        precio: document.querySelector("#precio").value,
        estado: document.querySelector("#estado").value
    };

    const respuesta = await API.request("/vehiculos", "POST", datos);

    const alertaError = document.querySelector("#alertaError");

    if (respuesta.status === "ok") {
        window.location.href = "../../index.html";
    } else {
        alertaError.textContent = respuesta.message;
        alertaError.classList.remove("d-none");
    }
});

cargarMarcas();
