<?php
$carpeta = __DIR__ . '/imagen.html';
$extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif', 'mp4'];
$archivos = [];

if (is_dir($carpeta)) {
    foreach (glob($carpeta . '/*') as $ruta) {
        if (!is_file($ruta)) {
            continue;
        }

        $extension = strtolower(pathinfo($ruta, PATHINFO_EXTENSION));
        if (!in_array($extension, $extensionesPermitidas, true)) {
            continue;
        }

        $archivos[] = [
            'nombre' => basename($ruta),
            'ruta' => 'imagen.html/' . basename($ruta),
            'esVideo' => $extension === 'mp4'
        ];
    }
}

usort($archivos, function ($a, $b) {
    return strcmp($a['nombre'], $b['nombre']);
});
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ideas madera</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        .item { display: none; }
        img, video { width: 100%; border-radius: 10px; }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="text-center mb-4">search</h2>

    <div class="input-group mb-4">
        <input id="searchInput" type="text" class="form-control" placeholder="Escribe: closet, cocina, puertas, muebles para tv" />
        <button class="btn btn-primary" type="button" onclick="buscar()">Buscar</button>
    </div>

    <div id="resultados" class="row g-3">
        <?php foreach ($archivos as $archivo): ?>
            <?php
            $nombre = strtolower($archivo['nombre']);
            $busquedaArchivo = preg_replace('/[^a-z0-9]+/', ' ', $nombre);
            $busquedaArchivo = str_replace(['purtas'], ['puertas'], $busquedaArchivo);
            ?>
            <div class="col-md-4 item" data-category="<?= htmlspecialchars(str_replace(['.jpg', '.jpeg', '.png', '.gif', '.webp', '.avif', '.mp4'], '', strtolower($archivo['nombre']))) ?>" data-search="<?= htmlspecialchars($busquedaArchivo) ?>">
                <?php if ($archivo['esVideo']): ?>
                    <video controls>
                        <source src="<?= htmlspecialchars($archivo['ruta']) ?>" type="video/mp4" />
                    </video>
                <?php else: ?>
                    <img src="<?= htmlspecialchars($archivo['ruta']) ?>" alt="<?= htmlspecialchars($archivo['nombre']) ?>" />
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function normalizar(texto) {
    return (texto || '')
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .toLowerCase()
        .replace(/purtas/g, 'puertas')
        .replace(/[^a-z0-9]+/g, ' ')
        .trim();
}

function buscar() {
    const texto = normalizar(document.getElementById('searchInput').value);
    const items = document.querySelectorAll('.item');

    items.forEach(item => {
        const categoria = normalizar(item.getAttribute('data-category'));
        const busqueda = normalizar(item.getAttribute('data-search'));
        const coincide = !texto || categoria.includes(texto) || busqueda.includes(texto);
        item.style.display = coincide ? 'block' : 'none';
    });
}

window.addEventListener('DOMContentLoaded', function () {
    buscar();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
