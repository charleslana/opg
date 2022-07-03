-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 03/07/2022 às 23:35
-- Versão do servidor: 10.4.24-MariaDB
-- Versão do PHP: 8.1.6

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
-- Estrutura para tabela `account`
--

CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'inactive',
  `token` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `session` varchar(255) DEFAULT NULL,
  `level` int(10) UNSIGNED DEFAULT 1,
  `belly` bigint(19) DEFAULT 0,
  `gold` bigint(19) DEFAULT 0,
  `avatar` int(10) UNSIGNED DEFAULT 1,
  `experience` bigint(19) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `name`, `status`, `token`, `role`, `session`, `level`, `belly`, `gold`, `avatar`, `experience`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'suporteopgame@gmail.com', '$2y$10$4PNRyrpe2f1JYMLzKXuqt.7osULID45pw9paM8U34q7TYwPCeEgOC', 'Charles Lana', 'active', NULL, 'user', 'DgrH1aOXQ0MBFbylLvukVU9hYAIf3w', 5, 1500, 500, 2, 3600, '2022-06-19 00:39:52', '2022-07-03 16:52:29', NULL),
(2, 'charleslanop@gmail.com', '$2y$10$1fMCPQZuJhwjPk4K7EbCAuOLjdbpgb4VIr/Z87EfWigelJKvhxtVK', 'Charles', 'inactive', '2BFSPRa867YG', 'user', NULL, 1, 0, 0, 1, 0, '2022-06-19 13:05:31', '2022-06-19 17:18:38', NULL),
(3, 'nosigo7732@runqx.com', '$2y$10$X7Jv.ctJSpKmWEs6JqlPouAdByLVsZnWS21uwkjIcWDn4TtnPMdNi', 'Teste', 'active', NULL, 'user', 'hSAOzKc9LDsYI2lyRvV0QntgiPEZ17', 1, 0, 0, 1, 0, '2022-06-19 17:36:10', '2022-06-26 22:40:25', NULL),
(4, 'test@test.com', '$2y$10$mh2ntHa6jzlf6C5hT83VbejzpqUAs7oGPsNRl8cIJOr1pJWl0Nwbi', 'Charles 1 2test', 'inactive', 'eIY47rwcoMOv', 'user', NULL, 1, 0, 0, 1, 0, '2022-06-19 17:54:55', '2022-06-19 17:54:55', NULL),
(5, 'xesix99400@mahazai.com', '$2y$10$1HDpvZthLXcZILyySzdI8OQE.Komml.ErguWA1eMFsCqz8SRQLImq', 'Usuário', 'active', NULL, 'user', 'rdJykcRSpWKZe2wF5i0vXQgA9Vx7Ia', 1, 0, 0, 1, 0, '2022-06-25 22:39:40', '2022-07-01 23:28:00', NULL),
(6, 'jiroxi4322@lenfly.com', '$2y$10$YS1dwoyGFSbM0iPdJQ5Gceh0IFmAc48cxj5ttdcVmsCy9FJagCswG', 'Usuário Temp', 'active', NULL, 'user', 'xKrmi3MsoFV9nev8WYt7SGHE4TRZlb', 1, 0, 0, 1, 0, '2022-06-28 22:27:05', '2022-06-29 19:41:21', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `account_character`
--

CREATE TABLE `account_character` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `character_id` int(10) UNSIGNED NOT NULL,
  `level` int(10) UNSIGNED DEFAULT 1,
  `npc_battles` int(10) UNSIGNED DEFAULT 0,
  `npc_wins` int(10) UNSIGNED DEFAULT 0,
  `npc_defeats` int(10) UNSIGNED DEFAULT 0,
  `npc_draws` int(10) UNSIGNED DEFAULT 0,
  `arena_battles` int(10) UNSIGNED DEFAULT 0,
  `arena_wins` int(10) UNSIGNED DEFAULT 0,
  `arena_defeats` int(10) UNSIGNED DEFAULT 0,
  `arena_draws` int(10) UNSIGNED DEFAULT 0,
  `life` tinyint(3) UNSIGNED DEFAULT 100,
  `energy` tinyint(3) UNSIGNED DEFAULT 100,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `account_character`
--

INSERT INTO `account_character` (`id`, `account_id`, `character_id`, `level`, `npc_battles`, `npc_wins`, `npc_defeats`, `npc_draws`, `arena_battles`, `arena_wins`, `arena_defeats`, `arena_draws`, `life`, `energy`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 25, 20, 40, 0, 0, 30, 50, 0, 0, 100, 100, '2022-06-25 20:45:25', '2022-06-25 20:47:07'),
(3, 1, 1, 10, 100, 130, 0, 0, 120, 140, 0, 0, 100, 100, '2022-06-25 20:45:25', '2022-06-25 20:45:25'),
(4, 1, 3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-25 20:45:25', '2022-06-25 20:45:25'),
(5, 1, 33, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-25 20:45:25', '2022-06-25 20:45:25'),
(6, 1, 32, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-25 20:45:25', '2022-06-25 20:45:25'),
(7, 1, 6, 3, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-25 20:45:25', '2022-06-26 21:45:19'),
(8, 3, 26, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-25 20:45:25', '2022-06-30 22:31:23'),
(9, 1, 22, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-27 21:20:59', '2022-06-27 21:20:59'),
(10, 1, 21, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-27 21:21:08', '2022-06-27 21:21:08'),
(11, 6, 20, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-28 22:44:10', '2022-06-28 22:44:10'),
(12, 6, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-29 19:41:39', '2022-06-29 19:41:39'),
(13, 6, 14, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-29 19:43:08', '2022-06-29 19:43:08'),
(14, 1, 17, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-30 15:19:43', '2022-06-30 15:19:43'),
(15, 3, 4, 1, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, '2022-06-30 22:30:21', '2022-06-30 22:31:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `account_item`
--

CREATE TABLE `account_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `account_character_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `level` int(10) UNSIGNED DEFAULT 0,
  `linked` enum('no','yes') NOT NULL,
  `chest` enum('no','yes') DEFAULT 'no',
  `equipped` enum('no','yes') DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `account_item`
--

INSERT INTO `account_item` (`id`, `account_id`, `account_character_id`, `item_id`, `level`, `linked`, `chest`, `equipped`) VALUES
(1, 1, 1, 1, 0, 'no', 'no', 'no'),
(2, 1, 1, 2, 0, 'no', 'no', 'no'),
(3, 1, 1, 1, 0, 'no', 'no', 'no'),
(4, 1, 1, 1, 0, 'no', 'no', 'no'),
(5, 1, 1, 1, 0, 'no', 'no', 'no'),
(6, 1, 1, 1, 0, 'no', 'no', 'no'),
(7, 1, 1, 1, 0, 'no', 'no', 'no'),
(8, 1, 1, 1, 0, 'no', 'no', 'no'),
(9, 1, 1, 1, 0, 'no', 'no', 'no'),
(10, 1, 1, 1, 0, 'no', 'no', 'no'),
(11, 1, 1, 1, 0, 'no', 'no', 'no'),
(12, 1, 1, 1, 0, 'no', 'no', 'no'),
(13, 1, 1, 1, 0, 'no', 'no', 'no'),
(14, 1, 1, 1, 0, 'no', 'no', 'no'),
(15, 1, 1, 1, 0, 'no', 'no', 'no'),
(16, 1, 1, 1, 0, 'no', 'no', 'no'),
(17, 1, 1, 1, 0, 'no', 'no', 'no'),
(18, 1, 1, 1, 0, 'no', 'no', 'no'),
(19, 1, 1, 1, 0, 'no', 'no', 'no'),
(20, 1, 1, 1, 0, 'no', 'no', 'no'),
(21, 1, 1, 1, 0, 'no', 'no', 'no'),
(22, 1, 1, 3, 0, 'no', 'no', 'yes');

-- --------------------------------------------------------

--
-- Estrutura para tabela `breed`
--

CREATE TABLE `breed` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `breed`
--

INSERT INTO `breed` (`id`, `name`) VALUES
(9, 'Animal'),
(12, 'Bilkan'),
(5, 'Ciborgue'),
(3, 'Gigante'),
(1, 'Humano'),
(2, 'Meio Gigante'),
(8, 'Sereia'),
(11, 'Shandian'),
(10, 'Skypiean'),
(4, 'Super Gigante'),
(6, 'Tritão'),
(7, 'Wotan');

-- --------------------------------------------------------

--
-- Estrutura para tabela `character`
--

CREATE TABLE `character` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `breed_id` int(10) UNSIGNED NOT NULL,
  `organization_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `strength_attributes` int(10) UNSIGNED NOT NULL,
  `defense_attributes` int(10) UNSIGNED NOT NULL,
  `life_attributes` int(10) UNSIGNED NOT NULL,
  `energy_attributes` int(10) UNSIGNED NOT NULL,
  `agility_attributes` int(10) UNSIGNED NOT NULL,
  `resistance_attributes` int(10) UNSIGNED NOT NULL,
  `intelligence_attributes` int(10) UNSIGNED NOT NULL,
  `maximum_level` int(10) UNSIGNED NOT NULL,
  `haki_unlock` enum('no','yes') NOT NULL,
  `akuma_no_mi_unlock` enum('no','yes') NOT NULL,
  `player_level_unlock` int(10) UNSIGNED DEFAULT NULL,
  `character_level_unlock` int(10) UNSIGNED DEFAULT NULL,
  `character_npc_battles_unlock` int(10) UNSIGNED DEFAULT NULL,
  `character_arena_battles_unlock` int(10) UNSIGNED DEFAULT NULL,
  `character_npc_wins_unlock` int(10) UNSIGNED DEFAULT NULL,
  `character_arena_wins_unlock` int(10) UNSIGNED DEFAULT NULL,
  `gold_unlock` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `character`
--

INSERT INTO `character` (`id`, `class_id`, `breed_id`, `organization_id`, `name`, `image`, `strength_attributes`, `defense_attributes`, `life_attributes`, `energy_attributes`, `agility_attributes`, `resistance_attributes`, `intelligence_attributes`, `maximum_level`, `haki_unlock`, `akuma_no_mi_unlock`, `player_level_unlock`, `character_level_unlock`, `character_npc_battles_unlock`, `character_arena_battles_unlock`, `character_npc_wins_unlock`, `character_arena_wins_unlock`, `gold_unlock`) VALUES
(1, 1, 1, 1, 'Luffy (Sem akuma no mi)', '1', 1, 1, 1, 1, 1, 1, 1, 50, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 1, 1, 1, 'Luffy', '2', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 1, 1, 1, 'Luffy (Gomu Gomu no Bazooka)', '3', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 1, 1, 1, 'Luffy (Gomu Gomu no Fusen)', '4', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', 2, NULL, NULL, NULL, NULL, NULL, 0),
(5, 1, 1, 1, 'Luffy (Gomu Gomu no Jet Gatling)', '5', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, 2, 2, 2, 'Luffy (Gear third)', '6', 4, 1, 1, 1, 1, 1, 0, 100, 'yes', 'yes', 10, NULL, 10, 10, 5, 1, 500),
(7, 1, 1, 1, 'Luffy (Gear second)', '7', 3, 2, 2, 1, 3, 2, 0, 100, 'yes', 'yes', 20, 50, NULL, NULL, NULL, NULL, 1000),
(8, 1, 1, 1, 'Zoro', '8', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(9, 1, 1, 1, 'Zoro (Santoryu)', '9', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(10, 1, 1, 1, 'Zoro (Sanjuroku Pound Ho)', '10', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(11, 1, 1, 1, 'Zoro (Hyakuhachi Pound Hou)', '11', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(12, 1, 1, 1, 'Zoro (Asura)', '12', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(13, 1, 1, 1, 'Nami', '13', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(14, 1, 1, 1, 'Nami (Cyclone Tempo)', '14', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(15, 1, 1, 1, 'Nami (Mirage)', '15', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(16, 1, 1, 1, 'Nami (Shiawase Punch)', '16', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(17, 1, 1, 1, 'Nami (Thunderbolt Tempo)', '17', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(18, 1, 1, 1, 'Usopp', '18', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(19, 1, 1, 1, 'Usopp (Hissatsu Kayaku Boshi)', '19', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(20, 1, 1, 1, 'Usopp (Impact Dial)', '20', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(21, 1, 1, 1, 'Usopp (Pound)', '21', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(22, 1, 1, 1, 'Sogeking', '22', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(23, 1, 1, 1, 'Sanji', '23', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(24, 1, 1, 1, 'Sanji (Parage Shot)', '24', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(25, 1, 1, 1, 'Sanji (O Cozinheiro)', '25', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(26, 1, 1, 1, 'Sanji (Perna Negra)', '26', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(27, 1, 1, 1, 'Chopper', '27', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(28, 1, 1, 1, 'Chopper (Heavy Point)', '28', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(29, 1, 1, 1, 'Chopper (Scope)', '29', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(30, 1, 1, 1, 'Chopper (Arm Point)', '30', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(31, 1, 1, 1, 'Chopper (Horn Point)', '31', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(32, 1, 1, 1, 'Chopper (Guard Point)', '32', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(33, 1, 1, 1, 'Chopper (Monster Point)', '33', 0, 0, 0, 0, 0, 0, 0, 0, 'no', 'no', NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `class`
--

CREATE TABLE `class` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(9, 'Arqueólogo'),
(5, 'Atirador'),
(8, 'Carpinteiro'),
(4, 'Cozinheiro'),
(2, 'Espadachim'),
(1, 'Lutador'),
(6, 'Médico'),
(7, 'Músico'),
(3, 'Navegador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `image` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `strength` int(10) UNSIGNED DEFAULT NULL,
  `defense` int(10) UNSIGNED DEFAULT NULL,
  `life` int(10) UNSIGNED DEFAULT NULL,
  `energy` int(10) UNSIGNED DEFAULT NULL,
  `agility` int(10) UNSIGNED DEFAULT NULL,
  `resistance` int(10) UNSIGNED DEFAULT NULL,
  `minimum_level` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `type` enum('helmet','weapon','clothing','shoe','accessory') NOT NULL,
  `rarity` enum('common','rare','epic','legendary','mythical') NOT NULL,
  `linked` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `item`
--

INSERT INTO `item` (`id`, `class_id`, `image`, `name`, `description`, `strength`, `defense`, `life`, `energy`, `agility`, `resistance`, `minimum_level`, `type`, `rarity`, `linked`) VALUES
(1, 1, 1, 'Kokutō Yoru', 'A espada usada pelo melhor espadachim do mundo,  Mihawk \"Olhos de Falcão\". É uma das 12 espadas Saijo Owazamono (Espadas de Graau Supremo) e sua lâmina é inclinada com o fio \"Chouji\" com duplo padrão irregular. Ela aparentemente se tornou uma lâmina negra após o uso do Haki de Mihawk.', 100, NULL, NULL, 20, 10, 5, 1, 'weapon', 'mythical', 'no'),
(2, 1, 2, 'Metal Arm', 'Kid pode organizar os objetos de metal presos ao seu corpo em uma variedade de formas, com sua técnica mais comum sendo formar um gigantesco braço de metal para desencadear ataques poderosos.', 50, 50, 20, NULL, NULL, 10, 1, 'weapon', 'legendary', 'no'),
(3, 1, 3, 'Kabuto', 'Usopp desenvolveu essa arma em algum momento antes de chegar ao Enies Lobby, usando os Dials que ele obteve em Skypiea. É um engenho metálico verde que parece um cruzamento entre um bastão e um estilingue. É aparentemente é nomeado com o nome do besouro do mesmo nome devido à sua semelhança com o chifre do besouro.', 25, NULL, NULL, 10, 50, NULL, 1, 'weapon', 'epic', 'no');

-- --------------------------------------------------------

--
-- Estrutura para tabela `organization`
--

CREATE TABLE `organization` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `organization`
--

INSERT INTO `organization` (`id`, `name`) VALUES
(1, 'Associação de Vítimas de Thriller Bark'),
(2, 'Bandidos do Monte Atama'),
(3, 'Buggy\'s Delivery'),
(4, 'Cipher Pol'),
(5, 'CP-0'),
(6, 'CP5'),
(7, 'CP6'),
(8, 'CP7'),
(9, 'Esquadrão dos Superpatos Selvagens'),
(10, 'Exército de Deus'),
(11, 'Família Dadan'),
(12, 'Família Kyoshiro'),
(13, 'Galley-La Company'),
(14, 'Germa 66'),
(15, 'Governo Mundial'),
(16, 'Guardas Tsumegeri'),
(17, 'Isshi-100'),
(18, 'Marinha'),
(19, 'Neo Marinha'),
(20, 'Nove Bainhas Vermelhas'),
(21, 'Orochi Oniwabanshu'),
(22, 'Pior Geração'),
(23, 'Pirata'),
(24, 'Shichibukai'),
(25, 'Submundo'),
(26, 'Tom\'s Workers');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_email_uindex` (`email`),
  ADD UNIQUE KEY `account_name_uindex` (`name`),
  ADD UNIQUE KEY `account_session_uindex` (`session`),
  ADD UNIQUE KEY `account_token_uindex` (`token`);

--
-- Índices de tabela `account_character`
--
ALTER TABLE `account_character`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_account_character` (`character_id`),
  ADD KEY `fk_account` (`account_id`);

--
-- Índices de tabela `account_item`
--
ALTER TABLE `account_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_account_item` (`account_id`),
  ADD KEY `fk_item` (`item_id`),
  ADD KEY `fk_account_character_item` (`account_character_id`);

--
-- Índices de tabela `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `breed_name_uindex` (`name`);

--
-- Índices de tabela `character`
--
ALTER TABLE `character`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `character_name_uindex` (`name`),
  ADD KEY `fk_class` (`class_id`),
  ADD KEY `fk_breed` (`breed_id`),
  ADD KEY `fk_organization` (`organization_id`);

--
-- Índices de tabela `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classes_name_uindex` (`name`);

--
-- Índices de tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_name_uindex` (`name`),
  ADD KEY `fk_item_class` (`class_id`);

--
-- Índices de tabela `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organization_name_uindex` (`name`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `account_character`
--
ALTER TABLE `account_character`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `account_item`
--
ALTER TABLE `account_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `breed`
--
ALTER TABLE `breed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `character`
--
ALTER TABLE `character`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `account_character`
--
ALTER TABLE `account_character`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `fk_account_character` FOREIGN KEY (`character_id`) REFERENCES `character` (`id`);

--
-- Restrições para tabelas `account_item`
--
ALTER TABLE `account_item`
  ADD CONSTRAINT `fk_account_character_item` FOREIGN KEY (`account_character_id`) REFERENCES `account_character` (`id`),
  ADD CONSTRAINT `fk_account_item` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `fk_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Restrições para tabelas `character`
--
ALTER TABLE `character`
  ADD CONSTRAINT `fk_breed` FOREIGN KEY (`breed_id`) REFERENCES `breed` (`id`),
  ADD CONSTRAINT `fk_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `fk_organization` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`);

--
-- Restrições para tabelas `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
