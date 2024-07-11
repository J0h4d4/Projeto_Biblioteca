<?php
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $isbn = $_POST['isbn'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $genero = $_POST['genero'];
        $ano_publicacao = $_POST['ano_publicacao'];
        $estado = $_POST['estado'];
        $capa = $_POST['capa'];
        $vendido = $_POST['vendido'];
        
        $sql = "INSERT INTO t_livro 
        (isbn, titulo, descricao, preco, genero, ano_publicacao, estado, capa, vendido)
         VALUES ('$isbn','$titulo','$descricao',$preco,'$genero',$ano_publicacao,$estado,'$capa',$vendido)";

        if ($conn->query($sql) === TRUE) {
            echo "Livro adicionado com sucesso!";
            header('Location: list_book.php');
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Adicionar Livro</title>
    </head>
    <body>
        <h1>Adicionar Livro</h1>
        <form method="POST" action="">

            <label>ISBN:</label><br>
            <input type="text" name="isbn" maxlength="13" required><br>

            <label>Título:</label><br>
            <input type="text" name="titulo" maxlength="100" required><br>

            <label>Gênero:</label><br>
            <input type="text" name="genero" maxlength="100"><br>

            <label>Ano de Publicação:</label><br>
            <input type="number" name="ano_publicacao" min="1" max="9999"><br>

            <input type="hidden" name="estado" value="0"><br><br>

            <input type="submit" value="Adicionar">

        </form>
        <a href="list_book.php">Voltar para a Lista de Livros</a>
    </body>
</html>