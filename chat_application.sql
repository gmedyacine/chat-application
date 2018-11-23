-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 23 nov. 2018 à 09:51
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chat_application`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat_session`
--

DROP TABLE IF EXISTS `chat_session`;
CREATE TABLE IF NOT EXISTS `chat_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `content`, `created_at`, `user_id`) VALUES
(1, 'Salut le monde\r\n', '2018-11-22 21:41:41', 2),
(2, 'lol', '2018-11-22 21:41:46', 2),
(3, 'lol', '2018-11-22 21:50:06', 2),
(4, 'Hello', '2018-11-22 21:58:32', 2),
(5, 'Salut', '2018-11-22 22:22:16', 1),
(6, 'AAlol', '2018-11-22 22:34:33', 1),
(7, 'Ã©Ã©Ã©Ã©', '2018-11-22 22:35:53', 1),
(8, 'Hello\r\n', '2018-11-22 23:07:26', 1),
(11, '&lt;u&gt;bonjour&lt;/u&gt;', '2018-11-23 09:00:28', 1),
(12, '&lt;script&gt;alert(1)&lt;/alert&gt;', '2018-11-23 09:00:45', 1),
(13, 'aaa', '2018-11-23 09:41:44', 1),
(14, 'Salut le monde again', '2018-11-23 09:41:49', 1),
(15, 'Hi I am Akali', '2018-11-23 09:42:32', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'Tchisuky', '$2y$10$ZyJY3Rz.m2GsFeV7ijK5re3ebqxEgQ6HFzakWufmagVXH/fFg2GqK'),
(2, 'Nefertity', '$2y$10$NyCI7G10J/syxQLMhvbeWOZCYiHrxk4GGLKPB2W7tqIGeYYfVk6h6'),
(3, 'Akali', '$2y$10$qU.lYhfeiV6ATCEmzeLjAOUar9czTUkg7rUdSJIB2hyEk5CiQVuzi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
