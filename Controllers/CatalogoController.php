<?php 

namespace Controllers;

use \Core\Controller;
use \Models\Products;

class CatalogoController extends Controller {
  /*========================*/
   /*CONTROLLER HOME*/
   /*======================*/
   public function index() {
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