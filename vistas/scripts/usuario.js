
var tabla;
function init(){
	limpiar();
	listar();
	
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
			$.post("../ajax/usuario.php?opc=activar", {idcategoria : idcategoria}, function(e){
				Swal.fire(
					'Activado!',
					'El usuario ha sido activado.',
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
			$.post("../ajax/usuario.php?opc=anular", {idcategoria : idcategoria}, function(e){
				Swal.fire(
					'Desactivado!',
					'El usuario ha sido desactivado.',
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
alert("ID Usuario: " +idcategoria);

$.post("../ajax/usuario.php?opc=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);	
	

		/// # es de la vista, data es de la tabla
		$("#idusuario").val(data.idusuario);
		$("#nombre").val(data.nombre);
		$("#login").val(data.login);
 		$("#clave").val(data.clave);
         $("#imagenmuestra").show();
         $("#imagenmuestra").attr("src","../files/usuario/"+data.imagen);

 	})
}
function limpiar(){
	$("#idusuario").val("");
		$("#nombre").val("");
		$("#login").val("");
 		$("#clave").val("");
		 $("#imagenmuestra").hide();
	$.post("../ajax/usuario.php?opc=permisos&id=",function(r){
		$("#permisos").html(r);
	
	});
}
function guardarRegistro(){
		
//	e.preventDefault(); //No se activará la acción predeterminada del evento	
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/usuario.php?opc=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          //alert(datos);	 
			  Swal.fire(
				'Registro guardado!',
				'Usuario registrado!',
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
					url: '../ajax/usuario.php?opc=listar',
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