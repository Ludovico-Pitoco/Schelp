<?php
session_start();

if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['user'];
$codusuario = (int) $usuario['codconta'];

$nomeequipe = $_POST['nomeequipe'];

include_once('conexaonormal.php');

$sql = "INSERT INTO equipes (nome) VALUES ('{$nomeequipe}')";

if (!mysqli_query($conexao, $sql)) {
    header("Location: criarequipe.php?erro=1");
    exit;
}

$codequipe = mysqli_insert_id($conexao);

$consulta = "INSERT INTO equipescontas (codcontafk, codequipefk, datas) 
             VALUES ('{$codusuario}', '{$codequipe}', NOW())";

if (mysqli_query($conexao, $consulta)) {
    header("Location: equipes.php");
    exit;
} else {
    header("Location: criarequipe.php?erro=2");
    exit;
}

mysqli_close($conexao);
?>