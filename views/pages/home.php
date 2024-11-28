<section class="header container">
  <h1>PAINEL DE CATÁLOGO</h1>
</section>

<section class="section list-products container">
  <div class="top">
    <a class="link" href="<?php echo BASE_URL; ?>product/add">Adicionar</a>
    <a class="link" href="<?php echo BASE_URL; ?>product/clean">Limpar</a>
    <a class="link" href="<?php echo BASE_URL; ?>product/multiple_products">Criar</a>
    <a class="link" href="<?php echo BASE_URL; ?>catalogo/view_catalogo">Catálogo</a>
  </div>

  <div class="list-wrapper">
    <table>
      <thead>
        <tr>
          <td>ID</td>
          <td>Imagem</td>
          <td class="-hidden">Referência</td>
          <td>Nome</td>
          <td class="-hidden">Categoria</td>
          <td class="-hidden">Preço</td>
          <td>Editar</td>
          <td>Excluir</td>
        </tr>
      </thead>

      <tbody>
        <?php foreach($products as $product): ?>
          <tr>
            <td class="col-xs"><?php echo $product['id']; ?></td>
            <?php if (isset($product['imagem'][0])): ?>
              <td class="col-sm"><img src="<?php echo BASE_URL; ?>media/products/<?php echo $product['imagem'][0]['url']; ?>" alt="" width="50"></td>
            <?php else: ?>
              <td class="col-sm">
                <img src="<?php echo BASE_URL; ?>assets/placeholder.jpg" alt="" width="50">
              </td>
            <?php endif; ?>
            <td class="col-xs -hidden"><?php echo $product['cod_produto']; ?></td>
            <td class="col-lg name-product"><?php echo $product['name']; ?></td>
            <td class="col-md -hidden"><?php echo $product['categoria']; ?></td>
            <td class="col-md -hidden" data-price><?php echo $product['preco']; ?></td>

            <td class="col-xs">
              <a href="<?php echo BASE_URL.'product/edit/'.$product['id']; ?>">
                <svg class="icon"><use xlink:href="#icon-pencil" /></svg>
              </a>
            </td>
            <td class="col-xs">
              <a href="<?php echo BASE_URL.'product/del/'.$product['id']; ?>" onclick="return confirmDelete();">
                <svg class="icon"><use xlink:href="#icon-del" /></svg>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<script>
  function confirmDelete() {
    // Exibe um alerta de confirmação
    return confirm('Tem certeza que deseja deletar este produto?');
  }
</script>

