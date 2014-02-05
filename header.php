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
 
if ($id == "login") {
    echo "<span class='login'>ABC arkabytes</span>\n";
    return;
}

if ($id == "inicio")
    echo "<a class='activo' href='?id=inicio'>Inicio</a>\n";
else
    echo "<a href='?id=inicio'>Inicio</a>\n";
  
if ($id == "servicios")
    echo "<a class='activo' href='?id=servicios'>Tus Servicios</a>\n";
else
    echo "<a href='?id=servicios'>Tus Servicios</a>\n";

if ($id == "estadisticas")
    echo "<a class='activo' href='?id=estadisticas'>Estadísticas</a>\n";
else
    echo "<a href='?id=estadisticas'>Estadísticas</a>\n";
  
if ($id== "incidencias")
    echo "<a class='activo' href='?id=incidencias'>Incidencias</a>\n";
else
    echo "<a href='?id=incidencias'>Incidencias</a>\n";
  
if ($id == "facturacion")
    echo "<a class='activo' href='?id=facturacion'>Facturación</a>\n";
else
    echo "<a href='?id=facturacion'>Facturación</a>\n";
  
echo "<a href='#'>Correo Web</a>\n";
  
if ($id == "ayuda")
    echo "<a class='activo' href='?id=ayuda'>Ayuda</a>\n";
else
    echo "<a href='?id=ayuda'>Ayuda</a>\n";
?>
<span id="logout"><a href="run/_logout.php" title="Cerrar sesión"><img src="iconos/salir24.png" alt="Salir"/></a></span>
