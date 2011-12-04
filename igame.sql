-- phpMyAdmin SQL Dump
-- version 3.3.7deb6
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 04 Décembre 2011 à 18:52
-- Version du serveur: 5.1.49
-- Version de PHP: 5.3.3-7+squeeze3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `igame`
--

-- --------------------------------------------------------

--
-- Structure de la table `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `name_clean` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `metal` int(10) DEFAULT NULL,
  `crystal` int(10) DEFAULT NULL,
  `deuterium` int(10) DEFAULT NULL,
  `energy` int(10) DEFAULT NULL,
  `multiplier` float NOT NULL DEFAULT '1.1',
  `square` int(5) NOT NULL,
  `construct_time` datetime NOT NULL,
  `previous_construct` varchar(255) NOT NULL,
  `important` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `building`
--

INSERT INTO `building` (`id`, `name`, `name_clean`, `content`, `metal`, `crystal`, `deuterium`, `energy`, `multiplier`, `square`, `construct_time`, `previous_construct`, `important`) VALUES
(1, 'Mine de métal', 'metal_mine', 'Une mine permettant d''extraire les métaux.', 50, 50, NULL, 20, 1.1, 2, '0000-00-00 00:02:00', '0', 1),
(2, 'Mine de cristal', 'crystal_mine', 'Une mine permettant d''extraire les cristaux.', 50, 50, NULL, 20, 1.1, 2, '0000-00-00 00:02:00', '0', 1),
(3, 'Synthétiseur de deuterium', 'deuterieum_synthetiser', 'Extrait et synthétise le deutérium.', 60, 30, NULL, 25, 1.1, 3, '0000-00-00 00:03:00', '0', 1),
(4, 'Centrale solaire', 'solar_plant', 'Récupère de l''énergie grâce au soleil, source inépuisable.', 50, 40, NULL, NULL, 1.1, 3, '0000-00-00 00:02:00', '0', 1);

-- --------------------------------------------------------

--
-- Structure de la table `igame_sessions`
--

CREATE TABLE IF NOT EXISTS `igame_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `igame_sessions`
--

INSERT INTO `igame_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('934ccf3603ab9e215080273dd7680e9a', '192.168.233.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.121 Safari/535.2', 1323017309, 'a:6:{s:9:"user_data";s:0:"";s:8:"username";s:4:"test";s:5:"email";s:12:"test@mail.fr";s:2:"id";i:1;s:6:"logged";b:1;s:9:"planet_id";s:1:"1";}'),
('91594b70f9c40ba1f322e089b8fba4bf', '192.168.233.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.121 Safari/535.2', 1323020996, 'a:6:{s:9:"user_data";s:0:"";s:8:"username";s:4:"test";s:5:"email";s:12:"test@mail.fr";s:2:"id";i:1;s:6:"logged";b:1;s:9:"planet_id";s:1:"1";}');

-- --------------------------------------------------------

--
-- Structure de la table `planets`
--

CREATE TABLE IF NOT EXISTS `planets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `galaxy` tinyint(2) NOT NULL,
  `system` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `planet` tinyint(2) NOT NULL,
  `metal` double(132,8) NOT NULL DEFAULT '0.00000000',
  `crystal` double(132,8) NOT NULL DEFAULT '0.00000000',
  `deuterium` double(132,8) NOT NULL DEFAULT '0.00000000',
  `energy_used` int(11) NOT NULL,
  `energy_max` int(11) NOT NULL,
  `metal_mine` int(11) NOT NULL,
  `crystal_mine` int(11) NOT NULL,
  `deuterium_sintetizer` int(11) NOT NULL,
  `solar_plant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `planets`
--

INSERT INTO `planets` (`id`, `user_id`, `name`, `galaxy`, `system`, `created_at`, `updated_at`, `planet`, `metal`, `crystal`, `deuterium`, `energy_used`, `energy_max`, `metal_mine`, `crystal_mine`, `deuterium_sintetizer`, `solar_plant`) VALUES
(1, 1, 'planète de test', 1, 1, '2011-12-01 00:00:00', '2011-12-04 18:50:00', 1, 8470.46508907, 9404.82777778, 8969.22777778, 20, 100, 1, 0, 0, 3),
(2, 1, 'youpi', 1, 1, '2011-12-02 00:00:00', '2011-12-04 18:49:58', 3, 14015.55555555, 16990.65555555, 13466.45555555, 50, 50, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `element_id` int(11) NOT NULL,
  `planet_id` int(11) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_finish` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `queue`
--

INSERT INTO `queue` (`id`, `element_id`, `planet_id`, `time_start`, `time_finish`) VALUES
(1, 1, 1, '2011-12-04 17:52:43', '0000-00-00 00:00:00'),
(2, 1, 1, '2011-12-04 17:53:15', '0000-00-00 00:00:00'),
(3, 1, 1, '2011-12-04 18:06:21', '2011-12-04 18:06:21'),
(4, 1, 1, '2011-12-04 18:07:10', '2011-12-04 18:07:10'),
(5, 1, 1, '2011-12-04 18:07:11', '2011-12-04 18:07:11'),
(6, 1, 1, '2011-12-04 18:21:12', '2011-12-04 18:21:12'),
(7, 1, 1, '2011-12-04 18:21:45', '2011-12-04 18:21:45'),
(8, 1, 1, '2011-12-04 18:24:52', '2011-12-04 18:24:52'),
(9, 1, 1, '2011-12-04 18:40:23', '2011-12-04 18:40:23'),
(10, 1, 1, '2011-12-04 18:40:31', '2011-12-04 18:40:31');

-- --------------------------------------------------------

--
-- Structure de la table `ship`
--

CREATE TABLE IF NOT EXISTS `ship` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ship`
--


-- --------------------------------------------------------

--
-- Structure de la table `technology`
--

CREATE TABLE IF NOT EXISTS `technology` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `technology`
--


-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'test@mail.fr', '2011-11-21 19:38:00', '2011-11-21 19:38:00'),
(2, 'machin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'machin@mail.fr', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
