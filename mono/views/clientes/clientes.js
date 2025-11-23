function init() {
  $("#form_clientes").on("submit", (e) => {
    GuardarEditar(e);
  });
}
const ruta = "../../controllers/clientes.controllers.php?op=";

$().ready(() => {
  CargaLista();
});

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (ListClientes) => {
    ListClientes = JSON.parse(ListClientes);
    console.log(ListClientes);
    $.each(ListClientes, (index, cliente) => {
      html += `<tr>
            <td>${index + 1}</td>
            <td>${cliente.nombres}</td>
            <td>${cliente.apellidos}</td>
            <td>${cliente.telefono || 'N/A'}</td>
            <td>${cliente.correo_electronico || 'N/A'}</td>
<td>
<button class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#ModalClientes" onclick='uno(${
        cliente.id
      })'>Editar</button>
<button class='btn btn-danger' onclick='eliminar(${
        cliente.id
      })'>Eliminar</button>
           </td>
           </tr> `;
    });
    $("#ListaClientes").html(html);
  });
};

var GuardarEditar = (e) => {
  e.preventDefault();
  var DatosFormularioCliente = new FormData($("#form_clientes")[0]);
  var accion = "";
  var ClienteId = document.getElementById("idCliente").value;

  if (ClienteId > 0) {
    accion = ruta + "actualizar";
    DatosFormularioCliente.append("id", ClienteId);
  } else {
    accion = ruta + "insertar";
  }

  for (var pair of DatosFormularioCliente.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
}
  $.ajax({
    url: accion,
    type: "post",
    data: DatosFormularioCliente,
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

var uno = (idCliente) => {
  console.log(idCliente);
  $.post(ruta + "uno", { idCliente: idCliente }, (cliente) => {
    cliente = JSON.parse(cliente);
    console.log(cliente);
    document.getElementById("idCliente").value = cliente.id;
    document.getElementById("nombres").value = cliente.nombres;
    document.getElementById("apellidos").value = cliente.apellidos;
    document.getElementById("telefono").value = cliente.telefono;
    document.getElementById("correo_electronico").value = cliente.correo_electronico;
  });
};

var eliminar = (idCliente) => {
  if (confirm("¿Está seguro de eliminar este cliente?")) {
    $.post(ruta + "eliminar", { idCliente: idCliente }, (respuesta) => {
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
  document.getElementById("idCliente").value = "";
  document.getElementById("nombres").value = "";
  document.getElementById("apellidos").value = "";
  document.getElementById("telefono").value = "";
  document.getElementById("correo_electronico").value = "";
  $("#ModalClientes").modal("hide");
};

init();
