# Projeto - Catálogo

Este é um projeto de catálogo de produtos, desenvolvido para organizar e exibir itens de maneira prática e eficiente.

## Requisitos

Para rodar este projeto, você precisará dos seguintes softwares instalados em sua máquina:

- **XAMPP** versão 8.2.4
- **PHP** versão 8.4.1

## Instalação

Siga os passos abaixo para configurar e iniciar o projeto em sua máquina local:

1. **Clone o repositório**:

   ```bash
   git clone https://seu-repositorio.git
   cd nome-do-repositorio
   ```

2. **Instale o XAMPP**:
   Se ainda não tiver o XAMPP instalado, faça o download da versão **8.2.4** [aqui](https://www.apachefriends.org/index.html) e siga as instruções de instalação para o seu sistema operacional.

3. **Configure o ambiente PHP**:
   Certifique-se de que o PHP 8.4.1 está instalado e configurado corretamente no XAMPP. Você pode verificar a versão do PHP rodando o seguinte comando no terminal:

   ```bash
   php -v
   ```

4. **Importe o banco de dados**:
   Na raiz do projeto, você encontrará o arquivo `catalogo_database.sql`. Para importar o banco de dados:
   - Abra o **phpMyAdmin** no XAMPP.
   - Crie um novo banco de dados com o nome desejado.
   - Importe o arquivo `catalogo_database.sql` para o banco de dados criado.

## Iniciar o Projeto

1. **Inicie os serviços do XAMPP**:

   - Abra o **XAMPP Control Panel** e inicie os serviços **Apache** e **MySQL**.

2. **Acesse o projeto**:

   - Abra seu navegador e vá para [http://localhost](http://localhost). O projeto estará rodando localmente.

3. **Configuração final**:
   Caso necessário, ajuste as configurações no arquivo de conexão com o banco de dados, conforme as credenciais do seu ambiente local.

## Funcionalidades

- **Cadastro de produtos**: Adicione, edite e exclua produtos no catálogo.
- **Visualização de produtos**: Exiba os produtos cadastrados de forma organizada.
