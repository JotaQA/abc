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
   	$direccion = $_REQUEST["direccion"];
   	$poblacion = $_REQUEST["poblacion"];
   	$provincia = $_REQUEST["provincia"];
   	$cp = $_REQUEST["cp"];
   	$nombre_logo = $_FILES["logo"]["name"];
   	$tmp_logo = $_FILES["logo"]["tmp_name"];
   	$nombre_logo_informes = $_FILES["logo_informes"]["name"];
    $tmp_logo_informes = $_FILES["logo_informes"]["tmp_name"];
    
    if (($nombre == "") || ($direccion == "") || ($poblacion == "") || ($provincia == "") || ($cp == "")) {
    	echo "<span class='error'>¡ERROR! Comprueba que has rellenado todos los campos obligatorios </span>";
    	return;
	}
    
    $bbdd = new BBDD();
    
    $sql = "UPDATE empresa SET nombre = ?, direccion = ?, poblacion = ?, provincia = ?, cp = ?";
    $ok = $bbdd->ejecuta_sentencia_i($sql, "sssss", array($nombre, $direccion, $poblacion, $provincia, $cp));
    if (!$ok) {
    	echo "<span class='error'>¡ERROR! No se ha podido modificar tu perfil. Comprueba que los datos son correctos</span>";
    	return;
    }
    
    // Colocar imágenes
    $directorio = "../../img"; 
    if ($nombre_logo != "")
    	move_uploaded_file($tmp_logo, $directorio . "/" . "logo.jpg");
    $directorio = "../img";
    if ($nombre_logo_informes != "")
    	move_uploaded_file($tmp_logo_informes, $directorio . "/" . "logo_informes.jpg");
    
    echo "Los datos de empresa se han actualizado correctamente";
?>
