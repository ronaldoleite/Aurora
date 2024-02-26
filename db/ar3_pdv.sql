-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/10/2023 às 20:46
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ar3_pdv`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixa`
--

CREATE TABLE `caixa` (
  `ID` int(11) NOT NULL,
  `VALORINICIAL` decimal(10,2) DEFAULT NULL,
  `VALORFINAL` decimal(10,2) DEFAULT NULL,
  `USUARIO` int(11) DEFAULT NULL,
  `DATAABERTURA` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `caixa`
--

INSERT INTO `caixa` (`ID`, `VALORINICIAL`, `VALORFINAL`, `USUARIO`, `DATAABERTURA`) VALUES
(1, 78.00, NULL, 1, '2023-08-31 20:16:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixas`
--

CREATE TABLE `caixas` (
  `ID` int(11) NOT NULL,
  `VALORFINAL` decimal(10,2) DEFAULT NULL,
  `USUARIO` int(11) DEFAULT NULL,
  `CAIXA` int(11) DEFAULT NULL,
  `DATAFECHAMENTO` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(40) DEFAULT NULL,
  `ESTATUS` enum('A','I') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`ID`, `DESCRICAO`, `ESTATUS`) VALUES
(1, 'Cama, Mesa&Banho', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `ID` int(11) NOT NULL,
  `CODIGO` varchar(6) NOT NULL,
  `NOME` varchar(255) DEFAULT NULL,
  `CPF` varchar(15) DEFAULT NULL,
  `RG` varchar(14) DEFAULT NULL,
  `CIDADE` varchar(40) DEFAULT NULL,
  `LOGRADOURO` varchar(80) DEFAULT NULL,
  `NUMERO` varchar(10) DEFAULT NULL,
  `BAIRRO` varchar(40) DEFAULT NULL,
  `CEP` varchar(40) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `TELEFONE` double DEFAULT NULL,
  `CELULAR` varchar(14) DEFAULT NULL,
  `SEXO` enum('M','F') DEFAULT NULL,
  `ATIVO` enum('S','N') DEFAULT NULL,
  `NOMEMAE` varchar(100) DEFAULT NULL,
  `EMPREGOATUAL` varchar(100) DEFAULT NULL,
  `RENDA` double DEFAULT NULL,
  `LIMITE` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`ID`, `CODIGO`, `NOME`, `CPF`, `RG`, `CIDADE`, `LOGRADOURO`, `NUMERO`, `BAIRRO`, `CEP`, `UF`, `TELEFONE`, `CELULAR`, `SEXO`, `ATIVO`, `NOMEMAE`, `EMPREGOATUAL`, `RENDA`, `LIMITE`) VALUES
(1, '00001', 'Loja', '000.000.000-00', '00.000.000-00', 'Mineiros do Tietê', 'Rua Antônio Félix Neto', '2296', 'Residencial Botânico', '17322-434', 'SP', 0, '00 00000-0000', 'M', 'S', 'Maria', 'Autonomo', 0, 0),
(2, '00002', 'Renata do fonseca vicente rodrigues', '376.652.508-58', '32.554.879-9', 'Mineiros do Tietê', 'Rua Antônio Félix Neto', '2296', 'Residencial Botânico', '17322-434', 'SP', 14, '12 00232-2545', 'F', 'S', 'Vania da Fonseca', 'Dona de Casa', 6500, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `crediario`
--

CREATE TABLE `crediario` (
  `ID` int(11) NOT NULL,
  `DATAPAGAMENTO` datetime DEFAULT NULL,
  `ESTATUS` varchar(40) DEFAULT NULL,
  `CLIENTE` int(11) DEFAULT NULL,
  `VENDA` int(11) DEFAULT NULL,
  `PARCELASPAGAS` decimal(10,0) DEFAULT NULL,
  `VALORPAGO` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `crediario`
--

INSERT INTO `crediario` (`ID`, `DATAPAGAMENTO`, `ESTATUS`, `CLIENTE`, `VENDA`, `PARCELASPAGAS`, `VALORPAGO`) VALUES
(1, '0000-00-00 00:00:00', 'Pago', 1, 5, 0, 0),
(2, '2023-09-19 14:16:52', 'Pago', 1, 6, 1, 100),
(12, NULL, NULL, 1, 6, 2, 59),
(13, NULL, NULL, 1, 6, 3, 68),
(14, '2023-09-19 15:37:06', 'Pago', 2, 7, 1, 27.01),
(15, NULL, NULL, 2, 7, 2, 27.01),
(16, NULL, NULL, 2, 7, 3, 27.01),
(17, NULL, NULL, 2, 7, 3, 27.01),
(18, NULL, NULL, 1, 6, 4, 79),
(19, NULL, NULL, 2, 7, 5, 27);

-- --------------------------------------------------------

--
-- Estrutura para tabela `estabelecimento`
--

CREATE TABLE `estabelecimento` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(60) DEFAULT NULL,
  `LOGRADOURO` varchar(60) DEFAULT NULL,
  `NUMERO` varchar(10) DEFAULT NULL,
  `BAIRRO` varchar(60) DEFAULT NULL,
  `CIDADE` varchar(60) DEFAULT NULL,
  `CEP` varchar(12) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL,
  `TELEFONE` varchar(15) DEFAULT NULL,
  `CNPJ` varchar(15) DEFAULT NULL,
  `IE` varchar(15) DEFAULT NULL,
  `LOGO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estabelecimento`
--

INSERT INTO `estabelecimento` (`ID`, `NOME`, `LOGRADOURO`, `NUMERO`, `BAIRRO`, `CIDADE`, `CEP`, `UF`, `TELEFONE`, `CNPJ`, `IE`, `LOGO`) VALUES
(1, 'Aurora - soluções em tecnologia', 'Rua Antônio Félix Neto', '2296', 'Residencial Botânico', 'Mineiros do Tietê', '17322-434', 'SP', '14 9 9804-2144', '25.401.211/0001', '21.110.110/0011', 'img-jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `formapagamento`
--

CREATE TABLE `formapagamento` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `formapagamento`
--

INSERT INTO `formapagamento` (`ID`, `DESCRICAO`) VALUES
(1, 'DINHEIRO'),
(2, 'DEBITO'),
(3, 'CREDITO'),
(4, 'CHEQUE'),
(5, 'CREDIARIO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(255) DEFAULT NULL,
  `RAZAOSOCIAL` varchar(255) DEFAULT NULL,
  `CIDADE` varchar(255) DEFAULT NULL,
  `BAIRRO` varchar(255) DEFAULT NULL,
  `LOGRADOURO` varchar(255) DEFAULT NULL,
  `CONTATO` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(80) DEFAULT NULL,
  `CEP` varchar(15) DEFAULT NULL,
  `UF` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedor`
--

INSERT INTO `fornecedor` (`ID`, `NOME`, `RAZAOSOCIAL`, `CIDADE`, `BAIRRO`, `LOGRADOURO`, `CONTATO`, `EMAIL`, `CEP`, `UF`) VALUES
(1, 'Loja', 'Loja', 'MINEIROS DO TIETê', 'CENTRO', '', '', '', '', 'SP');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itensvenda`
--

CREATE TABLE `itensvenda` (
  `ID` int(11) NOT NULL,
  `VENDA` int(11) DEFAULT NULL,
  `PRODUTO` int(11) DEFAULT NULL,
  `ITVE_QUANTIDADE` int(11) DEFAULT NULL,
  `ITVE_VENDA` double DEFAULT NULL,
  `ITVE_PRECOUNITARIO` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itensvenda`
--

INSERT INTO `itensvenda` (`ID`, `VENDA`, `PRODUTO`, `ITVE_QUANTIDADE`, `ITVE_VENDA`, `ITVE_PRECOUNITARIO`) VALUES
(1, 2, 1, 2, NULL, 29),
(2, 4, 1, 1, NULL, 29),
(3, 4, 2, 2, NULL, 199),
(4, 5, 1, 1, NULL, 29),
(5, 5, 2, 1, NULL, 199),
(6, 6, 1, 1, NULL, 29),
(7, 6, 2, 2, NULL, 199),
(8, 7, 1, 2, NULL, 29),
(9, 7, 2, 1, NULL, 199),
(10, 8, 2, 2, NULL, 199),
(11, 9, 1, 1, NULL, 29),
(12, 10, 1, 1, NULL, 29),
(13, 10, 2, 1, NULL, 199),
(14, 11, 1, 1, NULL, 29),
(15, 12, 1, 1, NULL, 29),
(16, 13, 2, 1, NULL, 199),
(17, 14, 2, 1, NULL, 199),
(18, 15, 2, 2, NULL, 199),
(19, 16, 1, 1, NULL, 29),
(20, 17, 3, 12, NULL, 34),
(21, 17, 4, 5, NULL, 65),
(22, 18, 5, 9, NULL, 19.9),
(23, 18, 6, 3, NULL, 19.9),
(24, 18, 10, 10, NULL, 19.9),
(25, 19, 14, 3, NULL, 19.9),
(26, 19, 13, 5, NULL, 19.9),
(27, 20, 12, 1, NULL, 19.9),
(28, 21, 12, 1, NULL, 19.9),
(29, 22, 6, 1, NULL, 19.9),
(30, 22, 9, 1, NULL, 19.9),
(31, 22, 14, 3, NULL, 19.9),
(32, 22, 12, 4, NULL, 19.9),
(33, 22, 8, 2, NULL, 19.9),
(34, 23, 5, 1, NULL, 19.9),
(35, 24, 6, 3, NULL, 19.9),
(36, 25, 8, 8, NULL, 19.9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil`
--

CREATE TABLE `perfil` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perfil`
--

INSERT INTO `perfil` (`ID`, `DESCRICAO`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'USUARIO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `ID` int(11) NOT NULL,
  `CODIGO` varchar(6) DEFAULT NULL,
  `DATACADASTRO` datetime DEFAULT NULL,
  `NOME` varchar(40) DEFAULT NULL,
  `DESCRICAO` varchar(255) DEFAULT NULL,
  `QUANTIDADE` int(11) DEFAULT NULL,
  `COR` varchar(40) DEFAULT NULL,
  `PRECO` double DEFAULT NULL,
  `DESCONTO` double DEFAULT NULL,
  `IMAGEM` varchar(100) DEFAULT NULL,
  `CATEGORIA` int(11) DEFAULT NULL,
  `FORNECEDOR` int(11) DEFAULT NULL,
  `ESTATUS` enum('A','I') DEFAULT NULL,
  `PRECODECUSTO` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`ID`, `CODIGO`, `DATACADASTRO`, `NOME`, `DESCRICAO`, `QUANTIDADE`, `COR`, `PRECO`, `DESCONTO`, `IMAGEM`, `CATEGORIA`, `FORNECEDOR`, `ESTATUS`, `PRECODECUSTO`) VALUES
(1, '00001', '2023-08-31 20:47:39', 'Tolha variadas', 'Não temos descrição deste produto', 0, 'variadas', 29, 5, '64f0e04b1f01e21.jpg', 1, 1, 'A', 8.00),
(2, '00002', '2023-08-31 20:48:38', 'Coberdrom', 'Não temos descrição', 0, 'variadas', 199, 7, '64f0e086d985626.jpg', 1, 1, 'A', 46.00),
(3, '00003', '2023-10-07 15:51:04', 'chinelo', 'chinelos de varias cores e tamanhos', 22, 'variados', 34, 0, '652162481e0b5teste.jpg', 1, 1, 'A', 34.00),
(4, '00004', '2023-10-07 15:51:45', 'verduras cozidas', '', 7, '', 65, 0, '65216271c5bfdimg.jpg', 1, 1, 'A', 35.00),
(5, '00005', '2023-10-07 10:57:41', 'Toalhas felpudas', '', 0, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90),
(6, '00006', '2023-10-07 11:00:13', 'TRAVESSEIRO', '', 3, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90),
(7, '00007', '2023-10-07 11:00:13', 'SAPATO', '', 10, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90),
(8, '00008', '2023-10-07 11:00:13', 'LENÇOL', '', 0, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90),
(9, '00009', '2023-10-07 11:00:13', 'CAPA DE SOFÁ', '', 9, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90),
(10, '00010', '2023-10-07 11:00:13', 'SHORTES', '', 0, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90),
(11, '00011', '2023-10-07 11:00:13', 'BLUSAS', '', 10, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90),
(12, '00012', '2023-10-07 11:00:13', 'CAMISETAS', '', 4, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90),
(13, '00013', '2023-10-07 11:00:13', 'CUECAS', '', 5, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90),
(14, '00014', '2023-10-07 11:00:13', 'CALCINHAS', '', 4, 'variadas', 19.9, NULL, '', 1, 1, 'A', 2.90);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(255) DEFAULT NULL,
  `USUARIO` varchar(60) DEFAULT NULL,
  `SENHA` varchar(100) DEFAULT NULL,
  `PERFIL` int(11) DEFAULT NULL,
  `EMAIL` varchar(80) DEFAULT NULL,
  `IMAGEM` varchar(100) DEFAULT NULL,
  `ATIVO` enum('S','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`ID`, `NOME`, `USUARIO`, `SENHA`, `PERFIL`, `EMAIL`, `IMAGEM`, `ATIVO`) VALUES
(1, 'Sistema', 'admin', '$2y$10$1rZOmy1rhLhKWJeRLeXmEeaqzc8kveNtbe4yTvIwTHa8isAVInu1.', 1, 'ronaldoleiter@gmail.com', '64f0d8da259c6ronaldo.jpg', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `ID` int(11) NOT NULL,
  `DATAVENDA` datetime DEFAULT NULL,
  `VALOR` double DEFAULT NULL,
  `USUARIO` int(11) DEFAULT NULL,
  `CLIENTE` int(11) DEFAULT NULL,
  `FOPA` int(11) DEFAULT NULL,
  `QUANTIDADEITENS` int(11) DEFAULT NULL,
  `PARCELAS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`ID`, `DATAVENDA`, `VALOR`, `USUARIO`, `CLIENTE`, `FOPA`, `QUANTIDADEITENS`, `PARCELAS`) VALUES
(2, '2023-08-31 20:59:25', 58, 1, 1, 1, 2, NULL),
(3, '2023-08-31 21:02:22', 0, 1, 1, 1, 0, NULL),
(4, '2023-08-31 21:08:36', 399.14, 1, 1, 1, 3, 1),
(5, '2023-08-31 21:12:48', 214.07, 1, 1, 5, 2, 1),
(6, '2023-09-11 20:27:05', 399.14, 1, 1, 5, 3, 5),
(7, '2023-09-19 20:36:24', 243.07, 1, 2, 5, 3, 9),
(8, '2023-09-27 23:10:45', 370.14, 1, 1, 1, 2, 1),
(9, '2023-09-28 21:40:34', 27.55, 1, 1, 1, 1, 1),
(10, '2023-09-30 19:12:32', 212.62, 1, 1, 1, 2, 1),
(11, '2023-09-30 19:24:21', 27.55, 1, 1, 1, 1, 1),
(12, '2023-09-30 21:12:08', 27.55, 1, 1, 1, 1, 1),
(13, '2023-09-30 21:21:11', 185.07, 1, 1, 1, 1, 1),
(14, '2023-09-30 21:25:02', 185.07, 1, 1, 1, 1, 1),
(15, '2023-10-06 13:55:26', 370.14, 1, 1, 1, 2, 1),
(16, '2023-10-06 13:55:59', 27.55, 1, 1, 1, 1, 1),
(17, '2023-10-07 16:01:26', 733, 1, 1, 1, 17, 1),
(18, '2023-10-07 16:11:50', 437.8, 1, 1, 1, 22, 1),
(19, '2023-10-09 22:57:20', 159.2, 1, 1, 1, 8, 1),
(20, '2023-10-10 16:24:25', 19.9, 1, 1, 1, 1, 1),
(21, '2023-10-10 20:07:05', 19.9, 1, 1, 1, 1, 1),
(22, '2023-10-10 20:50:01', 218.9, 1, 1, 1, 11, 1),
(23, '2023-10-13 14:54:07', 19.9, 1, 1, 2, 1, 1),
(24, '2023-10-13 14:54:50', 59.7, 1, 1, 2, 3, 1),
(25, '2023-10-13 14:55:31', 159.2, 1, 1, 3, 8, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USUARIO` (`USUARIO`);

--
-- Índices de tabela `caixas`
--
ALTER TABLE `caixas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CAIXA` (`CAIXA`),
  ADD KEY `USUARIO` (`USUARIO`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CODIGO` (`CODIGO`);

--
-- Índices de tabela `crediario`
--
ALTER TABLE `crediario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CLIENTE` (`CLIENTE`),
  ADD KEY `VENDA` (`VENDA`);

--
-- Índices de tabela `estabelecimento`
--
ALTER TABLE `estabelecimento`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `formapagamento`
--
ALTER TABLE `formapagamento`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PRODUTO` (`PRODUTO`),
  ADD KEY `VENDA` (`VENDA`);

--
-- Índices de tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CODIGO` (`CODIGO`),
  ADD KEY `FORNECEDOR` (`FORNECEDOR`),
  ADD KEY `CATEGORIA` (`CATEGORIA`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PERFIL` (`PERFIL`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FOPA` (`FOPA`),
  ADD KEY `CLIENTE` (`CLIENTE`),
  ADD KEY `USUARIO` (`USUARIO`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `caixas`
--
ALTER TABLE `caixas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `crediario`
--
ALTER TABLE `crediario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `estabelecimento`
--
ALTER TABLE `estabelecimento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `formapagamento`
--
ALTER TABLE `formapagamento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `caixa`
--
ALTER TABLE `caixa`
  ADD CONSTRAINT `caixa_ibfk_1` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`);

--
-- Restrições para tabelas `caixas`
--
ALTER TABLE `caixas`
  ADD CONSTRAINT `caixas_ibfk_1` FOREIGN KEY (`CAIXA`) REFERENCES `caixa` (`ID`),
  ADD CONSTRAINT `caixas_ibfk_2` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`);

--
-- Restrições para tabelas `crediario`
--
ALTER TABLE `crediario`
  ADD CONSTRAINT `crediario_ibfk_1` FOREIGN KEY (`CLIENTE`) REFERENCES `clientes` (`ID`),
  ADD CONSTRAINT `crediario_ibfk_2` FOREIGN KEY (`VENDA`) REFERENCES `venda` (`ID`);

--
-- Restrições para tabelas `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD CONSTRAINT `itensvenda_ibfk_1` FOREIGN KEY (`PRODUTO`) REFERENCES `produto` (`ID`),
  ADD CONSTRAINT `itensvenda_ibfk_2` FOREIGN KEY (`VENDA`) REFERENCES `venda` (`ID`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`FORNECEDOR`) REFERENCES `fornecedor` (`ID`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`CATEGORIA`) REFERENCES `categoria` (`ID`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`PERFIL`) REFERENCES `perfil` (`ID`);

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`FOPA`) REFERENCES `formapagamento` (`ID`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`CLIENTE`) REFERENCES `clientes` (`ID`),
  ADD CONSTRAINT `venda_ibfk_3` FOREIGN KEY (`USUARIO`) REFERENCES `usuario` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
