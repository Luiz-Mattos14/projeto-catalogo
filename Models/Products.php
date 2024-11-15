<?php
namespace Models;

use \Core\Model;

class Products extends Model {
   /*================================================*/
   /*BLOCO DE FUNÇÃO DAS CONTRUÇÕES DOS PRODUTOS    */
   /*==============================================*/

   public function getProductAll($start, $limit){
      $sql = "SELECT * FROM tb_produtos ORDER BY categoria ASC LIMIT $start, $limit";
      $sql = $this->db->query($sql);

      if($sql->rowCount() > 0){
         $products = $sql->fetchAll(\PDO::FETCH_ASSOC);

         return $products;
      } else{
         $_SESSION['returnMsg'] = 'Os Produtos não foram encontrados';

         return $_SESSION['returnMsg'];
      }
   }

   public function getCountProduct(){
      $sql = "SELECT COUNT(nome_produto) count FROM tb_produtos";
      $sql = $this->db->query($sql);

      if($sql->rowCount() > 0){
         $dados = $sql->fetch(\PDO::FETCH_ASSOC);

         return $dados['count'];
      }
   }

   public function countProductPage($limit){
      $sql = "SELECT COUNT(nome_produto) count FROM tb_produtos";
      $sql = $this->db->query($sql);

      if($sql->rowCount() > 0){
         $count = $sql->fetch(\PDO::FETCH_ASSOC);

         $dados = ceil($count['count'] / $limit);

         return $dados;
      }
   }
}
?>
