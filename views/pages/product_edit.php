<h1>EDITAR PRODUTO</h1>

<?php echo $item['id']; ?>

</br>

<form action="<?php echo BASE_URL; ?>product/edit_action" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $item['id']; ?>">

  <label for="name">Nome:</label>
  <input type="text" name="name" value="<?php echo $item['name']; ?>"><br>

  <label for="category">Categoria:</label>
  <select name="category" >
    <option value="<?php echo $item['categoria']; ?>"><?php echo $item['categoria']; ?></option>
    <option value="Eletrônicos">Eletrônicos</option>
    <option value="Vestuário">Vestuário</option>
    <option value="Alimentos">Alimentos</option>
  </select><br>

  <label for="price">Preço:</label>
  <input type="number" step="0.01" name="price" value="<?php echo $item['preco']; ?>"><br>

  <?php if (isset($item['imagem'][0])): ?>
    <img src="<?php echo BASE_URL; ?>media/products/<?php echo $item['imagem'][0]['url']; ?>" alt="" width="50">
  <?php endif; ?>
  <label for="images">Imagem do Produto</label></br>
  <input type="file" name="images[]" multiple> <!-- multiple permite selecionar várias imagens -->

  <button type="submit">Editar produto</button>
</form>

<?php if (!empty($msg)): ?>
  <div class="msg msg-active">
    <p><?php echo $msg; ?></p>
  </div>
<?php endif; ?>