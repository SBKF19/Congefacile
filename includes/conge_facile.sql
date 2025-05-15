-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 10 mai 2025 à 23:15
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
-- Base de données : `conge_facile`
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
(1, 'Salesse', 'Frederic', NULL, 1, 6, 1, 0, 0),
(2, 'Dunwoody', 'Benson', NULL, 5, 1, 0, 0, 0),
(3, 'Mikaël', 'Idasiak', NULL, 3, 4, 0, 0, 0),
(4, 'Garmadon', 'Wu', NULL, 4, 2, 0, 0, 0),
(5, 'Stedman', 'Cecil', NULL, 2, 5, 0, 0, 0),
(6, 'Martins', 'Jeff', 1, 1, 1, 0, 0, 0),
(7, 'Salesse', 'Olivier', 1, 1, 6, 0, 0, 0),
(8, 'Martin', 'Jean-Noël', 1, 1, 2, 0, 0, 0),
(9, 'Turcey', 'Adrien', 1, 1, 3, 0, 0, 0),
(10, 'Valenti', 'Nicolas', 1, 1, 4, 0, 0, 0),
(11, 'Dupas', 'Lucas', 1, 1, 5, 0, 0, 0),
(12, 'Mordi', 'Mordecai', 2, 5, 2, 0, 0, 0),
(13, 'Trashboat', 'Rigby', 2, 5, 3, 0, 0, 0),
(14, 'Quippenger', 'Skips', 2, 5, 6, 0, 0, 0),
(15, 'Maellard', 'Pops', 2, 5, 1, 0, 0, 0),
(16, 'Sorrenstein', 'Mitch', 2, 5, 5, 0, 0, 0),
(17, 'Ghost', 'Frappeur', 2, 5, 4, 0, 0, 0),
(18, 'Benkherouf', 'Sofiane', 3, 3, 4, 0, 0, 0),
(19, 'Le Goffic', 'Nicolas', 3, 3, 1, 0, 0, 0),
(20, 'Valenti', 'Eva', 3, 3, 5, 0, 0, 0),
(21, 'Platel', 'Kecy', 3, 3, 6, 0, 0, 0),
(22, 'Bibi', 'Abida', 3, 3, 2, 0, 0, 0),
(23, 'Leclerc', 'Elise', 3, 3, 3, 0, 0, 0),
(24, 'Smith', 'Kai', 4, 4, 3, 0, 0, 0),
(25, 'Walker', 'Jay', 4, 4, 6, 0, 0, 0),
(26, 'Julien', 'Zane', 4, 4, 4, 0, 0, 0),
(27, 'Bucket', 'Cole', 4, 4, 5, 0, 0, 0),
(28, 'Smith', 'Nya', 4, 4, 2, 0, 0, 0),
(29, 'Garmadon', 'Lloyd', 4, 4, 1, 0, 0, 0),
(30, 'Grayson', 'Mark', 5, 2, 1, 0, 0, 0),
(31, 'Connors', 'Rudy', 5, 2, 4, 0, 0, 0),
(32, 'Sloan', 'Rex', 5, 2, 6, 0, 0, 0),
(33, 'Cha', 'Kate', 5, 2, 2, 0, 0, 0),
(34, 'Rae', 'Shrinking', 5, 2, 3, 0, 0, 0),
(35, 'Wilkins', 'Samantha', 5, 2, 5, 0, 0, 0);

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
  `receipt_file` varchar(500) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `answer_comment` text DEFAULT NULL,
  `answer` tinyint(1) DEFAULT NULL,
  `answer_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'f.salesse@mentalworks.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2020-01-01 00:00:00.000000', 'Manager', 1),
(2, 'b.dunwoody@thepark.com', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2010-09-06 00:00:00.000000', 'Manager', 2),
(3, 'i.mikaël@stvincent.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2023-09-01 00:00:00.000000', 'Manager', 3),
(4, 'w.garmadon@ninja.go', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2011-01-14 00:00:00.000000', 'Manager', 4),
(5, 'c.stedman@invincib.le', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2021-03-26 00:00:00.000000', 'Manager', 5),
(6, 'j.martins@mentalworks.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2020-01-02 00:00:00.000000', 'Collaborateur', 6),
(7, 'o.salesse@mentalworks.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2020-01-03 00:00:00.000000', 'Collaborateur', 7),
(8, 'j.martin@mentalworks.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2020-01-04 00:00:00.000000', 'Collaborateur', 8),
(9, 'a.turcey@mentalworks.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2020-01-05 00:00:00.000000', 'Collaborateur', 9),
(10, 'n.valenti@mentalworks.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2020-01-06 00:00:00.000000', 'Collaborateur', 10),
(11, 'l.dupas@mentalworks.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2020-01-07 00:00:00.000000', 'Collaborateur', 11),
(12, 'm.mordi@thepark.com', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 0, '2010-09-06 00:00:00.000000', 'Collaborateur', 12),
(13, 'r.trashboat@thepark.com', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 0, '2010-09-06 00:00:00.000000', 'Collaborateur', 13),
(14, 's.quippenger@thepark.com', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2010-09-06 00:00:00.000000', 'Collaborateur', 14),
(15, 'p.maellard@thepark.com', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2010-09-06 00:00:00.000000', 'Collaborateur', 15),
(16, 'm.sorrenstein@thepark.com', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2010-09-06 00:00:00.000000', 'Collaborateur', 16),
(17, 'f.ghost@thepark.com', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2010-09-06 00:00:00.000000', 'Collaborateur', 17),
(18, 's.benkherouf@stvincent.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2024-01-01 00:00:00.000000', 'Collaborateur', 18),
(19, 'n.le goffic@stvincent.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2024-01-02 00:00:00.000000', 'Collaborateur', 19),
(20, 'e.valenti@stvincent.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2024-01-03 00:00:00.000000', 'Collaborateur', 20),
(21, 'k.platel@stvincent.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2024-01-04 00:00:00.000000', 'Collaborateur', 21),
(22, 'a.bibi@stvincent.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 0, '2024-01-05 00:00:00.000000', 'Collaborateur', 22),
(23, 'e.leclerc@stvincent.fr', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 0, '2024-01-06 00:00:00.000000', 'Collaborateur', 23),
(24, 'k.smith@ninja.go', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2011-01-14 00:00:00.000000', 'Collaborateur', 24),
(25, 'j.walker@ninja.go', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 0, '2011-01-14 00:00:00.000000', 'Collaborateur', 25),
(26, 'z.julien@ninja.go', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2011-01-14 00:00:00.000000', 'Collaborateur', 26),
(27, 'c.bucket@ninja.go', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2011-01-14 00:00:00.000000', 'Collaborateur', 27),
(28, 'n.smith@ninja.go', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2011-01-14 00:00:00.000000', 'Collaborateur', 28),
(29, 'l.garmadon@ninja.go', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2011-01-14 00:00:00.000000', 'Collaborateur', 29),
(30, 'm.grayson@invincib.le', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2021-03-26 00:00:00.000000', 'Collaborateur', 30),
(31, 'r.connors@invincib.le', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2021-03-26 00:00:00.000000', 'Collaborateur', 31),
(32, 'r.sloan@invincib.le', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 0, '2021-03-26 00:00:00.000000', 'Collaborateur', 32),
(33, 'k.cha@invincib.le', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 0, '2021-03-26 00:00:00.000000', 'Collaborateur', 33),
(34, 's.rae@invincib.le', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2021-03-26 00:00:00.000000', 'Collaborateur', 34),
(35, 's.wilkins@invincib.le', '$2y$10$/01Z30mkd3ZkTil3pBOkUenRXA8HJhk..yH96XDU8YNL/4VN8lLqK', 1, '2021-03-26 00:00:00.000000', 'Collaborateur', 35);

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
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `request_type`
--
ALTER TABLE `request_type`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
