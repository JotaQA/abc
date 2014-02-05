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
    $cantidad = floatval($_REQUEST["cantidad"]) / 100;
    
    $bbdd = new BBDD();
    
    if ($modificar != "") {
    	
    	$sql = "UPDATE tipos_iva SET nombre = ?, descripcion = ?, cantidad = ? WHERE id = ?";
    	$statement = $bbdd->conexion->prepare($sql);
    	$statement->bind_param("ssdi", $nombre, $descripcion, $cantidad, $modificar);
    	$ok = $statement->execute();
    	$statement->close();
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido modificar el tipo de IVA. Comprueba que los datos son correctos</span>";
    		return;
    	}
    	
    	echo "El tipo de IVA <strong><em>" . $nombre . "</em></strong> se ha actualizado correctamente";
    }
    else {
    	if ($nombre == "") {
    		echo "<span class='error'>¡ERROR! Debes indicar al menos el nombre</span>";
    		return;
    	}
    	
    	if ($bbdd->es_tipo_iva($nombre)) {
    		echo "<span class='error'>¡ERROR! El tipo de IVA <strong>" . $nombre . "</strong> ya existe en la Base de Datos. No se permiten nombres duplicados</span>";
    		return;
    	}
    	
    	$sql = "INSERT INTO tipos_iva (nombre, descripcion, cantidad) VALUES (?, ?, ?)";
    	$ok = $bbdd->ejecuta_sentencia_i($sql, "ssd", array($nombre, $descripcion, $cantidad));
    	
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido dar de alta el tipo de IVA. Comprueba que los datos son correctos</span>";
    		return;
    	}
    	
    	echo "El tipo de IVA <strong><em>" . $nombre . "</em></strong> ha sido dada de alta con éxito";
    }
?>
