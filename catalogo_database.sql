-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 28/11/2024 às 23:08
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `catalogo_database`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_imagem_produtos`
--

CREATE TABLE `tb_imagem_produtos` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_imagem_produtos`
--

INSERT INTO `tb_imagem_produtos` (`id`, `id_produto`, `url`) VALUES
(295, 1, 'b61e0f5e44e667492d7630e177b8431d.jpg'),
(296, 2, 'fc2b1ef5b81f14015d4f60639a90e9a9.jpg'),
(297, 3, 'e5a921ca85cd5dd9936afcc63380a95a.jpg'),
(298, 4, '1249f43bc3d7fe7932ad2cd1a7f06a52.jpg'),
(299, 5, 'a6adbdc262a63bc3dd896920b1f55e9e.jpg'),
(300, 6, '33541dcffad22b67a69efef2db4b9a89.jpg'),
(301, 7, '8c7e2b94dca62f813f28ec9b099aea50.jpg'),
(302, 8, '178f89aa06cf5054d68fa89b90772a4d.jpg'),
(303, 9, '481a674539dcb666dfda05943bf8aa3a.jpg'),
(304, 10, '40ea3c9573063284eaae96d7ca04a662.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL,
  `cod_produto` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `preco` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id`, `cod_produto`, `name`, `categoria`, `preco`) VALUES
(1, 'COD001', 'Produto 1 Produto 1 Produto 1 Produto 1 Produto 1 Produto 1 Produto 1 Produto 1 Produto 1 Produto 1	', 'Categoria 1', 100),
(2, 'COD002', 'Produto 2', 'Categoria 2', 1033.33),
(3, 'COD003', 'Produto 3', 'Categoria 3', 300),
(4, 'COD004', 'Produto 4', 'Categoria 1', 400),
(5, 'COD005', 'Produto 5', 'Categoria 2', 500),
(6, 'COD006', 'Produto 6', 'Categoria 3', 600),
(7, 'COD007', 'Produto 7', 'Categoria 1', 700),
(8, 'COD008', 'Produto 8', 'Categoria 2', 800),
(9, 'COD009', 'Produto 9', 'Categoria 3', 900),
(10, 'COD010', 'Produto 10', 'Categoria 1', 1000),
(11, 'teste001', 'dual', 'Categoria 1', 100),
(14, 'teste001', 'dual', 'Categoria 1', 100);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_imagem_produtos`
--
ALTER TABLE `tb_imagem_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_imagem_produtos`
--
ALTER TABLE `tb_imagem_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
