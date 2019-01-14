-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Janvier 2019 à 09:31
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mapromo`
--

-- --------------------------------------------------------

--
-- Structure de la table `adhesion`
--

CREATE TABLE `adhesion` (
  `Promotion_idPromo` int(11) NOT NULL,
  `Internaute_idInternaute` int(11) NOT NULL,
  `noteAdhesion` int(11) DEFAULT NULL,
  `commentaireAdhesion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `libCategorie` varchar(45) NOT NULL,
  `idType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `idDepartement` varchar(3) NOT NULL,
  `libDepartement` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `internaute`
--

CREATE TABLE `internaute` (
  `idInternaute` int(11) NOT NULL,
  `nomInternaute` varchar(45) NOT NULL,
  `prenomInternaute` varchar(45) NOT NULL,
  `mailInternaute` varchar(254) NOT NULL,
  `mdpInternaute` varchar(100) NOT NULL,
  `telInternaute` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `magasin`
--

CREATE TABLE `magasin` (
  `idMagasin` int(11) NOT NULL,
  `nomMagasin` varchar(45) NOT NULL,
  `adresse1Magasin` varchar(150) NOT NULL,
  `adresse2Magasin` varchar(150) NOT NULL,
  `latMagasin` float NOT NULL,
  `longMagasin` float NOT NULL,
  `telMagasin` varchar(8) NOT NULL,
  `mailMagasin` varchar(254) NOT NULL,
  `siretMagasin` varchar(14) NOT NULL,
  `photo1Magasin` varchar(100) DEFAULT NULL,
  `photo2Magasin` varchar(100) DEFAULT NULL,
  `codeINSEEVille` int(11) NOT NULL,
  `idResponsable` int(11) NOT NULL,
  `idType` int(11) NOT NULL,
  `idCategorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `idPromo` int(11) NOT NULL,
  `dateDebutPromo` datetime NOT NULL,
  `dateFinPromo` datetime NOT NULL,
  `libPromo` varchar(45) NOT NULL,
  `etatPromo` tinyint(4) NOT NULL,
  `codePromo` varchar(15) NOT NULL,
  `codeAvisPromo` varchar(15) NOT NULL,
  `photo1Promo` varchar(100) DEFAULT NULL,
  `photo2Promo` varchar(100) DEFAULT NULL,
  `photo3Promo` varchar(100) DEFAULT NULL,
  `idMagasin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

CREATE TABLE `responsable` (
  `idResponsable` int(11) NOT NULL,
  `nomResponsable` varchar(45) NOT NULL,
  `prenomResponsable` varchar(45) NOT NULL,
  `mailResponsable` varchar(254) NOT NULL,
  `mdpResponsable` varchar(100) NOT NULL,
  `telResponsable` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `idType` int(11) NOT NULL,
  `libType` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `codeINSEEVille` int(11) NOT NULL,
  `cpVille` varchar(5) NOT NULL,
  `nomVille` varchar(45) NOT NULL,
  `popVille` int(11) DEFAULT NULL,
  `latVille` float NOT NULL,
  `longVille` float NOT NULL,
  `idDepartement` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adhesion`
--
ALTER TABLE `adhesion`
  ADD PRIMARY KEY (`Promotion_idPromo`,`Internaute_idInternaute`),
  ADD KEY `fk_Promotion_has_Internaute_Internaute1_idx` (`Internaute_idInternaute`),
  ADD KEY `fk_Promotion_has_Internaute_Promotion1_idx` (`Promotion_idPromo`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`),
  ADD KEY `fk_Categorie_Type1_idx` (`idType`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`idDepartement`);

--
-- Index pour la table `internaute`
--
ALTER TABLE `internaute`
  ADD PRIMARY KEY (`idInternaute`);

--
-- Index pour la table `magasin`
--
ALTER TABLE `magasin`
  ADD PRIMARY KEY (`idMagasin`),
  ADD KEY `fk_Magasin_Ville_idx` (`codeINSEEVille`),
  ADD KEY `fk_Magasin_Responsable1_idx` (`idResponsable`),
  ADD KEY `fk_Magasin_Type1_idx` (`idType`),
  ADD KEY `fk_Magasin_Categorie1_idx` (`idCategorie`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`idPromo`),
  ADD KEY `fk_Promotion_Magasin1_idx` (`idMagasin`);

--
-- Index pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`idResponsable`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idType`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`codeINSEEVille`,`cpVille`),
  ADD KEY `fk_Ville_Departement1_idx` (`idDepartement`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `internaute`
--
ALTER TABLE `internaute`
  MODIFY `idInternaute` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `magasin`
--
ALTER TABLE `magasin`
  MODIFY `idMagasin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `idPromo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `responsable`
--
ALTER TABLE `responsable`
  MODIFY `idResponsable` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adhesion`
--
ALTER TABLE `adhesion`
  ADD CONSTRAINT `fk_Promotion_has_Internaute_Internaute1` FOREIGN KEY (`Internaute_idInternaute`) REFERENCES `internaute` (`idInternaute`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Promotion_has_Internaute_Promotion1` FOREIGN KEY (`Promotion_idPromo`) REFERENCES `promotion` (`idPromo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `fk_Categorie_Type1` FOREIGN KEY (`idType`) REFERENCES `type` (`idType`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `magasin`
--
ALTER TABLE `magasin`
  ADD CONSTRAINT `fk_Magasin_Categorie1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Magasin_Responsable1` FOREIGN KEY (`idResponsable`) REFERENCES `responsable` (`idResponsable`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Magasin_Type1` FOREIGN KEY (`idType`) REFERENCES `type` (`idType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Magasin_Ville` FOREIGN KEY (`codeINSEEVille`) REFERENCES `ville` (`codeINSEEVille`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `fk_Promotion_Magasin1` FOREIGN KEY (`idMagasin`) REFERENCES `magasin` (`idMagasin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `fk_Ville_Departement1` FOREIGN KEY (`idDepartement`) REFERENCES `departement` (`idDepartement`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
