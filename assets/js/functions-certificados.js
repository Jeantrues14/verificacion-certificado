/** Scripts certificados.php **/

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
    $('#modalModificarCertificados').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que ha abierto el modal
      var id = button.data('id') // Recibe el ID del certificado
      var idUsuario = button.data('usuario') // Recibe el ID del usuario
      var idCurso = button.data('curso') // Recibe el ID del curso
      var emision = button.data('emision') // Recibe la fecha de emisión

      // Asigna los datos al formulario del modal
      var modal = $(this)
      modal.find('#modalModificarId').val(id)
      modal.find('#modalModificarUsuario').val(idUsuario)
      modal.find('#modalModificarCurso').val(idCurso)
      modal.find('#modalModificarEmision').val(emision.replace(/(\d+)-(\d+)-(\d+)/g, '$3-$2-$1'));
    })
  });
  
  
  // Obtenemos el botón de eliminar curso
  var btnDelete = document.querySelectorAll('.btn-delete');
  
  // Iteramos sobre cada uno de ellos
  btnDelete.forEach(function(btn) {
    // Asignamos un manejador de evento al botón de eliminar
    btn.addEventListener('click', function() {
      // Obtenemos el ID del usuario a eliminar del atributo data-id del botón
      var idCertificado = this.getAttribute('data-id');
  
      // Actualizamos el enlace del botón de confirmación con el ID del usuario a eliminar
      var btnConfirmarDelete = document.querySelector('#btnConfirmarDelete');
      btnConfirmarDelete.href = 'componentes/eliminar-certificado.php?id=' + idCertificado;
    });
  });

  function generateCode() {
    // Array de caracteres que pueden formar parte del código aleatorio
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  
    // Longitud del código aleatorio
    const codeLength = 8;
  
    // Inicializamos el código aleatorio vacío
    let code = '';
  
    // Generamos el código aleatorio
    for (let i = 0; i < codeLength; i++) {
      // Generamos un número aleatorio entre 0 y el tamaño del array de caracteres
      const index = Math.floor(Math.random() * characters.length);
      // Añadimos el caracter correspondiente al código aleatorio
      code += characters[index];
    }
  
    // Asignamos el código aleatorio al input correspondiente
    document.getElementById('modalAgregarCodigo').value = code;
  }

  $('#modalAgregar').on('show.bs.modal', function () {
    generateCode();
  });

  var btnDelete = document.querySelectorAll('.btn-delete');
  
  // Iteramos sobre cada uno de ellos
  btnDelete.forEach(function(btn) {
    // Asignamos un manejador de evento al botón de eliminar
    btn.addEventListener('click', function() {
      // Obtenemos el ID del usuario a eliminar del atributo data-id del botón
      var idCertificado = this.getAttribute('data-id');
  
      // Actualizamos el enlace del botón de confirmación con el ID del usuario a eliminar
      var btnConfirmarEliminacion = document.querySelector('#btnConfirmarEliminacion');
      btnConfirmarEliminacion.href = 'componentes/eliminar-certificado.php?id=' + idCertificado;
    });
  });
  