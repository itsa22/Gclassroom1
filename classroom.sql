-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 nov. 2021 à 16:29
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `classroom`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_admin` int(11) NOT NULL,
  `nom_admin` varchar(255) DEFAULT NULL,
  `prenom_admin` varchar(255) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_admin`, `nom_admin`, `prenom_admin`, `tel`, `email`, `mot_de_passe`, `image_url`) VALUES
(3, 'Xavier', 'Razaf', '1234', 'xavier@gmail.com', 'xavier', 'IMG-61854ad33b4425.05408801.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

CREATE TABLE `commenter` (
  `id_com` int(11) NOT NULL,
  `id_cours` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nom_com` varchar(255) DEFAULT NULL,
  `prenom_com` varchar(255) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `Date_com` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commenter`
--

INSERT INTO `commenter` (`id_com`, `id_cours`, `email`, `nom_com`, `prenom_com`, `commentaire`, `Date_com`) VALUES
(119, 28, 'rochel@gmail.com', 'Mr', 'Rochel', 'bonjour', '2021-11-09 16:00:53'),
(120, 28, 'joyce@gmail.com', 'joyce', 'Whitman', 'bonjour monsieur', '2021-11-09 16:04:25'),
(121, 28, 'rochel@gmail.com', 'Mr', 'Rochel', 'avez-vous reçu le fichier que je vous ai envoyé', '2021-11-09 16:06:16'),
(122, 28, 'joyce@gmail.com', 'joyce', 'Whitman', 'non monsieur, aucun ne nous a été encoyé', '2021-11-09 16:07:19'),
(124, 23, 'ndrina@gmail.com', 'Mr', 'Ndrina', 'Bonjour je suis votre professeur en leadership', '2021-11-09 16:09:47'),
(125, 23, 'joyce@gmail.com', 'joyce', 'Whitman', 'Bonjour Mr Ndrina', '2021-11-09 16:10:06'),
(126, 24, 'joyce@gmail.com', 'joyce', 'Whitman', 'nous avons bien reçu le fichier merci beaucoup', '2021-11-09 16:11:04'),
(127, 24, 'ndrina@gmail.com', 'Mr', 'Ndrina', 'faîtes vos revisions', '2021-11-09 16:11:23'),
(128, 32, 'rochel@gmail.com', 'Mr', 'Rochel', 'Ecoutez cette chanson', '2021-11-09 16:19:52'),
(129, 32, 'joyce@gmail.com', 'joyce', 'Whitman', 'vouz aimez Alan Walker ?', '2021-11-09 16:20:26');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id_cours` int(11) NOT NULL,
  `id_module` int(11) DEFAULT NULL,
  `fichier` varchar(255) DEFAULT NULL,
  `message_prof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `id_module`, `fichier`, `message_prof`) VALUES
(23, 120, NULL, 'Bonjour, je suis votre professeurs de leadership'),
(24, 120, 'FILE-618a7f8dabca59.85624208.pptx', NULL),
(28, 150, NULL, 'je suis votre professeur de langage C'),
(32, 150, 'FILE-618a917c46dae7.53121785.mp3', 'voici un devoir à faire');

-- --------------------------------------------------------

--
-- Structure de la table `emploi_du_temps`
--

CREATE TABLE `emploi_du_temps` (
  `id_edt` int(11) NOT NULL,
  `id_module` int(11) DEFAULT NULL,
  `salle` int(255) DEFAULT NULL,
  `Date_edt` date DEFAULT NULL,
  `Horaire` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `emploi_du_temps`
--

INSERT INTO `emploi_du_temps` (`id_edt`, `id_module`, `salle`, `Date_edt`, `Horaire`) VALUES
(9, 120, 3, '2021-11-06', 'De 13:00 à 17:00');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etu` int(11) NOT NULL,
  `nom_etu` varchar(255) DEFAULT NULL,
  `prenom_etu` varchar(255) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `image_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etu`, `nom_etu`, `prenom_etu`, `tel`, `email`, `mot_de_passe`, `image_url`) VALUES
(39, 'joyce', 'Whitman', '12345', 'joyce@gmail.com', 'joyce', 'IMG-618a79d0949624.85569269.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `id_module` int(11) NOT NULL,
  `nom_module` varchar(255) DEFAULT NULL,
  `id_prof` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id_module`, `nom_module`, `id_prof`) VALUES
(120, 'leadership', 20),
(150, 'Language C', 21);

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id_prof` int(11) NOT NULL,
  `nom_prof` varchar(255) DEFAULT NULL,
  `prenom_prof` varchar(255) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id_prof`, `nom_prof`, `prenom_prof`, `tel`, `email`, `mot_de_passe`, `image_url`) VALUES
(20, 'Mr', 'Ndrina', '6', 'ndrina@gmail.com', 'ndrina', 'IMG-618a6352584117.27286455.jpg'),
(21, 'Mr', 'Rochel', '03456', 'rochel@gmail.com', 'rochel', 'IMG-618a63b9038e75.10964292.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `id_cours` (`id_cours`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`),
  ADD KEY `id_module` (`id_module`);

--
-- Index pour la table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  ADD PRIMARY KEY (`id_edt`),
  ADD KEY `fk_module_edt` (`id_module`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etu`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id_module`),
  ADD KEY `module_ibfk_1` (`id_prof`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id_prof`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commenter`
--
ALTER TABLE `commenter`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  MODIFY `id_edt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD CONSTRAINT `commenter_ibfk_1` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  ADD CONSTRAINT `fk_module_edt` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `professeur` (`id_prof`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
