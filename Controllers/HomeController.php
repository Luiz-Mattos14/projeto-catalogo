<?php
namespace Controllers;

use \Core\Controller;
use \Models\Products;

class HomeController extends Controller {

   /*========================*/
   /*CONTROLLER HOME*/
   /*======================*/
   public function index() {
      $products = new Products();

      $pagination = 1;
      if(isset($_GET['pagina'])) $pagination = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT);
      if(!$pagination) $pagination = 1;

      $limit = 20;
      $start = ($pagination * $limit) - $limit;

      //GET DOS PRODUTOS
      $item = $products->getProductAll($start, $limit);
      //GET DOS PRODUTOS
      $item = $products->getProductAll($start, $limit);
      
      $dados = array (
         'products' => $item,
         'nome' => 'Luiz'
      );

		$this->loadTemplate('pages/home', $dados);
	}
}
?>
