<?php
require_once 'includes/conexion.php';

$titulo = $_GET['titulo'] ?? '';
$por_pagina = 6;
$pagina = isset($_GET['pagina']) ? max(1, (int)$_GET['pagina']) : 1;
$offset = ($pagina - 1) * $por_pagina;

// Contar total
$sqlTotal = "SELECT COUNT(*) FROM titulos WHERE 1";
$params = [];
if ($titulo !== '') {
    $sqlTotal .= " AND titulo LIKE ?";
    $params[] = "%$titulo%";
}
$stmtTotal = $pdo->prepare($sqlTotal);
$stmtTotal->execute($params);
$totalLibros = $stmtTotal->fetchColumn();
$totalPaginas = ceil($totalLibros / $por_pagina);

// Obtener libros
$sql = "SELECT * FROM titulos WHERE 1";
if ($titulo !== '') $sql .= " AND titulo LIKE ?";
$sql .= " LIMIT $por_pagina OFFSET $offset";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'templates/header.php'; ?>

<div class="container mt-4">
  <h2 class="text-center mb-4">Listado de Libros</h2>

  <!-- Barra de búsqueda -->
  <form method="get" class="row g-3 mb-4">
    <div class="col-md-10">
      <input type="text" name="titulo" class="form-control" placeholder="Buscar por título" value="<?= htmlspecialchars($titulo) ?>">
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary w-100">Buscar</button>
    </div>
  </form>

  <!-- Libros -->
  <?php if (count($libros) > 0): ?>
    <?php foreach ($libros as $libro): ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($libro['titulo'] ?? 'Sin título') ?></h5>
          <p class="card-text"><?= htmlspecialchars($libro['notas'] ?? 'Sin descripción disponible') ?></p>
          <p class="card-text"><strong>Fecha:</strong> <?= !empty($libro['fecha_pub']) ? htmlspecialchars(substr($libro['fecha_pub'], 0, 10)) : 'No disponible' ?></p>
          <p class="card-text text-success"><strong>Precio:</strong> RD$ <?= isset($libro['precio']) ? number_format((float)$libro['precio'], 2) : '0.00' ?></p>
          <p class="card-text"><strong>Total ventas:</strong> <?= isset($libro['total_ventas']) ? (int)$libro['total_ventas'] : 0 ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="alert alert-warning">No se encontraron libros.</div>
  <?php endif; ?>

<!-- Paginación -->
<nav aria-label="Navegación de página">
  <ul class="pagination justify-content-center mt-4">
    <?php if ($pagina > 1): ?>
      <li class="page-item">
        <a class="page-link" href="?titulo=<?= urlencode($titulo) ?>&pagina=<?= $pagina - 1 ?>">Anterior</a>
      </li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
      <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
        <a class="page-link" href="?titulo=<?= urlencode($titulo) ?>&pagina=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>

    <?php if ($pagina < $totalPaginas): ?>
      <li class="page-item">
        <a class="page-link" href="?titulo=<?= urlencode($titulo) ?>&pagina=<?= $pagina + 1 ?>">Siguiente</a>
      </li>
    <?php endif; ?>
  </ul>
</nav>


<?php include 'templates/footer.php'; ?>
