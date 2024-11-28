<h1>CATALOGO</h1>

<button type='button' class="generate-pdf">Gerar PDF</button>

<div class="content" id="content"> <!-- Adicionada a ID aqui -->
  <table>
    <thead>
      <tr>
        <td>ID</td>
        <td>Código Produto</td>
        <td>Imagem</td>
        <td>Nome</td>
        <td>Categoria</td>
        <td>Preço</td>
        <td>Editar</td>
        <td>Excluir</td>
      </tr>
    </thead>

    <tbody>
      <?php foreach($products as $product): ?>
        <tr>
          <td><?php echo $product['id']; ?></td>
          <td><?php echo $product['cod_produto']; ?></td>
          <?php if (isset($product['imagem'][0])): ?>
            <td><img src="<?php echo BASE_URL; ?>media/products/<?php echo $product['imagem'][0]['url']; ?>" alt="" width="50"></td>
          <?php else: ?>
            <td>NO_IMAGE</td>
          <?php endif; ?>
          <td><?php echo $product['name']; ?></td>
          <td><?php echo $product['categoria']; ?></td>
          <td><?php echo $product['preco']; ?></td>

          <td><a href="<?php echo BASE_URL.'product/edit/'.$product['id']; ?>">EDITAR</a></td>
          <td><a href="<?php echo BASE_URL.'product/del/'.$product['id']; ?>">EXCLUIR</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  const button = document.querySelector('.generate-pdf');

  if(button) button.addEventListener("click", () => {
    console.log("clicou");
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF();

    // Captura o HTML e gera o PDF
    pdf.html(document.getElementById('content'), {
      callback: function (doc) {
        doc.save("catalogo.pdf");
      },
      x: 10,
      y: 10
    });
  })


</script>
