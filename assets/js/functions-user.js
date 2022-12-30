/** Scripts usuarios.php **/

//Navbar Scroll

var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
// Obtenemos todos los botones de eliminar
var btnsEliminar = document.querySelectorAll('.btn-delete');

// Iteramos sobre cada uno de ellos
btnsEliminar.forEach(function(btn) {
  // Asignamos un manejador de evento al botón de eliminar
  btn.addEventListener('click', function() {
    // Obtenemos el ID del usuario a eliminar del atributo data-id del botón
    var idUsuario = this.getAttribute('data-id');

    // Actualizamos el enlace del botón de confirmación con el ID del usuario a eliminar
    var btnConfirmarEliminacion = document.querySelector('#btnConfirmarEliminacionUser');
    btnConfirmarEliminacion.href = 'componentes/eliminar-usuario.php?id=' + idUsuario;
  });
});

$(document).ready(function() {
// Cuando se escribe en alguno de los campos
$('#modalAgregarNombre, #modalAgregarApellido').keyup(function() {
  // Concatena el valor del nombre y el apellido
  var nombreUsuario = $('#modalAgregarNombre').val() + ' ' + $('#modalAgregarApellido').val();
  // Asigna el resultado al campo de nombre de usuario
  $('#modalAgregarUsuario').val(nombreUsuario);
});
});


// Script para rellenar el formulario del modal 
$(document).ready(function() {
    // Cuando se haga clic en el botón de modificar
    $('#modalModificar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que ha abierto el modal
      var id = button.data('id') // Recibe los datos del usuario
      var nombre = button.data('nombre')
      var apellido = button.data('apellido')
      var rol = button.data('rol')

      // Asigna los datos al formulario del modal
      var modal = $(this)
      modal.find('#modalModificarId').val(id)
      modal.find('#modalModificarNombre').val(nombre)
      modal.find('#modalModificarApellido').val(apellido)
      modal.find('#modalModificarRol').val(rol)
    })
  });


  
 