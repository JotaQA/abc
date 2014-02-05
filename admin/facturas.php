<?php
/*
 * ABC ERP - Sistema ERP para PYMEs
 * Copyright (C) 2014 Santiago Faci <santi@arkabytes.com>
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
</script>

<script type="text/javascript">
// Elimina la factura de la lista -->
$(document).ready(function() {
    $('a.eliminar').click(function(e) {
        if (confirm('Vas a eliminar la factura. ¿Estás seguro?')) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            $.ajax({
                type: 'get',
                url: 'run/_eliminar_factura.php',
                data: 'ajax=1&eliminar=' + parent.attr('id').replace('registro-', ''),
                beforeSend: function() {
                    parent.animate({'backgroundColor':'#fb6c6c'}, 300);
                    $("#resultado").html("Eliminando factura . . .");
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
	
	$fila = $bbdd->ejecuta_escalar("SELECT COUNT(*) numero FROM facturas f, clientes c " .
		"WHERE f.id_cliente = c.id AND (f.numero_factura LIKE '%" . $busqueda_rapida . "%' OR CONCAT(c.nombre,c.apellidos) LIKE '%" . $busqueda_rapida . "%')");
	$numero = $fila["numero"];
	$paginas = ceil($numero / $tamano);
	
	include("include/paginacion.php");
?>
<div id="listado">
    <table class="cebra">
    <thead class="cabecera">
    <tr class="cabecera">
    <td>#</td>
    <td>Número</td>
    <td>Cliente</td>
    <td>Fecha</td>
    <td>Estado</td>
    <td>Importe</td>
    <td></td>
    <td></td>
    <!-- <td></td> -->
    </tr>
    </thead>
    <tbody class="scroll">
<?php
	$resultado = $bbdd->ejecuta_consulta("SELECT f.id, f.numero_factura, f.id_cliente, f.fecha, f.estado, f.importe FROM facturas f, clientes c " .
		"WHERE c.id = f.id_cliente AND (f.numero_factura LIKE '%" . $busqueda_rapida . "%' OR CONCAT(c.nombre,c.apellidos) LIKE '%" . $busqueda_rapida . "%')" .
		"ORDER BY f.nombre_cliente ASC, f.fecha DESC");
	
	if ($resultado->num_rows == 0) {
	    echo "<td colspan='10' style='text-align:center'><span class='titulocelda'>## Sin Datos ##</span></td>\n";
	}
	else {
	    while ($fila = $resultado->fetch_array()) {
	
	        $cliente = $bbdd->get_cliente_por_id($fila["id_cliente"]);
	
	        echo "<tr id='registro-" . $fila["id"] . "'>\n";
	        echo "<td>" . $fila["id"] . "</td>\n";
	        echo "<td>" . $fila["numero_factura"] . "</td>\n";
	        echo "<td><a class='popup' title='Ver cliente' href='ver_cliente.php?id=" . $fila["id_cliente"] . "'>" . 
	            $cliente->nombre . "</a></td>\n";
	        echo "<td>" . date("d-m-y", strtotime($fila["fecha"])) . "</td>\n";
	        echo "<td>" . $fila["estado"] . "</td>\n";
	        echo "<td>" . money_format("%i", $fila["importe"]) . "</td>\n";
	        echo "<td><a href='run/_generar_pdf_factura.php?numero_factura=" . $fila["numero_factura"] . "' title='Ver Documento' target='_blank'><img src='icons/pdf16.png' alt='Ver Documento'/></a></td>\n";
	        //echo "<td><a href='#' title='Modificar Factura'><img src='icons/editar16.png' alt='Modificar Factura'/></a></td>\n";
	        echo "<td><a class='eliminar' href='?eliminar=" . $fila["id"] . "' title='Eliminar Factura'><img src='icons/cerrar16.png' alt='Eliminar Factura'/></a></td>\n";
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
