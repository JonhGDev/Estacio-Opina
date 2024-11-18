## 👥 **Integrantes do Grupo**

- **João Guilherme S. do Carmo**
- **Felipe Crivelli Lima**
- **André Júnior F. dos Santos**
- **Johnny Chrystopher**
- **Rodrigo Resende**

**Script do Banco**

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 18/11/2024 às 01:33
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estacio_opina`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `reclamacoes`
--

DROP TABLE IF EXISTS `reclamacoes`;
CREATE TABLE IF NOT EXISTS `reclamacoes` (
  `id_reclamacoes` int NOT NULL AUTO_INCREMENT,
  `matricula` int NOT NULL,
  `tipo_reclamacoes` varchar(50) NOT NULL,
  `descricao_reclamacoes` varchar(255) NOT NULL,
  PRIMARY KEY (`id_reclamacoes`),
  KEY `matricula` (`matricula`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `reclamacoes`
--

INSERT INTO `reclamacoes` (`id_reclamacoes`, `matricula`, `tipo_reclamacoes`, `descricao_reclamacoes`) VALUES
(13, 303030, 'financeiro', 'to pobre'),
(14, 101010, 'professor', 'testando 1234'),
(27, 404040, 'aluno', 'asasassas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `matricula` varchar(100) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `senha` (`senha`),
  UNIQUE KEY `matricula` (`matricula`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `matricula`, `perfil`) VALUES
(1, 'felipe', 'felipe123@email.com', '1234', '101010', 'aluno'),
(2, 'andre', 'andre123@email.com', '12345', '202020', 'aluno'),
(3, 'guilherme', 'guilerme123@email.com', '123', '303030', 'aluno'),
(4, 'rodrigo', 'rodrigo@email.com', '1212', '404040', 'aluno'),
(5, 'Luiz', 'luiz@email.com', '000', '100100', 'adm'),
(6, 'teste', 'teste@email.com', '1010', '200200', 'aluno');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
