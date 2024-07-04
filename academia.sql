-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jun-2023 às 20:49
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `academia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_aluno` int(2) NOT NULL,
  `codigo_ident` varchar(10) NOT NULL,
  `nome_aluno` varchar(50) DEFAULT NULL,
  `tipo_usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id_aluno`, `codigo_ident`, `nome_aluno`, `tipo_usuario`) VALUES
(12, '1235', 'Alan', 'aluno'),
(19, '1234', 'Rita Lee', 'aluno'),
(20, '12365', 'Carlos', 'aluno'),
(22, '12369', 'Carla', 'administrador'),
(24, '295', 'Samuel', 'aluno'),
(25, '1258', 'teste', 'aluno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(2) NOT NULL,
  `nome_evento` varchar(50) NOT NULL,
  `descricao_evento` varchar(80) NOT NULL,
  `data_evento` date NOT NULL,
  `data_final` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `nome_evento`, `descricao_evento`, `data_evento`, `data_final`) VALUES
(3, 'Cantoria de Cidadela!', 'Cantores de sul de minas cantando na praça da cidade.', '2023-08-30', '2023-08-20'),
(4, 'ç ã ó', 'çã ló á ã', '2025-02-11', '2520-03-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicios`
--

CREATE TABLE `exercicios` (
  `id_exercicio` int(3) NOT NULL,
  `nome_exercicio` varchar(50) NOT NULL,
  `descricao_exercicio` varchar(150) NOT NULL,
  `musculo_exercicio` varchar(20) NOT NULL,
  `link_exercicio` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `exercicios`
--

INSERT INTO `exercicios` (`id_exercicio`, `nome_exercicio`, `descricao_exercicio`, `musculo_exercicio`, `link_exercicio`) VALUES
(1, 'Voador', ' Fortalece os músculos do peitoral, com ênfase no peitoral maior, peitoral menor e serrátil anterior.', 'Peitoral', ''),
(2, 'Supino reto', 'Trabalha peitoral maior, ombro e tríceps.', 'Peitoral', ''),
(3, 'Crucifixo 35', 'Trabalha peitoral, ombro, bíceps. ', 'Peitoral', ''),
(4, 'Crucifixo reto', 'Trabalha peitoral maior, ombro, bíceps. ', 'Peitoral', ''),
(5, 'Adução cross', 'Trabalha peitoral maior superior e inferior, latíssimo do dorso e deltoide anterior.', 'Peitoral', ''),
(6, 'Adução r baixa no cross', 'Trabalha o peitoral, costa, tríceps, bíceps.', 'Peitoral', ''),
(7, 'Flexão de braço', 'Trabalha o peitoral, ombro, tríceps, abdômen e lombar.', 'Peitoral', ''),
(8, 'Paralelo', 'Trabalha o deltoide, peitoral, tríceps.', 'Peitoral', ''),
(9, 'Crucifixo inverso cross', 'Trabalha deltoide lateral, rombóide, redondo menor, trapézio medial e inferior.', 'Costas', ''),
(10, 'Puxada pela frente', 'Trabalha latíssimo do dorso, deltóite posterior, trapézio inferior e rombóides.   ', 'Costas', ''),
(11, 'Remada articulada', 'Trabalha dorsal do corpo, trapézio, rombóide e deltoíde posterior.', 'Costas', ''),
(12, 'Remada sentada', 'Trabalha dorsal, redondos, trapézio, paravertebrais torácicos e lombares. ', 'Costas', ''),
(13, 'Pull over', 'Trabalha dorsal, deltóide posterior, redondo maior, tríceps e peitoral maior.', 'Peitoral', ''),
(14, 'Remada curvada', 'Trabalha o dorso, trapézio, bíceps braquial, serrátil,  rombóide.', 'Costas', ''),
(15, 'Remada cavalinho', 'Trabalha dorsal, trapézio e rombóides.', 'Costas', ''),
(16, 'Bíceps robot (máquina)', 'Trabalha bíceps braquial.', 'Bíceps', ''),
(17, 'Bíceps apoiado', 'Trabalha o bíceps braquial, flexores de punho.', 'Bíceps', ''),
(18, 'Bíceps alternado', 'Trabalha o bíceps braquial, flexores de punho.', 'Bíceps', ''),
(19, 'Bíceps  cross', 'Trabalha o bíceps braquial, flexores de cotovelo.', 'Bíceps', ''),
(20, 'Bíceps concentrado', 'Trabalha o bíceps braquial, braquial e braquiorradial.', 'Bíceps', ''),
(21, 'Bíceps direta', 'Trabalha o bíceps braquial, braquial, braquiorradial, flexor radial do carpo, palmar longo e flexor superficial dos dedos.', 'Bíceps', ''),
(22, 'Rosca martelo', 'Trabalha bíceps braquial, braquial e braquiorradial.', 'Bíceps', ''),
(23, 'Abdução de ombro', 'Trabalha deltóide e musculo supra-espinhoso.', 'Ombro', ''),
(24, 'Flexão alternada de ombro', 'Trabalha deltóide anterior, peitoral feixe clavicular e trapézio superior.', 'Ombro', ''),
(25, 'Flexão de ombro', 'Trabalha  o peitoral maior, deltóide anterior, coracobraquial e bíceps.', 'Ombro', ''),
(26, 'Desenvolvimento na máquina', 'Trabalha o deltóide e tríceps.', 'Ombro', ''),
(27, 'Remada alta', 'Trabalha frontal e média dos deltóides e trapézio.', 'Ombro', ''),
(28, 'Desenvolvimento com halter', 'Trabalha o deltóide e tríceps.', 'Ombro', ''),
(29, 'Leg 45', 'Trabalha quadríceps, panturrilha, glúteo e posterior de coxa.', 'Perna', ''),
(30, 'Hack máquina', 'Trabalha o quadríceps, posteriores, glúteos e flexores do quadril.', 'Perna', ''),
(31, 'Cadeira extensora', 'Trabalha quadríceps.', 'Perna', 'https://www.youtube.com/watch?v=qTRhLt9wGwA'),
(32, 'Mexa flexora', 'Trabalha o posterior.', 'Perna', 'https://www.youtube.com/watch?v=qTRhLt9wGwA'),
(33, 'Cadeira adutora', 'Trabalha adutores da coxa, glúteo médio e mínimo.', 'Perna', 'https://www.youtube.com/watch?v=qTRhLt9wGwA'),
(34, 'Cadeira abdutora', 'Trabalha parte lateral externa da coxa e quadril.', 'Perna', 'https://www.youtube.com/watch?v=qTRhLt9wGwA'),
(35, 'Sisy', 'Trabalha a coxa, glúteo, quadril e panturrilha.', 'Perna', 'https://www.youtube.com/watch?v=qTRhLt9wGwA'),
(36, 'Agachamento ', 'Trabalha a coxa, glúteo, posterior de coxa, lombar e abdômen.', 'Perna', ''),
(37, 'Panturrilheira', 'Trabalha gastrocnêmio e soleo.', 'Panturrilha', ''),
(38, 'Panturrilha PO', 'Trabalha gastrocnêmio e soleo.', 'Panturrilha', ''),
(39, 'Tríceps máquina', 'Trabalha tríceps.', 'Tríceps', ''),
(40, 'Tríceps cross', 'Trabalha tríceps, cabeça média longa e lateral.', 'Tríceps', ''),
(41, 'Tríceps patada', 'Trabalha tríceps, cabeça média longa e lateral.', 'Tríceps', ''),
(42, 'Tríceps curvado', 'Trabalha tríceps, cabeça média longa e lateral.', 'Tríceps', ''),
(43, 'Tríceps testa', 'Trabalha tríceps, cabeça média longa e lateral.', 'Tríceps', ''),
(44, 'Tríceps francês', 'Trabalha tríceps, cabeça média longa e lateral.', 'Tríceps', ''),
(45, 'Tríceps banco', 'Trabalha tríceps, costas e peitoral.', 'Tríceps', ''),
(47, 'Sumô', 'Trabalha o posterior de coxa.', 'Perna', 'https://www.youtube.com/watch?v=V4A0QrhcBLk'),
(48, 'teste', 'teste', 'teste', 'http://localhost/phpmyadmin/index.php?route=/database/operations&amp;db=bibliote');

-- --------------------------------------------------------

--
-- Estrutura da tabela `treino`
--

CREATE TABLE `treino` (
  `id_treino` int(2) NOT NULL,
  `id_aluno` int(2) DEFAULT NULL,
  `id_exercicio` int(3) NOT NULL,
  `exercicio` varchar(50) NOT NULL,
  `serie` int(2) DEFAULT NULL,
  `repeticoes` int(2) DEFAULT NULL,
  `dia_semana` varchar(20) NOT NULL,
  `descricao_exercicio` varchar(50) NOT NULL,
  `link_exercicio` varchar(80) NOT NULL,
  `musculo_exercicio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `treino`
--

INSERT INTO `treino` (`id_treino`, `id_aluno`, `id_exercicio`, `exercicio`, `serie`, `repeticoes`, `dia_semana`, `descricao_exercicio`, `link_exercicio`, `musculo_exercicio`) VALUES
(38, 12, 31, 'Cadeira extensora', 4, 4, 'Quarta', 'Trabalha quadríceps.', 'https://www.youtube.com/watch?v=qTRhLt9wGwA', 'Perna'),
(39, 12, 33, 'Cadeira adutora', 4, 4, 'Quarta', 'Trabalha adutores da coxa, glúteo médio e mínimo.', 'https://www.youtube.com/watch?v=qTRhLt9wGwA', 'Perna');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Índices para tabela `exercicios`
--
ALTER TABLE `exercicios`
  ADD PRIMARY KEY (`id_exercicio`);

--
-- Índices para tabela `treino`
--
ALTER TABLE `treino`
  ADD PRIMARY KEY (`id_treino`),
  ADD KEY `FK` (`id_aluno`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_aluno` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `exercicios`
--
ALTER TABLE `exercicios`
  MODIFY `id_exercicio` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `treino`
--
ALTER TABLE `treino`
  MODIFY `id_treino` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `treino`
--
ALTER TABLE `treino`
  ADD CONSTRAINT `FK` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`id_aluno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
