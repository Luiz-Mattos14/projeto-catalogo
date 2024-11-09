<?php
namespace Controllers;

use \Core\Controller;

class HomeController extends Controller {

   /*========================*/
   /*CONTROLLER HOME*/
   /*======================*/
   public function index() {
      
      $dados = array (
         "nome" => 'Luiz',
         "result" => 'passou'
      );

		$this->loadTemplate('pages/home', $dados);
	}
}
?>
