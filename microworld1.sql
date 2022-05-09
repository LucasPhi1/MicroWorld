-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 09 mai 2022 à 10:04
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `microworld1`
--

-- --------------------------------------------------------

--
-- Structure de la table `categ`
--

DROP TABLE IF EXISTS `categ`;
CREATE TABLE IF NOT EXISTS `categ` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categ`
--

INSERT INTO `categ` (`id`, `nom`) VALUES
(1, 'ORDINATEUR'),
(2, 'ÉCRAN'),
(4, 'SOURIS'),
(5, 'CLAVIER');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `mail`, `tel`, `adresse`, `password`) VALUES
(4, 'client', 'client', 'client@client.fr', '0679451245', '1 boulevard barbes 11000 carcassonne', '9cf95dacd226dcf43da376cdb6cbba7035218921'),
(3, 'Touil', 'lucas', 'mich@gmail.com', '0713131313', '112 rue alain 13000 marseille', '9cf95dacd226dcf43da376cdb6cbba7035218921');

-- --------------------------------------------------------

--
-- Structure de la table `imageprod`
--

DROP TABLE IF EXISTS `imageprod`;
CREATE TABLE IF NOT EXISTS `imageprod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cheminImg` varchar(60) NOT NULL,
  `idCateg` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `imageprod`
--

INSERT INTO `imageprod` (`id`, `cheminImg`, `idCateg`) VALUES
(10, 'imageProd/10/img.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `ancienPrix` int(11) NOT NULL,
  `prixPromo` int(11) NOT NULL,
  `idCateg` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `ancienPrix`, `prixPromo`, `idCateg`, `description`) VALUES
(10, 'msi', 3199, 2899, 1, 'msi mag forge');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
