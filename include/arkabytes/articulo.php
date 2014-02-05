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

class Articulo {

    public $id;
    public $nombre;
    public $descripcion;
    public $stock;
    public $precio_coste;
    public $precio_venta;
    public $observaciones;
    public $imagen1;
    public $imagen2;
    public $imagen3;
    public $miniatura;
    public $id_proveedor;
    public $id_tipo_iva;

    public static function nuevo_articulo($fila) {

        $articulo = new Articulo();
        $articulo->id = $fila["id"];
        $articulo->nombre = $fila["nombre"];
        $articulo->descripcion = $fila["descripcion"];
        $articulo->stock = $fila["stock"];
        $articulo->precio_coste = $fila["precio_coste"];
        $articulo->precio_venta = $fila["precio_venta"];
        $articulo->observaciones = $fila["observaciones"];
        $articulo->imagen1 = $fila["imagen1"];
        $articulo->imagen2 = $fila["imagen2"];
        $articulo->imagen3 = $fila["imagen3"];
        $articulo->miniatura = $fila["miniatura"];
        $articulo->id_proveedor = $fila["id_proveedor"];
        $articulo->id_tipo_iva = $fila["id_tipo_iva"];

        return $articulo;
    }
}
?>
