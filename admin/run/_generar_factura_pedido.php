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
 
    $numero_pedido = $_REQUEST["numero_pedido"];
    
    $fecha = $_REQUEST["fecha"];
    if ($fecha == "") {
    	echo "<span class='error'>La fecha de emisión es un campo obligatorio</span>";
    	return;
	}
    else
    	$fecha = date("Y-m-d", strtotime($fecha));
    
    $fecha_vencimiento = $_REQUEST["fecha_vencimiento"];
    if ($fecha_vencimiento == "") {
    	echo "<span class='error'>La fecha de vencimiento es un campo obligatorio</span>";
    	return;
    }
    else
    	$fecha_vencimiento = date("Y-m-d", strtotime($fecha_vencimiento));
 	 
    $estado = $_REQUEST["estado"];
    $nombre_forma_pago = $_REQUEST["forma_pago"];
    $comentarios = $_REQUEST["comentarios"];
    $observaciones = $_REQUEST["observaciones"];
    
    if ($fecha_vencimiento < $fecha) {
    	echo "<span class='error'>¡ERROR! La fecha de vencimiento no puede ser anterior a la de emisión</span>";
    	return;
    }
    
    $bbdd = new BBDD();
    $bbdd->conexion->autocommit(FALSE);
    
    $pedido = $bbdd->get_pedido_por_numero_pedido($numero_pedido);
    $cliente = $bbdd->get_cliente_por_id($pedido->id_cliente);
    $numero_factura = $bbdd->get_siguiente_numero_factura();
    
    $sql = "INSERT INTO facturas (numero_factura, fecha, fecha_vencimiento, estado, comentarios, " .
    	"observaciones, base_imponible, iva, importe, nombre_cliente, direccion, poblacion, provincia, " .
    	"cp, forma_pago, numero_pedido, id_cliente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $ok = $bbdd->ejecuta_sentencia_i($sql, "ssssssdddsssssssi", array($numero_factura, $fecha, $fecha_vencimiento, $estado, $comentarios,
    	$observaciones, $pedido->base_imponible, $pedido->iva, $pedido->importe, $cliente->nombre_completo, $cliente->direccion,
    	$cliente->poblacion, $cliente->provincia, $cliente->cp, $nombre_forma_pago, $numero_pedido, $cliente->id));
    
    if (!$ok) {
    	echo "<span class='error'>¡ERROR! No se ha podido generar la Factura. Comprueba que los datos son correctos</span>";
    	$bbdd->conexion->rollback();
    	return;
    }
    
    $id_factura = $bbdd->conexion->insert_id;
    $detalles_pedido = $bbdd->get_detalles_pedido($pedido->id);
    while ($fila = $detalles_pedido->fetch_assoc()) {
    	
    	$sql = "INSERT INTO detalles_factura (id_articulo, nombre_articulo, descripcion, precio, cantidad, descuento, " .
      		"subtotal, iva, observaciones, id_factura) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    	$ok = $bbdd->ejecuta_sentencia_i($sql, "issdddddsi", array($fila["id_articulo"], $fila["nombre_articulo"], 
    		$fila["descripcion"], $fila["precio"], $fila["cantidad"], $fila["descuento"], $fila["subtotal"],
    		$fila["iva"], $fila["observaciones"], $id_factura));
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido generar la Factura. Comprueba que los datos son correctos</span>";
    		$bbdd->conexion->rollback();
    		return;
    	}
    }
    
    $bbdd->conexion->commit();
    echo "La Factura se ha generado correctamente";
?>
