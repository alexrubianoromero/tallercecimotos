<?php
session_start();
$fechapan = date ( "Y/m/j");
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';

exit();
*/
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
if ($_POST['radio']== 'undefined'){$_POST['radio'] = 0;}
if ($_POST['antena']== 'undefined'){$_POST['antena'] = 0;}
if ($_POST['repuesto']== 'undefined'){$_POST['repuesto'] = 0;}
if ($_POST['herramienta']== 'undefined'){$_POST['herramienta'] = 0;}
if ($_POST['resolucion']== 'undefined'){$_POST['resolucion'] = 0;}
if ($_POST['forma_pago']== 'undefined'){$_POST['forma_pago'] = 0;}

include('../valotablapc.php');
//$sql_actualizar_orden = "update  $tabla14  set (factura,placa,sigla,fecha,observaciones,radio,antena,repuesto,herramienta,otros) 
$sql_actualizar_orden = "update  $tabla14  set 
resolucion = '".$_POST['resolucion']."',
estado = '20',
where id = '".$_POST['orden_numero']."'
and id_empresa = '".$_SESSION['id_empresa']."'
";

//echo '<br>'.$sql_actualizar_orden;
//exit();

$consulta_actualizar_orden = mysql_query($sql_actualizar_orden,$conexion); 

///////////////////////////////
$traer_suma_items = "select sum(total_item)  as  sumaitems from  $tabla15 i   
inner join $tabla14 o  on (o.id = i.no_factura) 
where o.id = '".$_POST['orden_numero']."'
 and o.id_empresa =  '".$_SESSION['id_empresa']."'  ";
$consulta_traer_suma  = mysql_query($traer_suma_items,$conexion);
$suma_items = mysql_fetch_array($consulta_traer_suma);
$sumaitems = 	$suma_items['sumaitems'];
//////////////////////////////



$siguiente_numero = $_POST['orden_numero'];   
//osea que el numero de la factura sea el del id de la orden pero si tiene resolucion sera modificado 
//esto esta bien si fuera una sola empresa pero cuando hay varias empresas cada una debe llevar su contador de cotizaciones
//ahora 01042015  si no es factura con resolucion simplemente se colocara el siguiente numero de cotizacion 

$prefijo = '';
$valor_iva = 0;
$valor_retefuente = 0;

if ($_POST['resolucion'] == '1')
     {                    
						 $sql_traer_numero_factura_con_resolucion =
						  "select contafac,prefijo_factura from  $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  " ;
						 // echo '<br>'.$sql_traer_numero_factura_con_resolucion.'<br>';
						 $numero_ultima_factura = mysql_query($sql_traer_numero_factura_con_resolucion,$conexion); 
						 $ultima_factura = mysql_fetch_assoc($numero_ultima_factura);
						 /*
						 echo '<pre>';
						print_r($ultima_factura);
						echo '</pre>';
						*/
						 $prefijo = $ultima_factura['prefijo_factura'];
						 $ultima_factura = $ultima_factura['contafac'];	
						 $siguiente_numero  = $ultima_factura + 1;
						//echo '<br>contafac'.$ultima_factura.'siguiente numero '.$siguiente_numero;
						 //exit(); 
					   $actualizar_contafac_empresa  = "update empresa set contafac = '".$siguiente_numero."'    
						where   id_empresa = '".$_SESSION['id_empresa']."'    ";
						//echo '<br>'.$actualizar_contafac_empresa.'<br>';
						  $actualizar_contafac = mysql_query($actualizar_contafac_empresa,$conexion); 
						  //////////////////////////////////
						  $sql_traer_valor_iva = "select iva from $tabla17";
						  //echo '<br>'.$sql_traer_valor_iva.'<br>';
						  $consulta_iva = mysql_query($sql_traer_valor_iva,$conexion); 
						  $iva = mysql_fetch_array($consulta_iva);
						  	/*
						  	echo '<pre>';
							print_r($iva);
							echo '</pre>';
							*/
						  $iva = $iva[0];
						  //echo '<br>ivaaaaaaaaaaaaaaaaaaaaaaaaaaa'.$iva;
						  /////////////////////////////////
						  $valor_iva = ($sumaitems * $iva)/100; 
						

	  }//fin de si reolucion == 1 
