<?php include 'templates/header.php'; ?>

<h1>Formulario de Contacto</h1>
<form id="contactoForm" action="guardar_contacto.php" method="POST" novalidate>
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" class="form-control" required
      oninvalid="this.setCustomValidity('Por favor, ingrese su nombre')"
      oninput="setCustomValidity('')">
  </div>
  <div class="form-group">
    <label for="correo">Correo</label>
    <input type="email" id="correo" name="correo" class="form-control" required
      oninvalid="this.setCustomValidity('Por favor, ingrese un correo válido')"
      oninput="setCustomValidity('')">
  </div>
  <div class="form-group">
    <label for="asunto">Asunto</label>
    <input type="text" id="asunto" name="asunto" class="form-control" required
      oninvalid="this.setCustomValidity('Por favor, ingrese el asunto')"
      oninput="setCustomValidity('')">
  </div>
  <div class="form-group">
    <label for="comentario">Comentario</label>
    <textarea id="comentario" name="comentario" class="form-control" rows="4" required
      oninvalid="this.setCustomValidity('Por favor, ingrese un comentario')"
      oninput="setCustomValidity('')"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php include 'templates/footer.php'; ?>

