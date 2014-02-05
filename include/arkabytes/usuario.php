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

class Usuario {

    public $usuario;
    public $nombre;
    public $email;
    public $nivel;

    function __construct($usuario = NULL, $nombre = NULL, $email = NULL, $nivel = NULL) {

    	if (func_num_args() == 0)
    		return;

    	$this->usuario = $usuario;
    	$this->nombre = $nombre;
    	$this->email = $email;
    	$this->nivel = $nivel;
    }

    public static function nuevo_usuario($fila) {

    	$usuario = new Usuario();
    	$usuario->usuario = $fila["usuario"];
    	$usuario->nombre = $fila["nombre"];
    	$usuario->email = $fila["email"];
    	$usuario->nivel = $fila["nivel"];

    	return $usuario;
    }
}
?>
