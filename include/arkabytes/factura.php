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

class Factura {

    public $id;
    public $numero_factura;
    public $fecha;
    public $fecha_vencimiento;
    public $estado;
    public $comentarios;
    public $observaciones;
    public $base_imponible;
    public $iva;
    public $importe;
    public $nombre_cliente;
    public $direccion;
    public $poblacion;
    public $provincia;
    public $cp;
    public $forma_pago;
    public $numero_pedido;
    public $id_cliente;

    /**
     * Crea y devuelve un nuevo pedido a partir de la fila del resultado de una consulta
     * @param fila La fila de la Base de Datos con los datos de la factura
     * @return El objeto factura que se ha creado
     */
    public static function nueva_factura($fila) {

        $factura = new Factura();
        $factura->id = $fila["id"];
        $factura->numero_factura = $fila["numero_factura"];
        $factura->fecha = $fila["fecha"];
        $factura->fecha_vencimiento = $fila["fecha_vencimiento"];
        $factura->estado = $fila["estado"];
        $factura->comentarios = $fila["comentarios"];
        $factura->observaciones = $fila["observaciones"];
        $factura->base_imponible = $fila["base_imponible"];
        $factura->iva = $fila["iva"];
        $factura->importe = $fila["importe"];
        $factura->nombre_cliente = $fila["nombre_cliente"];
        $factura->direccion = $fila["direccion"];
        $factura->poblacion = $fila["poblacion"];
        $factura->provincia = $fila["provincia"];
        $factura->cp = $fila["cp"];
        $factura->forma_pago = $fila["forma_pago"];
        $factura->numero_pedido = $fila["numero_pedido"];
        $factura->id_cliente = $fila["id_cliente"];

        return $factura;
    }
}
?>
