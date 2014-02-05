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
    $descripcion = $_REQUEST["descripcion"];
    
    $fecha_prevista = $_REQUEST["fecha_prevista"];
    if ($fecha_prevista == "")
    	$fecha_prevista = NULL;
    else
    	$fecha_prevista = date("Y-m-d", strtotime($fecha_prevista));
    
   	$fecha_inicio = $_REQUEST["fecha_inicio"];
   	if ($fecha_inicio == "")
   		$fecha_inicio = NULL;
   	else
    	$fecha_inicio = date("Y-m-d", strtotime($fecha_inicio));
   	
    $fecha_fin = $_REQUEST["fecha_fin"];
    if ($fecha_fin == "")
    	$fecha_fin = NULL;
    else
    	$fecha_fin = date("Y-m-d", strtotime($fecha_fin));
    
    $ubicacion = $_REQUEST["ubicacion"];
    $cliente = $_REQUEST["cliente"];
    $proveedor = $_REQUEST["proveedor"];
    $pedido = $_REQUEST["pedido"];
    $estado = $_REQUEST["estado"];
    $aviso = 0;
    if (isset($_REQUEST["aviso"]))
    	$aviso = $_REQUEST["aviso"];
    
    $fecha_aviso = $_REQUEST["fecha_aviso"];
    if ($fecha_aviso == "")
    	$fecha_aviso = NULL;
    else
    	$fecha_aviso = date("Y-m-d", strtotime($fecha_aviso));
    
    $modificar = "";
    if (isset($_REQUEST["modificar"]))
    	$modificar = $_REQUEST["modificar"];

    $bbdd = new BBDD();
     
    $id_proveedor = NULL;
    if ($proveedor != "")
    	$id_proveedor = $bbdd->get_id_proveedor($proveedor);
   	$id_cliente = NULL;
    if ($cliente != "")
    	$id_cliente = $bbdd->get_id_cliente($cliente);
   	$id_pedido = NULL;
    if ($pedido != "")
    	$id_pedido = $bbdd->get_id_pedido($pedido);
    
    if ($modificar != "") {
    	
    	$sql = "UPDATE tareas SET nombre = ?, descripcion = ?, fecha_prevista = ?, fecha_inicio = ?, fecha_fin = ?, " .
      		"ubicacion = ?, id_cliente = ?, id_proveedor = ?, id_pedido = ?, estado = ?, aviso = ?, fecha_aviso = ? WHERE id = ?";
    	$statement = $bbdd->conexion->prepare($sql);
    	$statement->bind_param("ssssssiiisisi", $nombre, $descripcion, $fecha_prevista, $fecha_inicio, $fecha_fin, $ubicacion, 
    		$id_cliente, $id_proveedor, $id_pedido, $estado, $aviso, $fecha_aviso, $modificar);
    	$ok = $statement->execute();
    	$statement->close();
    	if (!$ok) {
    		echo "<span class='error'>¡ERROR! No se ha podido actualizar la Tarea. Comprueba que los datos son correctos</span>";
    		return;
    	}
    	
    	echo "La Tarea <strong><em>" . $nombre . "</em></strong> se ha actualizado correctamente";
    }
    else {
    	if ($bbdd->es_tarea($nombre)) {
    		echo "<span class='error'>¡ERROR! La Tarea <strong>" . $nombre . "</strong> ya existe en la Base de Datos. No se permiten nombres duplicados</span>";
    		return;
    	}
    	
    	$sql = "INSERT INTO tareas (nombre, descripcion, fecha_prevista, fecha_inicio, fecha_fin, ubicacion, " .
    		"id_cliente, id_proveedor, id_pedido, estado, aviso, fecha_aviso, tipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'tarea'	)";
    	$statement = $bbdd->conexion->prepare($sql);
    	$statement->bind_param("ssssssiiisis", $nombre, $descripcion, $fecha_prevista, $fecha_inicio, $fecha_fin, $ubicacion, 
    		$id_cliente, $id_proveedor, $id_pedido, $estado, $aviso, $fecha_aviso);
    	$ok = $statement->execute();
    	$statement->close();
    	if (!$ok) {
    		echo "<span class='error'>!ERROR! No se ha podido dar de alta la Tarea. Comprueba que los datos son correctos</span>";
    		return;
    	}
    	
    	echo "La Tarea <strong><em>" . $nombre . "</em></strong> ha sido dado de alta con éxito";
    }
?>
