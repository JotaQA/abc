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

class Tarea {

    public $id;
    public $nombre;
    public $descripcion;
    public $fecha_prevista;
    public $fecha_inicio;
    public $fecha_fin;
    public $ubicacion;
    public $id_cliente;
    public $id_proveedor;
    public $id_pedido;
    public $estado;
    public $aviso;
    public $fecha_aviso;
    
    public static function nueva_tarea($fila) {

        $tarea = new Tarea();
        $tarea->id = $fila["id"];
        $tarea->nombre = $fila["nombre"];
        $tarea->descripcion = $fila["descripcion"];
        $tarea->fecha_prevista = $fila["fecha_prevista"];
        $tarea->fecha_inicio = $fila["fecha_inicio"];
        $tarea->fecha_fin = $fila["fecha_fin"];
        $tarea->ubicacion = $fila["ubicacion"];
        $tarea->id_cliente = $fila["id_cliente"];
        $tarea->id_proveedor = $fila["id_proveedor"];
        $tarea->id_pedido = $fila["id_pedido"];
        $tarea->estado = $fila["estado"];
        $tarea->aviso = $fila["aviso"];
        $tarea->fecha_aviso = $fila["fecha_aviso"];
        
        return $tarea;
    }
}
?>
