<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Visitas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Libro de Visitas</h1>
        <form action="guardar_comentario.php" method="POST" class="form-comentario">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="comentario">Comentario:</label>
                <textarea id="comentario" name="comentario" rows="4" required></textarea>
            </div>

            <input type="submit" value="Enviar comentario" class="btn">
        </form>

        <h2>Comentarios</h2>
        <div class="comentarios">
            <?php
            // conexion a base de datos
            $conn = new mysqli('localhost', 'root', '', 'libro_visitas');

            // verficacion
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta para obtener los comentarios
            $sql = "SELECT nombre, comentario, fecha FROM comentarios ORDER BY fecha DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // esto sirve para que los comentarios se muestren en la parte de abajo
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='comentario'>";
                    echo "<p><strong>" . htmlspecialchars($row['nombre']) . "</strong> (" . $row['fecha'] . ")</p>";
                    echo "<p>" . htmlspecialchars($row['comentario']) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay comentarios aún.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
