<?php
namespace Controllers;

use \Core\Controller;
use \Models\Products;

class ProductController extends Controller {

  /*========================*/
  /*CONTROLLER ADICIONAR O PRODUTO*/
  /*======================*/
  public function index() {
    $products = new Products();

    header("Location: ".BASE_URL."home");
    exit;
	}

  public function add() {
    $dados = array();

		$products = new Products();
    $dados['item'] = $products->getProductAll();

		$this->loadTemplate('pages/product_add', $dados);
  }

  public function add_action() {
		if(!empty($_POST['name'])) {

      $name = $_POST['name'];
      $category = $_POST['category'];
      $preco = $_POST['price'];
      // $status = $_POST['status'];

      $images = (!empty($_FILES['images']))?$_FILES['images']:array();

      // echo "<pre>";
			// var_dump('imagem', $images);
			// echo "</pre>";

      if(!empty($name)) {
        $products = new Products();

        $result = $products->createProduct($name, $category, $preco, $images);
      } else {
				header("Location: ".BASE_URL."home");
        exit;
			}

      header("Location: ".BASE_URL."home");
      exit;

    } else {
      header("Location: ".BASE_URL."home");
      exit;
    }
  }

  public function edit($id) {
    if(!empty($id)) {
      $dados = array();

      $products = new Products();

      $dados['item'] = $products->getProduct($id);

      $this->loadTemplate('pages/product_edit', $dados);
    }
  }

  public function edit_action() {
    if(!empty($_POST['id'])){
      $id = $_POST['id'];
      $name = $_POST['name'];
      $category = $_POST['category'];
      $price = $_POST['price'];

      $images = (!empty($_FILES['images']))?$_FILES['images']:array();


      echo "<pre>";
      if(isset($_FILES['images'])) {
        var_dump($_FILES['images']);
      }

      echo "</pre>";

      if(!empty($name)) {
        $products = new Products();

        $products->editProduct($id, $name, $category, $price,  $images);
      }
    }
  }

	public function del($id) {

    if(!empty($id)) {
      $products = new Products();
      $products->delProduct($id);
    }

    header("Location: ".BASE_URL."home");
    exit;
  }

  public function clean() {
    $products = new Products();
    $products->cleanAllProducts();

    header("Location: ".BASE_URL."home");
    exit;
  }

  public function multiple_products() {
    // Definir os dados base para o produto
    $baseProduct = [
      'category' => 'Categoria ',
      'preco' => 100.00,
    ];

    // Gerar os 10 produtos dinamicamente
    $productsAll = [];
    for ($i = 1; $i <= 10; $i++) {
      // Caminho da imagem na pasta assets/media
      $imageName = 'image-' . $i . '.jpg';  // Alterar para .png se necessário
      $imagePath = 'assets/media/' . $imageName;

      // Verificar se o arquivo existe
      if (file_exists($imagePath)) {
        // Obter o tipo de imagem
        $type = mime_content_type($imagePath);

        // Simulando o array $_FILES
        $tmp_name = $imagePath;
        $error = 0;
        $size = filesize($imagePath);

        // Simulando o array $_FILES
        $simulatedFiles = [
          'name' => [$imageName],
          'type' => [$type],
          'tmp_name' => [$tmp_name],
          'error' => [$error],
          'size' => [$size]
        ];

        // Adicionando o produto com o caminho correto para a imagem
        $productsAll[] = [
          'name' => 'Produto ' . $i,
          'category' => $baseProduct['category'] . $i,
          'preco' => $baseProduct['preco'] * $i,
          'images' => $simulatedFiles
        ];
      } else {
        // Caso o arquivo não exista, pode adicionar um erro ou pular o produto
        continue;
      }
    }

    // Chama o Model para criar os produtos no banco de dados
    $products = new Products();
    foreach ($productsAll as $product) {
      // Chama o método de criação do produto, que já processa as imagens corretamente
      $products->createProduct($product['name'], $product['category'], $product['preco'], $product['images']);
    }

    header("Location: " . BASE_URL . "home");
    exit;
  }
}
