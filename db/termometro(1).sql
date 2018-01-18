-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18-Jan-2018 às 13:57
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `termometro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `area` varchar(45) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `questions`
--

INSERT INTO `questions` (`id`, `text`, `category`, `area`, `order`) VALUES
(1, 'Você tem alto nível de energia quando acorda pela manhã.', 'Energia, Saúde e Disposição', 'area1', 0),
(2, 'Você se sente satisfeito com sua saúde física.', 'Energia, Saúde e Disposição', 'area1', 1),
(3, 'Você está feliz com seu corpo e com sua disposição diária.', 'Energia, Saúde e Disposição', 'area1', 2),
(4, 'Você se sente feliz ao aprender coisas novas.', 'Capacidade de Aprender, Conhecimento e Desenvolvimento Intelectual', 'area1', 3),
(5, 'Você está satisfeito com sua capacidade de aprender.', 'Capacidade de Aprender, Conhecimento e Desenvolvimento Intelectual', 'area1', 4),
(6, 'Você está satisfeito com seu atual nível de conhecimento e desenvolvimento intelectual.', 'Capacidade de Aprender, Conhecimento e Desenvolvimento Intelectual', 'area1', 5),
(7, 'Você se sente feliz com sua capacidade de lidar com adversidades e dificuldades da vida.', 'Resiliência e Equilíbrio Emocional', 'area1', 6),
(8, 'Você se sente feliz com sua capacidade de suportar o estresse do dia-a-dia.', 'Resiliência e Equilíbrio Emocional', 'area1', 7),
(9, 'Você está satisfeito com nível de equilíbrio emocional.', 'Resiliência e Equilíbrio Emocional', 'area1', 8),
(10, 'Você está feliz com o seu rendimento financeiro no último mês.', 'Equilíbrio e Perspectiva Financeira', 'area2', 9),
(11, 'Você está feliz com sua reserva financeira/poupança.', 'Equilíbrio e Perspectiva Financeira', 'area2', 10),
(12, 'Você está satisfeito com a possibilidade de aumento de ganhos e rendimentos futuros.', 'Equilíbrio e Perspectiva Financeira', 'area2', 11),
(13, 'Você está feliz com seu trabalho.', 'Realização e Alinhamento Profissional', 'area2', 12),
(14, 'Você se sente realizado profissionalmente.', 'Realização e Alinhamento Profissional', 'area2', 13),
(15, 'Você está satisfeito com o alinhamento entre sua vida profissional e pessoal.', 'Realização e Alinhamento Profissional', 'area2', 14),
(16, 'Você se sente feliz com o papel que desempenha no trabalho.', 'Contribuição Social e Profissional', 'area2', 15),
(17, 'Você está satisfeito com o resultado de seu trabalho e sua contribuição social.', 'Contribuição Social e Profissional', 'area2', 16),
(18, 'Você está satisfeito com sua dedicação e entrega no trabalho.', 'Contribuição Social e Profissional', 'area2', 17),
(19, 'Você está feliz com a qualidade de suas relações familiares mais próximas.', 'Família', 'area3', 18),
(20, 'Você está feliz com seus relacionamentos familiares mais distantes. ', 'Família', 'area3', 19),
(21, 'Estar com a família te deixa muito feliz.', 'Família', 'area3', 20),
(22, 'Você está feliz com seu círculo de amigos.', 'Amigos e Vida Social', 'area3', 21),
(23, 'Você se sente satisfeito com a sua vida social.', 'Amigos e Vida Social', 'area3', 22),
(24, 'Você está satisfeito com a intensidade/aproximação de relações de amizade.', 'Amigos e Vida Social', 'area3', 23),
(25, 'Você está satisfeito com sua capacidade de expressar amor/carinho ao próximo.', 'Amorosidade e Relacionamento Íntimo', 'area3', 24),
(26, 'Você se sente feliz com os diferentes tipos de amor que consegue expressar, tais como amor paternal, amor fraternal, amor maternal, amor incondicional etc.', 'Amorosidade e Relacionamento Íntimo', 'area3', 25),
(27, 'Você está feliz com seu relacionamento conjugal.', 'Amorosidade e Relacionamento Íntimo', 'area3', 26),
(28, 'Você se sente feliz com as atividades de lazer que tem realizado.', 'Lazer e Criatividade', 'area4', 27),
(29, 'Você está satisfeito com sua capacidade criativa.', 'Lazer e Criatividade', 'area4', 28),
(30, 'Você está feliz com a quantidade de tempo que tem para se divertir.', 'Lazer e Criatividade', 'area4', 29),
(31, 'No momento atual, você se se sente feliz com as coisas que são importantes em sua vida. ', 'Felicidade e Propósito', 'area4', 30),
(32, 'Você se sente feliz com suas principais crenças.', 'Felicidade e Propósito', 'area4', 31),
(33, 'Você se sente feliz com a direção da sua vida.', 'Felicidade e Propósito', 'area4', 32),
(34, 'O nível de sua fé contribui substancialmente para sua felicidade.', 'Fé e Espiritualidade', 'area4', 33),
(35, 'Você está satisfeito com relação a dimensão espiritual em sua vida.', 'Fé e Espiritualidade', 'area4', 34),
(36, 'Você se sente feliz com a marca que tem deixado no mundo e com seus resultados nos diferentes aspectos de sua vida.', 'Fé e Espiritualidade', 'area4', 35);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questions_copy`
--


--
-- Extraindo dados da tabela `questions_copy`
--


CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `area1` tinyint(1) NOT NULL,
  `area2` tinyint(1) NOT NULL,
  `area3` tinyint(1) NOT NULL,
  `area4` tinyint(1) NOT NULL,
  `result` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `results`
--
-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uid` varchar(150) NOT NULL,
  `uname` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `area1` tinyint(1) DEFAULT NULL,
  `area2` tinyint(1) DEFAULT NULL,
  `area3` tinyint(1) DEFAULT NULL,
  `area4` tinyint(1) DEFAULT NULL,
  `answers` text,
  `result` varchar(255) DEFAULT NULL,
  `shared` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions_copy`
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_created` (`user_id`,`created_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `facebook_id` (`uid`);

--
-- Indexes for table `users_copy`

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `questions_copy`
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23901;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33485;
--
-- AUTO_INCREMENT for table `users_copy`
--

