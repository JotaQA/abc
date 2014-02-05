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

    include("_check_login.php");
    require_once("../../include/arkabytes/bbdd.php");
 
    $usuario = $_REQUEST["usuario"];
    $old_usuario = $_REQUEST["old_usuario"];
    $contrasena1 = $_REQUEST["contrasena1"];
    $contrasena2 = $_REQUEST["contrasena2"];
    $nombre = $_REQUEST["nombre"];
    $email = $_REQUEST["email"];
    
    if (($usuario == "") || ($nombre == "") || ($email == "")) {
    	echo "<span class='error'>¡ERROR! El usuario, el nombre y el e-mail son datos obligatorios</span>";
    	return;
    }
    
    if ($old_usuario == "demo") {
    	echo "<span class='error'>¡ERROR! El usuario 'demo' no se puede modificar</span>";
    	return;
    }
    
    $bbdd = new BBDD();
    
    if ($contrasena1 == "") {
    	$sql = "UPDATE usuarios SET usuario = ?, nombre = ?, email = ? WHERE usuario = ?";
    	$ok = $bbdd->ejecuta_sentencia_i($sql, "ssss", array($usuario, $nombre, $email, $old_usuario));
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido modificar tu perfil. Comprueba que los datos son correctos</span>";
    		return;
    	}
    }
    else {
    	if ($contrasena1 != $contrasena2) {
    		echo "<span class='error'>¡ERROR! La contraseñas no coincide. Debes escribir dos veces la misma contraseña</span>";
    		return;
    	}
    	
    	$sql = $sql = "UPDATE usuarios SET usuario = ?, nombre = ?, contrasena = MD5(?), email = ? WHERE usuario = ?";
    	$ok = $bbdd->ejecuta_sentencia_i($sql, "sssss", array($usuario, $nombre, $contrasena1, $email, $old_usuario));
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido modificar tu perfil. Comprueba que los datos son correctos</span>";
    		return;
    	}
    }
    
    echo "Tu perfil se ha modificado correctamente";
?>
