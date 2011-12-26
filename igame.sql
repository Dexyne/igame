-- phpMyAdmin SQL Dump
-- version 3.3.7deb6
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 26 Décembre 2011 à 05:35
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
  `name` varchar(50) NOT NULL,
  `name_clean` varchar(50) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `content` text,
  `metal` int(11) DEFAULT NULL,
  `crystal` int(11) DEFAULT NULL,
  `deuterium` int(11) DEFAULT NULL,
  `energy` int(11) DEFAULT NULL,
  `multiplier` float NOT NULL DEFAULT '1.1',
  `square` int(5) NOT NULL,
  `construct_time` int(11) DEFAULT NULL,
  `previous_construct` varchar(255) NOT NULL,
  `important` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `building`
--

INSERT INTO `building` (`id`, `name`, `name_clean`, `introduction`, `content`, `metal`, `crystal`, `deuterium`, `energy`, `multiplier`, `square`, `construct_time`, `previous_construct`, `important`) VALUES
(1, 'Mine de métal', 'metal_mine', 'Une mine permettant d''extraire les métaux.', NULL, 50, 50, NULL, 8, 1.4, 2, 120, '0', 1),
(2, 'Mine de cristal', 'crystal_mine', 'Une mine permettant d''extraire les cristaux.', NULL, 50, 50, NULL, 8, 1.4, 2, 120, '0', 1),
(3, 'Synthétiseur de deuterium', 'deuterium_synthesizer', 'Extrait et synthétise le deutérium.', NULL, 60, 30, NULL, 12, 1.5, 3, 120, '0', 1),
(4, 'Centrale solaire', 'solar_plant', 'Récupère de l''énergie grâce au soleil, source inépuisable.', NULL, 50, 40, NULL, NULL, 1.2, 3, 120, '0', 1);

-- --------------------------------------------------------

--
-- Structure de la table `defense`
--

CREATE TABLE IF NOT EXISTS `defense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `defense`
--


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
('4b9251f667c9556e2a0cbeb0af2558f1', '192.168.233.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.63 Safari/535.7', 1324872312, 'a:6:{s:9:"user_data";s:0:"";s:8:"username";s:4:"test";s:5:"email";s:12:"test@mail.fr";s:2:"id";i:1;s:6:"logged";b:1;s:9:"planet_id";s:1:"1";}');

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
  `planet` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `metal` double(132,8) NOT NULL DEFAULT '0.00000000',
  `crystal` double(132,8) NOT NULL DEFAULT '0.00000000',
  `deuterium` double(132,8) NOT NULL DEFAULT '0.00000000',
  `energy_used` int(11) NOT NULL,
  `energy_max` int(11) NOT NULL,
  `metal_mine` tinyint(3) NOT NULL,
  `crystal_mine` tinyint(3) NOT NULL,
  `deuterium_synthesizer` tinyint(3) NOT NULL,
  `solar_plant` tinyint(3) NOT NULL,
  `laboratory` tinyint(3) NOT NULL,
  `yardspace` tinyint(3) NOT NULL,
  `ion` tinyint(3) NOT NULL,
  `laser` tinyint(3) NOT NULL,
  `plasma` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `planets`
--

INSERT INTO `planets` (`id`, `user_id`, `name`, `galaxy`, `system`, `planet`, `created_at`, `updated_at`, `metal`, `crystal`, `deuterium`, `energy_used`, `energy_max`, `metal_mine`, `crystal_mine`, `deuterium_synthesizer`, `solar_plant`, `laboratory`, `yardspace`, `ion`, `laser`, `plasma`) VALUES
(1, 1, 'planète de test', 1, 1, 1, '2011-12-01 00:00:00', '2011-12-26 03:16:29', 55498.52064463, 56774.88333334, 59076.39444446, 174, 74, 3, 3, 1, 2, 1, 0, 0, 0, 0),
(2, 1, 'youpi', 1, 1, 3, '2011-12-02 00:00:00', '2011-12-26 03:16:27', 63652.61111112, 65095.32222223, 61641.12222223, 28, 20, 1, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `element_id` int(11) NOT NULL,
  `element_type` varchar(50) DEFAULT NULL,
  `planet_id` int(11) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_finish` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `queue`
--


-- --------------------------------------------------------

--
-- Structure de la table `ship`
--

CREATE TABLE IF NOT EXISTS `ship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `name_clean` varchar(50) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `content` text,
  `metal` int(11) DEFAULT NULL,
  `crystal` int(11) DEFAULT NULL,
  `deuterium` int(11) DEFAULT NULL,
  `energy` int(11) DEFAULT NULL,
  `construct_time` int(11) NOT NULL,
  `previous_construct` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `ship`
--


-- --------------------------------------------------------

--
-- Structure de la table `technology`
--

CREATE TABLE IF NOT EXISTS `technology` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `name_clean` varchar(50) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `content` text,
  `metal` int(11) DEFAULT NULL,
  `crystal` int(11) DEFAULT NULL,
  `deuterium` int(11) DEFAULT NULL,
  `energy` int(11) DEFAULT NULL,
  `multiplier` float NOT NULL DEFAULT '1.1',
  `construct_time` int(11) DEFAULT NULL,
  `previous_construct` varchar(255) DEFAULT NULL,
  `important` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `technology`
--

INSERT INTO `technology` (`id`, `name`, `name_clean`, `introduction`, `content`, `metal`, `crystal`, `deuterium`, `energy`, `multiplier`, `construct_time`, `previous_construct`, `important`) VALUES
(1, 'Technologie Ion', 'ion', 'Rayon mortel.', 'Rayon mortel composé d''ions accélérés. En touchant un objet, il cause des dégâts importants.', NULL, 60, 60, NULL, 1.9, 128, NULL, 0),
(2, 'Technologie Laser', 'laser', 'Rayon intense et extrêmement énergétique de lumière.', 'Le Laser (lumière amplifiée par émission stimulée) crée un rayon intense et extrêmement énergétique de lumière cohérente. Ces installations servent dans beaucoup de domaines, p. e. aux ordinateurs optiques, armes laser qui peuvent détruire la protection d', NULL, 80, 55, NULL, 1.8, 115, NULL, 0),
(3, 'Technologie Plasma', 'plasma', 'Une amélioration de la technologie d''ions.', 'Une amélioration de la technologie d''ions, n''accélérant pas des ions mais du plasma à haute énergie. Le plasma a un effet extrêmement dévastateur en touchant un objet et s''y déchargeant.', NULL, 60, 70, NULL, 2, 136, NULL, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'test@mail.fr', '2011-11-21 19:38:00', '2011-12-23 13:29:42'),
(9, 'Example', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'example@mail.fr', '2011-12-23 13:23:58', '2011-12-23 13:23:58');
