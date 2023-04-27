<?php

$raiz = dirname(dirname(dirname(__file__)));
// echo $raiz;

//  die();
require_once($raiz.'/ventas/vista/ventasVista.php');
class ventasController
{
    protected $vista;
    public function __construct()
    {
        $this->vista = new ventasVista();
        // echo 'llego a controlador '; 
        if($_REQUEST['opcion']=='pantallaPrincipalVentas'){
            $this->pantallaPrincipalVentas($_REQUEST);
       }       
        if($_REQUEST['opcion']=='pantallaNuevaVenta'){
            $this->pantallaNuevaVenta($_REQUEST);
       }       
        if($_REQUEST['opcion']=='pregunteNuevoItemNewVentas'){
            $this->pregunteNuevoItemNewVentas($_REQUEST);
       }       
    }


    public function pantallaPrincipalVentas($request)
    {
        $this->vista->pantallaPrincipalVentas();
    }
    public function pantallaNuevaVenta($request)
    {
        $this->vista->pantallaNuevaVenta();
    }
    public function pregunteNuevoItemNewVentas($request){

        $this->vista->pregunteNuevoItemNewVentas();
    }
}

?>