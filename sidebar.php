<?php 
$current_page = $_SERVER['REQUEST_URI'];

if (strpos($current_page, "/Configuracoes/") !== false) {
    $path = "../";
} else {
    $path = "";
} 
?>

<div id="sidebar">
  <svg id="menu-sidebar" viewBox="0 0 72 72"xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" stroke="#FFFFFF"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="color"> <path fill="" stroke="none" d="M35.8377,9.4188c-0.8333,0.1667-9,0.1667-9,0.1667l-8.75,7.25l-4.9167,10.25l-3,12.4167l1.3333,8.75 l5.75,7.1667c0,0,4.75,4,11.1667,3.75c0,0,20,2.9167,26.5-3.5833l3.3333-3.5833l3.1667-6.3333l0.0833-7.6667l-1.5-7l-2.1667-6.9167 l-4.0833-7.5l-4.9167-4.1667L44.921,9.8355l-4.1667-0.8333L35.8377,9.4188z"></path> <path fill="" stroke="none" d="M55.5877,19.5021l2.5-1.8333l3.0833-0.5l1.9167,1.25l0.75,1c0,0,0.9167,3.6667,1,3.9167 c0.0833,0.25,0,6,0,6l-1.25,3.1667l-2.1667,1.9167l-2.3333-5.5l-3.1667-7.25L55.5877,19.5021z"></path> <polygon fill="" stroke="none" points="16.671,19.0021 14.0044,17.1688 11.2544,16.5855 8.3377,18.4188 6.671,23.3355 7.171,29.1688 8.3377,31.8355 10.8377,34.6688 12.2544,30.1688 14.421,24.2521"></polygon> <path fill="" stroke="none" d="M46.3377,44.5855l4.0833-2.4167l1.75-4.6667l1.25-7.25l-1.0833-4.75l-2.4167-2.8333l-4.3333-1.8333 l-5.4167,0.1667l-3.5833-0.0833l-7-0.3333l-4.6667,0.3333l-4.25,2.8333l-2,4.5833l0.0833,3.9167c0,0-0.0833,3.5,0.1667,3.9167 c0.25,0.4167,1.5833,4.4167,1.5833,4.4167l1.1667,1.6667l4,1.8333l-1,4c0,0-0.1667,6.5,1.25,8.4167 c1.4167,1.9167,5.75,5.4167,5.75,5.4167l6.4167,0.6667l4.5833-1.6667l3.8334-4.8333c0.8412-2.6884,1.1213-5.4142,1-8.1667 L46.3377,44.5855z"></path> </g> <g id="hair"></g> <g id="skin"></g> <g id="skin-shadow"></g> <g id="line"> <circle cx="27.6338" cy="29.6771" r="2" fill="#FFFFFF" stroke="none"></circle> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M23.0393,27.9538c0,0,4.726-6.5434,9.4521,0.1023"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M30.8968,40.1701c0,0,0.6484,2.299,3.537,2.7117"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M27.989,51.7674l1.2915,0.8045c1.2002,0.7477,2.5573,1.1408,3.9382,1.1408h5.6222c1.3232,0,2.6255-0.361,3.7893-1.0503 l1.5111-0.895"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M31.0557,35.5878c-2.6158,1.5082-5.9686,4.8289-5.5798,11.8762"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M26.8178,56.0264l0.2809,0.6695c1.0574,2.5206,3.1675,4.4503,5.7723,5.279l0.7864,0.2502 c2.2541,0.7171,4.6965,0.5509,6.8326-0.4651l0,0c2.0135-0.9577,3.6173-2.6051,4.5206-4.6436l0.4855-1.0957"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M16.0795,18.8447l-1.7688-1.228c-1.6197-1.1245-3.7931-1.0191-5.2965,0.2567l0,0c-0.7659,0.65-1.2866,1.5421-1.4642,2.5308 c-0.6192,3.4457-1.5742,11.5715,2.6707,13.7114"></path> <circle cx="43.3662" cy="29.9126" r="2" fill="#FFFFFF" stroke="none"></circle> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M48.0175,28.1759c0,0-4.726-6.5434-9.4521,0.1023"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M49.9607,41.4195c2.5152-1.7505,2.6995-5.9685,3.3012-10.1803c0.4127-2.8885-0.4716-5.895-3.5959-8.4888 c-3.1321-2.6002-7.3146-2.1486-9.39-1.6993c-1.0224,0.2213-2.0608,0.3145-3.1062,0.2758l-2.7267-0.1011 c-0.842-0.0312-1.6765-0.1564-2.4973-0.3471c-1.9859-0.4613-6.3637-1.0469-9.6117,1.6496 c-3.1243,2.5938-4.0086,5.6002-3.5959,8.4888c0.6017,4.2118,0.786,8.4298,3.3012,10.1803"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M41.1032,40.1701c0,0-0.6484,2.299-3.537,2.7117"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M41.2534,35.9947c2.5625,1.588,5.6444,4.9189,5.2707,11.6914"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M41.2534,35.9947c-0.5708-0.3538-1.1928-0.6531-1.7718-0.8958c-1.2375-0.5188-2.5724-0.7524-3.9139-0.7201l-0.0521,0.0013 c-1.5439,0.0372-3.0699,0.4152-4.4116,1.18c-0.0161,0.0092-0.0322,0.0184-0.0483,0.0277"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M54.4627,54.7601c0,0,12.6763-6.0522,3.9518-28.4623S36.0651,9.7105,36.0651,9.7105S22.3101,3.6656,13.5856,26.0757 s3.9518,28.4623,3.9518,28.4623"></path> <path fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5" d="M55.9205,19.0668l1.7688-1.228c1.6197-1.1245,3.7931-1.0191,5.2965,0.2567l0,0c0.7659,0.65,1.2866,1.5421,1.4642,2.5308 c0.6192,3.4457,1.5742,11.5715-2.6707,13.7114"></path> </g> </g></svg><br> <!--Ícone do menu-->
  <!--Ícone do macaco-->

  <menu align="center"> <!--Menu onde estarão os itens da navbar-->

    <li id="mandarinicio" class="lista-sidebar">
      <a href="<?php echo("".$path)?>inicio.php">
        <svg width="50" height="50" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.85 3.70391C13.05 3.10391 11.95 3.10391 11.15 3.70391L4.65 8.57891C4.08344 9.00383 3.75 9.6707 3.75 10.3789V18.5003C3.75 19.743 4.75736 20.7503 6 20.7503H10.25C10.6642 20.7503 11 20.4145 11 20.0003V17.0003C11 16.1719 11.6716 15.5003 12.5 15.5003C13.3284 15.5003 14 16.1719 14 17.0003V20.0003C14 20.4145 14.3358 20.7503 14.75 20.7503H19C20.2426 20.7503 21.25 19.743 21.25 18.5003V10.3789C21.25 9.6707 20.9166 9.00383 20.35 8.57891L13.85 3.70391Z" fill="#ffffff"/>
        </svg> <!--Ícone de início-->
      </a>
    </li>

    <li id="mandartarefas" class="lista-sidebar">
      <a href="<?php echo("".$path)?>tarefas.php">
        <svg width="50" height="50" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M10 3.5C8.75736 3.5 7.75 4.50736 7.75 5.75V6.5H4.75C3.50736 6.5 2.5 7.50736 2.5 8.75V17.75C2.5 18.9926 3.50736 20 4.75 20H19.2502C20.4928 20 21.5002 18.9926 21.5002 17.75V8.75C21.5002 7.50736 20.4928 6.5 19.2502 6.5H16.25V5.75C16.25 4.50736 15.2426 3.5 14 3.5H10ZM14.75 6.5H9.25V5.75C9.25 5.33579 9.58579 5 10 5H14C14.4142 5 14.75 5.33579 14.75 5.75V6.5Z" fill="#ffffff"/>
        </svg> <!--Ícone de tarefas-->
      </a>
    </li>

    <li id="mandarequipes" class="lista-sidebar">
      <a href="<?php echo("".$path)?>equipes.php">
        <svg width="50" height="50" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.75 2.5C5.50736 2.5 4.5 3.50736 4.5 4.75V19.5C4.5 21.1569 5.84315 22.5 7.5 22.5H18.75C19.1642 22.5 19.5 22.1642 19.5 21.75C19.5 21.3358 19.1642 21 18.75 21H18V18H18.75C19.1642 18 19.5 17.6642 19.5 17.25V4.75C19.5 3.50736 18.4926 2.5 17.25 2.5H6.75ZM7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18H16.5V21H7.5ZM8.625 5.875H15.375C15.7892 5.875 16.125 6.21079 16.125 6.625V9.875C16.125 10.2892 15.7892 10.625 15.375 10.625H8.625C8.21079 10.625 7.875 10.2892 7.875 9.875V6.625C7.875 6.21079 8.21079 5.875 8.625 5.875Z" fill="#ffffff"/>
        </svg> <!--Ícone de equipes-->
      </a>
    </li>

    <li id="mandarconfiguracoes" class="lista-sidebar">
      <a  href="<?php echo("".$path)?>Configuracoes/geral.php">
        <svg width="50" height="50" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3.39854 12.1458C2.33012 11.5289 1.96404 10.1627 2.5809 9.09428L4.09689 6.4685C4.71388 5.39984 6.08042 5.03388 7.14894 5.65079C7.63842 5.9334 8.25011 5.58009 8.25011 5.01524C8.25011 3.78144 9.2503 2.78125 10.4841 2.78125H13.5165C14.7502 2.78125 15.7501 3.78149 15.7501 5.01502C15.7501 5.57981 16.3615 5.93263 16.8503 5.65041C17.9185 5.03366 19.2845 5.39967 19.9012 6.46792L21.4176 9.09435C22.0345 10.1628 21.6684 11.5289 20.6 12.1458C20.1108 12.4282 20.1108 13.1343 20.6 13.4167C21.6684 14.0336 22.0344 15.3998 21.4176 16.4682L19.9012 19.0946C19.2845 20.1629 17.9185 20.5289 16.8503 19.9121C16.3615 19.6299 15.7501 19.9827 15.7501 20.5475C15.7501 21.781 14.7502 22.7812 13.5165 22.7812H10.4841C9.2503 22.7812 8.25011 21.7811 8.25011 20.5473C8.25011 19.9824 7.63844 19.6291 7.14896 19.9117C6.08044 20.5286 4.71391 20.1627 4.09692 19.094L2.58092 16.4682C1.96407 15.3998 2.33013 14.0336 3.39856 13.4168C3.88776 13.1343 3.88777 12.4282 3.39854 12.1458ZM11.9992 8.94618C9.88118 8.94618 8.16419 10.6632 8.16419 12.7812C8.16419 14.8992 9.88118 16.6162 11.9992 16.6162C14.1172 16.6162 15.8342 14.8992 15.8342 12.7812C15.8342 10.6632 14.1172 8.94618 11.9992 8.94618Z" fill="#ffffff"/>
        </svg><br><br> <!--Ícone de configurações-->
      </a>
    </li>
  </menu>

    <div class="dropdown-perfil">

      <a id="dropdown-perfil-ativar" onclick="alternarDropdown(); return false;" href="#">
      <img id="foto-perfil" src="<?php echo("".$path)?>arquivos/imagens/perfil/perfilpadrao.png"></img></a>

      <div class="menu-dropdown-perfil" id="menu-perfil">
        <div id="perfil-dropdown-top"><a href="<?php echo("".$path)?>Configuracoes/geral.php">Configurações</a></div>
        <div id="perfil-dropdown-bottom"><a href="<?php echo("".$path)?>logout.php">Sair</a></div>
      </div>

    </div>

  </div>

