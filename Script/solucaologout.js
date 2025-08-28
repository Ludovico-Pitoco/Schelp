window.addEventListener("pageshow", function (event) {
  // Se a página veio do cache do navegador
  if (
    event.persisted ||
    (window.performance && window.performance.navigation.type === 2)
  ) {
    // Força o recarregamento da página
    window.location.reload();
  }
});
