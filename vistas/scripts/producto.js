
var tabla;
function init(){
	limpiar();
	listar();
	$.post("../ajax/producto.php?opc=listapr", function(r){
		$("#proveedores").html(r);
		$('#proveedores').selectpicker('refresh');
});
var today=new Date();
var day=today.getDate();
var month=today.getMonth();
var year=today.getFullYear();
var mes=1+parseFloat(month);
    fechacreacion.value=day+"/"+mes+"/"+year;

	$("#formulario").on("submit", function(e){
	guardarRegistro(e);
	} );


}
function reporte1(id){
	if(id==0){
		window.location.href="../reportes/rptproducto.php";
	}else{
		window.location.href="../reportes/rptproducto.php?id="+id;
	}
	
}
function calcular(){
	calcularprecio();
	calcularporcentaje()
}
function calcularprecio(){
	precio1.value=Number(((porcentaje1.value/100)*costo.value)+parseFloat(costo.value)).toFixed(2);
	precio2.value=Number(((porcentaje2.value/100)*costo.value)+parseFloat(costo.value)).toFixed(2);
	precio3.value=Number(((porcentaje3.value/100)*costo.value)+parseFloat(costo.value)).toFixed(2);
}
function calcularporcentaje(){
	porcentaje1.value=Number(((parseFloat(precio1.value)-parseFloat(costo.value))/(costo.value))*100).toFixed(2);
	porcentaje2.value=Number(((parseFloat(precio2.value)-parseFloat(costo.value))/(costo.value))*100).toFixed(2);
	porcentaje3.value=Number(((parseFloat(precio3.value)-parseFloat(costo.value))/(costo.value))*100).toFixed(2);
}
function activar(idcategoria){

	Swal.fire({
		title: 'Desea activar el registro?',
		text: "Esta seguro de activar el registro",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, activar!'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.post("../ajax/producto.php?opc=activar", {idcategoria : idcategoria}, function(e){
				Swal.fire(
					'Activado!',
					'El producto ha sido activado.',
					'success'
				  )
	            tabla.ajax.reload();

        	});	
		  
		}
	  })


/*
bootbox.confirm("¿Está Seguro de activar la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/proveedor.php?opc=activar", {idcategoria : idcategoria}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})*/
	
}
function desactivar(idcategoria){

	Swal.fire({
		title: 'Desea desactivar el registro?',
		text: "Esta seguro de desactivar el registro",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, desactivar!'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.post("../ajax/producto.php?opc=anular", {idcategoria : idcategoria}, function(e){
				Swal.fire(
					'Desactivado!',
					'El producto ha sido desactivado.',
					'success'
				  )
	            tabla.ajax.reload();

        	});	
		  
		}
	  })


	/*bootbox.confirm("¿Está Seguro de anular la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/proveedor.php?opc=anular", {idcategoria : idcategoria}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})*/
	
}
function mostrar(idcategoria){
	$("#exampleModalCenter").modal('show');
$.post("../ajax/producto.php?opc=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);
		/// # es de la vista, data es de la tabla
		$("#idproducto").val(data.idproducto);
		$("#codigo").val(data.codigo);
		$("#producto").val(data.producto);
		$("#proveedores").val(data.idproveedor);
		$("#costo").val(data.costo);
		$("#existencia").val(data.existencia);
		$("#porcentaje1").val(data.porcentaje1);
		$("#porcentaje2").val(data.porcentaje2);
		$("#porcentaje3").val(data.porcentaje3);
		$("#precio1").val(data.precio1);
		$("#precio2").val(data.precio2);
		$("#precio3").val(data.precio3);
		$("#clasi").val(data.clasificacion);
		$("#unidad").val(data.unidad);
		$("#imagenmuestra").show();
	 $("#imagenmuestra").attr("src","../files/producto/"+data.imagen);
		$("#fechacreacion").val(data.fechacreacion);
		generarbarcode();
 	})
}
function limpiar(){
	$("#idproducto").val("");
		$("#codigo").val("");
		$("#producto").val("");
		$("#proveedores").val("");
		$("#costo").val("");
		$("#existencia").val("");
		$("#impuesto").val("");
		$("#imagen").val("");
		$("#porcentaje1").val("");
		$("#porcentaje2").val("");
		$("#porcentaje3").val("");
		$("#precio1").val("");
		$("#precio2").val("");
		$("#precio3").val("");
		$("#clasi").val("");
		$("#unidad").val("");
		var today=new Date();
var day=today.getDate();
var month=today.getMonth();
var year=today.getFullYear();
var mes=1+parseFloat(month);
    fechacreacion.value=day+"/"+mes+"/"+year;
		$("#fechacreacion").val(fechacreacion.value);
		esconderbarcode();
		$("#imagenmuestra").hide();
}
function guardarRegistro(){
		
//	e.preventDefault(); //No se activará la acción predeterminada del evento	
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/producto.php?opc=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          //alert(datos);	 
			  Swal.fire(
				'Registro guardado!',
				'Producto registrado!',
				'success'
			  )           	              	          
	          tabla.ajax.reload();
	    }

	});
	limpiar();
	listar();
	$("#exampleModalCenter").modal('hide');
}
function generarbarcode(){
    codigo=$("#codigo").val();
    JsBarcode("#barcode", codigo);
    $("#print").show();
	document.getElementById("guardar").disabled=false; 
}
function esconderbarcode(){
    JsBarcode("#barcode", 0);
	$("#barcode").hide();
	document.getElementById("guardar").disabled=true; 
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
					url: '../ajax/producto.php?opc=listar',
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


init();