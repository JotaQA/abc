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

    include("_check_login.php");
    require_once("../../include/arkabytes/bbdd.php");

    include("../../include/pChart2.1.4/class/pDraw.class.php");
    include("../../include/pChart2.1.4/class/pBarcode128.class.php");
    include("../../include/pChart2.1.4/class/pImage.class.php");
    
    $id = $_REQUEST["id"];
    $id = sprintf("%06s", $id);
    
    $barcode = new pBarcode128("../../include/pChart2.1.4/");
    $settings = array("ShowLegend"=>TRUE, "DrawArea"=>TRUE);
    $size = $barcode->getSize($id, $settings);
    
    $picture = new pImage($size["Width"], $size["Height"]);
    $picture->setFontProperties(array("FontName"=>"../../include/pChart2.1.4/fonts/GeosansLight.ttf"));
    
    $barcode->draw($picture, $id, 10, 10, $settings);
    $picture->autoOutput("../articulos/codigo.png");
?>
