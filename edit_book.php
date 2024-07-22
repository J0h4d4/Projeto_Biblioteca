
<!DOCTYPE html>
<html>
    <head>
        <title>Editar Livro</title>
    </head>
    <body>
        <h1>Editar Livro</h1>

        <?php

            include 'includes/liga_bd.php';
            
            //crio a instrução sql para selecionar todos os registos
            $sql ="SELECT * FROM t_livro WHERE isbn=$_POST[isbn]";
            
            // a variavel resultado vai guardar todos os dados de todos os manuais
            // o primeiro parametro é a base dados e o segundo a instrução sql
            $result =mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
            $book = mysqli_fetch_assoc($result);
        
        ?>

        <form action="edit_book.php" method="post" enctype="multipart/form-data">

            <label>ISBN:</label><br>
            <input type="text" name="isbn" value="<?php echo $book['isbn']; ?>" readonly><br>

            <label>Título:</label><br>
            <input type="text" name="titulo" value="<?php echo $book['titulo']; ?>" required><br>

            <label>Descrição:</label><br>
            <input type="text" name="descricao" value="<?php echo $book['descricao']; ?>" required><br>

            <label>Preço:</label><br>
            <input type="number" name="preco" value="<?php echo $book['preco']; ?>" required><br>

            <label>Gênero:</label><br>
            <input type="text" name="genero" value="<?php echo $book['genero']; ?>"><br>

            <label>Data de Publicação:</label><br>
            <input type="date" name="data_publicacao" value="<?php echo $book['data_publicacao']; ?>"><br>
            
            <label>Estado:</label><br>
            <input type="number" name="estado" value="<?php echo $book['estado']; ?>"><br>

            <label>Capa:</label><br>
            <img class="capa" src="capas/<?php echo $book['capa'];?>">
            <input type="hidden" name="capa" value="<?php echo $book['capa'];?>"><br>

            <label>Vendido:</label><br>
            <input type="number" name="vendido" value="<?php echo $book['vendido']; ?>"><br><br>

            <input type="submit" value="Atualizar">

        </form>
        <a href="list_book.php">Voltar para a Lista de Livros</a>

        <?php
            
            include 'includes/valida_capa.php';

            //caso não tenha trocado a imagem
            if(empty($_FILES['capa']['name'][0])) {
                $sql = "UPDATE t_livro SET 
                    titulo='$_POST[titulo]', descricao='$_POST[descricao]', preco=$_POST[preco],
                    genero='$_POST[genero]', data_publicacao='$_POST[data_publicacao]',
                    estado=$_POST[estado], vendido='$_POST[vendido]' 
                    WHERE isbn='$_POST[isbn]'";

                if (mysqli_query($conn, $sql)) {
                    echo "<h3>Livro atualizado com sucesso!</h3>";
                    header('Location: list_book.php');
                } else {
                    echo "Erro: " . $sql . "<br>" . $conn->error;
                }
            } 
            //caso tenha trocado a imagem
            else {
                include 'includes/valida_capa.php';
                if ($uploadOk==1) {
                    $sql = "UPDATE t_livro SET 
                    titulo='$_POST[titulo]', descricao='$_POST[descricao]', preco=$_POST[preco],
                    genero='$_POST[genero]', data_publicacao='$_POST[data_publicacao]',
                    estado=$_POST[estado], capa='".$capa."', vendido='$_POST[vendido]' 
                    WHERE isbn='$_POST[isbn]'";

                    if (mysqli_query($conn, $sql)) {
                        echo "<h3>Livro atualizado com sucesso!</h3>";
                        header('Location: list_book.php');

                        // primeiro envia a nova imagem
                        move_uploaded_file($_FILES['capa']['tmp_name'], $target_file);

                        // apago a imagem anterior
                        unlink('capas/'.$_POST['capa']);
                    } else {
                        echo "Erro: " . $sql . "<br>" . $conn->error;
                    }
                }
            }

            mysqli_close($conn);

        ?>
    </body>
</html>