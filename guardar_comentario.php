<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $comentario = $_POST['comentario'];

    // Validar los datos (puedes agregar más validaciones si es necesario)
    if (!empty($nombre) && !empty($comentario)) {
        // Conectar a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'libro_visitas');

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Insertar comentario en la base de datos
        $sql = "INSERT INTO comentarios (nombre, comentario) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre, $comentario);

        if ($stmt->execute()) {
            // Redirigir al libro de visitas para ver el nuevo comentario
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Por favor, completa todos los campos.";
    }
} else {
    echo "Método no permitido.";
}
?>
