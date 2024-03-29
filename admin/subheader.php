<?php
/*
 * ABC ERP - Sistema ERP para PYMEs
 * Copyright (C) 2014 Santiago Faci <santi@arkabytes.com>
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
?>
<script type="text/javascript">
jQuery(function() {

    $(document).ready(function() {
        $('#busqueda_rapida').focus();
    });
});
</script>

<?php
    if (($id == "inicio") || ($id == "login")) {
        return;
    }
?>
<div id="subheader">
<?php

    if (($id == "clientes") || ($id == "nuevo_cliente")) {

        echo "<a href='?id=nuevo_cliente' title='Nuevo Cliente'><img src='icons/anadirusuario32.png' alt='Nuevo Cliente'/></a>\n";
        echo "<a href='?id=clientes' title='Ver Clientes'><img src='icons/report32.png' alt='Ver Clientes'/></a>\n";
        echo "<a href='?id=pdf_clientes' title='Generar informe'><img src='icons/pdf32.png' alt='Generar Informe'/></a>\n";
    }
    else if (($id == "proveedores") || ($id == "nuevo_proveedor")) {

        echo "<a href='?id=nuevo_proveedor' title='Nuevo Proveedor'><img src='icons/anadirproveedor32.png' alt='Nuevo Proveedor'/></a>\n";
        echo "<a href='?id=proveedores' title='Ver Proveedores'><img src='icons/report32.png' alt='Ver Proveedor'/></a>\n";
    }
    else if (($id == "pedidos") || ($id == "nuevo_pedido")) {

        echo "<a href='?id=nuevo_pedido' title='Nuevo Pedido'><img src='icons/anadirpedido32.png' alt='Nuevo Pedido'/></a>\n";
        echo "<a href='?id=pedidos' title='Ver Pedidos'><img src='icons/report32.png' alt='Ver Pedidos'/></a>\n";
    }
    else if (($id == "facturas") || ($id == "nueva_factura")) {

        //echo "<a href='?id=nueva_factura' title='Nueva Factura'><img src='icons/anadirfactura32.png' alt='Nueva Factura'/></a>\n";
        echo "<a href='?id=facturas' title='Ver Facturas'><img src='icons/report32.png' alt='Ver Facturas'/></a>\n";
    }
    /*else if (($id == "tareas") || ($id == "nueva_tarea")) {
        
        echo "<a href='?id=nueva_tarea' title='Nueva Tarea'><img src='icons/anadirtarea32.png' alt='Nueva Tarea'/></a>\n";
        echo "<a href='?id=tareas' title='Tareas'><img src='icons/report32.png' alt='Ver Tareas'/></a>\n";
        echo "<a href='?id=calendario' title='Ver Calendario'><img src='icons/calendario32.png' alt='Ver Calendario'/></a>\n";
    }*/
    else if (($id == "articulos") || ($id == "nuevo_articulo")) {

        echo "<a href='?id=nuevo_articulo' title='Nuevo Artículo'><img src='icons/anadircesta32.png' alt='Nuevo Artículo'/></a>\n";
        echo "<a href='?id=articulos' title='Ver Artículos'><img src='icons/report32.png' alt='Ver Artículos'/></a>\n";
    }
    else if (($id == "maestras") || ($id == "nueva_forma_pago") || ($id == "nueva_forma_envio") || ($id == "nuevo_tipo_iva")) {

        echo "<a href='?id=nueva_forma_envio' title='Nueva Forma de Envío'><img src='icons/anadirformaenvio32.png' alt='Nueva Forma Envío'/></a>\n";
        echo "<a href='?id=nueva_forma_pago' title='Nueva Forma de Pago'><img src='icons/anadirformapago32.png' alt='Nueva Forma Pago'/></a>\n";
        echo "<a href='?id=nuevo_tipo_iva' title='Nuevo Tipo de IVA'><img src='icons/anadirtipoiva32.png' alt='Nuevo Tipo de IVA'/></a>\n";
        echo "<a href='?id=maestras' title='Ver Tablas Maestras'><img src='icons/report32.png' alt='Ver Tablas Maestras'/></a>\n";
    }
    else if (($id == "calendario") || ($id == "nuevo_evento") || ($id == "agenda") || ($id == "nueva_tarea")) {
    
    	echo "<a href='?id=nueva_tarea' title='Nueva Tarea'><img src='icons/anadirtarea32.png' alt='Nueva Tarea'/></a>\n";
    	echo "<a href='?id=nuevo_evento' title='Nuevo Evento'><img src='icons/anadiragenda32.png' alt='Nuevo Evento'/></a>\n";
    	echo "<a href='?id=agenda' title='Agenda'><img src='icons/report32.png' alt='Ver Agenda'/></a>\n";
    	echo "<a href='?id=calendario' title='Ver Calendario'><img src='icons/calendario32.png' alt='Ver Calendario'/></a>\n";
    }
    else if (($id == "configurar_perfil") || ($id == "configurar_empresa") || ($id == "configurar_aplicacion")) {
    
    	echo "<a href='?id=configurar_perfil' title='Configurar Perfil'><img src='icons/usuario32.png' alt='Configurar Peril'/></a>\n";
    	echo "<a href='?id=configurar_empresa' title='Configurar Empresa'><img src='icons/info232.png' alt='Configurar Empresa'/></a>\n";
    	echo "<a href='?id=configurar_aplicacion' title='Configurar Aplicación'><img src='icons/ejecutar32.png' alt='Configurar Aplicación'/></a>\n";
    }

?>
	<div id="fija">
    <form id="busqueda">
        <input type="image" id="buscar" src="icons/buscar32.png" alt="Buscar"/>
        <label for="busqueda_rapida"></label>
        <input style="margin-top: 5px" type="text" name="busqueda_rapida" id="busqueda_rapida" size="20" 
        	title="Introduce lo que quieras buscar y pulsa Enter" value="<?php echo $_REQUEST["busqueda_rapida"]; ?>"/> 
    </form>
    </div>

</div>
