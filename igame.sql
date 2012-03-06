-- phpMyAdmin SQL Dump
-- version 3.3.7deb6
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 05 Mars 2012 à 23:10
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
-- Création: Sam 04 Février 2012 à 18:43
--

DROP TABLE IF EXISTS `building`;
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
  `important` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `building`
--

INSERT INTO `building` (`id`, `name`, `name_clean`, `introduction`, `content`, `metal`, `crystal`, `deuterium`, `energy`, `multiplier`, `square`, `construct_time`, `important`) VALUES
(1, 'Mine de métal', 'metal_mine', 'Une mine permettant d''extraire les métaux.', 'Principale matière première pour la construction de bâtiments et de vaisseaux. Le métal est la matière première la moins chère, mais c''est la plus importante. La production du métal consomme moins d''énergie que la production des autres ressources. Plus les mines sont développées, plus elles sont profondes. Les réserves minérales sont situées en profondeur sur la majorité des planètes. Les mines les plus profondes permettent d''extraire plus de métal, ce qui augment leur rendement. Cependant, les mines les plus développées consomment aussi plus d''énergie.', 50, 50, NULL, 8, 1.4, 2, 120, 1),
(2, 'Mine de cristal', 'crystal_mine', 'Une mine permettant d''extraire les cristaux.', 'Le cristal est la principale ressource pour l''électronique et pour les alliages et son extraction consomme environ une fois et demi plus d''énergie que celle du métal, le cristal est donc plus précieux. Tous les vaisseaux et bâtiments ont besoin de cristal. Malheureusement, la plupart des cristaux nécessaires pour la construction de vaisseaux sont très rares et se trouvent en grande profondeur, comme le métal. La production augmente avec le développement des mines car on atteint des gisement plus grands et plus purs.', 50, 50, NULL, 8, 1.4, 2, 120, 1),
(3, 'Synthétiseur de deuterium', 'deuterium_synthesizer', 'Extrait et synthétise le deutérium.', 'Le deutérium est produit à partir d''eau lourde. Les plus grandes quantités se trouvent donc en grande profondeur, comme le métal et le cristal. Le développement du bâtiment permet d''accéder à des réserves de deutérium en plus grande profondeur et de concentrer ce deutérium extrait de l''eau lourde. Le deutérium sert de carburant pour les vaisseaux et est nécessaire pour presque toutes les recherches.', 60, 30, NULL, 12, 1.5, 3, 120, 1),
(4, 'Centrale solaire', 'solar_plant', 'Récupère de l''énergie grâce au soleil, source inépuisable.', 'Pour assurer l''alimentation des mines et des synthétiseurs en énergie, des centrales électriques solaires géantes sont nécessaires. Plus ces installations sont développées, plus la surface de la planète est recouverte de cellules photovoltaïques qui transforment les rayons de soleil en énergie électrique. Les centrales électriques solaires sont la base de l''alimentation énergétique d''une planète.', 50, 40, NULL, NULL, 1.2, 3, 120, 1),
(5, 'Usine de robots', 'factory_robots', 'Les usines de robots produisent des robots ouvriers qui servent à la construction de l''infrastructure planétaire. Chaque niveau augmente la vitesse de construction des différents bâtiments.', 'Le développement de ce bâtiment permet d''améliorer la vitesse de construction des bâtiments, vaisseaux, défenses et recherches.', 600, 230, 300, NULL, 1.3, 4, 210, 1),
(6, 'Chantier spatial', 'yardspace', 'Le chantier spatial permet de construire les vaisseaux et les installations de défense.', 'Le chantier spatial permet de construire les vaisseaux et les installations de défense. Plus le chantier est grand, plus la construction de vaisseaux et des installations de défense est rapide. La construction d''une usine de nanites permet la production de robots minuscules qui aident les robots ouvriers à travailler plus rapidement.', 850, 550, 300, NULL, 1.5, 5, 120, 1);

-- --------------------------------------------------------

--
-- Structure de la table `defenses`
--
-- Création: Lun 26 Décembre 2011 à 22:06
--

DROP TABLE IF EXISTS `defenses`;
CREATE TABLE IF NOT EXISTS `defenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `name_clean` varchar(50) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `content` text,
  `metal` int(11) DEFAULT NULL,
  `crystal` int(11) DEFAULT NULL,
  `deuterium` int(11) DEFAULT NULL,
  `energy` int(11) DEFAULT NULL,
  `gain_to` int(11) DEFAULT NULL,
  `obtained` int(11) DEFAULT NULL,
  `construct_time` int(11) DEFAULT NULL,
  `previous_construct` varchar(255) DEFAULT NULL,
  `important` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `defenses`
--

INSERT INTO `defenses` (`id`, `name`, `name_clean`, `introduction`, `content`, `metal`, `crystal`, `deuterium`, `energy`, `gain_to`, `obtained`, `construct_time`, `previous_construct`, `important`) VALUES
(1, 'Lanceur de missiles', 'rocket_launcher', 'Le lanceur de missiles est une façon simple et bon marché de se défendre.', 'Le lanceur de missiles est une façon simple et bon marché de se défendre. Comme il n''est qu''une évolution d''armes balistiques conventionnelles, il n''a pas besoin de recherche. Ses faibles frais de production permettent de s''en servir pour la défense contre des petites flottes, par contre au fur et à mesure il perd de son importance. Après il ne sert qu''à intercepter des missiles. Des rumeurs existent affirmant que les militaires sont en train de développer de nouveaux lanceurs. Les installations de défense sont désactivées dès qu''elles sont trop endommagées. Après une bataille, jusqu''à 70% des systèmes endommagés peuvent être réparés.', 2000, NULL, NULL, NULL, 100, 5, 1440, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `dependencies`
--
-- Création: Sam 04 Février 2012 à 18:28
--

DROP TABLE IF EXISTS `dependencies`;
CREATE TABLE IF NOT EXISTS `dependencies` (
  `element_id` int(11) NOT NULL,
  `needed_element_id` int(11) NOT NULL,
  `needed_level` tinyint(3) NOT NULL,
  `type_element` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `dependencies`
--

INSERT INTO `dependencies` (`element_id`, `needed_element_id`, `needed_level`, `type_element`) VALUES
(6, 5, 2, 'building');

-- --------------------------------------------------------

--
-- Structure de la table `igame_sessions`
--
-- Création: Sam 03 Décembre 2011 à 16:20
-- Dernière modification: Dim 04 Mars 2012 à 20:33
--

DROP TABLE IF EXISTS `igame_sessions`;
CREATE TABLE IF NOT EXISTS `igame_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `planets`
--
-- Création: Lun 26 Décembre 2011 à 22:24
--

