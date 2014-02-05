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

 require_once("config/abc-config.php");
?>
<script type="text/javascript">
jQuery(function() {
    // Indicador de carga
    var loader = jQuery('<div id="loader">Enviando . . .</div>')
        .css({position: "relative", bottom: "0px", left: "center", color: "#690D1A", padding: "5px"})
        .appendTo("#mensaje")
        .hide();

    jQuery("#login").ajaxStart(function() {
        loader.show();
    }).ajaxStop(function() {
        loader.hide();
    }).ajaxError(function(a, b, e) {
        throw e;
    });

    var v = jQuery("#login").validate({
        submitHandler: function(formulario) {
            jQuery(formulario).ajaxSubmit({
                target: "#resultado",
                success: function(responseText) {
                    if (responseText == "admin") {
                        $("#resultado").hide();
<?php
                        echo "window.location = '" . BASE_URL . "admin/?id=inicio'\n";
?>
                    }
                    else if (responseText == "") {
<?php
                        echo "window.location = '" . BASE_URL . "?id=inicio'\n";
?>
                    }
                }
            });
        }
    });
});
</script>
<div style="margin: auto; color: red;"><?php if (isset($mensaje)) echo $mensaje; ?></div>
<form id="login" method="post" action="run/_login.php">
    <fieldset class="login">
        <legend>Login</legend>
        <ol>
            <li>
            <label>Usuario:</label>
            <input type="text" name="usuario" class="required"/>
            </li>
            <li>
            <label>Contraseña:</label>
            <input type="password" name="contrasena" class="required"/>
            </li>
        </ol>
    </fieldset>
    <fieldset class="submit">
        <input type="submit" value="Entrar"/>
    </fieldset>
</form>
<div id="mensaje"></div>
<div id="resultado"></div>
