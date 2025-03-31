-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 19 mars 2025 à 17:08
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `conge-facile`
--

-- --------------------------------------------------------

--
-- Structure de la table `department`
--

CREATE TABLE `department` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'BU Symfony'),
(2, 'BU Wordpress'),
(3, 'BU Applications mobiles'),
(4, 'BU Marketing'),
(5, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE `person` (
  `id` int(8) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `manager_id` int(8) DEFAULT NULL,
  `department_id` int(8) NOT NULL,
  `position_id` int(8) NOT NULL,
  `alert_new_request` tinyint(1) NOT NULL,
  `alert_on_answer` tinyint(1) NOT NULL,
  `alert_before vacation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `person`
--

INSERT INTO `person` (`id`, `last_name`, `first_name`, `manager_id`, `department_id`, `position_id`, `alert_new_request`, `alert_on_answer`, `alert_before vacation`) VALUES
(1, 'Salesse', 'Frederic', NULL, 1, 6, 0, 0, 0),
(2, 'Salesse', 'Olivier', NULL, 4, 6, 0, 0, 0),
(3, 'Martin', 'Jean-Noël', NULL, 3, 6, 0, 0, 0),
(4, 'Martins', 'Jeff', 1, 1, 1, 0, 0, 0),
(5, 'Turcey', 'Adrien', 1, 1, 4, 1, 1, 1),
(6, 'Valenti', 'Nicolas', 2, 2, 2, 1, 1, 0),
(7, 'Dupas', 'Lucas', 3, 5, 5, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `position`
--

CREATE TABLE `position` (
  `id` int(8) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `position`
--

INSERT INTO `position` (`id`, `name`) VALUES
(1, 'Directeur technique'),
(2, 'Développeur Web'),
(3, 'Développeur applications mobiles'),
(4, 'Développeur C#'),
(5, 'Graphiste'),
(6, 'Community Manager');

-- --------------------------------------------------------

--
-- Structure de la table `request`
--

CREATE TABLE `request` (
  `id` int(8) NOT NULL,
  `request_type_id` int(8) NOT NULL,
  `collaborator_id` int(8) NOT NULL,
  `department_id` int(8) DEFAULT NULL,
  `created_at` datetime(6) NOT NULL,
  `start_at` datetime(6) NOT NULL,
  `end_at` datetime(6) NOT NULL,
  `receipt_file` mediumtext NOT NULL,
  `comment` text NOT NULL,
  `answer_comment` text DEFAULT NULL,
  `answer` tinyint(1) DEFAULT NULL,
  `answer_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `request`
--

INSERT INTO `request` (`id`, `request_type_id`, `collaborator_id`, `department_id`, `created_at`, `start_at`, `end_at`, `receipt_file`, `comment`, `answer_comment`, `answer`, `answer_at`) VALUES
(1, 1, 7, NULL, '2025-01-03 13:30:00.000000', '2025-01-08 13:30:00.000000', '2025-01-03 18:00:00.000000', 'dezdsx', 'J\'dois m\'occuper de mon gosse', NULL, NULL, NULL),
(2, 1, 4, NULL, '2024-12-10 08:00:00.000000', '2024-12-19 08:00:00.000000', '2024-12-23 18:00:00.000000', 'ezrfgdfs', 'Je garde mes enfants ce week-end', NULL, NULL, NULL),
(3, 1, 5, NULL, '2024-11-11 08:00:00.000000', '2024-11-29 08:00:00.000000', '2024-11-30 08:00:00.000000', 'sdvfsgbfxc', 'Je prends une petite pause à la montagne', NULL, NULL, NULL),
(4, 3, 6, NULL, '2024-09-08 08:00:00.000000', '2024-09-02 08:00:00.000000', '2024-09-06 18:00:00.000000', 'ssdfgrthyju', 'Grosse Gastro', 'Tkt frère pas de problème', 1, '2024-09-09 15:00:00.000000'),
(5, 1, 4, NULL, '2024-08-05 13:30:00.000000', '2024-08-08 13:30:00.000000', '2024-08-09 18:00:00.000000', 'efsrdvcsxw', 'J\'ai fini mon taf j\'veux quitter plus tôt', 'Non.', 0, '2024-08-07 10:00:00.000000');

-- --------------------------------------------------------

--
-- Structure de la table `request_type`
--

CREATE TABLE `request_type` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `request_type`
--

INSERT INTO `request_type` (`id`, `name`) VALUES
(1, 'Congé sans solde'),
(2, 'Congé payé'),
(3, 'Congé maladie'),
(4, 'Congé maternité/paternité'),
(5, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(2500) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `role` varchar(20) NOT NULL,
  `person_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `enabled`, `created_at`, `role`, `person_id`) VALUES
(1, 'j.martins@mentalworks.fr', 'cdsqdefrgt', 1, '2015-03-17 16:12:19.000000', 'Collaborateur', 4),
(2, 'a.turcey@mentalworks.fr', 'azsdefr', 1, '2023-03-17 16:17:20.000000', 'Collaborateur', 5),
(3, 'n.valenti@mentalworks.fr', 'szdefrgde', 1, '2020-03-17 16:18:56.000000', 'Collaborateur', 6),
(4, 'l.dupas@mentalworks.fr', 'scdvfgb', 0, '2025-03-05 16:20:07.000000', 'Collaborateur', 7),
(5, 'f.salesse@mentalworks.fr', 'sqzdefr', 1, '2020-03-01 16:20:49.000000', 'Manager', 1),
(6, 'ol.salesse@mentalworks.fr', 'kouijghgf', 1, '2019-03-05 16:20:49.000000', 'Manager', 2),
(7, 'jn.martin@mentalworks.fr', 'rgthhbcd', 0, '2016-01-16 16:23:23.000000', 'Manager', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_department_id` (`department_id`),
  ADD KEY `fk_position_id` (`position_id`),
  ADD KEY `fk_manager_id` (`manager_id`);

--
-- Index pour la table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_request_type` (`request_type_id`),
  ADD KEY `fk_collaborator_id` (`collaborator_id`);

--
-- Index pour la table `request_type`
--
ALTER TABLE `request_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_person_id` (`person_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `request_type`
--
ALTER TABLE `request_type`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `fk_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `fk_manager_id` FOREIGN KEY (`manager_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `fk_position_id` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Contraintes pour la table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `fk_collaborator_id` FOREIGN KEY (`collaborator_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `fk_request_type` FOREIGN KEY (`request_type_id`) REFERENCES `request_type` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_person_id` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
