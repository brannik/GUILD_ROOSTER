-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия на сървъра:            10.4.17-MariaDB - mariadb.org binary distribution
-- ОС на сървъра:                Win64
-- HeidiSQL Версия:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дъмп на структурата на БД guild_rooster
DROP DATABASE IF EXISTS `guild_rooster`;
CREATE DATABASE IF NOT EXISTS `guild_rooster` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `guild_rooster`;

-- Дъмп структура за таблица guild_rooster.accounts
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  `password` text NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 0,
  `fraction` int(11) NOT NULL DEFAULT 0,
  `guild_id` int(11) NOT NULL DEFAULT 0,
  `guild_rank` int(11) NOT NULL DEFAULT 0,
  `net_dkp` int(11) NOT NULL DEFAULT 0,
  `tot_dkp` int(11) NOT NULL DEFAULT 0,
  `hours` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица guild_rooster.accounts: ~2 rows (приблизително)
DELETE FROM `accounts`;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `username`, `password`, `rank`, `fraction`, `guild_id`, `guild_rank`, `net_dkp`, `tot_dkp`, `hours`, `active`) VALUES
	(40, 'AGSET', '149d60187e7e1d16f975b02be552f6da4d1f8f07', 2, 1, 1, 3, 230, 23000, 66, 1),
	(41, 'BRANNIK', 'ff41c940912e488d668513437bd07177ce5c3003', 0, 1, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Дъмп структура за таблица guild_rooster.characters
DROP TABLE IF EXISTS `characters`;
CREATE TABLE IF NOT EXISTS `characters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `char_name` varchar(50) NOT NULL DEFAULT '0',
  `fraction` int(11) NOT NULL DEFAULT 0,
  `char_class` varchar(50) NOT NULL DEFAULT '0',
  `char_race` varchar(50) NOT NULL DEFAULT '0',
  `char_level` int(11) NOT NULL DEFAULT 0,
  `char_owner` varchar(50) NOT NULL DEFAULT '0',
  `char_rank` int(11) NOT NULL DEFAULT 0,
  `notes` varchar(150) NOT NULL DEFAULT '0',
  `is_main` int(11) NOT NULL DEFAULT 0,
  `owner_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица guild_rooster.characters: ~3 rows (приблизително)
DELETE FROM `characters`;
/*!40000 ALTER TABLE `characters` DISABLE KEYS */;
INSERT INTO `characters` (`id`, `char_name`, `fraction`, `char_class`, `char_race`, `char_level`, `char_owner`, `char_rank`, `notes`, `is_main`, `owner_id`) VALUES
	(7, 'Agset', 1, 'paladin', 'b_elf_m', 80, 'none', 2, 'MS: 6.9 ret / OS: 6.5 holy', 1, 40),
	(8, 'Agsset', 1, 'druid', 'tauren_m', 80, 'Agset', 1, 'MS: 6.3 resto / OS: 6.3 cat', 0, 40),
	(9, 'Agsseet', 2, 'druid', 'n_elf_m', 80, 'Agset', 1, 'MS: 6.3 resto / OS: 6.3 cat', 0, 40);
/*!40000 ALTER TABLE `characters` ENABLE KEYS */;

-- Дъмп структура за таблица guild_rooster.events
DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type` int(11) NOT NULL DEFAULT 0,
  `event_leader` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `begin_at` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица guild_rooster.events: ~4 rows (приблизително)
DELETE FROM `events`;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `event_type`, `event_leader`, `date`, `begin_at`) VALUES
	(1, 4, 1, '2021-05-17 01:14:42', '01:14:41'),
	(2, 2, 1, '2021-05-27 01:14:43', '01:14:42'),
	(3, 3, 1, '2021-05-28 01:14:44', '01:14:43'),
	(4, 1, 1, '2021-05-31 01:14:44', '01:14:44');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Дъмп структура за таблица guild_rooster.guild
DROP TABLE IF EXISTS `guild`;
CREATE TABLE IF NOT EXISTS `guild` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guild_name` varchar(50) NOT NULL DEFAULT '0',
  `guild_master` varchar(50) NOT NULL DEFAULT '0',
  `members_count` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица guild_rooster.guild: ~0 rows (приблизително)
DELETE FROM `guild`;
/*!40000 ALTER TABLE `guild` DISABLE KEYS */;
INSERT INTO `guild` (`id`, `guild_name`, `guild_master`, `members_count`) VALUES
	(1, 'Server Staff', 'Brannik', 765);
/*!40000 ALTER TABLE `guild` ENABLE KEYS */;

-- Дъмп структура за таблица guild_rooster.guild_ranks
DROP TABLE IF EXISTS `guild_ranks`;
CREATE TABLE IF NOT EXISTS `guild_ranks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Дъмп данни за таблица guild_rooster.guild_ranks: ~5 rows (приблизително)
DELETE FROM `guild_ranks`;
/*!40000 ALTER TABLE `guild_ranks` DISABLE KEYS */;
INSERT INTO `guild_ranks` (`id`, `rank_name`) VALUES
	(1, 'Test'),
	(2, 'Member'),
	(3, 'Elite'),
	(4, 'Officer'),
	(5, 'Guild Master');
/*!40000 ALTER TABLE `guild_ranks` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
