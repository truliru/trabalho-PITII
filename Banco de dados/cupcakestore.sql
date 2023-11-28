-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Nov-2023 às 00:47
-- Versão do servidor: 5.7.17
-- versão do PHP: 8.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cupcakestore`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `Nome` char(80) NOT NULL,
  `Telefone` int(20) NOT NULL,
  `Rua` varchar(80) NOT NULL,
  `Numero` int(10) NOT NULL,
  `Cidade` varchar(80) NOT NULL,
  `Estado` varchar(40) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Usuario` varchar(40) NOT NULL,
  `Senha` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `Nome`, `Telefone`, `Rua`, `Numero`, `Cidade`, `Estado`, `Email`, `Usuario`, `Senha`) VALUES
(7, 'testetes', 33333333, 'teste', 333333, 'teste', 'teste', 'teste@gmail.com', 'teste4', 'teste4'),
(6, 'teste', 33333333, 'teste', 123, 'teste', 'te', 'teste@gmail.com', 'teste', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhes_pedido`
--

CREATE TABLE `detalhes_pedido` (
  `Id_detalhe` int(11) NOT NULL,
  `Id_pedido` int(11) DEFAULT NULL,
  `Preco_unitario` decimal(10,2) DEFAULT NULL,
  `nome_do_produto` varchar(100) DEFAULT NULL,
  `Quantidade` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `detalhes_pedido`
--

INSERT INTO `detalhes_pedido` (`Id_detalhe`, `Id_pedido`, `Preco_unitario`, `nome_do_produto`, `Quantidade`) VALUES
(21, 7, 10.99, 'Baunilha em pedaco', 2),
(20, 7, 15.99, 'Cream Rose', 1),
(19, 6, 25.00, 'Bomba de Chocolate', 1),
(18, 6, 10.99, 'Baunilha em pedaco', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `Id_pedido` int(11) NOT NULL,
  `Valor` decimal(10,2) DEFAULT NULL,
  `Id_cliente` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`Id_pedido`, `Valor`, `Id_cliente`) VALUES
(5, NULL, 7),
(4, NULL, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `Id_produto` int(11) NOT NULL,
  `Nome_produto` varchar(100) DEFAULT NULL,
  `Preco_produto` double(10,2) DEFAULT NULL,
  `Categoria_produto` varchar(50) DEFAULT NULL,
  `path-produto` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`Id_produto`, `Nome_produto`, `Preco_produto`, `Categoria_produto`, `path-produto`) VALUES
(1, 'Red Velvet', 19.99, 'Morango', './assets/img/cup-1.webp'),
(7, 'Baunilha em pedaco', 10.99, 'Baunilha', './assets/img/cup-4.webp'),
(3, 'Cream Rose', 15.99, 'Framboesa', './assets/img/cup-2.webp'),
(5, 'Bomba de Chocolate', 25.00, 'Chocolate', './assets/img/cup-3.webp'),
(14, 'Pistache', 30.00, 'Pistache', './assets/img/cup-5.webp'),
(15, 'White Flake', 15.00, 'Baunilha', './assets/img/cup-6.webp');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `detalhes_pedido`
--
ALTER TABLE `detalhes_pedido`
  ADD PRIMARY KEY (`Id_detalhe`),
  ADD KEY `Id_pedido` (`Id_pedido`),
  ADD KEY `fk_nome_produto` (`nome_do_produto`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Id_pedido`),
  ADD KEY `fk_cliente` (`Id_cliente`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`Id_produto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `detalhes_pedido`
--
ALTER TABLE `detalhes_pedido`
  MODIFY `Id_detalhe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `Id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
