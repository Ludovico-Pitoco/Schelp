<?php require_once("cabecalho.php")?>
<link rel="stylesheet" href="CSS/equipes.css?v=<?php echo time(); ?>">
    <title>Schelp - Equipes</title>
</head>
<body onload="pagina_ativa('mandarequipes')"> <!--Inicia a função javascript para marcar para o usuário qual a página em que ele está-->
    
<div class="principal"> <!--Div principal, tudo o que tiver na página vem nela-->

<?php include("sidebar.php");?> <!--Inclui a sidebar-->

<div class="barra-topo"><h1 class="titulo-schelp">SCHELP<h1></div> <!-- Barra do topo do site-->

<div class="conteudo" align="center"> <!--Conteúdo do site-->

<form action="criouequipe.php" method="POST">
Nome da Equipe: <input name="nomeequipe" type="text" required placeholder="Insira o nome da Equipe"><br><br>
<input type="submit"class="botao">

</form>

</div>

</div>

<?php require_once("rodape.php")?>