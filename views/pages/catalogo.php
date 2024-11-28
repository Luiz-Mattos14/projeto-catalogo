<!-- HTML -->
<section class="header container">
  <h1>CATÁLOGO</h1>
</section>

<section class="section list-products container">
  <div class="top">
    <a class="link" href="<?php echo BASE_URL; ?>home">Voltar</a>
    <button class="link" type='button' data-button-pdf>Gerar PDF</button>
  </div>

  <div class="list-wrapper">
    <div class="content" id="content">
      <?php foreach($products as $product): ?>
        <div class="product-block">
          <figure class="image">
            <img src="<?php echo BASE_URL; ?>media/products/<?php echo $product['imagem'][0]['url']; ?>" alt="" srcset="">
          </figure>
          <div class="description">
            <div class="cod-product">
              <?php echo $product['cod_produto']; ?>
            </div>
            <div class="category">
              <?php echo $product['categoria']; ?>
            </div>
            <div class="name">
              <h3><?php echo $product['name']; ?></h3>
            </div>

            <div class="price">
              <?php echo 'R$ ' . number_format($product['preco'], 2, ',', '.'); ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Script -->
<script>
  const button = document.querySelector('[data-button-pdf]');

  if (button) {
    button.addEventListener("click", () => {
      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF();

      // Verifica se o html2canvas está carregado corretamente
      if (typeof html2canvas === 'undefined') {
        console.error("html2canvas não foi carregado corretamente.");
        return;
      }

      // Usando html2canvas para capturar o conteúdo com o estilo
      html2canvas(document.getElementById('content'), {
        useCORS: true, // Garante que imagens externas sejam carregadas corretamente
        letterRendering: true
      }).then((canvas) => {
        const imgData = canvas.toDataURL('image/jpeg');

        // Ajuste a escala do tamanho da imagem para o PDF
        const pdfWidth = 210; // A largura padrão do A4 em mm
        const pdfHeight = (canvas.height * pdfWidth) / canvas.width; // Mantém a proporção

        // Adiciona a imagem ao PDF
        pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight); // Ajuste o tamanho conforme necessário
        
        // Salva o PDF
        pdf.save("catalogo.pdf");
      }).catch((error) => {
        console.error("Erro ao gerar o PDF:", error);
      });
    });
  }
</script>
