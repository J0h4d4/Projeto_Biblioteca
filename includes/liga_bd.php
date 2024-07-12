<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bd_gestao_livro";

    $connection = mysqli_connect($servername, $username, $password, $dbname);

    if ($connection->connect_error)
        die(mysqli_error($connection));

?>