<div class="modal fade" tabindex="-1" role="dialog" id="formulario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <i class="fa fa-user-circle"></i> Datos de prueba</h4>
            </div>
            <div class="modal-body">
			<form action="" id="form_prueba">
	           	<div class="row">
	           		<input type="hidden" id="id_prueba">
					<div class="col-md-6">
						<div class="form-group">
							<label for="dato1">Dato 1: </label>
							<input type="text" class="form-control" id="dato1" title="dato 1">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="dato2">Dato 2: </label>
							<input type="text" class="form-control" id="dato2" title="dato 2">
						</div>
					</div>
				</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="guardar" onclick="acciones('prueba', 'crear');"> <i class="fa fa-save"></i> Guardar</button>
				<button type="button" class="btn btn-warning" id="modificar" onclick="acciones('prueba', 'actualizar');"> <i class="fa fa-refresh"></i> Modificar</button>
				<button type="button" class="btn btn-danger" id="eliminar" onclick="eliminar_prueba();"> <i class="fa fa-trash"></i> Eliminar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cancelar"> <i class="fa fa-close"></i> Cancelar</button>
            </div>
         </form>
        </div>
    </div>
</div>

<!-- Listado de pruebas -->

<div class="panel panel-default" id="listado">
	<div class="panel-heading">

		<div class="panel-title"> <i class="fa fa-group"></i> Listado de registros </div>

	</div>
	<div class="panel-body">
		<div id="toolbar">
		    <button class="btn btn-sm btn-info" id="btn_nuevo"><i class="fa fa-plus"></i> NUEVO </button>
		</div>
		<table
		id="tabla_prueba"
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
					<th data-field="id_prueba" data-visible="false">Id prueba</th>
					<th data-field="dato1">dato1</th>
					<th data-field="dato2">dato2</th>
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

<script src="modules/prueba/js/prueba.js"></script>