<?php

$titulo = "Autores Registrados";
include 'includes/conexion.php';
include 'templates/header.php';

// Configuración de paginación
$registros_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

$sql_total = "SELECT COUNT(*) FROM autores";
$total_autores = $pdo->query($sql_total)->fetchColumn();
$total_paginas = ceil($total_autores / $registros_por_pagina);

// Traemos más datos: telefono y direccion
$sql = "SELECT nombre, apellido, ciudad, pais, telefono, direccion FROM autores LIMIT $inicio, $registros_por_pagina";
$resultado = $pdo->query($sql);
?>

<div class="container mt-5">
  <h1 class="mb-4 text-center">Autores Registrados</h1>
  <?php foreach ($resultado as $autor): ?>
    <div class="card mb-3 shadow-sm">
      <div class="card-body">
        <h5 class="card-title">
          <?= htmlspecialchars($autor['nombre'] . ' ' . $autor['apellido']) ?>
        </h5>
        <p class="card-text mb-1">
          <strong>Ciudad:</strong> <?= htmlspecialchars($autor['ciudad']) ?>, <?= htmlspecialchars($autor['pais']) ?>
        </p>
        <p class="card-text mb-1">
          <strong>Teléfono:</strong> <?= htmlspecialchars($autor['telefono']) ?>
        </p>
        <p class="card-text">
          <strong>Dirección:</strong> <?= htmlspecialchars($autor['direccion']) ?>
        </p>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- Paginación -->
  <nav aria-label="Navegación de página">
    <ul class="pagination justify-content-center mt-4">
      <?php if ($pagina_actual > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?pagina=<?= $pagina_actual - 1 ?>">Anterior</a>
        </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
        <li class="page-item <?= $i == $pagina_actual ? 'active' : '' ?>">
          <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($pagina_actual < $total_paginas): ?>
        <li class="page-item">
          <a class="page-link" href="?pagina=<?= $pagina_actual + 1 ?>">Siguiente</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</div>

<?php include 'templates/footer.php'; ?>
