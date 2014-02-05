<?php
/*
 * ABC ERP - Sistema ERP para PYMEs
 * Copyright (C) 2013 Santiago Faci <santi@arkabytes.com>
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
jQuery(function() {

    $(document).ready(function() {
        $('#nombre').focus();
    });
});
</script>

<?php 
	require_once("../include/arkabytes/bbdd.php");
	
	$bbdd = new BBDD();
	$tips = $bbdd->ejecuta_escalar("SELECT valor FROM opciones WHERE nombre = 'tips'");
?>

<span class="titulocelda">Configuración de Aplicación</span>
<form id="formulario" method="post" action="run/_configurar_aplicacion.php" enctype="multipart/form-data">
    <fieldset>
    <legend>Datos de Aplicación</legend>
    <ol>
    <li>
        <label>Mostrar consejos</label>
        <input type="checkbox" name="tips" id="tips" value="1" <?php if ($tips["valor"] == "1") echo "checked"?>/> (Muestra consejos en algunas pantallas ** De esta forma **)
    </li>
    </ol>
    </fieldset>
    <fieldset class="submit">
        <input type="submit" value="Enviar"/> 
    </fieldset>
</form>
<div id="mensaje"></div>
<div id="resultado"></div>
