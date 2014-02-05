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
<span class="titulocelda">Nueva Forma de Envío</span>

<?php 
	$modificar = "";
	if (isset($_REQUEST["modificar"]))
		$modificar = $_REQUEST["modificar"];
	
	if (isset($modificar)) {
		require_once("../config/abc-config.php");
		require_once("../include/arkabytes/bbdd.php");
		
		$bbdd = new BBDD();
		$forma_envio = $bbdd->get_forma_envio_por_id($modificar);
	}
?>

<form id="formulario" method="post" action="run/_nueva_forma_envio.php">
    <fieldset>
    <legend>Datos de Envío</legend>
    <span class="tip">** Recuerda que puedes avanzar por las cajas de texto pulsando Tab **</span>
    <ol>
    <li>
        <label><strong>Nombre</strong></label>
        <input type="text" name="nombre" size="20" class="required" value="<?php echo $forma_envio->nombre; ?>"/>
    </li>
    <li>
        <label>Descripcion</label>
        <input type="text" name="descripcion" size="40" value="<?php echo $forma_envio->descripcion; ?>"/>
    </li>
    <li>
        <label>Coste</label>
        <input type="text" name="coste" size="5" value="<?php echo round($forma_envio->coste, 2); ?>"/>
    </li>
    <li>
        <label>Días</label>
        <input type="text" name="dias" size="5" value="<?php echo $forma_envio->dias; ?>"/>
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
