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

    include("_check_login.php");
    require_once("../../include/arkabytes/bbdd.php");
 
    $modificar = $_REQUEST["modificar"];
    
    $nombre = $_REQUEST["nombre"];
    $descripcion = $_REQUEST["descripcion"];
    $coste = $_REQUEST["coste"];
    if ($coste == "")
        $coste = 0;
    $dias = $_REQUEST["dias"];
    if ($dias == "")
        $dias = 0;
    
    $bbdd = new BBDD();
    
    if ($modificar != "") {
    	
    	$sql = "UPDATE formas_envio SET nombre = ?, descripcion = ?, coste = ?, dias = ? WHERE id = ?";
    	$statement = $bbdd->conexion->prepare($sql);
    	$statement->bind_param("ssdii", $nombre, $descripcion, $coste, $dias, $modificar);
    	$ok = $statement->execute();
    	$statement->close();
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido modificar la Forma de Envío. Comprueba que los datos son correctos</span>";
    		return;
    	}
    	
    	echo "La Forma de Envío <strong><em>" . $nombre . "</em></strong> se ha actualizado correctamente";
    }
    else {
    	if ($nombre == "") {
    		echo "<span class='error'>¡ERROR! Debes indicar al menos el nombre</span>";
    		return;
    	}
    	
    	if ($bbdd->es_forma_envio($nombre)) {
    		echo "<span class='error'>¡ERROR! La Forma de Envío <strong>" . $nombre . "</strong> ya existe en la Base de Datos. No se permiten nombres duplicados</span>";
    		return;
    	}
    	
    	$sentencia = "INSERT INTO formas_envio (nombre, descripcion, coste, dias) VALUES ('" . $nombre . "','" . $descripcion . "'," . $coste . "," . $dias . ")";
    	
    	$resultado = $bbdd->ejecuta_sentencia($sentencia);
    	if (!$resultado) {
    		echo "<span class='error'>¡ERROR! No se ha podido dar de alta la Forma de Envío. Comprueba que los datos son correctos</span>";
    		return;
    	}
    	
    	echo "La Forma de Envío <strong><em>" . $nombre . "</em></strong> ha sido dada de alta con éxito";
    }
?>
