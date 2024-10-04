<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $comentario = $_POST['comentario'];

    //se validan los datos en eso de base de datos
    if (!empty($nombre) && !empty($comentario)) {
        // se conecta a la mabe de satos mysql que esta en xammp y se llama libro_visitas
        $conn = new mysqli('localhost', 'root', '', 'libro_visitas');

        //conexion
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // insertar comentario 
        $sql = "INSERT INTO comentarios (nombre, comentario) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre, $comentario);

        if ($stmt->execute()) {
            // ver el nuevo comentario
            header("Location: index.php");
            exit;
        } else {
            echo "error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "por favor, completa todos los campos.";
    }
} else {
    echo "metodo no permitido.";
}
?>
