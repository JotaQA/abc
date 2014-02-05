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
 
    $nombre = $_REQUEST["nombre"];
    $apellidos = $_REQUEST["apellidos"];
    $email = $_REQUEST["email"];

    if (($nombre == "") || ($apellidos == "")) {
        echo "<span class='error'>¡ERROR! Debes indicar al menos un nombre y apellidos</span>";
        return;
    }

    $bbdd = new BBDD();

    if ($bbdd->es_cliente($nombre, $apellidos)) {
        echo "<span class='error'>¡ERROR! El Cliente <strong>" . $nombre . "</strong> ya existe en la Base de Datos. No se permiten nombres duplicados</span>";
        return;
    }
	
    
    $sql = "INSERT INTO clientes (nombre, apellidos, nombre_completo, email) VALUES (?, ?, ?, ?)";

    $resultado = $bbdd->ejecuta_sentencia_i($sql, "ssss", array($nombre, $apellidos, $nombre . " " . $apellidos, $email));
    if (!$resultado) {
        echo "<span class='error'>¡ERROR! No se ha podido dar de alta el Cliente. Comprueba que los datos son correctos</span>";
        return;
    }

    echo "El Cliente <strong><em>" . $nombre . "</em></strong> ha sido dado de alta con éxito";
?>
