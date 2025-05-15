function openSidebar() {
    document.getElementById("sidebar").style.left = "0";
    document.getElementById("overlay").style.display = "block";
  }

  function closeSidebar() {
    document.getElementById("sidebar").style.left = "-250px";
    document.getElementById("overlay").style.display = "none";
  }

  var tema = "Claro";
  var cor = "#FFFFFF"

  function mudartema(body) {
    if (tema == "Claro")
    {
      cor = "#000000";
      tema = "Escuro";
    }
    else{
      cor = "#FFFFFF";
      tema = "Claro";
    }
    body.style.backgroundColor = cor;
}

    