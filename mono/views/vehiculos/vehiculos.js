function init() {
    $("#form_vehiculos").on("submit", (e) => {
        GuardarEditar(e);
    });
}
const ruta = "../../controllers/vehiculos.controllers.php?op=";

$().ready(() => {
    CargaLista();
});

var CargaLista = () => {
    var html = "";
    $.get(ruta + "todos", (ListVehiculos) => {
        ListVehiculos = JSON.parse(ListVehiculos);
        console.log(ListVehiculos);
        $.each(ListVehiculos, (index, vehiculo) => {
            // Formatear el tipo de motor para display
            var tipoMotorDisplay = vehiculo.tipo_motor === 'dos_tiempos' ? 'Dos Tiempos' : 'Cuatro Tiempos';

            html += `<tr>
            <td>${index + 1}</td>
            <td>${vehiculo.nombre_cliente}</td>
            <td>${vehiculo.marca}</td>
            <td>${vehiculo.modelo}</td>
            <td>${vehiculo.anio}</td>
            <td>${tipoMotorDisplay}</td>
<td>
<button class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#ModalVehiculos" onclick='uno(${vehiculo.id
                })'>Editar</button>
<button class='btn btn-danger' onclick='eliminar(${vehiculo.id
                })'>Eliminar</button>
           </td>
           </tr> `;
        });
        $("#ListaVehiculos").html(html);
    });
};

var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormularioVehiculo = new FormData($("#form_vehiculos")[0]);
    var accion = "";
    var VehiculoId = document.getElementById("idVehiculo").value;

    if (VehiculoId > 0) {
        accion = ruta + "actualizar";
        DatosFormularioVehiculo.append("id", VehiculoId);
    } else {
        accion = ruta + "insertar";
    }

    for (var pair of DatosFormularioVehiculo.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
    $.ajax({
        url: accion,
        type: "post",
        data: DatosFormularioVehiculo,
        processData: false,
        contentType: false,
        cache: false,
        success: (respuesta) => {
            console.log(respuesta);
            respuesta = JSON.parse(respuesta);
            if (respuesta == "ok") {
                alert("Se guardó con éxito");
                CargaLista();
                LimpiarCajas();
            } else {
                alert("Error al guardar: " + respuesta);
            }
        },
    });
};

var uno = async (idVehiculo) => {
    console.log(idVehiculo);
    await clientes();
    $.post(ruta + "uno", { idVehiculo: idVehiculo }, (vehiculo) => {
        vehiculo = JSON.parse(vehiculo);
        console.log(vehiculo);
        document.getElementById("idVehiculo").value = vehiculo.id;
        document.getElementById("id_cliente").value = vehiculo.id_cliente;
        document.getElementById("marca").value = vehiculo.marca;
        document.getElementById("modelo").value = vehiculo.modelo;
        document.getElementById("anio").value = vehiculo.anio;
        document.getElementById("tipo_motor").value = vehiculo.tipo_motor;
    });
};

var clientes = () => {
    return new Promise((resolve, reject) => {
        var html = `<option value="">Seleccione un cliente</option>`;
        $.post(
            "../../controllers/clientes.controllers.php?op=todos",
            async (ListaClientes) => {
                ListaClientes = JSON.parse(ListaClientes);
                $.each(ListaClientes, (index, cliente) => {
                    html += `<option value="${cliente.id}">${cliente.nombres} ${cliente.apellidos}</option>`;
                });
                await $("#id_cliente").html(html);
                resolve();
            }
        ).fail((error) => {
            reject(error);
        });
    });
};

var eliminar = (idVehiculo) => {
    if (confirm("¿Está seguro de eliminar este vehículo?")) {
        $.post(ruta + "eliminar", { idVehiculo: idVehiculo }, (respuesta) => {
            respuesta = JSON.parse(respuesta);
            if (respuesta == "ok") {
                alert("Se eliminó con éxito");
                CargaLista();
            } else {
                alert("Error al eliminar");
            }
        });
    }
};

var LimpiarCajas = () => {
    document.getElementById("idVehiculo").value = "";
    document.getElementById("id_cliente").value = "";
    document.getElementById("marca").value = "";
    document.getElementById("modelo").value = "";
    document.getElementById("anio").value = "";
    document.getElementById("tipo_motor").value = "";
    $("#ModalVehiculos").modal("hide");
};

init();
