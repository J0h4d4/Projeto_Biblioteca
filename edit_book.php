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

        $sql = "UPDATE t_livro SET 
        titulo='$titulo', descricao='$descricao',preco=$preco, genero='$genero', 
        ano_publicacao='$ano_publicacao', estado=$estado, capa='$titulo', vendido='$vendido' 
        WHERE isbn='$isbn'";

        if ($conn->query($sql) === TRUE) {
            echo "Livro atualizado com sucesso!";
            header('Location: list_book.php');
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {

        $isbn = $_GET['isbn'];
        $sql = "SELECT * FROM t_livro WHERE isbn=$isbn";
        $result = $conn->query($sql);
        $livro = $result->fetch_assoc();
    }
    $conn->close(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Editar Livro</title>
    </head>
    <body>
        <h1>Editar Livro</h1>
        <form method="POST" action="">

            <label>ISBN:</label><br>
            <input type="text" name="isbn" value="<?php echo $livro['isbn']; ?>" readonly><br>

            <label>Título:</label><br>
            <input type="text" name="titulo" value="<?php echo $livro['titulo']; ?>" required><br>

            <label>Descrição:</label><br>
            <input type="text" name="descricao" value="<?php echo $livro['descricao']; ?>" required><br>

            <label>Preço:</label><br>
            <input type="number" name="preco" value="<?php echo $livro['preco']; ?>" required><br>

            <label>Gênero:</label><br>
            <input type="text" name="genero" value="<?php echo $livro['genero']; ?>"><br>

            <label>Ano de Publicação:</label><br>
            <input type="year" name="ano_publicacao" value="<?php echo $livro['ano_publicacao']; ?>"><br>
            
            <label>Estado:</label><br>
            <input type="number" name="estado" value="<?php echo $livro['estado']; ?>"><br><br>

            <label>Capa:</label><br>
            <input type="text" name="capa" value="<?php echo $livro['capa']; ?>" required><br>

            <label>Vendido:</label><br>
            <input type="number" name="vendido" value="<?php echo $livro['vendido']; ?>"><br>

            <input type="submit" value="Atualizar">

        </form>
        <a href="list_book.php">Voltar para a Lista de Livros</a>
    </body>
</html>