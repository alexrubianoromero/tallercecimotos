<!DOCTYPE html>
<html >
<!-- <html lang="es"  class"no-js">
-->

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
<?php 
include('../valotablapc.php');
$sql_carros ="select idcarro,placa from $tabla4";
$consulta_placas = mysql_query($sql_carros,$conexion);
?>
<Div id="contenidos" align="center">
		<header>
			<h3 align="center">POR FAVOR ESCRIBA LA PLACA </h3>
		</header>


	    <div id="muestrepplacas2_honda" align="center">
	      <table width="520" border="0">
	        <tr>
	          <td width="210">     <h3>
	            <input type="placa"  id = "placa123" name="placa123" class="fila_llenar"  size ="10" placeholder="PLACA">
                </h3></td>
      <td width="294" align="center"><h3>
        <label>      </label>
        </h3><button type ="button"  id = "consultar_placa" ><h3>CONSULTAR</h3></button></td>
    </tr>
	        <tr>
	          <td> <button type ="button"  id = "crear_orden" ><h3>SIGUIENTE</h3></button></td>
      <td><div  id = "consulta_placa"></div></td>
    </tr>
	        <tr>
	          <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	        <tr>
	          <td height="87" colspan="2"><h3><label  for="casilla_carros" > NUEVA PLACA </label> 
              <input type="checkbox" name="casilla_carros" id = "casilla_carros"  value="checkbox" /></h3></td>
      </tr>
	        <tr>
	          <td height="87" colspan="2"><?php  //include('../colocar_links2.php');  ?></td>
    </tr>
          </table>
  </div>
</Div>

<div id = "carros123" align="center">
</div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
			   /*
			    $("#empresapan").change(function(event){
                    var cod = $("#empresapan").find(':selected').val();
                    $("#resultados").load('muestre_datos_cliente.php?cod='+cod );
                });
				*/
	
						///////////////////////
			           ///////////////////////
				
				
				///////////////////////////////////
				
					$("#casilla_carros").click(function(event) {
							    if($(this).is(":checked")) 
								{ 
										 $("#carros123").load('pregunte_datos_nuevo_carro.php');
										//alert('Se hizo check en el checkbox.');
							  
							  
							  	} else {
										//alert('Se destildo el checkbox');
										$("#carros123").html('');
							  }	  
					  });
					  //////////////////////////
					  
					  $("#crear_orden").click(function(){
								var placa123 =$("#placa123").val();
								$(window).attr('location', 'orden_captura_honda.php?placa123='+placa123);
									//alert(data);
								});	
							//});
							
					  /////////////////////////
					  $("#consultar_placa").click(function(){
							var data =  'placa=' + $("#placa123").val();
							$.post('consultar_placa.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#consulta_placa").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					  
					
					//////////////////////////////
		 });			
          	
</script>