DROP TABLE IF EXISTS `planets`;
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
  `metal_mine` tinyint(3) NOT NULL DEFAULT '0',
  `crystal_mine` tinyint(3) NOT NULL DEFAULT '0',
  `deuterium_synthesizer` tinyint(3) NOT NULL DEFAULT '0',
  `solar_plant` tinyint(3) NOT NULL DEFAULT '0',
  `factory_robots` tinyint(3) NOT NULL DEFAULT '0',
  `laboratory` tinyint(3) NOT NULL DEFAULT '0',
  `yardspace` tinyint(3) NOT NULL DEFAULT '0',
  `ion` tinyint(3) NOT NULL DEFAULT '0',
  `laser` tinyint(3) NOT NULL DEFAULT '0',
  `plasma` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `planets`
--

INSERT INTO `planets` (`id`, `user_id`, `name`, `galaxy`, `system`, `planet`, `created_at`, `updated_at`, `metal`, `crystal`, `deuterium`, `energy_used`, `energy_max`, `metal_mine`, `crystal_mine`, `deuterium_synthesizer`, `solar_plant`, `factory_robots`, `laboratory`, `yardspace`, `ion`, `laser`, `plasma`) VALUES
(1, 1, 'planète de test', 1, 1, 1, '2011-12-01 00:00:00', '2012-03-04 20:33:37', 321440.61786683, 296940.42500000, 217675.42222226, 203, 74, 4, 3, 2, 2, 2, 0, 2, 0, 0, 0),
(2, 1, 'youpi', 1, 1, 3, '2011-12-02 00:00:00', '2012-02-20 15:16:16', 131452.45833335, 65095.32222223, 61641.12222223, 28, 20, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `queue`
--
-- Création: Jeu 08 Décembre 2011 à 19:38
--

DROP TABLE IF EXISTS `queue`;
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
-- Création: Dim 04 Mars 2012 à 19:46
--

DROP TABLE IF EXISTS `ship`;
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
  `multiplier` float NOT NULL DEFAULT '1.1',
  `construct_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ship`
--

INSERT INTO `ship` (`id`, `name`, `name_clean`, `introduction`, `content`, `metal`, `crystal`, `deuterium`, `energy`, `multiplier`, `construct_time`) VALUES
(1, 'Petit transporteur', 'small_carrier', 'Le petit transporteur est un vaisseau très maniable et capable de transporter des matières premières sur d''autres planètes rapidement.', 'Le petit transporteur est un vaisseau très maniable et capable de transporter des matières premières sur d''autres planètes rapidement.', 2000, 2000, NULL, NULL, 1.1, 480);

-- --------------------------------------------------------

--
-- Structure de la table `technologies`
--
-- Création: Lun 26 Décembre 2011 à 06:01
--

DROP TABLE IF EXISTS `technologies`;
CREATE TABLE IF NOT EXISTS `technologies` (
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
-- Contenu de la table `technologies`
--

INSERT INTO `technologies` (`id`, `name`, `name_clean`, `introduction`, `content`, `metal`, `crystal`, `deuterium`, `energy`, `multiplier`, `construct_time`, `previous_construct`, `important`) VALUES
(1, 'Technologie Ion', 'ion', 'Rayon mortel.', 'Rayon mortel composé d''ions accélérés. En touchant un objet, il cause des dégâts importants.', NULL, 60, 60, NULL, 1.9, 128, NULL, 0),
(2, 'Technologie Laser', 'laser', 'Rayon intense et extrêmement énergétique de lumière.', 'Le Laser (lumière amplifiée par émission stimulée) crée un rayon intense et extrêmement énergétique de lumière cohérente. Ces installations servent dans beaucoup de domaines, p. e. aux ordinateurs optiques, armes laser qui peuvent détruire la protection d', NULL, 80, 55, NULL, 1.8, 115, NULL, 0),
(3, 'Technologie Plasma', 'plasma', 'Une amélioration de la technologie d''ions.', 'Une amélioration de la technologie d''ions, n''accélérant pas des ions mais du plasma à haute énergie. Le plasma a un effet extrêmement dévastateur en touchant un objet et s''y déchargeant.', NULL, 60, 70, NULL, 2, 136, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--
-- Création: Lun 19 Décembre 2011 à 19:42
--

DROP TABLE IF EXISTS `users`;
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
