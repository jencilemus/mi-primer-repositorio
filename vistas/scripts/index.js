var tabla;
function init(){
    mostrarf();
    mostrari();
    mostrarv();
    mostrarmax();
    listar();
    precios();
    var today=new Date();
    var day=today.getDate();
    var month=today.getMonth();
    var year=today.getFullYear();
    var mes=1+parseFloat(month);
    fecha2.value=day+"/"+mes+"/"+year;
    $("#fecha2").val(fecha2.value);
    fecha1.value="Fecha de la factura:    "+day+"/"+mes+"/"+year;
    $("#fecha1").html(fecha1.value);

    $.post("../ajax/factura.php?opc=listapro", function(r){
		$("#producto").html(r);
});
$.post("../ajax/factura.php?opc=listaven", function(r){
    $("#vendedores").html(r);
});
$("#formulario").on("submit", function(e){
        guardarRegistro(e);
        } );
}
var contar=0;
var detalles=0;
function precios(){
	pro=producto.value;
$.post("../ajax/factura.php?opc=listaprecio",{"pro" : pro}, function(r)
	{	
		$("#precio").html(r);
 	})
}
function mostrar(){
    pro=producto.value;
$.post("../ajax/factura.php?opc=mostrar",{"pro" : pro}, function(data, status)
	{
		data = JSON.parse(data);
		/// # es de la vista, data es de la tabla
		$("#codigo").val(data.codigo);
        $("#unidad").val(data.unidad);
		
 	})
}
function mostrarf(){
    
    var today=new Date();
    var day=today.getDate();
    var month=today.getMonth();
    var year=today.getFullYear();
    var mes=1+parseFloat(month);
    fecha2.value=day+"/"+mes+"/"+year;
    var fecha3=fecha2.value;
$.post("../ajax/factura.php?opc=mostrarf",{"fecha3" : fecha3}, function(r)
	{
		
		/// # es de la vista, data es de la tabla
        const onlyNumbers = r.replace(/[^0-9]+/g, "");
        $("#ventasactuales").html(onlyNumbers);
		
 	})
}
function mostrari(){
    
    var today=new Date();
    var day=today.getDate();
    var month=today.getMonth();
    var year=today.getFullYear();
    var mes=1+parseFloat(month);
    fecha2.value=day+"/"+mes+"/"+year;
    var fecha3=fecha2.value;
$.post("../ajax/factura.php?opc=mostrari",{"fecha3" : fecha3}, function(r)
	{
		
		/// # es de la vista, data es de la tabla
        const onlyNumbers = r.replace(/[^0-9.]+/g, "");
        var numero=Number((parseFloat(onlyNumbers)).toFixed(2));
        $("#ingresosdia").html("L. "+numero);
		
 	})
}
function mostrarmax(){
    
    var today=new Date();
    var day=today.getDate();
    var month=today.getMonth();
    var year=today.getFullYear();
    var mes=1+parseFloat(month);
    fecha2.value=day+"/"+mes+"/"+year;
    var fecha3=fecha2.value;
$.post("../ajax/factura.php?opc=mostrarmax",{"fecha3" : fecha3}, function(r)
	{
		
		/// # es de la vista, data es de la tabla
        const onlyNumbers = r.replace(/[^0-9.]+/g, "");
        var numero=Number((parseFloat(onlyNumbers)).toFixed(2));
        $("#ventamasalta").html("L. "+numero);
		
 	})
}
function mostrarv(){
    var today=new Date();
    var day=today.getDate();
    var month=today.getMonth();
    var year=today.getFullYear();
    var mes=1+parseFloat(month);
    fecha2.value=day+"/"+mes+"/"+year;
    var fecha3=fecha2.value;
$.post("../ajax/factura.php?opc=mostrarv1", {"fecha3" : fecha3}, function(r)
	{
		
		/// # es de la vista, data es de la tabla
        const onlyNumbers = r.replace(/[^0-9.]+/g, "");
        var vendedor1=Number((parseFloat(onlyNumbers)).toFixed(2));
		$.post("../ajax/factura.php?opc=mostrarv2",{"fecha3" : fecha3}, function(r)
     {
         
         /// # es de la vista, data es de la tabla
         const onlyNumbers = r.replace(/[^0-9.]+/g, "");
         var vendedor2=Number((parseFloat(onlyNumbers)).toFixed(2));
         if(vendedor2>vendedor1){
            $("#vendedormasventas").html("Daniel Argeñal");
        }else{
            $("#vendedormasventas").html("Carlos Argeñal");
        }
    })
 	})
     
      
}

