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
 
    $modificar = $_REQUEST["modificar"];
    $usuario = $_REQUEST["usuario"];
    $contrasena = $_REQUEST["contrasena"];
    $contrasena2 = $_REQUEST["contrasena2"];
    $nombre = $_REQUEST["nombre"];
    $apellidos = $_REQUEST["apellidos"];
    $nombre_completo = $nombre . " " . $apellidos;
    $empresa = $_REQUEST["empresa"];
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

    $usuario_creado = NULL;

    $bbdd = new BBDD();

    if ($contrasena != $contrasena2) {
        echo "<span class='error'>La contraseña no coincide, comprueba que es correcta</span>";
        return;
    }

    if ($modificar != "") {
    	
    	$sentencia = "UPDATE clientes SET nombre = ?, apellidos = ?, nombre_completo = ?, empresa = ?, cif = ?, direccion = ?, poblacion = ?, provincia = ?, " .
      		"cp = ?, pais = ?, telefono = ?, movil = ?, fax = ?, email = ?, web = ?, observaciones = ? WHERE id = ?"; 
    	$statement = $bbdd->conexion->prepare($sentencia);
    	$statement->bind_param("ssssssssssssssssi", $nombre, $apellidos, $nombre_completo, $empresa, $cif, $direccion, $poblacion, $provincia, $cp, $pais, $telefono,
    		$movil, $fax, $email, $web, $observaciones, $modificar);

    	$ok = $statement->execute();
    	$statement->close();
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido actualizar el Cliente. Comprueba que los datos son correctos</span>";
    		return;
    	}
    	
    	echo "El cliente <strong><em>" . $nombre . "</em></strong> se ha actualizado correctamente";
    }
    else {
    	
    	if ($bbdd->es_cliente($nombre, $apellidos)) {
    		echo "<span class='error'>¡ERROR! El Cliente <strong>" . $nombre . "</strong> ya existe en la Base de Datos. No se permiten nombres duplicados</span>";
    		return;
    	}
    
	    /* Alta del usuario, si procede */
	    if (($usuario != "") && ($contrasena != "")) {
	
	        if ($bbdd->es_usuario($usuario)) {
	         
	            echo "<span class='error'>¡ERROR! El nombre de usuario <strong>" . $usuario . "</strong> ya existe. Deberás escoger otro</span>";
	            return;
	        }
	
	        $nivel = "usuario";
	        $contrasena = md5($contrasena);
	        
	        $sql = "INSERT INTO usuarios (usuario, contrasena, nombre, email, nivel) VALUES (?, ?, ?, ?, ?)";
	        $statement = $bbdd->conexion->prepare($sql);
	        $statement->bind_param("sssss", $usuario, $contrasena, $nombre, $email, $nivel);
	        $ok = $statement->execute();
	        $statement->close();
	        if (!$ok) {
	            echo "<span class='error'>¡ERROR! No se ha podido crear el usuario del Cliente. Comprueba que los datos son correctos</span>";
	            return;
	        }
	
	        $usuario_creado = mysql_insert_id();
	        if (!$usuario_creado) {
	            $usuario_creado = "NULL";
	        }
	    }
	
	    $sql = "INSERT INTO clientes (nombre, apellidos, nombre_completo, empresa, cif, direccion, poblacion, provincia, cp, pais, telefono, movil, fax, email, web, observaciones, " .
	    	"id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	    $statement = $bbdd->conexion->prepare($sql);
	    $statement->bind_param("ssssssssssssssssi", $nombre, $apellidos, $nombre_completo, $empresa, $cif, $direccion, $poblacion, $provincia, $cp, $pais,
	    	$telefono, $movil, $fax, $email, $web, $observaciones, $usuario_creado);
	    $ok = $statement->execute();
	    $statement->close();
	    if (!$ok) {
	        echo "<span class='error'>¡ERROR! No se ha podido dar de alta el Cliente. Comprueba que los datos son correctos</span>";
	        return;
	    }
	
	    echo "El Cliente <strong><em>" . $nombre . "</em></strong> ha sido dado de alta con éxito";
	}
?>
