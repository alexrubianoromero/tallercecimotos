function pantallaNuevaVenta()
{
    // alert('ventas ');
    const http=new XMLHttpRequest();
    const url = '../ventas/ventas.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            document.getElementById("div_resultado_ventas").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=pantallaNuevaVenta');
}


function pregunteItemsNewVentas(){
    //    alert('digfame el item ');
       //muestre ventana apara introducir nuevo item 
    //    var idOrden =  document.getElementById("idOrden").value;
       const http=new XMLHttpRequest();
       const url = '../ventas/ventas.php';
       http.onreadystatechange = function(){
           if(this.readyState == 4 && this.status ==200){
               document.getElementById("cuerpoModalAgregarItems").innerHTML = this.responseText;
            }
        };
        
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=pregunteNuevoItemNewVentas"
        // + "&idOrden="+idOrden
        );
    }
