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

class Imagenes {

	/**
	 * Redimensiona una imagen para generar una miniatura
	 * @param unknown $ruta_imagen
	 */
    public static function redimensionar_imagen($ruta_imagen) {
        
    	// Mantiene la proporción de la imagen
    	$x = 94;
    	$ratio = 0;
    	$tamano = getimagesize($ruta_imagen);
    	$ratio = floatval($tamano[0] / $tamano[1]);
    	$y = $x / $ratio;
    	
    	$extension = Imagenes::get_extension($ruta_imagen);
    	if (($extension == "jpg") || ($extension == "jpeg")) 
    		$imagen = ImageCreateFromJPEG($ruta_imagen);
    	else if (($extension == "png"))
    		$imagen = ImageCreateFromPNG($ruta_imagen);
    	else
    		$imagen = imagecreatefromgif($ruta_imagen);
        
        $nueva_imagen = imagecreatetruecolor($x, $y);
        ImageCopyResized($nueva_imagen, $imagen, 0, 0, 0, 0, $x, $y, imagesx($imagen), imagesy($imagen));
        ImageJPEG($nueva_imagen, $ruta_imagen, 100);
        ImageDestroy($imagen);
    }
    
    /**
     * Devuelve la extensión de un fichero
     * @param unknown $ruta_imagen
     * @return string
     */
    public static function get_extension($ruta_imagen) {
    	
    	$posicion = strrpos($ruta_imagen, ".");
    	$extension = substr($ruta_imagen, $posicion + 1, strlen($ruta_imagen));
    	
    	return strtolower($extension);
    }
}
?>
