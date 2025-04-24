<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <script src="JS/script.js"></script>
    <title>Schelp</title>
</head>

<body>
    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

    <!-- Navbar -->
    <div class="navbar">
        <span class="menu-icon" onclick="openSidebar()">☰</span>
        <p style="margin-left: 25px; font-family: jersey; font-weight: bold; font-size:x-large; letter-spacing: 2px;">SCHELP</p>
    </div>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <a href="index.html">Início</a>
        <a href="tarefas.html">Tarefas</a>
        <a href="conteudo.html">Conteúdos</a>
        <a href="config.html">Configurações</a>
        <a href="feedback.php">Feedback</a>
    </div>

    <h1 align="center" class="titulo">Feedback</h1>

    <div align="center" style="display: flexbox;">

        <div style="margin:2vw;">

        <form method="post">

            <p>Nome:</p>
            <input type="text" name="nome" maxlength="80" required autocomplete="off" placeholder="Insira seu Nome:"><br>

            <p>Email:</p>
            <input type="email" name="email" maxlength="80" required autocomplete="off" placeholder="Insira seu Email:">

            <p>Sugestão:</p>
            <textarea required autocomplete="off" maxlength="300" name="sugestao" placeholder="Insira sua sugestão:" style="width: 40vw; height: 15vw;"></textarea><br><br>

            <input class="botao" type="submit" value="Enviar">

        </form>

        </div>

    </div>

</body>

</html>


<?php

error_reporting(0);

$nome = $_POST['nome'];
$email = $_POST['email'];
$sugestao = $_POST['sugestao'];

$insercao = "INSERT INTO feedback (nomefeedback, emailfeedback, sugestao) VALUES ('$nome', '$email' '$sugestao')";

include_once('conexao.php');

if (mysqli_query($conexao, $insercao)) {
    echo "<p>Feedback enviado com sucesso</p>";
} 
else {
    echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
}
?>