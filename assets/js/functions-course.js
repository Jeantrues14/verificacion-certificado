/** Scripts cursos.php **/

    //Navbar Scroll

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

  // Script para rellenar el formulario del modal Modificar Curso
  $(document).ready(function() {
    // Cuando se haga clic en el botón de modificar
    $('#modalModificarCourse').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que ha abierto el modal
      var id = button.data('id') // Recibe los datos del usuario
      var nombre = button.data('nombre')
  
      // Asigna los datos al formulario del modal
      var modal = $(this)
      modal.find('#modalModificarId').val(id)
      modal.find('#modalModificarCurso').val(nombre)
    })
  });
  
  // Obtenemos el botón de eliminar curso
  var btnDeleteCourse = document.querySelectorAll('.btn-delete');
  
  // Iteramos sobre cada uno de ellos
  btnDeleteCourse.forEach(function(btn) {
    // Asignamos un manejador de evento al botón de eliminar
    btn.addEventListener('click', function() {
      // Obtenemos el ID del usuario a eliminar del atributo data-id del botón
      var idCurso = this.getAttribute('data-id');
  
      // Actualizamos el enlace del botón de confirmación con el ID del usuario a eliminar
      var btnConfirmarDelete = document.querySelector('#btnConfirmarDeleteCourse');
      btnConfirmarDelete.href = 'componentes/eliminar-curso.php?id=' + idCurso;
    });
  });
  