<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/cadastro.css?v=<?php echo time(); ?>">
    <title>Schelp - Cadastro</title>
</head>
<body>

<form action="consultacadastro.php" method="POST">
<div class="main-login">
    <div class="left-login">
        <h1></h1>
    </div>

    <div class="right-login">
       <div class="card-login">
         <h1>CADASTRE-SE</h1>
         <br><br>
        <div class="textfield">
            <label for="Usuario">Usuário</label>
            <input type="text" name="nome" placeholder="Usuário">
        </div>
        <br>
        <div class="textfield">
            <label for="Usuario">E-mail</label>
            <input type="text" name="email" placeholder="E-mail">
        </div>
        <br>
        <div class="textfield">
            <label for="Usuario">Senha</label>
            <input type="password" name="senha" placeholder="Senha">
        </div>
            <button class="btn-login">CADASTRAR</button>
       </div>
    </div>
</div>
</form>
</body>
</html>