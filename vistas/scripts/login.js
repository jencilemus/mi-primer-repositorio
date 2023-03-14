function init(){

}
init();
$(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        icon: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    
  });
function verificarclave(){
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000
  });
    cla=clave.value;
    usua=usuario.value;
    $.post("../ajax/usuario.php?opc=verificar",{"cla" : cla, "usua" : usua}, function(data, status)
	{
		data2 = JSON.parse(data);	
        if(data2==0){
            Toast.fire({
              icon: 'error',
              title: 'El usuario o contraseña no existe. Verifique bien el usuario y clave.'
            });
        }else{
            $.post("../ajax/usuario.php?opc=estado",{"cla" : cla, "usua" : usua}, function(data, status)
	    {
		    data1 = JSON.parse(data);
            if(0==data1){
              Toast.fire({
                icon: 'error',
                title: 'El usuario existe, pero actualmente se encuentra desactivado.'
              });
            }else{
              var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
              });
                Toast.fire({
                icon: 'success',
                title: 'Inicio de sesion exitosa. Bienvenido(a) '+data2+'.'
              })
                $(location).attr("href", "usuario.php"); 
            }
                    
        })
        }
             
        

 	})
}
