<div class="modal fade" tabindex="-1" role="dialog" id="formulario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <i class="fa fa-user-circle"></i> Usuarios</h4>
            </div>
            <div class="modal-body">
			<form action="" id="form_usuarios">
	           	<div class="row">
	           		<input type="hidden" id="id_persona">
					<div class="col-md-4">
						<div class="form-group">
							<label for="username">nombre de usuario: </label>
							<input type="text" class="form-control" id="username" title="Nombre de usuario" onblur="validar_username(this.value);">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="passkey">Contraseña: </label>
							<input type="password" class="form-control" id="passkey" title="CONTRASEÑA">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="confirm_passkey">Confirmar: </label>
							<input type="password" class="form-control" id="confirm_passkey" title="CONFIRMAR">
							<span class="text-danger" id="error_pass" style="display: none;">
								<i class="fa fa-close"></i> Las contraseñas no son iguales
							</span>
							<span class="text-success" id="success_pass" style="display: none;">
								<i class="fa fa-check"></i> Las contraseñas son iguales
							</span>
						</div>
					</div>
				</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="guardar" onclick="acciones('usuarios', 'crear');"> <i class="fa fa-save"></i> Guardar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar"> <i class="fa fa-close"></i> Cancelar</button>
            </div>
         </form>
        </div>
    </div>
</div>

<!-- Listado de Personas -->

<div class="panel panel-default" id="listado">
	<div class="panel-heading">

		<div class="panel-title"> <i class="fa fa-group"></i> Listado de usuarios </div>

	</div>
	<div class="panel-body">
		<div id="toolbar">
		    <button class="btn btn-sm btn-info" id="btn_nuevo"><i class="fa fa-plus"></i> NUEVO </button>
		</div>
		<table
		id="tabla_usuarios"
		data-toggle="table"
    	data-pagination="true"
		data-page-list="[5, 10, 20, 50, 100, all]"
		data-show-pagination-switch="false"
		data-search="true"
		data-toolbar="#toolbar"
		data-single-select="false"
		data-click-to-select="false"
		data-show-refresh="false"
		data-show-export="false" style="display: none;">
			<thead>
				<tr>
					<!-- <th data-field="state" data-checkbox="true"></th> -->
					<th data-field="id_usuario" data-visible="false">Id usuario</th>
					<th data-field="username">Email</th>
					<th data-field="estatus">Estatus</th>
					<th data-field="acciones" class="col-lg-2">Acciones</th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="load_table text-center">
		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
		<br>
		Cargando datos de la tabla...
	</div>
</div>

<script src="modules/usuarios/js/usuarios.js"></script>