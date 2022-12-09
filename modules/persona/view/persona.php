<div class="modal fade" tabindex="-1" role="dialog" id="formulario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <i class="fa fa-user-circle"></i> Personas</h4>
            </div>
            <div class="modal-body">
			<form action="" id="form_persona">
	           	<div class="row">
	           		<input type="hidden" id="id_persona">
					<div class="col-md-6">
						<div class="form-group">
							<label for="cedula">CÉDULA: </label>
							<input type="text" class="form-control solo-numero" id="cedula" maxlength="8" title="CEDULA" onblur="validar_cedula(this.value);">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="nombre">NOMBRE Y APELLIDO: </label>
							<input type="text" class="form-control" id="nombre" title="NOMBRE Y APELLIDO">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="telefono">TELÉFONO: </label>
							<input type="text" class="form-control solo-numero" id="telefono" maxlength="11" title="TELEFONO">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">CORREO ELECTRÓNICO: </label>
							<input type="text" class="form-control email" id="email" title="CORREO ELECTRONICO">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="direccion">DIRECCIÓN: </label>
							<input type="text" class="form-control" id="direccion" title="DIRECCION">
						</div>
					</div>
				</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="guardar" onclick="acciones('persona', 'crear');"> <i class="fa fa-save"></i> Guardar</button>
				<button type="button" class="btn btn-warning" id="modificar" onclick="acciones('persona', 'actualizar');"> <i class="fa fa-refresh"></i> Modificar</button>
				<button type="button" class="btn btn-danger" id="eliminar" onclick="confirmar();"> <i class="fa fa-trash"></i> Eliminar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar"> <i class="fa fa-close"></i> Cancelar</button>
            </div>
         </form>
        </div>
    </div>
</div>

<!-- Listado de Personas -->

<div class="panel panel-default" id="listado">
	<div class="panel-heading">

		<div class="panel-title"> <i class="fa fa-group"></i> Listado de Personas </div>

	</div>
	<div class="panel-body">
		<div id="toolbar">
		    <button class="btn btn-sm btn-info" id="btn_nuevo"><i class="fa fa-plus"></i> NUEVO </button>
		</div>
		<table
		id="tabla_persona"
		data-toggle="table"
    	data-pagination="true"
		data-page-list="[5, 10, 20, 50, 100, all]"
		data-show-pagination-switch="false"
		data-search="true"
		data-toolbar="#toolbar"
		data-single-select="true"
		data-click-to-select="true"
		data-show-refresh="false"
		data-show-export="false" style="display: none;">
			<thead>
				<tr>
					<th data-field="state" data-checkbox="true"></th>
					<th data-field="id_persona" data-visible="false">Id persona</th>
					<th data-field="cedula">Cédula</th>
					<th data-field="nombre">Nombre y Apellido</th>
					<th data-field="telefono">Teléfono</th>
					<th data-field="email">Email</th>
					<th data-field="direccion">Dirección</th>
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

<script src="modules/persona/js/persona.js"></script>