<?php
    include 'config.php';
    $sql = "SELECT * FROM t_livro";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lista de Livros</title>
    </head>
    <body>
        <h1>Lista de Livros</h1>
        <a href="add_book.php">Adicionar Livro</a>
        <table border="1">
            <tr>
                <th>ISBN</th>
                <th>Título</th>
                <th>Gênero</th>
                <th>Ano de Publicação</th>
                <th>Estado</th>
            </tr>
            <?php 
                while ($row = $result->fetch_assoc()): 
            ?>
            <tr>
                <td><?php echo $row['isbn']; ?></td>
                <td><?php echo $row['titulo']; ?></td>
                <td><?php echo $row['genero']; ?></td>
                <td><?php echo $row['ano_publicacao']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <td>
                    <a href="edit_book.php?isbn=<?php echo $row['isbn']; ?>">Editar</a>
                    <a href="delete_book.php?isbn=<?php echo $row['isbn']; ?>"
                    onclick="return confirm('Tem certeza que deseja apagar este livro?');">Apagar</a>
                </td>
            </tr>
        <?php 
            endwhile; 
        ?>
        </table>
    </body>
</html>
<?php
    $conn->close();
?>