-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 02 sep. 2023 à 01:49
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quidditch`
--

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id`, `nom`, `ville`, `image`) VALUES
(1, 'Les Faucons Virevoltants', 'Paris', '/images/Faucons.png'),
(2, 'Les Tourbillons Écarlates', 'New-York', '/images/Tourbillon.png'),
(3, 'Les Griffes Enchantées', 'Londres', '/images/griffes.png'),
(4, 'Les Éclairs Sombres', 'Tokyo', '/images/eclair.png');

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `buts` int(11) NOT NULL,
  `image` varchar(150) DEFAULT NULL,
  `equipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id`, `prenom`, `nom`, `buts`, `image`, `equipe_id`) VALUES
(3, 'Éloïse', 'Martel', 2, '', 1),
(4, 'Rylan', 'Thornwood', 4, '', 2),
(5, 'Leona', 'Blanchard', 6, '', 4),
(6, 'Caelan', 'Havengrove', 4, '', 3),
(7, 'Aurélien ', 'Tremblay', 8, '', 1),
(8, 'Isabella ', 'Drakos', 2, '', 1),
(9, 'Cedric ', 'Thornfield', 5, '', 2),
(10, 'Elara ', 'Whitewood', 10, '', 1),
(11, 'Felix ', 'Montclair', 1, '', 1),
(12, 'Serena ', 'Larkspur', 11, '', 2),
(13, 'Théo ', 'Ravenscroft', 12, '', 2),
(14, 'Livia', 'Ironheart', 4, '', 2),
(15, 'Remy ', 'Silverbrook', 8, '', 2),
(16, 'Astrid ', 'Blackthorn', 3, '', 1),
(17, 'Hugo', 'Stormrider', 7, '', 3),
(18, 'Nova ', 'Swiftwing', 4, '', 3),
(19, 'Maximillian ', 'Frostbane', 2, '', 3),
(20, 'Valentina ', 'Nightshade', 8, '', 3),
(21, 'Leandro ', 'Thunderstrike', 14, '', 3),
(22, 'Marcella ', 'Firestone', 15, '', 4),
(23, 'Lucian ', 'Shadowdancer', 2, '', 4),
(24, 'Astraea', ' Skythorn', 8, '', 4),
(25, 'Caspian', ' Stormrider', 10, '', 4),
(26, 'Seraphina ', 'Moonstrike', 1, '', 4);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `joueurs_equipes`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `joueurs_equipes` (
`id` int(11)
,`prenom` varchar(255)
,`nom` varchar(255)
,`buts` int(11)
,`image` varchar(150)
,`equipe_id` int(11)
,`equipe_nom` varchar(255)
,`equipe_ville` varchar(255)
,`equipe_image` varchar(150)
);

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

CREATE TABLE `matchs` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `ville` varchar(255) NOT NULL,
  `equipe_id_1` int(11) NOT NULL,
  `equipe_id_2` int(11) NOT NULL,
  `equipe_gagnante_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`id`, `numero`, `date`, `ville`, `equipe_id_1`, `equipe_id_2`, `equipe_gagnante_id`) VALUES
(1, 1, '2018-03-07', 'Tokyo', 1, 2, 1),
(2, 2, '2019-02-07', 'New-York', 1, 2, 1),
(3, 3, '2023-08-08', 'Paris', 4, 1, 4),
(4, 4, '2023-04-04', 'Londres', 3, 4, 4),
(5, 5, '2023-07-12', 'Montréal', 2, 4, 4),
(6, 6, '2023-06-07', 'Nantes', 3, 1, 3),
(7, 7, '2022-04-13', 'Québec', 1, 4, 1),
(8, 8, '2017-05-03', 'Liverpool', 4, 3, 4),
(9, 9, '2020-08-05', 'Manchester', 3, 2, 2),
(10, 10, '2021-03-02', 'Bordeaux', 4, 2, 4),
(11, 11, '2023-10-13', 'Paris', 1, 4, NULL),
(12, 12, '2023-11-17', 'Londres', 3, 2, NULL);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `matchs_equipes`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `matchs_equipes` (
`id` int(11)
,`numero` int(11)
,`date` date
,`ville` varchar(255)
,`equipe_id_1` int(11)
,`equipe_id_2` int(11)
,`equipe_gagnante_id` int(11)
,`equipe1_nom` varchar(255)
,`equipe1_ville` varchar(255)
,`equipe2_nom` varchar(255)
,`equipe2_ville` varchar(255)
,`equipe_gagnante_nom` varchar(255)
,`equipe_gagnante_ville` varchar(255)
,`equipe_gagnante_image` varchar(150)
);

-- --------------------------------------------------------

--
-- Structure de la vue `joueurs_equipes`
--
DROP TABLE IF EXISTS `joueurs_equipes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `joueurs_equipes`  AS SELECT `joueurs`.`id` AS `id`, `joueurs`.`prenom` AS `prenom`, `joueurs`.`nom` AS `nom`, `joueurs`.`buts` AS `buts`, `joueurs`.`image` AS `image`, `joueurs`.`equipe_id` AS `equipe_id`, `equipes`.`nom` AS `equipe_nom`, `equipes`.`ville` AS `equipe_ville`, `equipes`.`image` AS `equipe_image` FROM (`joueurs` join `equipes` on(`joueurs`.`equipe_id` = `equipes`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `matchs_equipes`
--
DROP TABLE IF EXISTS `matchs_equipes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `matchs_equipes`  AS SELECT `matchs`.`id` AS `id`, `matchs`.`numero` AS `numero`, `matchs`.`date` AS `date`, `matchs`.`ville` AS `ville`, `matchs`.`equipe_id_1` AS `equipe_id_1`, `matchs`.`equipe_id_2` AS `equipe_id_2`, `matchs`.`equipe_gagnante_id` AS `equipe_gagnante_id`, `equipe1`.`nom` AS `equipe1_nom`, `equipe1`.`ville` AS `equipe1_ville`, `equipe2`.`nom` AS `equipe2_nom`, `equipe2`.`ville` AS `equipe2_ville`, `equipe_gagnante`.`nom` AS `equipe_gagnante_nom`, `equipe_gagnante`.`ville` AS `equipe_gagnante_ville`, `equipe_gagnante`.`image` AS `equipe_gagnante_image` FROM (((`matchs` left join `equipes` `equipe1` on(`matchs`.`equipe_id_1` = `equipe1`.`id`)) left join `equipes` `equipe2` on(`matchs`.`equipe_id_2` = `equipe2`.`id`)) left join `equipes` `equipe_gagnante` on(`matchs`.`equipe_gagnante_id` = `equipe_gagnante`.`id`)) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipe_id` (`equipe_id`);

--
-- Index pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipe_id_1` (`equipe_id_1`),
  ADD KEY `equipe_id_2` (`equipe_id_2`),
  ADD KEY `equipe_gagnante_id` (`equipe_gagnante_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `joueurs_ibfk_1` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`);

--
-- Contraintes pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`equipe_id_1`) REFERENCES `equipes` (`id`),
  ADD CONSTRAINT `matchs_ibfk_2` FOREIGN KEY (`equipe_id_2`) REFERENCES `equipes` (`id`),
  ADD CONSTRAINT `matchs_ibfk_3` FOREIGN KEY (`equipe_gagnante_id`) REFERENCES `equipes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
