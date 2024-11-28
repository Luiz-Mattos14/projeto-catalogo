<?php 

namespace Controllers;

use \Core\Controller;
use \Models\Products;

class CatalogoController extends Controller {
  /*========================*/
  /*CONTROLLER CATALOGO */
  /*======================*/
  public function index() {

    header("Location: ".BASE_URL."home");
    exit;
  }

  public function view_catalogo() {
    $products = new Products();

    //GET DOS PRODUTOS
    $item = $products->getProductAll();
    
    $dados = array (
      'products' => $item,
    );

    $this->loadTemplate('pages/catalogo', $dados);
  }
}

?>