<?php
session_start();
				/*
				echo '<pre>';
				print_r($_GET);
				echo '</pre>';
				*/

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
<? 
include("../empresa.php");
include('../valotablapc.php');
include('../funciones.php');
include('../colocar_links2.php');

$sql_clientes = "select * from $proveedores where idcliente = '".$_GET['idcliente']."'   and  id_empresa = '".$_SESSION['id_empresa']."'   ";
//echo '<br>'.$sql_clientes;

$consulta_clientes = mysql_query($sql_clientes,$conexion);

$filas = mysql_num_rows($consulta_clientes); 

//echo '<br>'.$filas;
if ($filas  > 0)
			{   
			 $datos = get_table_assoc($consulta_clientes);
			 	/*
				echo '<pre>';
				print_r($datos);
				echo '</pre>';
				*/
			 
			 ?>
			 <br> <br>
			 <form name = "formu1"  action = "actualize_datos_cliente.php"  method = "post">
			<table width="572" border="1">
  <tr>
    <td width="248">&nbsp;</td>
    <td width="308">&nbsp;</td>
  </tr>
  <tr>
    <td>IDENTIFICACION</td>
    <td><input name="identi" id  = "identi" type="text"  value = "<?php  echo $datos[0]['identi']?> " > </td>
  </tr>
  <tr>
    <td>EMPRESA</td>
    <td><input name="nombre" id  = "nombre" type="text"  value = "<?php  echo $datos[0]['nombre'] ?> "   ></td>
  </tr>
   <tr>
    <td>CONTACTO</td>
    <td><input name="contacto" id  = "contacto" type="text"  value = "<?php  echo $datos[0]['contacto'] ?> "   ></td>
  </tr>
  <tr>
    <td>DIRECCION</td>
    <td><input name="direccion" id  = "direccion" type="text"  value = "<?php  echo $datos[0]['direccion']?> "></td>
  </tr>
  <tr>
    <td>TELEFONO</td>
    <td><input name="telefono" id  = "telefono" type="text"  value = "<?php  echo $datos[0]['telefono']?> "></td>
  </tr>
  <!--
  <tr>
    <td>ENTIDAD</td>
    <td><input name="entidad" id  = "entidad" type="text"  value = "<?php  //echo $datos[0]['entidad']?> "></td>
  </tr>

-->
  <tr>
    <td>EMAIL</td>
    <td><input name="email" id  = "email" type="text"  value = "<?php  echo $datos[0]['email']?> "></td>
  </tr>
  <tr>
    <td>OBSERVACIONES </td>
    <td><input name="observaci" id  = "observaci" type="text"  value = "<?php  echo $datos[0]['observaci']?> "></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="idcliente" id  = "idcliente" type="hidden"  value = "<?php  echo $datos[0]['idcliente']?> "></td>
  </tr>
  <tr>
    <td colspan="2"><button type ="submit"  id = "actualizar_cliente" ><h3>Actualizar</h3></button></td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>

			
			<?php
			 }
 else      { echo '<br> NO EXISTE INFORMACION ACERCA DE ESTA PERSONA';}			
			  
 ?>


</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
			   
			   /////////////////
			  
			   ////////////////
			   
			   
			  
						$("#actualizar_cliente").click(function(){
							var data =  'idcliente=' + $("#idcliente").val();
								data += '&identi=' + $("#identi").val();
								data += '&nombre=' + $("#nombre").val();
								data += '&telefono=' + $("#telefono").val();
								data += '&direccion=' + $("#direccion").val();
								//data += '&entidad=' + $("#entidad").val();
								data += '&email=' + $("#email").val();
								data += '&observaci=' + $("#observaci").val();
								data += '&contacto=' + $("#contacto").val();

							$.post('actualize_datos_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
		
					
		 });	//fin de la funcion principal 		
          	
</script>


