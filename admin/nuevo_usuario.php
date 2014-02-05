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
?>
<form id="formulario" method="post" action="run/_nuevo_usuario.php" enctype="multipart/form-data">
    <fieldset>
    <legend>Datos de Usuario</legend>
    <span class="tip">** Recuerda que puedes avanzar por las cajas de texto pulsando Tab **</span>
    <ol>
    <li>
        <label><strong>Nombre</strong></label>
        <input type="text" name="nombre" id="nombre" size="20" class="required"/>
    </li>
    <li>
        <label>Contraseña</label>
        <input type="password" name="contrasena" size="40" class="required"/>
    </li>
    <li>
        <label>Contraseña</label>
        <input type="password" name="contrasena2" size="5" class="required"/>
    </li>
    <li>
        <label>Nombre</label>
        <input type="text" name="nombre" size="5"/>
    </li>
    <li>
        <label>Email</label>
        <input type="text" name="email"/>
    </li>
    <li>
        <label for="nivel">Nivel</label>
        <select name="nivel" id="nivel">
            <option value="admin">admin</option>
            <option value="usuario">usuario</option>
        </select>
    </li>
    <li>
        <label>Imagen</label>
        <input type="file" name="imagen"/>
    </li>
    </ol>
    </fieldset>
    <fieldset class="submit">
        <input type="submit" value="Enviar"/> 
    </fieldset>
</form>
<div id="mensaje"></div>
<div id="resultado"></div>