else  {   //osea si no se le va a cobrar el iva , en el caso de las empresas de regimen simplificado siempre seran sin iva 

						$sql_traer_numero_cotizacion =
						  "select contacot from  $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  " ;
						 // echo '<br>'.$sql_traer_numero_factura_con_resolucion.'<br>';
						 $numero_ultima_cotizacion = mysql_query($sql_traer_numero_cotizacion,$conexion); 
						 $ultima_cotizacion = mysql_fetch_assoc($numero_ultima_cotizacion);
						 $ultima_cotizacion = $ultima_cotizacion['contacot'];	
						 $siguiente_numero  = $ultima_cotizacion + 1; 

						 $actualizar_contacot_empresa  = "update empresa set contacot = '".$siguiente_numero."'    
						 where   id_empresa = '".$_SESSION['id_empresa']."'    ";
						 $actualizar_contacot = mysql_query($actualizar_contacot_empresa,$conexion); 
      } //fin de else si reolucion == 1 

$valor_total = 	$sumaitems + $valor_iva;
$conprefijo = $prefijo.$siguiente_numero;
///////////////////////aqui se realiza la creacion de la factura en la tabla facturas 
$crear_factura = "insert into $tabla11 (numero_factura,fecha, sumaitems,id_empresa,id_orden,resolucion,placa,valor_iva,total_factura,valor_retefuente,
	elaborado_por,tipo_factura,forma_pago)
 values (
 '$conprefijo','$fechapan','".$sumaitems."','".$_SESSION['id_empresa']."',
 '".$_POST['orden_numero']."' 
 ,'".$_POST['resolucion']."'
 ,'".$_POST['placa']."'
  ,'".$_POST['suma_total_iva']."'
  ,'".$_POST['total_final_factura']."'
  ,'".$_POST['valor_retefuente']."'
   ,'".$_POST['elaborado_por']."'
   ,'1'
    ,'".$_POST['forma_pago']."'
 
 )"; 

//echo '<br>'.$crear_factura.'<br>';

/////ahora traer el id de la factura para poderla vizualizar
$consulta_crear = mysql_query($crear_factura,$conexion);
$sql_traer_id_factura  = "select id_factura from  $tabla11 where id_orden = '".$_POST['orden_numero']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_id_factura = mysql_query($sql_traer_id_factura,$conexion);  
$id_factura = mysql_fetch_assoc($consulta_id_factura);
/*
echo '<pre>';
print_r($id_factura);
echo '</pre>';
*/

 
//exit();
////////////////////////////////////
////ahora se deben registrar los movimientos de inventario en la tabla de movimientos 
///primero se deben traer los items respectivos de la factura 

$sql_traer_items_factura = "select * from $tabla15 where no_factura = '".$_POST['orden_numero']."' and id_empresa = '".$_SESSION['id_empresa']."' "; 
$consulta_items = mysql_query($sql_traer_items_factura,$conexion);
while($items_factura = mysql_fetch_array($consulta_items)) 
		{
		    //conseguir el id del codigo del producto se busca con el codigo y la empresa en productos
			$sql_id_producto = "select  p.id_codigo  from $tabla15 as i
			inner join $tabla12 as p on (i.codigo = p.codigo_producto)
			inner join $tabla11 as f on (f.id_orden = i.no_factura)
			where p.codigo_producto = '".$items_factura[2]."' 
			and p.id_empresa =  '".$_SESSION['id_empresa']."'
			and i.no_factura = '".$_POST['orden_numero']."'
			";
			
			//echo '<br>'.$sql_id_producto;
			
			$consulta_id_producto  = mysql_query($sql_id_producto,$conexion);
			$id_producto = mysql_fetch_assoc($consulta_id_producto);
			/*
			echo '<pre>';
			print_r($id_producto);
			echo '</pre>';
			*/
			
			//echo '<br>'.$items_factura[0] ;
			$sql_registrar_movimiento = "insert into $tabla19 (fecha_movimiento,cantidad,observaciones,tipo_movimiento,id_factura_venta,id_empresa,id_codigo_producto)     
			values ('".$fechapan."','".$items_factura[4]."','Salida_Inventario','3','".$id_factura['id_factura']."','".$_SESSION['id_empresa']."','".$id_producto['id_codigo']."' ) ";
			
//echo '<br>'.$sql_registrar_movimiento;
$consulta_registrar_movimiento = mysql_query($sql_registrar_movimiento,$conexion) ;
		}
///////////////////////////////////
echo "<h2>FACTURA CREADA</h2>";
echo "<a href='factura_imprimir.php?id_factura=".$id_factura['id_factura']."'  target='_blank' ><h2>Vista Impresion Factura</h2></a>";
include('../colocar_links2.php');

//echo "<br><a href='../menu_principal.php' >Pagina Principal</a>";
//echo "<br><a href='index.php' >Menu Facturas</a>";
//<a href="#">#</a>
?>