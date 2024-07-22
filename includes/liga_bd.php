<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bd_gestao_livro";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error)
        die(mysqli_error($conn));

?>