<?php
require_once 'includes/conexion.php';

// Obtener los 3 libros más vendidos
$sql = "SELECT * FROM titulos ORDER BY total_ventas DESC LIMIT 3";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'templates/header.php'; ?>

<div class="container mt-4">
  <div class="jumbotron text-center bg-light p-5 rounded shadow-sm mb-4">
    <h1 class="display-4">Bienvenido a la Librería Online</h1>
    <p class="lead">Nos alegra que estés aquí. Explora nuestro amplio catálogo de libros, desde clásicos hasta las últimas novedades.</p>
  </div>

  <h2 class="mb-4">Top 3 Libros Más Vendidos</h2>

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

    <div class="text-center mt-4">
      <a href="libros.php" class="btn btn-primary btn-lg">Ir a la Librería</a>
    </div>


  <?php else: ?>
    <div class="alert alert-warning">No hay libros disponibles.</div>
  <?php endif; ?>
</div>

<?php include 'templates/footer.php'; ?>

