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

class Pedido {

    public $id;
    public $numero_pedido;
    public $fecha;
    public $fecha_entrega;
    public $estado;
    public $comentarios;
    public $observaciones;
    public $base_imponible;
    public $iva;
    public $importe;
    public $id_cliente;
    public $coste_envio;
    public $coste_forma_pago;
    public $dias_envio;
    public $forma_envio;
    public $forma_pago;
    public $terminado;

    /**
     * Crea y devuelve un nuevo pedido a partir de la fila del resultado de una consulta
     * @param fila La fila de la Base de Datos con los datos del pedido
     * @return El objeto pedido que se ha creado
     */
    public static function nuevo_pedido($fila) {

        $pedido = new Pedido();
        $pedido->id = $fila["id"];
        $pedido->numero_pedido = $fila["numero_pedido"];
        $pedido->fecha = $fila["fecha"];
        $pedido->fecha_entrega = $fila["fecha_entrega"];
        $pedido->estado = $fila["estado"];
        $pedido->comentarios = $fila["comentarios"];
        $pedido->observaciones = $fila["observaciones"];
        $pedido->base_imponible = $fila["base_imponible"];
        $pedido->iva = $fila["iva"];
        $pedido->importe = $fila["importe"];
        $pedido->id_cliente = $fila["id_cliente"];
        $pedido->coste_envio = $fila["coste_envio"];
        $pedido->coste_forma_pago = $fila["coste_forma_pago"];
        $pedido->dias_envio = $fila["dias_envio"];
        $pedido->forma_envio = $fila["forma_envio"];
        $pedido->forma_pago = $fila["forma_pago"];
        $pedido->terminado = $fila["terminado"];

        return $pedido;
    }
}
?>
