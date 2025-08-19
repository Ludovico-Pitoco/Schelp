<?php require_once("cabecalho.php")?>
<link href="CSS/inicio.css" rel="stylesheet">
    <title>Schelp - Início</title>
</head>
<body onload="pagina_ativa('mandarinicio')"> <!--Inicia a função javascript para marcar para o usuário qual a página em que ele está-->
    
<div class="principal"> <!--Div principal, tudo o que tiver na página vem nela-->

<?php include("sidebar.php");?> <!--Inclui a sidebar-->

<div class="barra-topo"><h1 class="titulo-schelp">SCHELP<h1></div> <!-- Barra do topo do site-->

<div align="center" class="conteudo"> <!--Conteúdo do site-->

<h1 class="mensagem">Olá <span class="nomedousuario"><?php echo htmlspecialchars($usuario['nome']); ?></span>, seja bem-vindo ao Schelp!</h1>

</div>

</div>

</body>
</html>