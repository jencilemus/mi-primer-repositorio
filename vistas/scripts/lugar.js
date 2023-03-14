
var tabla;
function init(){

	listar();
	limpiar();
	$("#formulario").on("submit", function(e){
	guardarRegistro(e);
	} );


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
			$.post("../ajax/lugar.php?opc=activar", {idcategoria : idcategoria}, function(e){
				Swal.fire(
					'Activado!',
					'El lugar ha sido activado.',
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
        	$.post("../ajax/lugar.php?opc=activar", {idcategoria : idcategoria}, function(e){
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
			$.post("../ajax/lugar.php?opc=anular", {idcategoria : idcategoria}, function(e){
				Swal.fire(
					'Desactivado!',
					'El lugar ha sido desactivado.',
					'success'
				  )
	            tabla.ajax.reload();

        	});	
		  
		}
	  })


	/*bootbox.confirm("¿Está Seguro de anular la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/lugar.php?opc=anular", {idcategoria : idcategoria}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})*/
	
}
function mostrar(idcategoria){
	$("#exampleModalCenter").modal('show');
alert("ID Lugar: " +idcategoria);

$.post("../ajax/lugar.php?opc=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);	
	

		/// # es de la vista, data es de la tabla
		$("#idlugar").val(data.idlugar);
		$("#lugar").val(data.lugar);
		

 	})
}
function limpiar(){
	$("#idlugar").val("");
		$("#lugar").val("");
		$("#descripcion").val("");
 		$("#idcategoria").val("");
 		$("#estante").val("");

}
function guardarRegistro(){
		
//	e.preventDefault(); //No se activará la acción predeterminada del evento	
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/lugar.php?opc=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          //alert(datos);	 
			  Swal.fire(
				'Registro guardado!',
				'Lugar registrado!',
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
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		       'copyHtml5','excelHtml5','csvHtml5','pdf'
		        ],
		"ajax":
				{
					url: '../ajax/lugar.php?opc=listar',
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