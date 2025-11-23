<?php require_once('../html/head2.php');
require_once('../../config/sesiones.php');  ?>
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">RegAsis /</span> Clientes</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
    <button type="button" class="btn btn-outline-secondary" 
    data-bs-toggle="modal" data-bs-target="#ModalClientes">Nuevo Cliente</button>
    <h5 class="card-header">Lista de Clientes</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaClientes">

            </tbody>
        </table>
    </div>
</div>



<!-- Modal Clientes-->

<div class="modal" tabindex="-1" id="ModalClientes">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal"> Nuevo Cliente </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_clientes" method="post">
                <input type="hidden" name="idCliente" id="idCliente">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Ingrese los nombres" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese los apellidos" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese el teléfono">
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico">Correo Electrónico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" class="form-control" placeholder="correo@ejemplo.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../html/scripts2.php') ?>

<script src="./clientes.js"></script>
