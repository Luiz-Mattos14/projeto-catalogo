<div>

<h1>HOME</h1>
</br>

<a href="<?php echo BASE_URL; ?>product/add">ADICIONAR (FORMULÁRIO)</a>
</br>
</br>
<a href="<?php echo BASE_URL; ?>product/clean">LIMPAR</a>
</br>
</br>
<a href="<?php echo BASE_URL; ?>product/multiple_products">CRIAR</a>
</br>
</br>
</div>


<div class="product">
  <table>
    <thead>
      <tr>
        <td>ID</td>
        <td>Imagem</td>
        <td>Nome</td>
        <td>Categoria</td>
        <td>Preço</td>
        <td>Status</td>
        <td>Editar</td>
        <td>Excluir</td>
      </tr>
    </thead>

    <tbody>
      <?php foreach($products as $product): ?>
        <tr>
          <td><?php echo $product['id']; ?></td>
          <?php if (isset($product['imagem'][0])): ?>
            <td><img src="<?php echo BASE_URL; ?>media/products/<?php echo $product['imagem'][0]['url']; ?>" alt="" width="50"></td>
          <?php else: ?>
            <td>NO_IMAGE</td>
          <?php endif; ?>
          <td><?php echo $product['name']; ?></td>
          <td><?php echo $product['categoria']; ?></td>
          <td><?php echo $product['preco']; ?></td>
          <td><?php echo $product['status']; ?></td>

          <td><a href="<?php echo BASE_URL.'product/edit/'.$product['id']; ?>">EDITAR</a></td>
          <td><a href="<?php echo BASE_URL.'product/del/'.$product['id']; ?>">EXCLUIR</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

