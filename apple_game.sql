-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 24 Avril 2016 à 04:00
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `apple_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

CREATE TABLE IF NOT EXISTS `acheteur` (
  `IdAcheteur` smallint(3) NOT NULL AUTO_INCREMENT,
  `Surnom` varchar(20) NOT NULL,
  `CarteValeur` int(3) DEFAULT NULL,
  PRIMARY KEY (`IdAcheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `idvendeur` smallint(3) NOT NULL,
  `idacheteur` smallint(2) NOT NULL,
  `date` date NOT NULL,
  `message` text,
  `typemessage` smallint(6) NOT NULL,
  PRIMARY KEY (`idvendeur`,`idacheteur`,`date`),
  KEY `FK_Acheteur_chat` (`idacheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `transation`
--

CREATE TABLE IF NOT EXISTS `transation` (
  `idVendeur` smallint(3) NOT NULL DEFAULT '0',
  `idAheteur` smallint(3) NOT NULL DEFAULT '0',
  `T_date` date NOT NULL DEFAULT '0000-00-00',
  `prixTransaction` mediumint(3) NOT NULL,
  `carteVendeur` mediumint(3) NOT NULL,
  `carteAcheteur` mediumint(3) NOT NULL,
  `tranche` smallint(1) NOT NULL,
  PRIMARY KEY (`idVendeur`,`idAheteur`,`T_date`),
  KEY `FK_Acheteur_Tran` (`idAheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

CREATE TABLE IF NOT EXISTS `vendeur` (
  `IdVendeur` smallint(3) NOT NULL AUTO_INCREMENT,
  `Surnom` varchar(25) NOT NULL,
  `CarteValeur` int(3) DEFAULT NULL,
  `Slogon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdVendeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `FK_Acheteur_chat` FOREIGN KEY (`idacheteur`) REFERENCES `acheteur` (`IdAcheteur`),
  ADD CONSTRAINT `FK_Vendeur_chat` FOREIGN KEY (`idvendeur`) REFERENCES `vendeur` (`IdVendeur`);

--
-- Contraintes pour la table `transation`
--
ALTER TABLE `transation`
  ADD CONSTRAINT `FK_Acheteur_Tran` FOREIGN KEY (`idAheteur`) REFERENCES `acheteur` (`IdAcheteur`),
  ADD CONSTRAINT `FK_Vendeur_Tran` FOREIGN KEY (`idVendeur`) REFERENCES `vendeur` (`IdVendeur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
