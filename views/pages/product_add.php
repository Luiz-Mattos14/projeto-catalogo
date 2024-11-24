<h1>ADICIONAR PRODUTO (FORMULÁRIO)</h1>

</br>

<form action="<?php echo BASE_URL; ?>product/add_action" method="POST" enctype="multipart/form-data">
  <label for="name">Nome:</label>
  <input type="text" name="name" ><br>

  <label for="category">Categoria:</label>
  <select name="category" >
    <option value="Eletrônicos">Eletrônicos</option>
    <option value="Vestuário">Vestuário</option>
    <option value="Alimentos">Alimentos</option>
  </select><br>

  <label for="price">Preço:</label>
  <input type="number" step="0.01" name="price" ><br>

  <label for="image">Imagem do Produto</label></br>
  <input type="file" name="images[]" /><br/><br/><br/>

  <button type="submit">Cadastrar Produto</button>
</form>

<?php if (!empty($msg)): ?>
  <div class="msg msg-active">
    <p><?php echo $msg; ?></p>
  </div>
<?php endif; ?>