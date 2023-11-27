-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 nov. 2023 à 13:53
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `cost`
--

DROP TABLE IF EXISTS `cost`;
CREATE TABLE IF NOT EXISTS `cost` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) DEFAULT NULL,
  `montant` float DEFAULT NULL,
  `refund_montant` float DEFAULT NULL,
  `timing` int NOT NULL,
  `dateligne` date DEFAULT NULL,
  `idFicheFrais` int DEFAULT NULL,
  `statu` varchar(3) NOT NULL,
  `linkJustif` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idFicheFrais` (`idFicheFrais`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `cost`
--

INSERT INTO `cost` (`id`, `libelle`, `montant`, `refund_montant`, `timing`, `dateligne`, `idFicheFrais`, `statu`, `linkJustif`) VALUES
(183, 'transport (voiture)', 210.28, 210.28, 347, '2023-11-03', 95, 'F', ''),
(184, 'logement', 122.4, 122.4, 3, '2023-11-03', 95, 'F', ''),
(185, 'restauration', 97.4, 97.4, 5, '2023-11-03', 95, 'F', ''),
(186, 'cinema', 12, 0, 0, '2023-11-03', 95, 'HF', '../uploads/1/20230123_181745873_iOS.jpg'),
(187, 'transport (voiture)', 29.09, 29.09, 48, '2023-11-07', 96, 'F', ''),
(188, 'restauration', 54, 25, 1, '2023-11-07', 96, 'F', ''),
(189, 'transport (voiture)', 116.91, 116.91, 221, '2023-11-22', 97, 'F', ''),
(190, 'logement', 88.45, 88.45, 2, '2023-11-22', 97, 'F', ''),
(191, 'restauration', 478, 125, 5, '2023-11-22', 97, 'F', ''),
(192, 'transport (train)', 87, NULL, 0, '2023-11-08', 98, 'HF', '../uploads/1/mongolefière.png'),
(193, 'logement', 68, NULL, 1, '2023-11-08', 98, 'F', ''),
(194, 'restauration', 49.6, NULL, 2, '2023-11-08', 98, 'F', ''),
(195, 'cinema', 13, NULL, 0, '2023-11-08', 98, 'HF', '../uploads/1/20230123_181745873_iOS.jpg'),
(196, 'transport (train)', 134, 134, 0, '2023-11-23', 99, 'HF', '../uploads/4/291716_github_logo_social network_social_icon.png'),
(197, 'transport (voiture)', 129.68, NULL, 214, '2023-11-29', 100, 'F', ''),
(198, 'transport (voiture)', 33.94, NULL, 56, '2023-11-30', 101, 'F', ''),
(199, 'transport (voiture)', 33.94, NULL, 56, '2023-12-08', 102, 'F', ''),
(200, 'transport (voiture)', 7.27, 7.27, 12, '2023-12-10', 103, 'F', ''),
(201, 'transport (voiture)', 1.82, NULL, 3, '2023-11-11', 104, 'F', ''),
(202, 'transport (voiture)', 74.54, NULL, 123, '2023-11-03', 105, 'F', ''),
(203, 'transport (voiture)', 87.87, NULL, 145, '2023-11-17', 106, 'F', ''),
(204, 'transport (voiture)', 3.03, NULL, 5, '2023-11-17', 107, 'F', ''),
(205, 'transport (voiture)', 27.27, NULL, 45, '2023-11-09', 108, 'F', '');

-- --------------------------------------------------------

--
-- Structure de la table `cost_sheet`
--

DROP TABLE IF EXISTS `cost_sheet`;
CREATE TABLE IF NOT EXISTS `cost_sheet` (
  `idFicheFrais` int NOT NULL AUTO_INCREMENT,
  `montant_total` float NOT NULL,
  `refund_total` float NOT NULL,
  `beginDate` date NOT NULL,
  `endDate` date NOT NULL,
  `idUser` int NOT NULL,
  `idUserValidation` int DEFAULT NULL,
  `statue` varchar(30) NOT NULL,
  PRIMARY KEY (`idFicheFrais`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `cost_sheet`
--

INSERT INTO `cost_sheet` (`idFicheFrais`, `montant_total`, `refund_total`, `beginDate`, `endDate`, `idUser`, `idUserValidation`, `statue`) VALUES
(95, 442.08, 430.08, '2023-11-01', '2023-11-03', 1, 2, 'T'),
(96, 83.09, 54.09, '2023-11-07', '2023-11-07', 1, 2, 'T'),
(97, 683.36, 330.36, '2023-11-20', '2023-11-22', 4, 2, 'T'),
(98, 217.6, 0, '2023-11-08', '2023-11-08', 1, NULL, 'NT'),
(99, 134, 134, '2023-11-22', '2023-11-23', 4, 2, 'T'),
(100, 129.68, 0, '2023-11-29', '2023-11-29', 1, NULL, 'NT'),
(101, 33.94, 0, '2023-11-30', '2023-11-30', 1, NULL, 'NT'),
(102, 33.94, 0, '2023-12-08', '2023-12-08', 1, NULL, 'NT'),
(103, 7.27, 7.27, '2023-12-10', '2023-12-10', 1, 2, 'T'),
(104, 1.82, 0, '2023-11-09', '2023-11-11', 1, NULL, 'NT'),
(105, 74.54, 0, '2023-10-31', '2023-11-03', 1, NULL, 'NT'),
(106, 87.87, 0, '2023-11-15', '2023-11-17', 1, NULL, 'NT'),
(107, 3.03, 0, '2023-11-15', '2023-11-17', 1, NULL, 'NT'),
(108, 27.27, 0, '2023-11-08', '2023-11-09', 1, NULL, 'NT');

-- --------------------------------------------------------

--
-- Structure de la table `prices`
--

DROP TABLE IF EXISTS `prices`;
CREATE TABLE IF NOT EXISTS `prices` (
  `nomPrice` varchar(200) NOT NULL,
  `maxPrice` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `prices`
--

INSERT INTO `prices` (`nomPrice`, `maxPrice`) VALUES
('logement', 67),
('restauration', 25);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `adress` varchar(500) NOT NULL,
  `cp` int NOT NULL,
  `ville` varchar(100) NOT NULL,
  `dateEmbauche` datetime NOT NULL,
  `statut` varchar(50) NOT NULL,
  `cvcar` int NOT NULL,
  `ppLink` varchar(200) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `login`, `password`, `adress`, `cp`, `ville`, `dateEmbauche`, `statut`, `cvcar`, `ppLink`, `isActive`) VALUES
(1, 'BOURDIN', 'Jean', 'jean.bourdin@gmail.com', '$2y$10$8nuvVyY0ZX2dckaamD.teeNqmz2u0LP9ADGy7hllUmxgXPGmRzFHW', '2 Chemin des Eglantine', 69580, 'Sathonay-Village', '2023-10-12 12:52:32', 'visiteur', 4, '../uploads/1/jean Bourdin.jpg', 1),
(2, 'DUCHAMPS', 'Pierrick', 'pierrick.duchamps@gmail.com', '$2y$10$SxbYW79rtiE81zILhQgRtuzIogn/wC4pnJdSukjMXHSvTHkyJ36Sa', '5 Allée du Champs d\'Épis', 69360, 'Communay', '2023-10-12 12:59:08', 'comptable', 0, '../uploads/2/pierrick Duchamps.jpg', 1),
(3, 'JACQUES', 'Yannis', 'admin@gmail.com', '$2y$10$gmsRFs/LPQiC9DLKKdtoXeQ6XK88ykhHapmg7WeJDsyErvuPkFMZW', '13 avenue George Pompidou', 69005, 'Lyon', '2023-11-09 15:04:56', 'admin', 0, '../uploads/3/yannis Jacques.jpg', 1),
(4, 'GENEVAY', 'Lola', 'lola.genevay@gmail.com', '$2y$10$8o2/jDcmsvAI3yTG3NZlfOGms5nIOU9NKeE2AhpTRTLZG3vpV6EV2', '89 avenue champs Elysée', 75008, 'Paris', '2023-11-13 00:00:00', 'visiteur', 2, '../uploads/4/lola.jpg', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cost`
--
ALTER TABLE `cost`
  ADD CONSTRAINT `cost_ibfk_1` FOREIGN KEY (`idFicheFrais`) REFERENCES `cost_sheet` (`idFicheFrais`);

--
-- Contraintes pour la table `cost_sheet`
--
ALTER TABLE `cost_sheet`
  ADD CONSTRAINT `cost_sheet_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
