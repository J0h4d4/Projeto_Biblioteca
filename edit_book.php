
<!DOCTYPE html>
<html>
    <head>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') 
                echo "<meta http-equiv='refresh' content='5;url=list_book.php'>";
        ?>
        <title>Editar Livro</title>
    </head>
    <body>
        <h1>Editar Livro</h1>

        <?php
            include 'includes/liga_bd.php';
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                
                include 'includes/valida_capa.php';

                $isbn = $_POST['isbn'];
                $titulo = $_POST['titulo'];
                $descricao = $_POST['descricao'];
                $preco = $_POST['preco'];
                $genero = $_POST['genero'];
                $data_publicacao = $_POST['data_publicacao'];
                $estado = $_POST['estado'];
            
                //caso não tenha trocado a capa
                if(empty($_FILES["capa"]["name"][0])) {
                    $sql = "UPDATE t_livro SET 
                        titulo='$titulo', descricao='$descricao', preco=$preco,
                        genero='$genero', data_publicacao='$data_publicacao',
                        estado=$estado 
                        WHERE isbn='$isbn'";

                    if (mysqli_query($conn, $sql)) {
                        echo "<h3>Livro atualizado com sucesso!</h3>";
                        header('Location: list_book.php');
                    } else {
                        echo "Erro: " . $sql . "<br>" . $conn->error;
                    }
                } 
                //caso tenha trocado a capa
                else {
                    if ($uploadOk==1) {
                        $sql = "UPDATE t_livro SET 
                        titulo='$titulo', descricao='$descricao', preco=$preco,
                        genero='$genero', data_publicacao='$data_publicacao',
                        estado=$estado, capa='".$capa."' 
                        WHERE isbn='$isbn'";

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

                echo "<br/><h4>Aguarde que vai ser redirecionado</h4>";
                echo "<input type='button' value='Voltar ao menu' onclick='window.open('list_book.php','_self')'>";
                
            } else {
            
                //crio a instrução sql para selecionar todos os registos
                $sql ="SELECT * FROM t_livro WHERE isbn='$_GET[isbn]'";
                
                // a variavel resultado vai guardar todos os dados de todos os manuais
                // o primeiro parametro é a base dados e o segundo a instrução sql
                $result =mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
                $book = mysqli_fetch_assoc($result);
        
                echo "<form action='edit_book.php' method='post' enctype='multipart/form-data'>";

                echo    "<label>ISBN:</label><br>";
                echo    "<input type='text' name='isbn' value='".$book['isbn']."' readonly><br>";

                echo    "<label>Título:</label><br>";
                echo    "<input type='text' name='titulo' value='".$book['titulo']."' required><br>";

                echo    "<label>Descrição:</label><br>";
                echo    "<input type='text' name='descricao' value='".$book['descricao']."' required><br>";

                echo    "<label>Preço:</label><br>";
                echo    "<input type='number' name='preco' value='".$book['preco']."' required><br>";

                echo    "<label>Gênero:</label><br>";
                echo    "<input type='text' name='genero' value='".$book['genero']."'><br>";

                echo    "<label>Data de Publicação:</label><br>";
                echo    "<input type='date' name='data_publicacao' value='".$book['data_publicacao']."'><br>";
                        
                echo    "<label>Estado:</label><br>";
                echo    "<input type='number' name='estado' value='".$book['estado']."'><br>";

                echo    "<label>Capa:</label><br>";
                echo    "<img class='capa' src='capas/".$book['capa']."' width='100'>";
                echo    "<input type='hidden' name='capa' value='".$book['capa']."'><br>";

                echo    "Nova Capa:<br>";
                echo    "<input type='file' name='capa'><br><br>";

                echo    "<input type='submit' value='Atualizar'>";

                echo "</form>";
                echo "<a href='list_book.php'>Voltar para a Lista de Livros</a>";
            }
        ?>
    </body>
</html>