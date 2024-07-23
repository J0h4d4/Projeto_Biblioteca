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
            $result = $conn->query($sql);
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
                while ($row = $result->fetch_assoc()): 
            ?>
            <tr>
                <td><?php echo $row['isbn']; ?></td>
                <td><?php echo $row['titulo']; ?></td>
                <td><?php echo $row['descricao']; ?></td>
                <td><?php echo $row['preco']; ?></td>
                <td><?php echo $row['genero']; ?></td>
                <td><?php echo $row['data_publicacao']; ?></td>
                <td><?php echo $row['estado']; ?></td>
                <td><?php echo $row['capa']; ?></td>
                <td><?php echo $row['vendido']; ?></td>
                <td>
                    <form action="edit_book.php" method="post">
                        <input type="hidden" name="isbn" value="<?php echo $row['isbn'];?>"><br>
                        <button class="icon" type="submit" background-image="imgs/edit.png"></button>
                    </form>
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