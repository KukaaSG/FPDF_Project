<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Playlist - 2º DAW</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<div class="container">
    <h2>Añadir Canción</h2>
    
    <form action="index.php" method="POST">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" required autocomplete="off">
        </div>
        
        <div class="form-group">
            <label for="artista">Artista / Banda</label>
            <input type="text" id="artista" name="artista" required autocomplete="off">
        </div>
        
        <div class="form-group">
            <label for="genero">Género</label>
            <input type="text" id="genero" name="genero" required autocomplete="off">
        </div>

        <div class="btn-group">
            <button type="submit" name="agregar">Agregar al Array</button>
            <button type="submit" name="generar" <?= empty($_SESSION['playlist']) ? 'disabled' : '' ?>>Generar PDF</button>
        </div>
    </form>

    <div class="status-panel">
        <span>Canciones en cola: <strong><?= count($_SESSION['playlist']) ?></strong></span>
        <?php if (!empty($_SESSION['playlist'])): ?>
            <a href="index.php?action=clear" class="btn-danger">Vaciar lista</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>




