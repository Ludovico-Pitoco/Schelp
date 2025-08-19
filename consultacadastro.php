<?php
include_once('conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$query = "INSERT INTO conta(nome, senha, email) VALUES('".$usuario."', '".$senha."', '".$email."')";

try {

    $query = "INSERT INTO conta(nome, senha, email) VALUES ('$usuario', '$senha', '$email')";

    mysqli_query($conexao, $query);

    header("Location: sucessocadastro.php");

} catch (mysqli_sql_exception $e) {

    if ($e->getCode() == 1062) {
        
        header("Location: errocadastro.php");

    }
}

mysqli_close($conexao);

?>