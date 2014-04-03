abc
===

ABC es una aplicación ERP para gestionar Clientes, Proveedores, Pedidos, Facturas e Inventario, dirigido a PYMEs

[http://abc.arkabytes.com](http://abc.arkabytes.com)

-----------
DESCRIPCIÓN
-----------

    ABC ERP - Aplicación Web ERP para PYMEs
              Gestión de Clientes y Proveedores
              Gestión de Pedidos y Facturación
              Gestión del Inventario y Stock
              Gestión de Tareas y Eventos

----------
ESTRUCTURA
----------

- admin

    Contiene código de la parte administrativa de la aplicación web

- config

    Contiene ficheros de configuración de la aplicación

- css

    Contiene las hojas de estilo

- iconos

    Contiene el set de iconos utilizado en toda la aplicación

- img

    Contiene las imágenes utilizadas en toda la aplicación

- include

    Contiene librerias propias y externas utilizadas en el proyecto (Ver más abajo LIBRERIAS EXTERNAS UTILIZADAS)

- run

    Contiene los scripts que procesan los formularios web

- sql

    Contiene el backup de la estructura de la Base de Datos (MySQL) utilizada

----------
REQUISITOS
----------

- Servidor Web Apache
- PHP > 5.2
- MySQL > 5.1
- Driver php-mysqlnd

--------------------------------
INTRUCCIONES PARA SU INSTALACIÓN
--------------------------------

Ver el documento INSTALL

----------------------------
LIBRERIAS EXTENAS UTILIZADAS
----------------------------

- jQuery v1.7.1
    
    The jQuery Project
    http://jquery.com

- jQuery UI v.18.7
    The jQuery Project
    http://jqueryui.com

- FancyZoom
    Script para visualizar imágenes
    http://www.cabel.name/2008/02/fancyzoom-10.html
    
- FullCalendar
http://arshaw.com/fullcalendar/

- FPDF
    Librería para la generación de documentos pdf
    http://www.fpdf.org

- Script para la generación de facturas (se ha utilizado una modificación sobre el original)
    Autor Xavier Nicolay
    http://www.fpdf.org/en/script/script20.php

- JQuery Calculator
    Calculadora inline
    http://keith-wood.name/calculator.html

-------
AUTORES
-------

    Santiago Faci <santi@arkabytes>
