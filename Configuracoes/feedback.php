<?php
define("base_path", "../");
include("../cabecalho.php");
include("../sidebar.php");
?>

<script src="../script/script.js"></script>


    <title>Schelp - Configurações</title>
</head>
<body onload="pagina_ativa('mandarconfiguracoes')"> <!--Inicia a função javascript para marcar para o usuário qual a página em que ele está-->
    
<div class="principal"> <!--Div principal, tudo o que tiver na página vem nela-->

<link rel="stylesheet" href="../css/style.css">

<div class="barra-topo"><h1 class="titulo-schelp">SCHELP<h1></div> <!-- Barra do topo do site-->

<div class="conteudo"> <!--Conteúdo do site-->

<?php include("configuracoes-sidebar.php");?> <!--Inclui a sidebar de configurações-->

<div class="conteudo-configuracoes"> <!--Conteúdo específico da página de configurações-->

<section>
    
<div class="titulo-configuracoes">
<h2>
    Feedback
</h2>
</div>

<div>
    <dl  class="cont-config-perfil">
        
    </dl>
</div>

</section>

</div>

</div>

</body>
</html>
