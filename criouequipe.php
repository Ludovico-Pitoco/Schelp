<?php
$nomeequipe = $_POST['nomeequipe'];

$sql = "insert into equipes(nome) values('{$nomeequipe}')";

include_once('conexaonormal.php');

if( mysqli_query($conexao, $sql))
{
        header("Location: equipes.php");
}
else
{
        header("Location: criarequipe.php");
        echo"<p>ERRO</p>";
}

mysqli_close($conexao);
?>