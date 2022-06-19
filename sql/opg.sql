-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 19-Jun-2022 às 17:32
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
-- Banco de dados: `opg`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `account`
--

CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive',
  `token` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `level` int(10) UNSIGNED DEFAULT 1,
  `belly` float DEFAULT 0,
  `gold` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `name`, `status`, `token`, `role`, `created_at`, `updated_at`, `deleted_at`, `level`, `belly`, `gold`) VALUES
(1, 'suporteopgame@gmail.com', '$2y$10$9qnTSsBpskB3JnY6OIGFdOSALW1JZ2IxAbYFLuwqT6ksZvF7J7Kwe', 'Charles Lana', 'active', NULL, 'user', '2022-06-19 00:39:52', '2022-06-19 00:40:45', NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `account_character`
--

CREATE TABLE `account_character` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `character_id` int(10) UNSIGNED NOT NULL,
  `level` int(11) UNSIGNED DEFAULT 1,
  `npc_battles` int(11) UNSIGNED DEFAULT 0,
  `arena_battles` int(11) UNSIGNED DEFAULT 0,
  `npc_wins` int(11) UNSIGNED DEFAULT 0,
  `arena_wins` int(11) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `character`
--

CREATE TABLE `character` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `strength_attributes` int(11) NOT NULL,
  `defense_attributes` int(11) NOT NULL,
  `life_attributes` int(11) NOT NULL,
  `energy_attributes` int(11) NOT NULL,
  `agility_attributes` int(11) NOT NULL,
  `resistance_attributes` int(11) NOT NULL,
  `maximum_level` int(11) NOT NULL,
  `haki_unlock` enum('no','yes') NOT NULL,
  `akuma_no_mi_unlock` enum('no','yes') NOT NULL,
  `player_level_unlock` int(11) DEFAULT NULL,
  `character_level_unlock` int(11) DEFAULT NULL,
  `character_npc_battles_unlock` int(11) DEFAULT NULL,
  `character_arena_battles_unlock` int(11) DEFAULT NULL,
  `character_npc_wins_unlock` int(11) DEFAULT NULL,
  `character_arena_wins_unlock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `character`
--

INSERT INTO `character` (`id`, `name`, `image`, `strength_attributes`, `defense_attributes`, `life_attributes`, `energy_attributes`, `agility_attributes`, `resistance_attributes`, `maximum_level`, `haki_unlock`, `akuma_no_mi_unlock`, `player_level_unlock`, `character_level_unlock`, `character_npc_battles_unlock`, `character_arena_battles_unlock`, `character_npc_wins_unlock`, `character_arena_wins_unlock`) VALUES
(1, 'Luffy (Sem akuma no mi)', '1', 1, 1, 1, 1, 1, 1, 50, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Luffy', '2', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Luffy3', '3', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Luffy4', '4', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Luffy5', '5', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Luffy6', '6', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Luffy (Gear second)', '7', 3, 2, 2, 1, 3, 2, 100, 'yes', 'yes', 20, 50, NULL, NULL, NULL, NULL),
(8, 'Luffy8', '8', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Luffy9', '9', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Luffy10', '10', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Luffy11', '11', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Luffy12', '12', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Luffy13', '13', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Luffy14', '14', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Luffy15', '15', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Luffy16', '16', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Luffy17', '17', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Luffy18', '18', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Luffy19', '19', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Luffy20', '20', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Luffy21', '21', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Luffy22', '22', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Luffy23', '23', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Luffy24', '24', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Luffy25', '25', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Luffy26', '26', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Luffy27', '27', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Luffy28', '28', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Luffy29', '29', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Luffy30', '30', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Luffy31', '31', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Luffy32', '32', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Luffy33', '33', 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_email_uindex` (`email`);

--
-- Índices para tabela `account_character`
--
ALTER TABLE `account_character`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_account_character` (`character_id`),
  ADD KEY `fk_account` (`account_id`);

--
-- Índices para tabela `character`
--
ALTER TABLE `character`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `character_name_uindex` (`name`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `account_character`
--
ALTER TABLE `account_character`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `character`
--
ALTER TABLE `character`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `account_character`
--
ALTER TABLE `account_character`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `fk_account_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
