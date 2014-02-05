<?php
/*
 * ABC ERP - Sistema ERP para PYMEs
 * Copyright (C) 2011 Santiago Faci <santi@arkabytes.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
?>
<script type="text/javascript">
$(function() {
    $("#fecha_prevista").datepicker({dateFormat: 'dd-mm-yy'});
    $("#fecha_inicio").datepicker({dateFormat: 'dd-mm-yy'});
    $("#fecha_fin").datepicker({dateFormat: 'dd-mm-yy'});
	$("#fecha_aviso").datepicker({dateFormat: 'dd-mm-yy'});
	$("#fecha_aviso").prop("disabled", true);
});
</script>
<script type="text/javascript">
$(function() {
	$("#fecha_prevista").change(function() {
		var value = $(this).val();
		if ($("#fecha_inicio").val() == "") {
			$("#fecha_inicio").val(value);
		}
		if ($("#fecha_fin").val() == "") {
			$("#fecha_fin").val(value);
		}
	});
});
</script>
<!-- Popup para crear un cliente -->
<script type="text/javascript">
$(function() {
    $("#crear_cliente").button();
    $("#crear_cliente").click(function(e) {
        e.preventDefault();
        $("#dialogo_cliente").dialog("open");
    });
});
</script>
<!-- Popup para crear un proveedor -->
<script type="text/javascript">
$(function() {
    $("#crear_proveedor").button();
    $("#crear_proveedor").click(function(e) {
        e.preventDefault();
        $("#dialogo_proveedor").dialog("open");
    });
});
</script>
<script type="text/javascript">
$(function() {
	$("#cliente").autocomplete({
	    source: "run/_buscar_cliente.php",
	    minLength: 2,
	    select: function(event, ui) {
	    },
	    search: function() {
	        $(this).addClass("cargando");
	    },
	    open: function() {
	        $(this).removeClass("cargando");
	    }
	});
});
</script>
<script type="text/javascript">
$(function() {
	$("#proveedor").autocomplete({
	    source: "run/_buscar_proveedor.php",
	    minLength: 2,
	    select: function(event, ui) {
	    },
	    search: function() {
	        $(this).addClass("cargando");
	    },
	    open: function() {
	        $(this).removeClass("cargando");
	    }
	});
});
</script>
<script type="text/javascript">
$(function() {
	$("#pedido").autocomplete({
	    source: "run/_buscar_pedido.php",
	    minLength: 2,
	    select: function(event, ui) {
	    },
	    search: function() {
	        $(this).addClass("cargando");
	    },
	    open: function() {
	        $(this).removeClass("cargando");
	    }
	});
});
</script>
<!-- Cambio del checkbox -->
<script type="text/javascript">
$(function() {
	$("#aviso").click(function() {
		if ($("#aviso").is(":checked"))
			$("#fecha_aviso").prop("disabled", false);
		else
			$("#fecha_aviso").prop("disabled", true);
	});
});
</script>
<!--  Diálogos para ventanas emergentes  -->
<?php 
    include("../include/arkabytes/dialogo_cliente.php");
    include("../include/arkabytes/dialogo_proveedor.php");
    
	$modificar = "";
	
	if (isset($_REQUEST["modificar"]))
		$modificar = $_REQUEST["modificar"];
	
	if (isset($modificar)) {
		require_once("../config/abc-config.php");
		require_once("../include/arkabytes/bbdd.php");
		$bbdd = new BBDD();
		$tarea = $bbdd->get_tarea_por_id($modificar);
		
		$aviso = 0;
		$nombre_cliente = "";
		if ($tarea->id_cliente != "")
			$nombre_cliente = $bbdd->get_cliente_por_id($tarea->id_cliente)->nombre_completo;
		$nombre_proveedor = "";
		if ($tarea->id_proveedor != "")
			$nombre_proveedor = $bbdd->get_proveedor_por_id($tarea->id_proveedor)->nombre;
		$numero_pedido = "";
		if ($tarea->id_pedido != "")
			$numero_pedido = $bbdd->get_pedido_por_id($tarea->id_pedido)->numero_pedido;
		
		$fecha_prevista = "";
		if ($tarea->fecha_prevista != "")
			$fecha_prevista = date("d-m-Y", strtotime($tarea->fecha_prevista));
		$fecha_inicio = "";
		if ($tarea->fecha_inicio != "")
			$fecha_inicio = date("d-m-Y", strtotime($tarea->fecha_inicio));
		$fecha_fin = "";
		if ($tarea->fecha_fin != "")
			$fecha_fin = date("d-m-Y", strtotime($tarea->fecha_fin));
		$fecha_aviso = "";
		if ($tarea->fecha_aviso != "")
			$fecha_aviso = date("d-m-Y", strtotime($tarea->fecha_aviso));
	}
?>
<form id="formulario" method="post" action="run/_nueva_tarea.php">
    <fieldset>
    <legend>Datos de Tarea</legend>
    <span class="tip">** Recuerda que puedes avanzar por las cajas de texto pulsando Tab **</span>
    <ol>
    <li>
        <label for="nombre"><strong>Nombre</strong></label>
        <input type="text" name="nombre" id="nombre" class="required" size="30" value="<?php echo $tarea->nombre; ?>"/>
    </li>
    <li>
        <label>Descripción</label>
        <textarea rows="10" cols="30" name="descripcion" id="descripcion"><?php echo $tarea->descripcion; ?></textarea>
    </li>
    <li>
        <label><strong>Fecha Prevista</strong></label>
        <input type="text" name="fecha_prevista" class="required" id="fecha_prevista" size="10" value="<?php echo $fecha_prevista; ?>"/> (dd-mm-aaaa)
    </li>
    <li>
        <label><strong>Fecha Inicio</strong></label>
        <input type="text" name="fecha_inicio" class="required" id="fecha_inicio" size="10" value="<?php echo $fecha_inicio; ?>"/> (dd-mm-aaaa)
    </li>
    <li>
        <label>Fecha Fin</label>
        <input type="text" name="fecha_fin" id="fecha_fin" size="10" value="<?php echo $fecha_fin; ?>"/> (dd-mm-aaaa)
    </li>
    <li>
        <label>Ubicación</label>
        <input type="text" name="ubicacion" id="ubicación" size="20" value="<?php echo $tarea->ubicacion; ?>"/>
    </li>
    <li>
        <label for="cliente">Cliente</label>
        <input type="text" name="cliente" id="cliente" size="30" value="<?php echo $nombre_cliente; ?>"/> <a href="#" id="crear_cliente" title="Dar de alta un Cliente">+</a>   
    </li>
    <li>
        <label for="proveedor">Proveedor</label>
        <input type="text" name="proveedor" id="proveedor" size="30" value="<?php echo $nombre_proveedor; ?>"/> <a href="#" id="crear_proveedor" title="Dar de alta un Proveedor">+</a>   
    </li>
    <li>
        <label for="pedido">Pedido</label>
        <input type="text" name="pedido" id="pedido" size="30" value="<?php echo $numero_pedido; ?>"/>
    </li>
    <li>
        <label for="estado">Estado</label>
        <select name="estado" id="estado">
            <option value="pendiente" <?php if ($tarea->estado == "pendiente") echo "selected"; ?>>Pendiente</option>
            <option value="realizada" <?php if ($tarea->estado == "realizada") echo "selected"; ?>>Realizada</option>
            <option value="pospuesta" <?php if ($tarea->estado == "pospuesta") echo "pospuesta"; ?>>Pospuesta</option>
        </select>
    </li>
    <li>
        <label>Aviso</label>
        <input type="checkbox" name="aviso" id="aviso" value="<?php echo $tarea->aviso; ?>"/> (No disponible en esta versión)
    </li>
    <li>
        <label>Fecha Aviso</label>
        <input type="text" name="fecha_aviso" id="fecha_aviso" size="10" value="<?php echo $fecha_aviso; ?>"/> (dd-mm-aaaa)
    </li>
    </ol>
    </fieldset>

    <fieldset class="submit">
    	<input type="hidden" name="modificar" value="<?php echo $modificar; ?>"/>
        <input type="submit" value="Enviar"/> 
    </fieldset>
</form>
<div id="mensaje"></div>
<div id="resultado"></div>