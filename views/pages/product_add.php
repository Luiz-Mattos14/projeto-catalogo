<section class="header container">
  <h1>ADICIONAR PRODUTO</h1>
</section>

<section class="section list-products container">
  <div class="top">
    <a class="link" href="<?php echo BASE_URL; ?>home">Voltar</a>
  </div>

  <div class="list-wrapper">
    <form class="form-wrapper" action="<?php echo BASE_URL; ?>product/add_action" method="POST" enctype="multipart/form-data">

      <fieldset>
        <label class="label col-md" for="cod_produto">
          <span>Referência*</span>
          <input class="input" type="text" name="cod_produto" placeholder="Digite aqui..." required maxlength="10">
        </label>

        <label class="label col-md" for="name">
          <span>Nome*</span>
          <input class="input" type="text" name="name" placeholder="Digite aqui..." required maxlength="100">
        </label>  

        <label class="label col-md" for="category">
          <span>Categoria*</span>
          <select class="select" name="category" required>
            <option value="Categoria 1">Categoria 1</option>
            <option value="Categoria 2">Categoria 2</option>
            <option value="Categoria 3">Categoria 3</option>
          </select>
        </label>


        <label class="label" for="price" required>
          <span>Preço*</span>
          <input class="input" type="text" name="price" placeholder="Digite aqui..." required data-price maxlength="10">
        </label>

        <label class="label -image" for="image" data-image-form>
          <svg class="icon"><use xlink:href="#icon-image" /></svg>
          <h4>Arraste ou clique aqui</h4>
          <input type="file" name="images[]" id="image" accept="image/*" />

          <div class="image-preview-container" style="display: none;">
            <img class="image-preview" src="" alt="Imagem selecionada" style="max-width: 100%; margin-top: 10px;"/>
          </div>
        </label>

        <button class="btn" type="submit">Cadastrar Produto</button>
      </fieldset>
    </form>

    <?php if (!empty($msg)): ?>
      <div class="msg msg-active">
        <p><?php echo $msg; ?></p>
      </div>
    <?php endif; ?>
  </div>
</section>
