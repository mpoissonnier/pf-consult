-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 17 Janvier 2018 à 16:52
-- Version du serveur :  5.7.20-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `PFCONSULT`
--

-- --------------------------------------------------------

--
-- Structure de la table `Domaine`
--

CREATE TABLE `Domaine` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Domaine`
--

INSERT INTO `Domaine` (`id`, `nom`) VALUES
(1, 'MEDICAL'),
(2, 'JURIDIQUE');

-- --------------------------------------------------------

--
-- Structure de la table `Sous_Specialite`
--

CREATE TABLE `Sous_Specialite` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8_bin NOT NULL,
  `sousDomaine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `Sous_Specialite`
--

INSERT INTO `Sous_Specialite` (`id`, `nom`, `sousDomaine`) VALUES
(1, 'chirurgie cardiaque', 1),
(2, 'chirurgie esthétique', 1),
(3, 'chirurgie générale', 1),
(4, 'chirurgie maxillo-faciale', 1),
(5, 'chirurgie pédiatrique', 1),
(6, 'chirurgie thoracique', 1),
(7, 'chirurgie vasculaire', 1),
(8, 'neurochirurgie', 1),
(9, 'Droit des personnes', 38),
(10, 'Droit pénal', 38),
(11, 'Droit immobilier', 38),
(12, 'Droit rural', 38),
(13, 'Droit de l\'environnement', 38),
(14, 'Droit public', 38),
(15, 'Droit de la propriété intellectuelle', 38),
(16, 'Droit commercial', 38),
(17, 'Droit des sociétés', 38),
(18, 'Droit fiscal', 38),
(19, 'Droit social', 38),
(20, 'Droit économique', 38),
(21, 'Droit des mesures d\'exécution', 38),
(22, 'Droit communautaire', 38),
(23, 'Droit des relations internationales', 38);

-- --------------------------------------------------------

--
-- Structure de la table `Specialite`
--

CREATE TABLE `Specialite` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `domaine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Specialite`
--

INSERT INTO `Specialite` (`id`, `nom`, `domaine`) VALUES
(1, 'Chirurgie', 1),
(2, 'Allergologie', 1),
(3, 'Immunologie', 1),
(4, 'Andrologie', 1),
(5, 'Anesthésiologie', 1),
(6, 'Cardiologie', 1),
(7, 'Dermatologie', 1),
(8, 'Endocrinologie', 1),
(9, 'Gastro-entérologie', 1),
(10, 'Gériatrie', 1),
(11, 'Gynécologie', 1),
(12, 'Hématologie', 1),
(13, 'Hépatologie', 1),
(14, 'Infectiologie', 1),
(15, 'Médecine aiguë', 1),
(16, 'Médecine du travail', 1),
(17, 'Médecine générale', 1),
(18, 'Médecine interne', 1),
(19, 'Médecine nucléaire', 1),
(20, 'Médecine palliative', 1),
(21, 'Médecine physique', 1),
(22, 'Méecine préventive', 1),
(23, 'Néonatologie', 1),
(24, 'Néphrologie', 1),
(25, 'Neurologie', 1),
(26, 'Odontologie', 1),
(27, 'Obstétrique', 1),
(28, 'Ophtalmologie', 1),
(29, 'Orthopédie', 1),
(30, 'Oto-rhino-laryngologie', 1),
(31, 'Pédiatre', 1),
(32, 'Pneumologie', 1),
(33, 'Psychiatre', 1),
(34, 'Radiologie', 1),
(35, 'Radiothérapie', 1),
(36, 'Rhumatologie', 1),
(37, 'Urologie', 1),
(38, 'Avocat', 2),
(39, 'Administrateur judiciaire', 2),
(40, 'Analyste juridique', 2),
(41, 'Assistant juridique', 2),
(42, 'Clerc', 2),
(43, 'Commissaire', 2),
(44, 'Conseiller en propriété intellectuelle', 2),
(45, 'Détective privé', 2),
(46, 'Éducateur de la protection', 2),
(47, 'Fiscaliste', 2),
(48, 'Greffier', 2),
(49, 'Huissier de justice', 2),
(50, 'Juge', 2),
(51, 'Juriste', 2),
(52, 'Mandataire judiciaire', 2),
(53, 'Médiateur pénal', 2),
(54, 'Notaire', 2),
(55, 'Procureur de la République', 2),
(56, 'Substitut du procureur', 2),
(57, 'Surveillant de l’administration', 2);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `civilite` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ddn` date NOT NULL,
  `adresse` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cp` int(5) UNSIGNED NOT NULL,
  `ville` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) UNSIGNED NOT NULL,
  `specialite` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Domaine`
--
ALTER TABLE `Domaine`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Sous_Specialite`
--
ALTER TABLE `Sous_Specialite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Specialite`
--
ALTER TABLE `Specialite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Domaine`
--
ALTER TABLE `Domaine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Sous_Specialite`
--
ALTER TABLE `Sous_Specialite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `Specialite`
--
ALTER TABLE `Specialite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