function validar(){
    var val=0;
    if(""==codigocliente.value){
        alert("Ingrese el codigo del cliente");
        val++;
    }
    if(""==cliente.value){
        alert("Ingrese el cliente");
        val++;
    }
    if(""==rtn.value){
        alert("Ingrese el rtn");
        val++;
    }
    if(0==val){
        document.getElementById("ingresar").disabled=false; 
    }else{
        document.getElementById("ingresar").disabled=true; 
    }        
}
function validarproducto(){
    var val=0;
    
    if(0>cantidad.value){
        alert("Ingrese una cantidad correcta");
        val++;
    }
    if(0==val){
        document.getElementById("btn1").disabled=false; 
    }else{
        document.getElementById("btn1").disabled=true; 
    }        
}
function vaciar(){
    codigo.value="";
    cantidad.value="";
}
function clientec(){
    clienten.value="Facturar a "+'<br><strong>'+cliente.value+'</strong><br>'+telefono.value;
    $("#clienten").html(clienten.value);
    vendedorc();
}
function vendedorc(){
    vendedor1.value="Vendedor:    "+vendedores.value;
    $("#vendedor1").html(vendedor1.value);
}
function calcular(){
    impuesto15();
    calculartotal();
    vendedorc();
    clientec();
    $("#cargo").html(parseFloat(cargoenvio.value));
    precios();
    mostrar();
}
function calculartotal(){
    var sumasb=0.00;
    var totale=0.00;
    var sub2=document.getElementsByName("subtotal[]");
    for(i=0; i<sub2.length; i++){
        sb=sub2[i];
        sumasb+=parseFloat(sb.value);
    }
    totale=sumasb;
    $("#subtotal").html(totale);    
}
function verificarcantidad(){
    var cant1=document.getElementsByName("cantidad[]");
    var precio1=document.getElementsByName("precio[]");
    var sub=document.getElementsByName("subtotal[]");
    for(i=0; i<cant1.length; i++){
        if(0>=cant1[i].value){
            alert("Ingresar cantidad mayor que 0 en el campo.");
        }else if(0>=precio1[i].value){
            alert("Ingresar precio mayor que 0 en el campo.");
        }else{
            alert("Hola subtotal"+cant1[i].value);
            sb=cant1[i].value*precio1[i].value;
            alert("hola"+sb);
            sub[i]=sb;
        }
    }
}

function validarefectivo(){
    var sub1=document.getElementsByName("subtotal[]");
    var sumasb=0.00;
    var totale=0.00;
    for(i=0; i<sub1.length; i++){
        sb=sub1[i];
        sumasb+=parseFloat(sb.value);
    }
    totale=sumasb;
    if(efectivo.value>=totale){
        cambio.value=efectivo.value-totale;
        alert("Su saldo es suficiente para el pago.");
        alert("Su cambio es de: "+cambio.value);
        guardarRegistro();
    }else{
        alert("Saldo insuficiente para el pago\nIntenta otra vez.");
    }
    $("#cambio").html(cambio.value);
}
function impuesto15(){
    var sub2=document.getElementsByName("subtotal[]");
    var impuesto15=0.00;
    var sumaimp15=0.00;
    var total=0.00;
    for(i=0; i<sub2.length; i++){
        sumaimp15+=parseFloat(sub2[i].value);
    }
    var sumasb=0.00;
    var totale=0.00;
    var sub2=document.getElementsByName("subtotal[]");
    for(i=0; i<sub2.length; i++){
        sb=sub2[i];
        sumasb+=parseFloat(sb.value);
    }
    totale=sumasb;
    impuesto15=Number((parseFloat(totale)*1.15-parseFloat(totale)).toFixed(2));
    total=Number((parseFloat(impuesto15)+parseFloat(cargoenvio.value)+totale).toFixed(2))
    $("#totalimpuesto15").html(parseFloat(impuesto15));
    $("#total").html(parseFloat(total));
}

function eliminarfila(fi){
    $("#filas"+fi).remove();
    detalles--;
    calcular();
    validar();
}
function guardarRegistro(){
		
    //	e.preventDefault(); //No se activará la acción predeterminada del evento	
        var formData = new FormData($("#formulario")[0]);
        $.ajax({
            url: "../ajax/factura.php?opc=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
    
            success: function(datos)
            {                    
                  //alert(datos);	 
                  Swal.fire(
                    'Factura guardado!',
                    'Ingreso registrado!',
                    'success'
                  )           	              	          
                  tabla.ajax.reload();
            }
    
        });
        listar();
}
    /*tbllistado*/
function listar(){
    
        tabla=$('#tbllistado').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginación y filtrado realizados por el servidor
            "responsive": true, "lengthChange": false, "autoWidth": false,
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            buttons: [		          
                   'copyHtml5','excelHtml5','csvHtml5','pdf'
                    ],
            "ajax":
                    {
                        url: '../ajax/factura.php?opc=listar',
                        type : "get",
                        dataType : "json",						
                        error: function(e){
                            console.log(e.responseText);	
                        }
                    },
            "bDestroy": true,
            "paging": true,
            
            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
        }).DataTable();
}
function imprimir(){
    window.addEventListener("load", window.print());
}

init();