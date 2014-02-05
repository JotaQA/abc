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
$(document).ready(function() {
    $("table tr:nth-child(odd)").addClass("alt");
});

// Llamada a script para eliminar un cliente
$(document).ready(function() {
    $('a.eliminar').click(function(e) {
        if (confirm('Vas a eliminar la tarea. ¿Estás seguro?')) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            $.ajax({
                type: 'get',
                url: 'run/_eliminar_tarea.php',
                data: 'ajax=1&eliminar=' + parent.attr('id').replace('registro-', ''),
                beforeSend: function() {
                    parent.animate({'backgroundColor':'#fb6c6c'}, 300);
                    $("#resultado").html("Eliminando Tarea/Evento . . .");
                },
                success: function(responseText) {
                    parent.slideUp(600, function() {
                        parent.remove();
                    });
                    $("#resultado").html(responseText);
                    setTimeout(function() {
                        $("#resultado").html("");
                    }, 2000);
                }
            });
        }
        
        // Si responde que no, se cancela el evento por defecto (el click del enlace)
        e.preventDefault();
    });
});
</script>
<?php 
	require_once("../config/abc-config.php");
	require_once("../include/arkabytes/bbdd.php");
	
	$tamano = 10;
	$bbdd = new BBDD();
	if (!isset($_REQUEST["inicio"]))
		$inicio = 0;
	else
		$inicio = $_REQUEST["inicio"];
	
	$busqueda_rapida = $_REQUEST["busqueda_rapida"];
	
	if ($busqueda_rapida == "")
		$fila = $bbdd->ejecuta_escalar("SELECT COUNT(*) numero FROM tareas");
	else
		$fila = $bbdd->ejecuta_escalar("SELECT COUNT(*) numero FROM tareas WHERE nombre LIKE '%" . $busqueda_rapida . 
			"%' OR descripcion LIKE '%" . $busqueda_rapida . "%'");
	
	$numero = $fila["numero"];
	$paginas = ceil($numero / $tamano);
	
	include("include/paginacion.php");
?>

<div id="listado">
    <table class="cebra">
    <thead class="cabecera">
    <tr class="cabecera">
    <td>#</td>
    <td>Nombre</td>
    <td>Descripción</td>
    <td>Fecha</td>
    <td>Estado</td>
    <td>Tipo</td>
    <td></td>
    <td></td>
    </tr>
    </thead>
    <tbody class="scroll">
<?php
		$resultado = $bbdd->ejecuta_consulta("SELECT id, nombre, descripcion, fecha_inicio, estado, tipo FROM tareas " .
			"WHERE nombre LIKE '%" . $busqueda_rapida . "%' OR descripcion LIKE '%" . $busqueda_rapida . "%' " . 
		    "ORDER BY fecha_inicio DESC");
	
	if ($resultado == null) {
	    echo "<td colspan='7' style='text-align:center'><span class='titulocelda'>## Sin Datos ##</span></td>\n";
	}
	else {
	    
	    while ($fila = $resultado->fetch_array()) {
	
	        echo "<tr id='registro-" . $fila["id"] . "'>\n";
	        echo "<td>" . $fila["id"] . "</td>\n";
	        echo "<td><a class='popup' title='Más Información' href='ver_tarea.php?id=" . $fila["id"] . "'>" . 
	            $fila["nombre"] ."</a></td>\n";
	        echo "<td>" . $fila["descripcion"] . "</td>\n";
	        echo "<td>" . date("d-m-Y", strtotime($fila["fecha_inicio"])) . "</a></td>\n";
	        echo "<td>" . $fila["estado"] . "</td>\n";
	        echo "<td>" . $fila["tipo"] . "</td>\n";
	        if ($fila["tipo"] == "tarea")
	        	echo "<td><a href='?id=nueva_tarea&modificar=" . $fila["id"] . "' title='Modificar Tarea'><img src='icons/editar16.png' alt='Modificar Tarea'/></a></td>\n";
	        else
	        	echo "<td><a href='?id=nuevo_evento&modificar=" . $fila["id"] . "' title='Modificar Evento'><img src='icons/editar16.png' alt='Modificar Evento'/></a></td>\n";
	        echo "<td><a class='eliminar' href='?eliminar=" . $fila["id"] . "' title='Eliminar Tarea'><img src='icons/cerrar16.png' alt='Eliminar Tarea'/></a></td>\n";
	        echo "</tr>\n";
	    }
	
	    $resultado->close();
	}
?>
</tbody>
</table>
</div>
<?php 
	include("include/paginacion.php");
?>
<div id="resultado"></div>