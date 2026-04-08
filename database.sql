-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 avr. 2026 à 00:25
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
-- Base de données : `sitenouveau`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service` enum('email','whatsapp','phone') NOT NULL,
  `content` text NOT NULL,
  `status` enum('envoyé','erreur','annulé','supprimé') DEFAULT 'envoyé',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `service`, `content`, `status`, `created_at`) VALUES
(1, 2, 'email', 'bonjour', 'envoyé', '2026-04-03 17:03:01'),
(2, 2, 'email', '', 'supprimé', '2026-04-03 17:03:18'),
(3, 2, 'email', '', 'supprimé', '2026-04-03 17:03:31'),
(4, 2, 'email', '', 'supprimé', '2026-04-03 17:03:33'),
(5, 2, 'email', '', 'supprimé', '2026-04-03 17:06:29'),
(6, 2, 'whatsapp', 'bonjour', 'envoyé', '2026-04-03 22:15:18'),
(7, 2, 'whatsapp', 'bonjour', 'envoyé', '2026-04-03 22:25:16'),
(14, 5, 'whatsapp', 'bonjour', 'envoyé', '2026-04-04 02:41:17'),
(15, 5, 'whatsapp', 'je syuiui gyftdtyug dcuy', 'envoyé', '2026-04-04 02:42:08'),
(16, 5, 'whatsapp', 'je syuiui gyftdtyug dcuy', 'envoyé', '2026-04-04 02:52:20');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'guidaidi', 'yaguiandre@gmail.com', '$2y$10$yHMOHQUvTyCeD7cwLPWYFO7yGU0iKjBc4l/HYmqQnsH.u2.e.yfHC', '2026-04-03 16:11:43', 'user'),
(2, 'dadaga', 'dadaga@gmail.com', '$2y$10$bRB4TDnB7VL7aShdO9q0POof8vfdBDlxAEt2eDIn5tJeQNUGuUehy', '2026-04-03 17:01:23', 'user'),
(5, 'guidaidi', 'guidaidi@gmail.com', '$2y$10$ecD4wAGQs/wyNSp9nLLHo.4oQEJa.W6PiuDCjca8u9RsPoHUnBkm.', '2026-04-03 22:58:08', 'user'),
(8, 'Devadmin', '', '$2y$10$x7cvhlpiVpnaq5YGQrQmqeCC7vLsKKTk9iZs8crtdGcW.MBJbQJmi', '2026-04-04 04:50:42', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
