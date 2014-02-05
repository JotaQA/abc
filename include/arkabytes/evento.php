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

class Evento {

    public $id;
    public $nombre;
    public $descripcion;
    public $fecha_prevista;
    public $ubicacion;
    public $id_cliente;
    public $id_proveedor;
    public $aviso;
    public $fecha_aviso;
    
    public static function nuevo_evento($fila) {

        $evento = new Tarea();
        $evento->id = $fila["id"];
        $evento->nombre = $fila["nombre"];
        $evento->descripcion = $fila["descripcion"];
        $evento->fecha_prevista = $fila["fecha_prevista"];
        $evento->ubicacion = $fila["ubicacion"];
        $evento->id_cliente = $fila["id_cliente"];
        $evento->id_proveedor = $fila["id_proveedor"];
        $evento->aviso = $fila["aviso"];
        $evento->fecha_aviso = $fila["fecha_aviso"];
        
        return $evento;
    }
}
?>
