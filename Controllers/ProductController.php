<?php
namespace Controllers;

use \Core\Controller;
use \Models\Products;

class ProductController extends Controller {

   /*========================*/
   /*CONTROLLER PRODUCT*/
   /*======================*/
   public function index() {
      // $products = new Products();

      echo 'Controller Carregado';  // Para testar se o controller está sendo chamado corretamente.

      $dados = array(
        'teste' => 'teste'
     );


      // Exibe o formulário de adicionar produto
      $this->loadTemplate('pages/product', $dados);
	}
}
?>
