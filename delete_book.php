<?php
    include 'includes/liga_bd.php';

    $isbn = $_GET['isbn'];
    $sql = "DELETE FROM t_livro WHERE isbn=$isbn";

    if ($conn->query($sql) === TRUE) {
        echo "Livro eliminado com sucesso!";
    } else {
        echo "Erro ao eliminar: " . $conn->error;
    }
    $conn->close();
    header('Location: list_book.php');
?>