<?php
session_start();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../num2letras.php'); 
 $letras = num2letras($datos[0]['totalfac']);
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<? include("../empresa.php");
//echo '<br>empresa <br>'.$empresa.'<br>' ; 

$sql_traer_datos_recibo   = "select *  from $tabla23  where  numero_recibo = '".$_REQUEST['numero']."'  and id_empresa = '".$_SESSION['id_empresa']."'  and anulado = '0' ";
$consulta_datos_recibo = mysql_query($sql_traer_datos_recibo,$conexion);
$datos_recibo = mysql_fetch_assoc($consulta_datos_recibo);


$letras = num2letras( $datos_recibo['lasumade']);
/*
echo '<pre>';
print_r($datos_recibo);
echo '</pre>';
*/
 if($datos_recibo['tipo_recibo']== '1')
	 		{
				$recibidopagado =  'RECIBIDO DE';
				$ingresoegreso  = 'INGRESO';	
			}
	  if($datos_recibo['tipo_recibo']== '2'){$recibidopagado= 'PAGADO A';$ingresoegreso  = 'EGRESO';	}

$ancho_tabla= '95%';	  
?>
<Div id="contenidos">
<h4>

<table width="95%" border="0">
  <tr>
    <td width="17%"><div align="center"><img src="../logos/motoracing.png" width="210" height="168"></div></td>
    <td width="46%"><div align="center"><img src="../imagenes/honda_orden/todosjuntos.jpg" width="422" height="137"></div></td>
  
  </tr>
</table>
<br>
<table width="95%" border="1">
  <tr>
    <td>RECIBO <?php echo $ingresoegreso ?> NUMERO </td>
    <td><?php echo $datos_recibo['numero_recibo'] ?></td>
  </tr>
  <tr>
    <td width="45%">FECHA:</td>
    <td width="55%"><?php echo $datos_recibo['fecha_recibo'] ?></td>
  </tr>
  <tr>
    <td>
	 <?php
	
	  echo $recibidopagado;
	 ?>	</td>
    <td><?php echo $datos_recibo['dequienoaquin'] ?></td>
  </tr>
  <tr>
    <td>LA SUMA DE (numeros) </td>
    <td><?php echo $datos_recibo['lasumade'] ?></td>
  </tr>
    <tr>
    <td></td>
    <td colspan="2">Efectivo:<?php echo $datos_recibo['efectivo'] ?>
      T_Debito:<?php echo $datos_recibo['t_debito'] ?>
      T_Credito:<?php echo $datos_recibo['t_credito'] ?>

    </td>
  </tr>
  
  <tr>
    <td>Valor en letras </td>
    <td><?php  echo $letras.' Pesos M/cte';  ?> </td>
  </tr>
  <tr>
    <td>POR CONCEPTO DE : </td>
    <td><textarea name="porconceptode" id = "porconceptode" cols="80%" rows="2"><?php echo $datos_recibo['porconceptode'] ?></textarea></td>
  </tr>
  <tr>
    <td>OBSERVACIONES</td>
    <td><textarea name="observaciones" id = "observaciones" cols="80%" rows="2"><?php echo $datos_recibo['observaciones'] ?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>FIRMA</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><textarea name="textarea" cols="80" rows="5"></textarea></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
	
	
</table>
<table width="95%" border="0">
<tr>
    <td colspan="2" align = "center"><?php  echo $direccion.'-'.$telefono; ;  ?></td>
    </tr>
</table>



</h4>
</Div>
	
</body>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   
</html>




 


