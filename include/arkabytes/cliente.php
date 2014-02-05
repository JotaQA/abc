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

class Cliente {

    public $id;
    public $nombre;
    public $apellidos;
    public $nombre_completo;
    public $empresa;
    public $cif;
    public $direccion;
    public $poblacion;
    public $provincia;
    public $cp;
    public $pais;
    public $telefono;
    public $movil;
    public $fax;
    public $email;
    public $web;
    public $observaciones;

    /**
     * Crea y devuelve un nuevo cliente a partir de la fila del resultado de una consulta
     * @param fila La fila de la Base de Datos con los datos del cliente
     * @return El objeto cliente que se ha creado
     */
    public static function nuevo_cliente($fila) {

        $cliente = new Cliente();
        $cliente->id = $fila["id"];
        $cliente->nombre = $fila["nombre"];
        $cliente->apellidos = $fila["apellidos"];
        $cliente->nombre_completo = $fila["nombre_completo"];
        $cliente->empresa = $fila["empresa"];
        $cliente->cif = $fila["cif"];
        $cliente->direccion = $fila["direccion"];
        $cliente->poblacion = $fila["poblacion"];
        $cliente->provincia = $fila["provincia"];
        $cliente->cp = $fila["cp"];
        $cliente->telefono = $fila["telefono"];
        $cliente->movil = $fila["movil"];
        $cliente->fax = $fila["fax"];
        $cliente->email = $fila["email"];
        $cliente->web = $fila["web"];
        $cliente->observaciones = $fila["observaciones"];

        return $cliente;
    }
}
?>
