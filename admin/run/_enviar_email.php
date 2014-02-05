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

	$para = $_REQUEST["para"];
	$asunto = $_REQUEST["asunto"];
	$mensaje = $_REQUEST["mensaje"];
	
	$cabeceras = "From: Arkabytes <contacto@arkabytes.com>";
	/*
	if (mail($para, $asunto, $mensaje, $cabeceras)) {

		echo "Mensaje enviado correctamente";
	}
	else {
		echo "<span class='error'>Se ha producido un error al enviar el email. Inténtelo de nuevo</span>";
	}
	*/
	echo "<span class='error'>Función desactivada en la versión demo</span>";
?>