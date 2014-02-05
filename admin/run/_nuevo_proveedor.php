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
 
    $nombre = $_REQUEST["nombre"];
    $cif = $_REQUEST["cif"];
    $direccion = $_REQUEST["direccion"];
    $poblacion = $_REQUEST["poblacion"];
    $provincia = $_REQUEST["provincia"];
    $cp = $_REQUEST["cp"];
    $pais = $_REQUEST["pais"];
    $telefono = $_REQUEST["telefono"];
    $movil = $_REQUEST["movil"];
    $fax = $_REQUEST["fax"];
    $email = $_REQUEST["email"];
    $web = $_REQUEST["web"];
    $observaciones = $_REQUEST["observaciones"];
    if (isset($_REQUEST["modificar"]))
    	$modificar = $_REQUEST["modificar"];

    $bbdd = new BBDD();
    
    if ($modificar != "") {
    	$sql = "UPDATE proveedores SET nombre = ?, cif = ?, direccion = ?, poblacion = ?, provincia = ?, cp = ?, pais = ?, " .
    		"telefono = ?, movil = ?, fax = ?, email = ?, web = ?, observaciones = ? WHERE id = ?";
    	$statement = $bbdd->conexion->prepare($sql);
    	$statement->bind_param("sssssssssssssi", $nombre, $cif, $direccion, $poblacion, $provincia, $cp, $pais, $telefono, $movil,
    		$fax, $email, $web, $observaciones, $modificar);
    	$ok = $statement->execute();
    	$statement->close();
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido actualizar el Proveedor. Comprueba que los datos son correctos</span>";
    		return;
    	}
    	
    	echo "El Proveedor <strong><em>" . $nombre . "</em></strong> se ha actualizado correctamente";
    }
    else {
    	if ($bbdd->es_proveedor($nombre)) {
    		echo "<span class='error'>¡ERROR! El Proveedor <strong>" . $nombre . "</strong> ya existe en la Base de Datos. No se permiten nombres duplicados</span>";
    		return;
    	}
    	
    	$sql = "INSERT INTO proveedores (nombre, cif, direccion, poblacion, provincia, cp, pais, telefono, movil, fax, email, web, observaciones) " .
    		"VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    	$statement = $bbdd->conexion->prepare($sql);
    	$statement->bind_param("sssssssssssss", $nombre, $cif, $direccion, $poblacion, $provincia, $cp, $pais, $telefono, $movil, 
    		$fax, $email, $web, $observaciones);
    	$ok = $statement->execute();
    	$statement->close();
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido dar de alta el Proveedor. Comprueba que los datos son correctos</span>";
    		return;
    	}
    	
    	echo "El Proveedor <strong><em>" . $nombre . "</em></strong> ha sido dado de alta con éxito";
    }
?>
