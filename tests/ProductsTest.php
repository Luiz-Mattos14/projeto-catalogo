<?php
  /*================================================*/
  /*FUNÇÃO DOS TESTE   */
  /*==============================================*/
  /* comando para rodar o teste no terminal na pasta raiz do projeto */
  /* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/ProductsTest.php */

require_once __DIR__ . '/../config.php';

use PHPUnit\Framework\TestCase;
use Models\Products;

class ProductsTest extends TestCase {
  private $products;
  private $pdoMock;

  // Setup do teste com configuração do mock (BD)
  protected function setUp(): void {
    // Criando o mock do PDO
    $this->pdoMock = $this->createMock(PDO::class);

    // Criando o mock do PDOStatement
    $mock = $this->createMock(PDOStatement::class);

    // Simula a execução da consulta sem erros
    $mock->method('execute')->willReturn(true);

    // Simula a função fetchAll retornando produtos
    $mock->method('fetchAll')->willReturn([
      ['id' => 1, 'cod_produto' => 'COD001', 'name' => 'Produto 1', 'categoria' => 'Categoria 1', 'preco' => 50.0],
      ['id' => 2, 'cod_produto' => 'COD002', 'name' => 'Produto 2', 'categoria' => 'Categoria 2', 'preco' => 60.0]
    ]);

    // Simula a função rowCount para retornar que há 2 produtos
    $mock->method('rowCount')->willReturn(2);

    // // Simula a função fetch para o produto individual
    $mock->method('fetch')->willReturn([
      'id' => 1,
      'cod_produto' => 'COD001',
      'name' => 'Produto Teste',
      'categoria' => 'Categoria Teste',
      'preco' => 99.99
    ]);

    // Agora garantimos que o prepare e o query sempre retornarão o mock
    $this->pdoMock->method('prepare')->willReturn($mock);
    $this->pdoMock->method('query')->willReturn($mock);

    // Mock do método lastInsertId (simula a inserção do produto)
    $this->pdoMock->method('lastInsertId')->willReturn('1'); // Retorna o ID inserido

    // Inicializando a classe Products
    $this->products = $this->getMockBuilder(Products::class)
      ->onlyMethods(['deleteImageByID', 'addProductImage'])
      ->getMock();

    // Usando Reflection para injetar o mock do PDO no objeto Products
    $reflection = new \ReflectionClass($this->products);
    $dbProperty = $reflection->getProperty('db');
    $dbProperty->setAccessible(true); // Torna a propriedade acessível
    $dbProperty->setValue($this->products, $this->pdoMock); // Atribui o mock do PDO
  }

  // Utilizando tearDown para organizar a saída dos testes
  protected function tearDown(): void {
    // Mensagens de sucesso ao final dos testes
    $this->printSuccessMessages();
  }

  // Teste para criar um produto
  public function testCreateProduct(): void {
    $codProduto = "COD001";
    $name = "Produto Teste";
    $category = "Categoria Teste";
    $price = 99.99;
    $images = [
      'name' => ['image1.jpg'],
      'type' => ['image/jpeg'],
      'tmp_name' => ['/tmp/phpYzdqkD'],
      'error' => [0],
      'size' => [12345],
    ];

    // Executa o método createProduct
    $this->products->createProduct($codProduto, $name, $category, $price, $images);

    // Verifica se o produto foi adicionado corretamente
    $product = $this->products->getProduct(1);

    //print_r($product);
    $this->assertEquals($codProduto, $product['cod_produto']);
    $this->assertEquals($name, $product['name']);
    $this->assertEquals($category, $product['categoria']);
    $this->assertEquals($price, $product['preco']);

    // Adiciona a mensagem de sucesso ao final
    $this->addSuccessMessage("testCreateProduct");
  }

  // Teste para obter todos os produtos
  public function testGetProductAll(): void {
    $products = $this->products->getProductAll();

    $this->assertIsArray($products);
    $this->assertNotEmpty($products);
    $this->assertCount(2, $products);

    //print_r($products);

    // Verifica se os dados dos produtos estão corretos
    $this->assertEquals('COD001', $products[0]['cod_produto']);
    $this->assertEquals('COD002', $products[1]['cod_produto']);
    $this->assertEquals('Produto 1', $products[0]['name']);
    $this->assertEquals('Produto 2', $products[1]['name']);

    // Adiciona a mensagem de sucesso
    $this->addSuccessMessage("testGetProductAll");
  }

  // Teste para obter um único produto
  public function testGetProduct(): void {
    $productId = 1;

    // Executa a função getProduct e captura o retorno
    $product = $this->products->getProduct($productId);

    //print_r($product);

    // Verifica se o produto retornado está correto
    $this->assertIsArray($product); 
    $this->assertEquals($productId, $product['id']); 
    $this->assertEquals('COD001', $product['cod_produto']);
    $this->assertEquals('Produto Teste', $product['name']); 
    $this->assertEquals('Categoria Teste', $product['categoria']);
    $this->assertEquals(99.99, $product['preco']);

    // Adiciona a mensagem de sucesso ao final
    $this->addSuccessMessage("testGetProduct");
  }

  // Teste para editar o produtos
  public function testEditProduct(): void {
    $id = 1;
    $codProduto = "COD001"; 
    $newName = "Produto Editado";
    $newCategory = "Categoria Editada";
    $newPrice = 10.0;
    $images = [
      'name' => ['image1.jpg'],
      'type' => ['image/jpeg'],
      'tmp_name' => ['/tmp/phpYzdqkD'],
      'error' => [0],
      'size' => [12345],
    ];

    // Executa a função editProduct e captura o retorno
    $result = $this->products->editProduct($id,  $codProduto, $newName, $newCategory, $newPrice, $images);

    print_r($result);

    // Verifica se os dados do produto foram atualizados corretamente
    $this->assertEquals($newName, $result['name']);
    $this->assertEquals($codProduto, $result['cod_produto']); 
    $this->assertEquals($newCategory, $result['categoria']);
    $this->assertEquals($newPrice, $result['preco']);

    // Adiciona a mensagem de sucesso ao final
    $this->addSuccessMessage("testEditProduct");
  }


  /*================================================*/
  /*BLOCO DE FUNÇÃO DO RETORNO DAS MENSAGENS DO PHPUNIT  */
  /*==============================================*/
  private $successMessages = [];

  private function addSuccessMessage(string $testName): void {
    $this->successMessages[] = "Teste '$testName' passou com sucesso.";
  }

  // Função para imprimir as mensagens de sucesso
  private function printSuccessMessages(): void {
    // Limpa a tela para evitar sobrecarga de mensagens
    if (!empty($this->successMessages)) {
      echo PHP_EOL . "Testes finalizados com sucesso!" . PHP_EOL;
      foreach ($this->successMessages as $message) {
          echo $message . PHP_EOL;
      }
    }
  }
}

?>
