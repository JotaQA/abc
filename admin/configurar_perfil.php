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
        $('#usuario').focus();
    });
});
</script>

<?php 
	$bbdd = new BBDD();
	
	$usuario = unserialize($_SESSION["usuario"]);
?>

<span class="titulocelda">Configuración de Perfil</span>
<form id="formulario" method="post" action="run/_configurar_perfil.php" enctype="multipart/form-data">
    <fieldset>
    <legend>Datos del Usuario</legend>
    <ol>
    <li>
        <label><strong>Usuario</strong></label>
        <input type="text" name="usuario" id="nombre" size="15" class="required" value="<?php echo $usuario->usuario; ?>"/>
    </li>
    <li>
        <label>Contraseña</label> 
        <input type="password" name="contrasena1" size="10" value=""/> (sólo se modificará si escribe algún valor)
    </li>
    <li>
        <label>Contraseña (repetida)</label> 
        <input type="password" name="contrasena2" size="10" value=""/> (sólo se modificará si escribe algún valor)
    </li>
    <li>
        <label><strong>Nombre</strong></label>
        <input type="text" name="nombre" size="20" class="required" value="<?php echo $usuario->nombre; ?>"/>
    </li>
    <li>
        <label><strong>E-mail</strong></label>
        <input type="text" name="email" size="20" class="required" value="<?php echo $usuario->email; ?>"/>
    </li>
    </ol>
    </fieldset>
    <fieldset class="submit">
    	<input type="hidden" name="old_usuario" value="<?php echo $usuario->usuario; ?>"/>
        <input type="submit" value="Enviar"/> 
    </fieldset>
</form>
<div id="mensaje"></div>
<div id="resultado"></div>
