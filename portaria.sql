-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jul-2025 às 20:49
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `portaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfuncionarios`
--

CREATE TABLE `tbfuncionarios` (
  `pkIdFunc` int(11) NOT NULL,
  `nomeFunc` varchar(50) NOT NULL,
  `usuarioFunc` varchar(50) NOT NULL,
  `senhaFunc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuarios`
--

CREATE TABLE `tbusuarios` (
  `pkIdUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `numDocUsuario` varchar(50) NOT NULL,
  `dataNascUsuario` date DEFAULT NULL,
  `caminho` text DEFAULT NULL,
  `nomeImg` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvisitas`
--

CREATE TABLE `tbvisitas` (
  `pkIdVisita` int(11) NOT NULL,
  `dataVisita` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataSaidaVisita` timestamp NULL DEFAULT NULL,
  `fkIdUsuario` int(11) NOT NULL,
  `fkIdFuncionario` int(11) DEFAULT NULL,
  `motivoVisita` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbfuncionarios`
--
ALTER TABLE `tbfuncionarios`
  ADD PRIMARY KEY (`pkIdFunc`);

--
-- Índices para tabela `tbusuarios`
--
ALTER TABLE `tbusuarios`
  ADD PRIMARY KEY (`pkIdUsuario`),
  ADD UNIQUE KEY `numDocUsuario` (`numDocUsuario`);

--
-- Índices para tabela `tbvisitas`
--
ALTER TABLE `tbvisitas`
  ADD PRIMARY KEY (`pkIdVisita`),
  ADD KEY `tbvisitas_ibfk_1` (`fkIdUsuario`),
  ADD KEY `tbvisitas_ibfk_2` (`fkIdFuncionario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbfuncionarios`
--
ALTER TABLE `tbfuncionarios`
  MODIFY `pkIdFunc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbusuarios`
--
ALTER TABLE `tbusuarios`
  MODIFY `pkIdUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbvisitas`
--
ALTER TABLE `tbvisitas`
  MODIFY `pkIdVisita` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbvisitas`
--
ALTER TABLE `tbvisitas`
  ADD CONSTRAINT `tbvisitas_ibfk_1` FOREIGN KEY (`fkIdUsuario`) REFERENCES `tbusuarios` (`pkIdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbvisitas_ibfk_2` FOREIGN KEY (`fkIdFuncionario`) REFERENCES `tbfuncionarios` (`pkIdFunc`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
