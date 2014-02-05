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

class FormaEnvio {

    public $nombre;
    public $descripcion;
    public $coste;
    public $dias;

    function __construct($nombre = NULL, $descripcion = NULL, $coste = NULL, $dias = NULL) {

    	if (func_num_args() == 0)
    		return;

    	$this->nombre = $nombre;
    	$this->descripcion = $descripcion;
    	$this->coste = $coste;
    	$this->dias = $dias;
    }

    public static function nueva_forma_envio($fila) {

    	$forma_envio = new FormaEnvio();
    	$forma_envio->nombre = $fila["nombre"];
    	$forma_envio->descripcion = $fila["descripcion"];
    	$forma_envio->coste = $fila["coste"];
    	$forma_envio->dias = $fila["dias"];

    	return $forma_envio;
    }
}
?>
