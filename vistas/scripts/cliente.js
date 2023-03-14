var tabla;
function init(){
	limpiar();
	listar();
	$.post("../ajax/cliente.php?opc=listapr", function(r){
		$("#lugares").html(r);
		$('#lugares').selectpicker('refresh');
});


	$("#formulario").on("submit", function(e){
	guardarRegistro(e);
	} );


}
function reporte1(id){
	if(id==0){
		window.location.href="../reportes/rptcategorias.php";
	}else{
		window.location.href="../reportes/rptcategorias.php?id="+id;
	}
	
}
function activar(idcliente){

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
			$.post("../ajax/cliente.php?opc=activar", {idcategoria : idcategoria}, function(e){
				Swal.fire(
					'Activado!',
					'El proveedor ha sido activado.',
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
			$.post("../ajax/cliente.php?opc=anular", {idcategoria : idcategoria}, function(e){
				Swal.fire(
					'Desactivado!',
					'El proveedor ha sido desactivado.',
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
$.post("../ajax/cliente.php?opc=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);
		
		/// # es de la vista, data es de la tabla
		$("#idproveedor").val(data.idcliente);
		$("#rtn").val(data.rtn);
		$("#cliente").val(data.cliente);
		$("#direccion").val(data.direccion);
		$("#estado civil").val(data.estadocivil);
		$("#contacto").val(data.telefono);
		
 	})
}
function limpiar(){
	$("#idproveedor").val("");
    $("#rtn").val("");
		$("#cliente").val("");
 		$("#direccion").val("");
		 $("#estado civil").val("");
		 $("#contacto").val("");
		

}
function guardarRegistro(){
		
//	e.preventDefault(); //No se activará la acción predeterminada del evento	
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/cliente.php?opc=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          //alert(datos);	 
			  Swal.fire(
				'Registro guardado!',
				'Cliente registrado!',
				'success'
			  )           	              	          
	          tabla.ajax.reload();
	    }

	});

	limpiar();
	listar();
	$("#exampleModalCenter").modal('hide');
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
					url: '../ajax/cliente.php?opc=listar',
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