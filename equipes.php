<?php require_once("cabecalho.php")?>
<link href="CSS/equipes.css" rel="stylesheet">
<title>Schelp - Equipes</title>
</head>
<body onload="pagina_ativa('mandarequipes')">

<div class="principal">

<?php include("sidebar.php"); ?>

<div class="barra-topo"><h1 class="titulo-schelp">SCHELP</h1></div>

<div class="conteudo">

<a href="criarequipe.php">
    <button class="botao-criar">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" stroke="#FFFFFF">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <title></title>
                <g id="Complete">
                    <g data-name="add" id="add-2">
                        <g>
                            <line fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="12" x2="12" y1="19" y2="5"></line>
                            <line fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="5" x2="19" y1="12" y2="12"></line>
                        </g>
                    </g>
                </g>
            </g>
        </svg>
    </button>
</a>

<?php
include_once('conexao.php');

try {
    // Preparando a query com PDO
    $stmt = $pdo->query("SELECT * FROM equipes ORDER BY nome");
    $equipes = $stmt->fetchAll();
    
    echo "<div class='container-blocos'>";
    
    foreach ($equipes as $dados) {
        echo "
        <a href='equipe.php'>
            <div class='blocoequipe'>
                <div class='logoequipe'>
                    <svg width='75' height='75' viewBox='0 0 24 25' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path d='M6.75 2.5C5.50736 2.5 4.5 3.50736 4.5 4.75V19.5C4.5 21.1569 5.84315 22.5 7.5 22.5H18.75C19.1642 22.5 19.5 22.1642 19.5 21.75C19.5 21.3358 19.1642 21 18.75 21H18V18H18.75C19.1642 18 19.5 17.6642 19.5 17.25V4.75C19.5 3.50736 18.4926 2.5 17.25 2.5H6.75ZM7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18H16.5V21H7.5ZM8.625 5.875H15.375C15.7892 5.875 16.125 6.21079 16.125 6.625V9.875C16.125 10.2892 15.7892 10.625 15.375 10.625H8.625C8.21079 10.625 7.875 10.2892 7.875 9.875V6.625C7.875 6.21079 8.21079 5.875 8.625 5.875Z' fill='#ffffff'/>
                    </svg>
                </div>
                <br>
                <p class='tituloequipe'>".$dados['nome']."</p>
            </div>
        </a>";
    }
    
    echo "</div>";

} catch (PDOException $e) {
    die("Erro ao consultar equipes: " . $e->getMessage());
}
?>

</div>
</div>

</body>
</html>
