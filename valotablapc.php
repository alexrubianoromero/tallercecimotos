<?php
$tabla1 = "categorias";
$tabla2 = "subcategorias";
$tabla3 ="cliente0";
$tabla4 ="carros";
//$tabla5 ="parametros";
$tabla10 = "empresa"; 
$tabla11 = "facturas";
$tabla12 = "productos";
$tabla13 = "item_factura";
$tabla14 = "ordenes";
$tabla15 = "item_orden";
$tabla16 = "usuarios";
$tabla17 = "iva";
$tabla18 = "item_temporal";
$tabla19 = "movimientos_inventario";
$tabla20 = "retefuente";
$tabla21 = "tecnicos";
$tabla22 = "salin_salfin_caja";
$tabla23 = "recibos_de_caja";
$tabla24 = "nombres_items_carros";
$tabla25 = "relacion_orden_inventario";
$tabla26 = "estados_ordenes";
$tabla30 = "perfiles";
$tabla31 = "menu_perfil";
$tabla50 = "recibos_de_caja_traz";
$tabla_prefacturas = "prefacturas";
$proveedores = "proveedores";
$tablaima = "imagenes_ordenes";
$tabla100 = "item_orden_facturas_sin_orden";
$cuentasxpagar ="cuentasxpagar";
$anotaciones_inventario = "anotaciones_inventario";
$meses = "meses";
$prestamos_internos  = "prestamos_internos";
$empresas_externas = "empresas_externas";
/*valores para pc*/

$servidor = "localhost";
$usuario = "root";
$clave  = "peluche2016";
$nombrebase = "base_demo";






$conexion =mysql_connect($servidor,$usuario,$clave);
$la_base =mysql_select_db($nombrebase,$conexion);

?>
