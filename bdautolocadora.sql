-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/07/2025 às 02:19
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdautolocadora2025`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcliente`
--

CREATE TABLE `tbcliente` (
  `cliente_cpf` char(11) NOT NULL,
  `cliente_nome` varchar(100) DEFAULT NULL,
  `cliente_endereco` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbcliente`
--

INSERT INTO `tbcliente` (`cliente_cpf`, `cliente_nome`, `cliente_endereco`) VALUES
('00022266033', 'Otávio da Silva Pacheco', 'Rua Sete'),
('04465757099', 'Andreia Sias Rodrigues', 'Rua Três'),
('05034497093', 'Leonardo Teixeira', 'Rua Seis');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbfuncionario`
--

CREATE TABLE `tbfuncionario` (
  `funcionario_nome` varchar(20) NOT NULL,
  `funcionario_matricula` int(11) NOT NULL,
  `funcionario_senha` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbfuncionario`
--

INSERT INTO `tbfuncionario` (`funcionario_nome`, `funcionario_matricula`, `funcionario_senha`) VALUES
('Leonardo Teixeira', 2, 'leo1234'),
('Leandro Hassum', 3, 'leandro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tblocacao`
--

CREATE TABLE `tblocacao` (
  `locacao_codigo` int(11) NOT NULL,
  `locacao_veiculo` varchar(7) DEFAULT NULL,
  `locacao_cliente` char(11) DEFAULT NULL,
  `locacao_data_inicio` date DEFAULT NULL,
  `locacao_data_fim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tblocacao`
--

INSERT INTO `tblocacao` (`locacao_codigo`, `locacao_veiculo`, `locacao_cliente`, `locacao_data_inicio`, `locacao_data_fim`) VALUES
(3, 'FJB4E12', '00022266033', '2025-05-07', '2025-05-27'),
(4, 'IMR4592', '05034497093', '2025-05-07', '2025-05-30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmarca`
--

CREATE TABLE `tbmarca` (
  `marca_codigo` int(11) NOT NULL,
  `marca_nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbmarca`
--

INSERT INTO `tbmarca` (`marca_codigo`, `marca_nome`) VALUES
(1, 'Volkswagen'),
(2, 'Fiat'),
(3, 'Chevrolet'),
(4, 'Honda');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbveiculo`
--

CREATE TABLE `tbveiculo` (
  `veiculo_placa` varchar(7) NOT NULL,
  `veiculo_marca` int(11) DEFAULT NULL,
  `veiculo_descricao` varchar(100) NOT NULL,
  `veiculo_status` enum('disponível','locado') DEFAULT 'disponível'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbveiculo`
--

INSERT INTO `tbveiculo` (`veiculo_placa`, `veiculo_marca`, `veiculo_descricao`, `veiculo_status`) VALUES
('FJB4E12', 1, 'Gol 1.6 2003', 'locado'),
('IMR-359', 1, 'Golf GTI 2015', 'disponível'),
('IMR3422', 4, 'Civic G10 1.5 2017', 'disponível'),
('IMR4592', 4, 'HRV', 'locado'),
('IRG3914', 3, 'Onix 1.6 LTZ', 'disponível');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`cliente_cpf`);

--
-- Índices de tabela `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  ADD PRIMARY KEY (`funcionario_matricula`);

--
-- Índices de tabela `tblocacao`
--
ALTER TABLE `tblocacao`
  ADD PRIMARY KEY (`locacao_codigo`),
  ADD KEY `cliente_cpf` (`locacao_cliente`),
  ADD KEY `veiculo_placa` (`locacao_veiculo`);

--
-- Índices de tabela `tbmarca`
--
ALTER TABLE `tbmarca`
  ADD PRIMARY KEY (`marca_codigo`);

--
-- Índices de tabela `tbveiculo`
--
ALTER TABLE `tbveiculo`
  ADD PRIMARY KEY (`veiculo_placa`),
  ADD KEY `fkmarca` (`veiculo_marca`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  MODIFY `funcionario_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tblocacao`
--
ALTER TABLE `tblocacao`
  MODIFY `locacao_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbmarca`
--
ALTER TABLE `tbmarca`
  MODIFY `marca_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tblocacao`
--
ALTER TABLE `tblocacao`
  ADD CONSTRAINT `cliente_cpf` FOREIGN KEY (`locacao_cliente`) REFERENCES `tbcliente` (`cliente_cpf`),
  ADD CONSTRAINT `veiculo_placa` FOREIGN KEY (`locacao_veiculo`) REFERENCES `tbveiculo` (`veiculo_placa`);

--
-- Restrições para tabelas `tbveiculo`
--
ALTER TABLE `tbveiculo`
  ADD CONSTRAINT `fkmarca` FOREIGN KEY (`veiculo_marca`) REFERENCES `tbmarca` (`marca_codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
