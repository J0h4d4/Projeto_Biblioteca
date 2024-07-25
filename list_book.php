<!DOCTYPE html>
<html>
    <head>
        <title>Lista de Livros</title>
    </head>
    <body>
        <h1>Lista de Livros</h1>
        <a href="add_book.php">Adicionar Livro</a>
        <?php
            include 'includes/liga_bd.php';
            $sql = "SELECT * FROM t_livro";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
        ?>
        <table border="1">
            <tr>
                <th>ISBN</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Gênero</th>
                <th>Data de Publicação</th>
                <th>Estado</th>
                <th>Capa</th>
                <th>Vendido</th>
            </tr>
            <?php 
                while ($row = mysqli_fetch_assoc($result)): 
            ?>
            <tr>
                <td><?php echo $row['isbn']; ?></td>
                <td><?php echo $row['titulo']; ?></td>
                <td><?php echo $row['descricao']; ?></td>
                <td><?php echo $row['preco']; ?></td>
                <td><?php echo $row['genero']; ?></td>
                <td><?php echo $row['data_publicacao']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <td><img src="capas/<?php echo $row['capa']; ?>" width="100"></td>
                <td><?php echo $row['vendido']; ?></td>
                <td>
                    <form action="edit_book.php" method="get">
                        <input type="hidden" name="isbn" value="<?php echo $row['isbn'];?>"><br>
                        <button type="submit" background-image="imgs/edit.png">
                            <img src="imgs/edit.png" width="50" title="Edit">
                        </button>
                    </form>
                    <button type="submit" background-image="imgs/delete.png">
                        <img src="imgs/delete.png" width="50" alt="Delete">
                    </button>
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