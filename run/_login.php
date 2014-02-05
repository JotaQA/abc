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
 
    require_once("../config/abc-config.php");
    require_once("../include/arkabytes/bbdd.php");

    $usuario = $_REQUEST["usuario"];
    $contrasena = $_REQUEST["contrasena"];

    $bbdd = new BBDD();

    $usuario = $bbdd->comprobar_usuario($usuario, md5($contrasena));

    if ($usuario == null) {
        echo "El nombre de usuario o contraseña no son correctos. Por favor, inténtelo de nuevo";
        return;
    }

    session_start();
    $_SESSION["usuario"] = serialize($usuario);
    
    /*if ($usuario->nivel == "usuario") {
        echo "";
    }
    else if ($usuario->nivel == "admin") {
        echo "admin";
    }*/

    return;
?>
