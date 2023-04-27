<?php

class ventasVista
{


    public function pantallaPrincipalVentas()
    {
        ?>
        <div id= "div_principal_ventas">
            <div id="div_botones_ventas" class ="row">
                <div class ="col-md-3">
                    <button class="btn btn-primary" onclick="pantallaNuevaVenta();">Nueva Venta</button>
                </div>
                <div class ="col-md-3"></div>
                <div class ="col-md-3"></div>
                <div class ="col-md-3"></div>
            </div>
            <div id="div_resultado_ventas">

            </div>
            <?php  $this->modalAgregarItems(); ?>
            <?php  $this->modalFiltrosCodigosNew(); ?>
        </div>
        <?php
    }
    public function modalAgregarItems (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div  class="modal fade" id="myModalAgregarItems" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header" id="headerNuevaOrden">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">BUSCAR CODIGO </h4>
                  </div>
                  <div id="cuerpoModalAgregarItems" class="modal-body">
                      
                      
                  </div>
                  <div class="modal-footer" id="footerNuevoCliente">
                      <button  type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function modalFiltrosCodigosNew (){
        ?>
         <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
         Launch demo modal
         </button> -->
          <div class="modal fade" id="myModalFiltrosCodigosNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Filtros Codigos New</h4>
                  </div>
                  <div id="cuerpoModalFiltrosCodigosNew" class="modal-body">
         
                      
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
    public function pantallaNuevaVenta()
    {
        ?>
        <div id="div_nueva_venta">
            <div id="div_previzualizar_codigo">
                <div id ="div_filtros_codigo">
                  <button
                    class="btn btn-primary"
                    data-toggle="modal" data-target="#myModalAgregarItems" 
                    onclick="pregunteItemsNewVentas();"
                  >Agregar Item</button>
                </div>
                <div id="div_muestre_info_codigo">
                    <table>
                        <tr>
                            <td>Codigo</td>
                            <td>Referencia</td>
                            <td>Descripcion</td>
                            <td>Valor</td>
                            <td>Cantidad</td>
                            <td>Total</td>
                            <td>Agregar</td>
                            
                        </tr>
                    </table>
                </div>

            </div>
            <div id="div_final_venta">

            </div>
        </div>

        <?php
    }

    public function pregunteNuevoItemNewVentas()
    {
      ?> 
      <div  style="color:black">
          <div class="row">
              <div class="col-xs-2">
              </div>   
              <div class="col-xs-4">
                  <button  
                  onclick="filtroBuscarCodigoIngresoOrdenNew();"
                  class="btn btn-primary" 
                  data-toggle="modal" data-target="#myModalFiltrosCodigosNew"
                  >
                  <i class="fas fa-search" ></i> 
                  BUSCAR CODIGO
              </button>
              
          </div>
          <div class="col-xs-4">
              <button
              class="btn btn-primary" 
                  onclick= "cerrarventanaItems();"
              >
                  CERRAR 
              </button>
          </div>    
          <div class="col-xs-2">
              </div>  
  
  
          </div>
          <br>
          <input type = "hidden" value= "<?php echo $id ?>">
          <div class="row form-group">
              <div class="col-xs-3">
                  <label >Codigo:</label>
              </div>
              <div class="col-xs-7">
                  <!-- Codigo:<input type="text" id = "codNuevoItem" onblur="verifiqueCodigo();"> -->
                  <input class ="form-control" 
                          type="text" 
                          id = "codNuevoItem" 
                          onkeyup="verificarSiExisteCodigo();"
                  >
              </div>
          </div>
          <div class="row form-group">
              <div class="col-xs-3">
                  <label >Referencia:</label>
              </div>
              <div class="col-xs-7">
                  <input class ="form-control" type="text" id = "referenciapan" >
              </div>
          </div>
          <div class="row form-group">
              <div class="col-xs-3">
                  <label >Descripcion:</label>
              </div>
              <div class="col-xs-7">
                  <input class ="form-control" type="text" id = "descripan" ">
              </div>
          </div>
          <div class="row form-group">
              <div class="col-xs-3">
                  <label > Valor Unit:</label>
              </div>
              <div class="col-xs-7">
                  <input class ="form-control" type="text" id = "valorUnitpan" ">
              </div>
          </div>
          <div class="row form-group">
              <div class="col-xs-3">
                  <label > Cantidad: <span id="existencias" style="color:green;"></span><input type ="hidden" id="inputexistencias"></label>
              </div>
              <div class="col-xs-7">
  
                  <input class ="form-control" 
                      type="text" 
                      id = "cantipan" 
                      onkeyup="generarTotalItem();"
                  >
              </div>
          </div>
      
          <div class="row form-group">
              <div class="col-xs-3">
                  <label > Total:</label>
              </div>
              <div class="col-xs-7">
                  <input class ="form-control" type="text" id = "totalItem" onfocus="blur();" >
              </div>
          </div>
      
          <div class="row">
              <div class="col-xs-6">
                  <button class="btn btn-primary"  
                          data-dismiss="modal"
                          onclick="cerrarVentanaNuevoItem();"
                  >Cancelar</button>
              </div>
              <div class="col-xs-6">
                  <button class="btn btn-primary" 
                          id = "grabarNuevoItem" 
                          data-dismiss="modal"
                          onclick="agregarItemVenta();"
                          >Grabar Item</button>
                          <!-- onclick="grabarNuevoItemNew();" -->
              </div>
          </div>
      </div>
      <?php
    }




}



?>