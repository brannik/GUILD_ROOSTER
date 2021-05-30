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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Изнасянето на данните беше деселектирано.

-- Дъмп структура за таблица guild_rooster.characters
DROP TABLE IF EXISTS `characters`;
CREATE TABLE IF NOT EXISTS `characters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `char_name` varchar(50) NOT NULL DEFAULT '0',
  `char_class` int(11) NOT NULL DEFAULT 0,
  `char_race` int(11) NOT NULL DEFAULT 0,
  `char_level` int(11) NOT NULL DEFAULT 0,
  `char_prim_spec` int(11) NOT NULL DEFAULT 0,
  `char_prim_spec_gear` int(11) NOT NULL DEFAULT 0,
  `char_sec_spec` int(11) NOT NULL DEFAULT 0,
  `char_sec_spec_gear` int(11) NOT NULL DEFAULT 0,
  `char_prim_prof` int(11) NOT NULL DEFAULT 0,
  `char_sec_prof` int(11) NOT NULL DEFAULT 0,
  `char_owner` int(11) NOT NULL DEFAULT 0,
  `char_rank` int(11) NOT NULL DEFAULT 0,
  `char_alt_of` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Изнасянето на данните беше деселектирано.

-- Дъмп структура за таблица guild_rooster.guild
DROP TABLE IF EXISTS `guild`;
CREATE TABLE IF NOT EXISTS `guild` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guild_name` varchar(50) NOT NULL DEFAULT '0',
  `guild_master` varchar(50) NOT NULL DEFAULT '0',
  `members_count` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Изнасянето на данните беше деселектирано.

-- Дъмп структура за таблица guild_rooster.guild_ranks
DROP TABLE IF EXISTS `guild_ranks`;
CREATE TABLE IF NOT EXISTS `guild_ranks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Изнасянето на данните беше деселектирано.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
