<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login.css?v=<?php echo time(); ?>">
    <title>Schelp - Login</title>
</head>
<body>
    
<div class="main-login">
    <div class="left-login">
        <h1></h1>
    </div>

    <div class="right-login">
       <div class="card-login">
         <h1>LOGIN</h1>
         <br><br>
        <div class="textfield">
            <label for="Usuario">Usuário</label>
            <input type="text" name="usuario" placeholder="Usuário">
        </div>
        <br>
        <div class="textfield">
            <label for="Usuario">Senha</label>
            <input type="password" name="senha" placeholder="Senha">
            <a href="#">Esqueci minha senha</a>
        </div>
        
            <button class="btn-login">Login</button>
            <a href="#"> Não tem uma conta? Cadastrar-se</a>
        
       </div>
    </div>

</div>

</body>
</html>