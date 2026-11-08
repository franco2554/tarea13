// front/dist/js/auto.js
// Pagina del auto: mostrar sus datos y el formulario para modificarlo

const idAuto = new URLSearchParams(window.location.search).get("id");

const formAuto = document.querySelector("#formAuto");
const inputMarca = document.querySelector("#marca");
const inputModelo = document.querySelector("#modelo");
const inputAnio = document.querySelector("#anio");
const inputPrecio = document.querySelector("#precio");
const inputEstado = document.querySelector("#estado");

function mostrarAuto(auto) {
    document.querySelector("#tituloAuto").textContent = auto.nombre_marca + " " + auto.modelo;

    document.querySelector("#infoMarca").textContent = auto.nombre_marca;
    document.querySelector("#infoModelo").textContent = auto.modelo;
    document.querySelector("#infoAnio").textContent = auto.anio;
    document.querySelector("#infoPrecio").textContent = "$ " + auto.precio;
    document.querySelector("#infoEstado").textContent = auto.estado;

    inputMarca.value = auto.id_marca;
    inputModelo.value = auto.modelo;
    inputAnio.value = auto.anio;
    inputPrecio.value = auto.precio;
    inputEstado.value = auto.estado;
}

async function cargarMarcas(marcaElegida) {
    const respuesta = await API.request("/marcas");

    inputMarca.innerHTML = '<option value="" selected disabled>Seleccionar marca...</option>';

    respuesta.marcas.forEach(marca => {
        const opcion = document.createElement("option");
        opcion.value = marca.id_marca;
        opcion.textContent = marca.nombre_marca;
        inputMarca.appendChild(opcion);
    });

    if (marcaElegida) {
        inputMarca.value = marcaElegida;
    }
}

async function cargarAuto() {
    if (!idAuto) {
        document.querySelector("#alertaNoEncontrado").classList.remove("d-none");
        return;
    }

    const respuesta = await API.request("/vehiculos/" + idAuto);

    if (respuesta.status !== "ok") {
        document.querySelector("#alertaNoEncontrado").classList.remove("d-none");
        return;
    }

    mostrarAuto(respuesta.vehiculo);
    cargarMarcas(respuesta.vehiculo.id_marca);
}

formAuto.addEventListener("submit", async (e) => {
    e.preventDefault();

    const datos = {
        id_marca: inputMarca.value,
        modelo: inputModelo.value.trim(),
        anio: inputAnio.value,
        precio: inputPrecio.value,
        estado: inputEstado.value
    };

    const respuesta = await API.request("/vehiculos/" + idAuto, datos);

    if (respuesta.status === "ok") {
        document.querySelector("#alertaGuardado").classList.remove("d-none");

        const auto = await API.request("/vehiculos/" + idAuto);
        mostrarAuto(auto.vehiculo);
    }
});

cargarAuto();
