<?php
session_start();
date_default_timezone_set('America/Bogota');

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
echo '---------------------------------------------------------------------------';
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
//exit();


/*
'".$_POST['orden_numero']."',
'".$_POST['placa']."',
'".$_POST['clave']."',
'".$_POST['fecha']."',
'".$_POST['descripcion']."',
'".$_POST['radio']."',
'".$_POST['antena']."',
'".$_POST['repuesto']."',
'".$_POST['herramienta']."',
'".$_POST['otros']."'
*/
if ($_POST['cambiar_mecanico']== 'undefined'){$_POST['cambiar_mecanico'] = 0;}

if($_POST['cambiar_mecanico'] == 1)
{$_POST['mecanico'] = $_POST['mecanico_nuevo'];}
$estado_a_grabar  = $_POST['estado'];
if($ultimo_estado <> '...')
		{
				if($_POST['estado']<>$_POST['ultimo_estado'])
				  {
					 echo 'los dos estados son diferentes';
					 $estado_a_grabar  = $_POST['ultimo_estado'];
					 
					 //
				  }
				 else
				 {   $estado_a_grabar  = $_POST['estado'];
				  
				 } 
  
		}// fin de if($ultimo_estado <> '...')
//echo '<br>valor de cambiar_mecanico'.$_POST['cambiar_mecanico'];

include('../valotablapc.php');
//$sql_actualizar_orden = "update  $tabla14  set (factura,placa,sigla,fecha,observaciones,radio,antena,repuesto,herramienta,otros) 
$sql_actualizar_orden = "update  $tabla14  set 
observaciones = '".$_POST['descripcion']."',
iva = '".$_POST['iva']."'
,kilometraje = '".$_POST['kilometraje']."'
,mecanico = '".$_POST['mecanico']."'
,kilometraje_cambio = '".$_POST['kilometraje_cambio']."'
,abono = '".$_POST['abono']."'
,estado = '".$estado_a_grabar."'
,usuario_modificacion = '".$_POST['id_usuario']."'
where id = '".$_POST['id_orden']."'
";

//echo '<br>'.$sql_actualizar_orden;
//exit();

$consulta_grabar = mysql_query($sql_actualizar_orden,$conexion); 

actualizar_inventario_estado_vehiculo($tabla24,$tabla25,$_SESSION['id_empresa'],$id_orden,$conexion);

/////////////////////////////////
//grabar_trazabilidad de cambios en las ordenes
$fecha_hora_actual = date('Y-m-d H:i:s');
$sql_cambios_ordenes ="insert into $tabla60 (id_orden,id_usuario,fechayhora,id_empresa)  
values ('".$_POST['id_orden']."','".$_SESSION['id_usuario']."','".$fecha_hora_actual."','".$_SESSION['id_empresa']."')";
$consulta_trazabilidad = mysql_query($sql_cambios_ordenes,$conexion);
/////////////////////////////

echo "<br><br><h2>ORDEN  ACTUALIZADA</h2>";
include('../colocar_links2.php');

//<a href="#">#</a>
//tabla24 nombres_items_carros
//tabla25 relacion_orden_inventario
function actualizar_inventario_estado_vehiculo($tabla24,$tabla25,$id_empresa,$id_orden,$conexion)
{
  // echo '<br>pasoooooooooooooooooooooooooooo11111<br>';
   $sql_nombres_inventario = "select * from $tabla24 where id_empresa = '".$id_empresa."' order by id_nombre_inventario";
   //echo '<br>'.$sql_nombres_inventario.'<br>';
   $consulta_nombres_inventario = mysql_query($sql_nombres_inventario,$conexion);
   while ($nombres_items = mysql_fetch_assoc($consulta_nombres_inventario))
   		{
			//echo 'pasooooooo2222222222222222222222';
			//echo '<br>1 '.$nombres_items['id_nombre_inventario'];
			$id_de_nombre = $nombres_items['id_nombre_inventario'];
			//echo '<br>idnombre'.$id_de_nombre;
			$cantidad = 'cantidad_'.$id_de_nombre;
			//echo '<br>cantidad123 '.$cantidad;
			
			$consulta_actualizar_valor_cantidad ="update $tabla25  set   
					valor = '".$_REQUEST[$id_de_nombre]."',
					cantidad = '".$_REQUEST[$cantidad]."'
					where id_nombre_inventario = '".$id_de_nombre."'   
					and id_orden = '".$_REQUEST['id_orden']."' 
					and id_empresa = '".$_SESSION['id_empresa']."' ";
			//echo '<br>consulta_actualizar'.$consulta_actualizar_valor_cantidad.'<br>';
			$consulta_actulizar_valores = mysql_query($consulta_actualizar_valor_cantidad,$conexion);		
		}// fin del while 
   
   

}// fin de la funcion de actualizar_inventario_estado_vehiculo 

echo '<h2><a href="orden_imprimir_honda_cero.php?idorden='.$_REQUEST['id_orden'].'" target="blank">VISTA IMPRESION ORDEN</a></h2>';

?>