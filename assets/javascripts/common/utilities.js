// ===============================================================
// FORMAT MONEY
// ===============================================================
export function formatMoneyTable(value) {
  const priceAll = document.querySelectorAll("[data-price]");

  if (priceAll.length > 0)
    priceAll.forEach((price) => {
      const value = parseFloat(price.textContent.trim());

      if (!isNaN(value)) {
        // Formata o número para o formato monetário brasileiro
        price.textContent = value.toLocaleString("pt-BR", {
          style: "currency",
          currency: "BRL",
        });
      }
    });
}

export function formatMoneyInput() {
  // Seleciona os inputs com o atributo 'data-price'
  const inputs = document.querySelectorAll("input[data-price]");

  inputs.forEach((input) => {
    // Escuta o evento de input para aplicar a formatação enquanto o usuário digita
    input.addEventListener("input", function (event) {
      let value = event.target.value;

      // Remove todos os caracteres não numéricos (exceto ponto e vírgula)
      value = value.replace(/\D/g, "");

      // Converte o valor para número e divide por 100 (caso haja algum valor em centavos)
      let numericValue = parseInt(value);
      if (!isNaN(numericValue)) {
        // Formata o valor para duas casas decimais
        value = (numericValue / 100).toFixed(2);

        // Substitui ponto por vírgula para formato monetário brasileiro
        value = value.replace(".", ",");

        // Adiciona ponto de milhar
        value = value.replace(/(\d)(?=(\d{3})+\,)/g, "$1.");

        // Atualiza o valor no campo de entrada com o prefixo 'R$'
        event.target.value = "R$ " + value;
      }
    });
  });
}
