<?php
namespace Models;

use \Core\Model;

class Products extends Model {
  /*================================================*/
  /*BLOCO DE FUNÇÃO DAS CONTRUÇÕES DOS PRODUTOS    */
  /*==============================================*/

  public function getProductAll() {
    $sql = "SELECT * FROM tb_produtos ORDER BY id ASC";
    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $products = $sql->fetchAll(\PDO::FETCH_ASSOC);

      foreach ($products as $key => $item) {
        $products[$key]['imagem'] = $this->getImagesByProductId($item['id']);
      }
    } else {
      $_SESSION['returnMsg'] = 'Os Produtos não foram encontrados';

      $products = [];
    }

    return $products;
  }

  public function getProduct($id) {
    $sql = "SELECT * FROM tb_produtos WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0){
      $product = $sql->fetch(\PDO::FETCH_ASSOC);  

      $product['imagem'] = $this->getImagesByProductId($product['id']);

      return $product;
    } else {
      $_SESSION['returnMsg'] = 'O Produto não foi encontrados';

      return $_SESSION['returnMsg'];
    }
  }

  public function createProduct($cod_prod, $name, $category, $preco, $images) {
    $sql = "INSERT INTO tb_produtos (cod_produto, name, categoria, preco) VALUES (:cod_produto, :name, :categoria, :preco)";
    $sql = $this->db->prepare($sql);

    $sql->bindValue(':cod_produto', $cod_prod);
    $sql->bindValue(':name', $name);
    $sql->bindValue(':categoria', $category);
    $sql->bindValue(':preco', $preco);
    $sql->execute();

    $id = $this->db->lastInsertId();

    $allowed_images = array('image/jpeg', 'image/jpg', 'image/png');
      
    for($q=0;$q<count($images['name']);$q++) {
      $tmp_name = $images['tmp_name'][$q];
      $type = $images['type'][$q];

      if(in_array($type, $allowed_images)) {
        $this->addProductImage($id, $tmp_name, $type);
      }
    }
  }

  public function editProduct($id, $cod_prod,  $name, $category, $price, $images) {
    if (!empty($id) && !empty($cod_prod) && !empty($name) && !empty($category) && !empty($price)) {
      // Atualiza os dados do produto
      $sql = "UPDATE tb_produtos SET cod_produto = :cod_produto, name = :name, categoria = :category, preco = :price WHERE id = :id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(":cod_produto", $cod_prod);
      $sql->bindValue(":name", $name);
      $sql->bindValue(":category", $category);
      $sql->bindValue(":price", $price);
      $sql->bindValue(":id", $id);
      $sql->execute();

      // Verifica se as imagens foram fornecidas e se têm o formato correto
      if (is_array($images) && isset($images['name']) && !empty($images['name'][0])) {
        // Exclui as imagens antigas
        $this->deleteImageByID($id, $images);
      } elseif (is_array($images) && empty($images['name'][0])) {
        // Se as imagens forem passadas, mas não houverem imagens, podemos ignorar o código
        return;
      }

      // Processa as novas imagens
      if (is_array($images) && isset($images['name'])) {
        for ($q = 0; $q < count($images['name']); $q++) {
          $tmp_name = $images['tmp_name'][$q];
          $type = $images['type'][$q];

          if (in_array($type, ['image/jpeg', 'image/jpg', 'image/png'])) {
            $this->addProductImage($id, $tmp_name, $type);
          }
        }
      }

      // Retorna o produto atualizado
      return [
        'name' => $name,
        'cod_produto' => $cod_prod,
        'categoria' => $category,
        'preco' => $price,
      ];
    }
    return null;
  }

  public function delProduct($id) {
    // Primeiro, excluímos as imagens associadas ao produto
    $this->deleteImageByID($id);

    // Agora, deletamos o produto da tabela tb_produtos
    $sql = "DELETE FROM tb_produtos WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();
  }
  
  public function cleanAllProducts() {
    // Primeiro, removemos todas as imagens associadas aos produtos
    $this->deleteAllProductImages(); // Chama a função que deleta todas as imagens

    // Agora, limpamos a tabela tb_produtos
    $sql = "TRUNCATE TABLE tb_produtos";
    $sql = $this->db->prepare($sql);
    $sql->execute();
  }

  /*================================================*/
  /*BLOCO DE FUNÇÃO DAS CONTRUÇÕES DAS IMAGENS DOS PRODUTOS    */
  /*==============================================*/
  public function addProductImage($id, $tmp_name, $type) {

    switch($type) {
      case 'image/jpg':
      case 'image/jpeg':
        $o_img = imagecreatefromjpeg($tmp_name);
        break;
      
      case 'image/png':
        $o_img = imagecreatefrompng($tmp_name);
        break;
    }

    if(!empty($o_img)) {
      $width = 500;
      $height = 500;
      $ratio = $width / $height;

      list($o_width, $o_height) = getimagesize($tmp_name);

      $o_ratio = $o_width / $o_height;

      if($ratio > $o_ratio) {
        $img_w = $height * $o_ratio;
        $img_h = $height;
      } else {
        $img_h = $width / $o_ratio;
        $img_w = $width;
      }

      if($img_w < $width) {
        $img_w = $width;
        $img_h = $img_w / $o_ratio;
      }

      if($img_h < $height) {
        $img_h = $height;
        $img_w = $img_h * $o_ratio;
      }

      $px = 0;
      $py = 0;

      if($img_w > $width) {
        $px = ($img_w - $width) / 2;
      }

      if($img_h > $height) {
        $py = ($img_h - $height) / 2;
      }

      $img = imagecreatetruecolor($width, $height);
      imagecopyresampled($img, $o_img, -$px, -$py, 0, 0, $img_w, $img_h, $o_width, $o_height);


      $filename = md5(time().rand(0,999).rand(0,999)).'.jpg';

      imagejpeg($img, PATH_SITE.'media/products/'.$filename);

      $sql = "INSERT INTO tb_imagem_produtos (id_produto, url) VALUES (:id_product, :url)";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(":id_product", $id);
      $sql->bindValue(":url", $filename);
      $sql->execute();
    }
  }

  public function getImagesByProductId($id) {
    $array = [];

    $sql = "SELECT url FROM tb_imagem_produtos WHERE id_produto = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    return $array;  // Sempre retorna um array
  }

  public function deleteImageByID($id) {
    // Primeiro, pegamos o caminho da imagem associado ao produto
    $sql = "SELECT url FROM tb_imagem_produtos WHERE id_produto = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id", $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      // Se existir, pegamos o nome do arquivo da imagem
      $image = $sql->fetch(\PDO::FETCH_ASSOC);
      $imagePath = PATH_SITE . 'media/products/' . $image['url'];

      // Excluímos o arquivo da pasta de produtos
      if (file_exists($imagePath)) {
        unlink($imagePath);  // Deleta o arquivo
      }

      // Agora, removemos o registro da imagem na tabela tb_imagem_produtos
      $deleteSql = "DELETE FROM tb_imagem_produtos WHERE id_produto = :id";
      $deleteSql = $this->db->prepare($deleteSql);
      $deleteSql->bindValue(":id", $id);
      $deleteSql->execute();
    }
  }

  public function deleteAllProductImages() {
    // Obtém todas as imagens na tabela tb_imagem_produtos
    $sql = "SELECT url FROM tb_imagem_produtos";
    $sql = $this->db->prepare($sql);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      // Percorre todas as imagens e exclui as físicas e os registros
      $images = $sql->fetchAll(\PDO::FETCH_ASSOC);

      foreach ($images as $image) {
        $imagePath = PATH_SITE . 'media/products/' . $image['url'];

        // Exclui a imagem da pasta
        if (file_exists($imagePath)) {
          unlink($imagePath);
        }

        // Exclui o registro da imagem na tabela tb_imagem_produtos
        $deleteSql = "DELETE FROM tb_imagem_produtos WHERE url = :url";
        $deleteSql = $this->db->prepare($deleteSql);
        $deleteSql->bindValue(":url", $image['url']);
        $deleteSql->execute();
      }
    }
  }
}
?>
