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
    if (!empty($_POST['name'])) {
      $cod_prod = $_POST['cod_produto'];
      $name = $_POST['name'];
      $category = $_POST['category'];
      $preco = $_POST['price'];

      $images = (!empty($_FILES['images'])) ? $_FILES['images'] : array();

      if (!empty($cod_prod) && !empty($name) && !empty($category)) {
        $products = new Products();

        // Criar o produto com o preço formatado
        $result = $products->createProduct($cod_prod, $name, $category, $preco, $images);
      } else {
        header("Location: " . BASE_URL . "home");
        exit;
      }

      header("Location: " . BASE_URL . "home");
      exit;
    } else {
        header("Location: " . BASE_URL . "home");
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
      $cod_prod = $_POST['cod_produto'];
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

        $products->editProduct($id, $cod_prod, $name, $category, $price,  $images);
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
      'category' => ['Categoria 1', 'Categoria 2', 'Categoria 3'],
      'preco' => 100.00,
    ];

    // Gerar os 10 produtos dinamicamente
    $productsAll = [];
    for ($i = 1; $i <= 10; $i++) {
      // Caminho da imagem na pasta assets/media
      $imageName = 'image-' . $i . '.jpg'; 
      $imagePath = 'assets/media/' . $imageName;

      // Verificar se o arquivo existe
      if (file_exists($imagePath)) {
        // Obter o tipo de imagem
        $type = mime_content_type($imagePath);

        // Simulando o array $_FILES
        $tmp_name = $imagePath;
        $error = 0;
        $size = filesize($imagePath);

        $simulatedFiles = [
            'name' => [$imageName],
            'type' => [$type],
            'tmp_name' => [$tmp_name],
          'error' => [$error],
          'size' => [$size]
        ];

        // Adicionando o produto com o caminho correto para a imagem
        $productsAll[] = [
            'cod_produto' => 'COD' . str_pad($i, 3, '0', STR_PAD_LEFT), // Código do produto
          'name' => 'Produto ' . $i,
          'category' => $baseProduct['category'][($i - 1) % 3], // Alterna entre as categorias
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
      $products->createProduct($product['cod_produto'], $product['name'], $product['category'], $product['preco'], $product['images']);
    }

    header("Location: " . BASE_URL . "home");
    exit;
  }
}
