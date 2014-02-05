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
 
    date_default_timezone_set("Europe/Madrid");
    
    $cliente = $_REQUEST["cliente"];
    $numero_factura = $_REQUEST["numero"];
    $fecha = date("Y-m-d H:is:s", new DateTime($_REQUEST["fecha"]));
    $fecha_vencimiento = date("Y-m-d H:i:s", new DateTime($_REQUEST["fecha_vencimiento"]));
    $estado = $_REQUEST["estado"];
    $comentario = $_REQUEST["comentario"];
    $observaciones = $_REQUEST["observaciones"];
    $importe = $_REQUEST["importe"];
    $base_imponible = $_REQUEST["base_imponible"];
    $iva = $_REQUEST["iva"];
    $nombre_forma_pago = $_REQUEST["forma_pago"];

    $bbdd = new BBDD();

    $id_cliente = $bbdd->get_id_cliente($cliente);
    $forma_pago = $bbdd->get_forma_pago($nombre_forma_pago);

    $sentencia = "INSERT INTO facturas (numero_factura, fecha, fecha_vencimiento, estado, comentarios, observaciones, base_imponible, iva, importe, nombre_cliente, direccion, poblacion, provincia, cp, forma_pago)
    VALUES (" . $id_cliente . ",'" . $numero . "','" . $fecha . "','" . $fecha_entrega . "','" . $estado . "','" . $comentario . "','" . $observaciones .
    "','" . $nombre_forma_envio . "','" . $nombre_forma_pago . "'," . $forma_envio->coste . "," . $forma_pago->coste . "," . $forma_envio->dias . ")";

    $resultado = $bbdd->ejecuta_sentencia($sentencia);
    if (!$resultado) {
        echo "<span class='error'>¡ERROR! No se ha podido dar de alta el Pedido. Comprueba que los datos son correctos</span>";
        return;
    }

    echo "El Pedido <strong><em>" . $nombre . "</em></strong> ha sido dado de alta con Ã©xito";
?>
