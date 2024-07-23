<!DOCTYPE html>
<html>
    <head>
        <title>Adicionar Livro</title>
    </head>
    <body>
        <h1>Adicionar Livro</h1>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
                include 'includes/liga_bd.php';

                $isbn = $_POST['isbn'];
                $titulo = $_POST['titulo'];
                $descricao = $_POST['descricao'];
                $preco = $_POST['preco'];
                $genero = $_POST['genero'];
                $data_publicacao = $_POST['data_publicacao'];
                $estado = $_POST['estado'];
                $capa = $_POST['capa'];
                    
                $sql = "INSERT INTO t_livro 
                (isbn, titulo, descricao, preco, genero, data_publicacao, estado, capa)
                VALUES ('$isbn','$titulo','$descricao',$preco,'$genero','$data_publicacao',$estado,'$capa')";

                if ($conn->query($sql) === TRUE) {
                    echo "Livro adicionado com sucesso!";
                    header('Location: list_book.php');
                } else {
                    echo "Erro: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
            }
        ?>
        <form action="add_book.php" method="post">

            <label>ISBN:</label><br>
            <input type="text" name="isbn" maxlength="13" required><br>

            <label>Título:</label><br>
            <input type="text" name="titulo" maxlength="100" required><br>

            <label>Descrição:</label><br>
            <input type="text" name="descricao" maxlength="255" required><br>

            <label>Preço:</label><br>
            <input type="number" name="preco" min="0" max="999999" required><br>

            <label>Gênero:</label><br>
            <input type="text" name="genero" maxlength="100"><br>

            <label>Data de Publicação:</label><br>
            <input type="date" name="data_publicacao"><br>

            <input type="hidden" name="estado" value="0"><br>

            <label>Capa:</label><br>
            <input type="text" name="capa" maxlength="50" required><br><br>

            <input type="submit" value="Adicionar">

        </form>
        <a href="list_book.php">Voltar para a Lista de Livros</a>
    </body>
</html>