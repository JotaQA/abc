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
    require_once("../../include/fpdf/invoice.php");
    
    $bbdd = new BBDD();
    
	$numero_pedido = $_REQUEST["numero_pedido"];
	$pedido = $bbdd->get_pedido_por_numero_pedido($numero_pedido);
	$cliente = $bbdd->get_cliente_por_id($pedido->id_cliente);
	$datos_empresa = $bbdd->ejecuta_escalar("SELECT * FROM empresa");
	
	$pdf = new PDF_Invoice('P', 'mm', 'A4');
	$pdf->AddPage();
	$pdf->addSociete(utf8_decode($datos_empresa["nombre"]), 
		utf8_decode($datos_empresa["direccion"] . "\n" . $datos_empresa["cp"] . " " . $datos_empresa["poblacion"] .
		"\n" . $datos_empresa["provincia"]));
	
	$pdf->Image('../img/logo_informes.jpg',10,8,45);
	
	$pdf->fact_dev("Pedido", $pedido->numero_pedido);
	if ($pedido->estado == "pendiente")
		$pdf->temporaire(utf8_decode("Presupuesto"));
	$pdf->addDate(date("d-m-Y", strtotime($pedido->fecha)));
	//$pdf->addClient($cliente->empresa);
	//$pdf->addPageNumber("1");
	$pdf->addClientAdresse(utf8_decode($cliente->nombre_completo . "\n" . $cliente->direccion . "\n" . $cliente->cp . " " . $cliente->poblacion . "\n" . $cliente->provincia));
	$pdf->addReglement(utf8_decode($pedido->forma_pago));
	//$pdf->addEcheance("");	// Fecha de pago (sólo para facturas)
	
	$cols=array( "REFERENCIA"    => 23,
			"NOMBRE"  => 78,
			"CANTIDAD"     => 22,
			"PRECIO"      => 26,
			"SUBTOTAL" => 25,
			"IVA"          => 16 );
	$pdf->addCols( $cols);
	$cols=array( "REFERENCIA"    => "L",
			"NOMBRE"  => "L",
			"CANTIDAD"     => "C",
			"PRECIO"      => "R",
			"SUBTOTAL" => "R",
			"IVA"          => "C" );
	$pdf->addLineFormat($cols);
	
	$y    = 109;
	
	$subtotal = 0;
	$iva = 0;
	$detalles_pedido = $bbdd->get_detalles_pedido($pedido->id);
	while ($fila = $detalles_pedido->fetch_assoc()) {
	
		$line = array( "REFERENCIA"    => $fila["id_articulo"],
				"NOMBRE"  => utf8_decode($fila['nombre_articulo']),
				"CANTIDAD"     => $fila['cantidad'],
				"PRECIO"      => number_format($fila['precio'], 2, ",", "."),
				"SUBTOTAL" => number_format($fila['subtotal'], 2, ",", "."),
				"IVA"          => number_format($fila["iva"], 2, ",", "."));
		$size = $pdf->addLine($y, $line);
		$y   += $size + 2;
		
		$subtotal += $fila["subtotal"];
		$iva += $fila["iva"];
	}
	
	$total = $subtotal + $iva;
	
	$subtotal = number_format($subtotal, 2, ",", ".");
	$iva = number_format($iva, 2, ",", ".");
	$total = number_format($total, 2, ",", ".");
	$pdf->addCadreEurosFrancs($subtotal, $iva, $total);
	$pdf->Output();
?>