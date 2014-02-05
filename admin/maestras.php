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

$(document).ready(function() {
    $('a.eliminar_fe').click(function(e) {
        if (confirm('Vas a eliminar la Forma de Envío. ¿Estás seguro?')) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            $.ajax({
                type: 'get',
                url: 'run/_eliminar_forma_envio.php',
                data: 'ajax=1&eliminar=' + parent.attr('id').replace('registro-', ''),
                beforeSend: function() {
                    parent.animate({'backgroundColor':'#fb6c6c'}, 300);
                    $("#resultado").html("Eliminando forma de envío . . .");
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

$(document).ready(function() {
    $('a.eliminar_fp').click(function(e) {
        if (confirm('Vas a eliminar la Forma de Pago. ¿Estás seguro?')) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            $.ajax({
                type: 'get',
                url: 'run/_eliminar_forma_pago.php',
                data: 'ajax=1&eliminar=' + parent.attr('id').replace('registro-', ''),
                beforeSend: function() {
                    parent.animate({'backgroundColor':'#fb6c6c'}, 300);
                    $("#resultado").html("Eliminando forma de pago . . .");
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

$(document).ready(function() {
    $('a.eliminar_ti').click(function(e) {
        if (confirm('Vas a eliminar el Tipo de IVA. ¿Estás seguro?')) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            $.ajax({
                type: 'get',
                url: 'run/_eliminar_tipo_iva.php',
                data: 'ajax=1&eliminar=' + parent.attr('id').replace('registro-', ''),
                beforeSend: function() {
                    parent.animate({'backgroundColor':'#fb6c6c'}, 300);
                    $("#resultado").html("Eliminando tipo de IVA . . .");
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

<span class="titulocelda">Formas de Envío</span>
<?php
	require_once("../config/abc-config.php");
	require_once("../include/arkabytes/bbdd.php");
	
	$tamano = 5;
	$bbdd = new BBDD();
	if (!isset($_REQUEST["iniciofe"]))
		$iniciofe = 0;
	else
		$iniciofe = $_REQUEST["iniciofe"];
	$busqueda_rapida = $_REQUEST["busqueda_rapida"];
	
	$fila = $bbdd->ejecuta_escalar("SELECT COUNT(*) numero FROM formas_envio WHERE nombre LIKE '%" . $busqueda_rapida . "%'");
	$numero = $fila["numero"];
	$paginas = ceil($numero / $tamano); 
?>
<div id="listado_medio">
    <table class="cebra">
    <thead class="cabecera">
    <tr class="cabecera">
    <td>#</td>
    <td>Nombre</td>
    <td>Descripción</td>
    <td>Coste</td>
    <td>Días</td>
    <td></td>
    <td></td>
    </tr>
    </thead>
    <tbody class="scroll">
<?php
	$resultado = $bbdd->ejecuta_consulta("SELECT id, nombre, descripcion, coste, dias FROM formas_envio " .
		"WHERE nombre LIKE '%" . $busqueda_rapida . "%' OR descripcion LIKE '%" . $busqueda_rapida . "%' ORDER BY nombre");
	
	if ($resultado->num_rows == 0) {
	    
	    echo "<td colspan='7' style='text-align:center'><span class='titulocelda'>## Sin Datos ##</span></td>\n";
	}
	else {
	    
	    while ($fila = $resultado->fetch_array()) {
	
	        echo "<tr id='registro-" . $fila["id"] . "'>\n";
	        echo "<td>" . $fila["id"] . "</td>\n";
	        echo "<td>" . $fila["nombre"] . "</td>\n";
	        echo "<td>" . $fila["descripcion"] . "</td>\n";
	        echo "<td>" . money_format("%i", $fila["coste"]) . "</td>\n";
	        echo "<td>" . $fila["dias"] . "</td>\n";
	        echo "<td><a href='?id=nueva_forma_envio&modificar=" . $fila["id"] . "' title='Modificar Forma Envío'><img src='icons/editar16.png' alt='Modificar Forma Envío'/></a></td>\n";
	        echo "<td><a class='eliminar_fe' href='?eliminar=" . $fila["id"] . "' title='Eliminar Forma Envío'><img src='icons/cerrar16.png' alt='Eliminar Forma Envío'/></a></td>\n";
	        echo "</tr>\n";
	    }
	
	    $resultado->close();
	}
?>
</tbody>
</table>
<?php
	if ($numero > $tamano) {
		echo "<div style='text-align:center'>";
		for ($i = 0; $i < $paginas; $i++) {
			if (($i * $tamano) == $iniciofe)
				echo "[" . ($i + 1) . "] ";
			else
				echo "<a href='?id=maestras&iniciofe=" . ($i * $tamano) . "'>[" . ($i + 1) . "]</a> ";
		}
		echo "</div>"; 
	}
?>
</div>
<span class="titulocelda">Formas de Pago</span>
<?php
	if (!isset($_REQUEST["iniciofp"]))
		$iniciofe = 0;
	else
		$iniciofe = $_REQUEST["iniciofp"];
	
	$fila = $bbdd->ejecuta_escalar("SELECT COUNT(*) numero FROM formas_pago WHERE nombre LIKE '%" . $busqueda_rapida . 
		"%' OR descripcion LIKE '%" . $busqueda_rapida . "%'");
	$numero = $fila["numero"];
	$paginas = ceil($numero / $tamano);
?>
<div id="listado_medio">
    <table class="cebra">
    <thead class="cabecera">
    <tr class="cabecera">
    <td>#</td>
    <td>Nombre</td>
    <td>Descripción</td>
    <td>Coste</td>
    <td></td>
    <td></td>
    </tr>
    </thead>
    <tbody class="scroll">
<?php

$resultado = $bbdd->ejecuta_consulta("SELECT id, nombre, descripcion, coste FROM formas_pago " .
	"WHERE nombre LIKE '%" . $busqueda_rapida . "%' OR descripcion LIKE '%" . $busqueda_rapida . "%' ORDER BY nombre");

if ($resultado->num_rows == 0) {
    
    echo "<td colspan='7' style='text-align:center'><span class='titulocelda'>## Sin Datos ##</span></td>\n";
}
else {
    
    while ($fila = $resultado->fetch_array()) {

        echo "<tr id='registro-" . $fila["id"] . "'>\n";
        echo "<td>" . $fila["id"] . "</td>\n";
        echo "<td>" . $fila["nombre"] . "</td>\n";
        echo "<td>" . $fila["descripcion"] . "</td>\n";
        echo "<td>" . money_format("%i", $fila["coste"]) . "</td>\n";
        echo "<td><a href='?id=nueva_forma_pago&modificar=" . $fila["id"] . "' title='Modificar Forma Pago'><img src='icons/editar16.png' alt='Modificar Forma Pago'/></a></td>\n";
        echo "<td><a class='eliminar_fp' href='?eliminar=" . $fila["id"]. "' title='Eliminar Forma Pago'><img src='icons/cerrar16.png' alt='Eliminar Forma Pago'/></a></td>\n";
        echo "</tr>\n";
    }

    $resultado->close();
}
?>
</tbody>
</table>
<?php 
	if ($numero > $tamano) {
		echo "<div style='text-align:center'>";
		for ($i = 0; $i < $paginas; $i++) {
			if (($i * $tamano) == $iniciofp)
				echo "[" . ($i + 1) . "] ";
			else
				echo "<a href='?id=maestras&iniciofp=" . ($i * $tamano) . "'>[" . ($i + 1) . "]</a> ";
		}
		echo "</div>";
	}
?>
</div>
<span class="titulocelda">Tipos de IVA</span>
<?php
	if (!isset($_REQUEST["inicioti"]))
		$inicioti = 0;
	else
		$inicioti = $_REQUEST["inicioti"];
	
	$fila = $bbdd->ejecuta_escalar("SELECT COUNT(*) numero FROM tipos_iva WHERE nombre LIKE '%" . $busqueda_rapida . 
		"%' OR descripcion LIKE '%" . $busqueda_rapida . "%'");
	$numero = $fila["numero"];
	$paginas = ceil($numero / $tamano);
?>
<div id="listado_medio">
    <table class="cebra">
    <thead class="cabecera">
    <tr class="cabecera">
    <td>#</td>
    <td>Nombre</td>
    <td>Descripción</td>
    <td>Cantidad</td>
    <td></td>
    <td></td>
    </tr>
    </thead>
    <tbody class="scroll">
<?php

$resultado = $bbdd->ejecuta_consulta("SELECT id, nombre, descripcion, cantidad FROM tipos_iva " .
	"WHERE nombre LIKE '%" . $busqueda_rapida . "%' OR descripcion LIKE '%" . $busqueda_rapida . "%' ORDER BY nombre");

if ($resultado->num_rows == 0) {
    
    echo "<td colspan='7' style='text-align:center'><span class='titulocelda'>## Sin Datos ##</span></td>\n";
}
else {
    
    while ($fila = $resultado->fetch_array()) {

        echo "<tr id='registro-" . $fila["id"] . "'>\n";
        echo "<td>" . $fila["id"] . "</td>\n";
        echo "<td>" . $fila["nombre"] . "</td>\n";
        echo "<td>" . $fila["descripcion"] . "</td>\n";
        //echo "<td>" . money_format("%i", $fila["coste"]) . "</td>\n";
        echo "<td>" . $fila["cantidad"] * 100 . " %" . "</td>\n";
        echo "<td><a href='?id=nuevo_tipo_iva&modificar=" . $fila["id"] . "' title='Modificar Tipo de IVA'><img src='icons/editar16.png' alt='Modificar Tipo de IVA'/></a></td>\n";
        echo "<td><a class='eliminar_ti' href='?eliminar=" . $fila["id"]. "' title='Eliminar Tipo de IVA'><img src='icons/cerrar16.png' alt='Eliminar Tipo de IVA'/></a></td>\n";
        echo "</tr>\n";
    }

    $resultado->close();
}
?>
</tbody>
</table>
<?php
	if ($numero > $tamano) {
		echo "<div style='text-align:center'>";
		for ($i = 0; $i < $paginas; $i++) {
			if (($i * $tamano) == $inicioti)
				echo "[" . ($i + 1) . "] ";
			else
				echo "<a href='?id=maestras&iniciofe=" . ($i * $tamano) . "'>[" . ($i + 1) . "]</a> ";
		}
		echo "</div>"; 
	}
?>
</div>
<div id="resultado"></div>
