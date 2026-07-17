-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jan-2026 às 11:59
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mapa_interativo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id_utilizador` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `tipo_utilizador` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id_utilizador`, `nome`, `email`, `tipo_utilizador`, `senha`) VALUES
(1, 'Ana Silva', 'ana.silva@email.com', 'Administrador', 'hash1'),
(2, 'Bruno Costa', 'bruno.costa@email.com', 'Utilizador', 'hash2'),
(3, 'Carla Mendes', 'carla.mendes@email.com', 'Utilizador', 'hash3'),
(4, 'Diogo Rocha', 'diogo.rocha@email.com', 'Utilizador', 'hash4'),
(5, 'Eduarda Lopes', 'eduarda.lopes@email.com', 'Utilizador', 'hash5'),
(6, 'Fábio Martins', 'fabio.martins@email.com', 'Utilizador', 'hash6'),
(7, 'Gonçalo Pires', 'goncalo.pires@email.com', 'Utilizador', 'hash7'),
(8, 'Helena Sousa', 'helena.sousa@email.com', 'Utilizador', 'hash8'),
(9, 'Igor Almeida', 'igor.almeida@email.com', 'Utilizador', 'hash9'),
(10, 'Joana Ribeiro', 'joana.ribeiro@email.com', 'Utilizador', 'hash10');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id_utilizador`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
