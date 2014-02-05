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
    $email = $_REQUEST["email"];

    if ($nombre == "") {
        echo "<span class='error'>¡ERROR! Debes indicar al menos un nombre</span>";
        return;
    }

    $bbdd = new BBDD();

    if ($bbdd->es_proveedor($nombre)) {
        echo "<span class='error'>¡ERROR! El Proveedor <strong>" . $nombre . "</strong> ya existe en la Base de Datos. No se permiten nombres duplicados</span>";
        return;
    }

    $sentencia = "INSERT INTO proveedores (nombre, email) VALUES ('" . $nombre . "','" . $email . "')";

    $resultado = $bbdd->ejecuta_sentencia($sentencia);
    if (!$resultado) {
        echo "<span class='error'>¡ERROR! No se ha podido dar de alta al Proveedor. Comprueba que los datos son correctos</span>";
        return;
    }

    echo "El Proveedor <strong><em>" . $nombre . "</em></strong> ha sido dado de alta con éxito";
?>
