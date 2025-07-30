document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('contactoForm');

  form.addEventListener('submit', function (e) {
    if (!form.checkValidity()) {
      if (!form.nombre.value.trim()) {
        alert('Por favor, ingrese su nombre');
        form.nombre.focus();
        e.preventDefault();
        return;
      }

      if (!form.correo.value.trim() || !form.correo.checkValidity()) {
        alert('Por favor, ingrese un correo válido');
        form.correo.focus();
        e.preventDefault();
        return;
      }

      if (!form.asunto.value.trim()) {
        alert('Por favor, ingrese el asunto');
        form.asunto.focus();
        e.preventDefault();
        return;
      }

      if (!form.comentario.value.trim()) {
        alert('Por favor, ingrese un comentario');
        form.comentario.focus();
        e.preventDefault();
        return;
      }
    }
  });
});
