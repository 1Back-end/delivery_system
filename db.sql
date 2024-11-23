-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 23 nov. 2024 à 17:50
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
-- Base de données : `delivery_system`
--

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE `cities` (
  `uuid` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `region_uuid` varchar(36) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `cities`
--

INSERT INTO `cities` (`uuid`, `name`, `region_uuid`, `created_at`, `updated_at`) VALUES
('fdbdef5e-a9bb-11ef-8ebb-24418c1325d5', 'Bertoua', '0adec0c7-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbdf25a-a9bb-11ef-8ebb-24418c1325d5', 'Yaoundé', '0adec051-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbdf51e-a9bb-11ef-8ebb-24418c1325d5', 'Douala', '0adec0ec-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbdf772-a9bb-11ef-8ebb-24418c1325d5', 'Garoua', '0adec10d-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbdf9a4-a9bb-11ef-8ebb-24418c1325d5', 'Maroua', '0adec19c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbdfbc6-a9bb-11ef-8ebb-24418c1325d5', 'Bamenda', '0adec12c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbdfd88-a9bb-11ef-8ebb-24418c1325d5', 'Dschang', '0adec14b-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbdffe2-a9bb-11ef-8ebb-24418c1325d5', 'Ebolowa', '0adec165-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe0084-a9bb-11ef-8ebb-24418c1325d5', 'Kumba', '0adec183-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe01b8-a9bb-11ef-8ebb-24418c1325d5', 'Kribi', '0adeb4e8-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe031c-a9bb-11ef-8ebb-24418c1325d5', 'Ngaoundéré', '0adec0c7-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe04c0-a9bb-11ef-8ebb-24418c1325d5', 'Buea', '0adec183-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe0664-a9bb-11ef-8ebb-24418c1325d5', 'Limbe', '0adec183-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe07a8-a9bb-11ef-8ebb-24418c1325d5', 'Buea', '0adec183-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe08ec-a9bb-11ef-8ebb-24418c1325d5', 'Maroua', '0adec19c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe0a30-a9bb-11ef-8ebb-24418c1325d5', 'Bafoussam', '0adec14b-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe0b74-a9bb-11ef-8ebb-24418c1325d5', 'Bertoua', '0adec0c7-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe0c88-a9bb-11ef-8ebb-24418c1325d5', 'Tiko', '0adec183-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe0da2-a9bb-11ef-8ebb-24418c1325d5', 'Mbalmayo', '0adec051-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe0e42-a9bb-11ef-8ebb-24418c1325d5', 'Kousséri', '0adec19c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe0f64-a9bb-11ef-8ebb-24418c1325d5', 'Mbouda', '0adec14b-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe1066-a9bb-11ef-8ebb-24418c1325d5', 'Banyo', '0adec0c7-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe118a-a9bb-11ef-8ebb-24418c1325d5', 'Mokolo', '0adec19c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe12bc-a9bb-11ef-8ebb-24418c1325d5', 'Bafang', '0adec14b-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe13fe-a9bb-11ef-8ebb-24418c1325d5', 'Tonga', '0adec12c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe1512-a9bb-11ef-8ebb-24418c1325d5', 'Kousséri', '0adec19c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe1634-a9bb-11ef-8ebb-24418c1325d5', 'Sangmélima', '0adec165-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe1756-a9bb-11ef-8ebb-24418c1325d5', 'Foumban', '0adec14b-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe188a-a9bb-11ef-8ebb-24418c1325d5', 'Bertoua', '0adec0c7-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe19ac-a9bb-11ef-8ebb-24418c1325d5', 'Mbanga', '0adec0ec-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe1ad6-a9bb-11ef-8ebb-24418c1325d5', 'Kumba', '0adec183-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe1bf0-a9bb-11ef-8ebb-24418c1325d5', 'Nkambe', '0adec12c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe1d12-a9bb-11ef-8ebb-24418c1325d5', 'Edea', '0adec0ec-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe1e34-a9bb-11ef-8ebb-24418c1325d5', 'Bamenda', '0adec12c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe1f56-a9bb-11ef-8ebb-24418c1325d5', 'Mbandjock', '0adec051-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe2080-a9bb-11ef-8ebb-24418c1325d5', 'Bafia', '0adec051-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe21a2-a9bb-11ef-8ebb-24418c1325d5', 'Kribi', '0adec183-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe22c4-a9bb-11ef-8ebb-24418c1325d5', 'Bali', '0adec12c-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13'),
('fdbe23e6-a9bb-11ef-8ebb-24418c1325d5', 'Loum', '0adec0ec-a9ba-11ef-8ebb-24418c1325d5', '2024-11-23 15:43:13', '2024-11-23 15:43:13');

-- --------------------------------------------------------

--
-- Structure de la table `deliveries`
--

CREATE TABLE `deliveries` (
  `uuid` varchar(36) NOT NULL,
  `package_uuid` varchar(36) NOT NULL,
  `delivery_vehicle_uuid` varchar(36) NOT NULL,
  `departure_city_uuid` varchar(36) NOT NULL,
  `destination_city_uuid` varchar(36) NOT NULL,
  `departure_date` date DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `status` enum('en cours','livré','annulé') DEFAULT 'en cours',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `neighborhoods`
--

CREATE TABLE `neighborhoods` (
  `uuid` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_uuid` varchar(36) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `packages`
--

CREATE TABLE `packages` (
  `uuid` varchar(36) NOT NULL,
  `sender_uuid` varchar(36) NOT NULL,
  `receiver_uuid` varchar(36) NOT NULL,
  `sender_address` text NOT NULL,
  `receiver_address` text NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `dimensions` varchar(255) DEFAULT NULL,
  `status` enum('en attente','en transit','livré','perdu','annulé') DEFAULT 'en attente',
  `tracking_number` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 1500.00,
  `scheduled_delivery_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `uuid` varchar(36) NOT NULL,
  `package_uuid` varchar(36) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('carte','espèces','virement') NOT NULL,
  `payment_status` enum('en attente','réussi','échoué') DEFAULT 'en attente',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `uuid` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`uuid`, `name`, `created_at`, `updated_at`, `is_deleted`) VALUES
('0adeb4e8-a9ba-11ef-8ebb-24418c1325d5', 'Adamaoua', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0),
('0adec051-a9ba-11ef-8ebb-24418c1325d5', 'Centre', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0),
('0adec0c7-a9ba-11ef-8ebb-24418c1325d5', 'Est', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0),
('0adec0ec-a9ba-11ef-8ebb-24418c1325d5', 'Littoral', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0),
('0adec10d-a9ba-11ef-8ebb-24418c1325d5', 'Nord', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0),
('0adec12c-a9ba-11ef-8ebb-24418c1325d5', 'Nord-Ouest', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0),
('0adec14b-a9ba-11ef-8ebb-24418c1325d5', 'Ouest', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0),
('0adec165-a9ba-11ef-8ebb-24418c1325d5', 'Sud', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0),
('0adec183-a9ba-11ef-8ebb-24418c1325d5', 'Sud-Ouest', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0),
('0adec19c-a9ba-11ef-8ebb-24418c1325d5', 'Extrême-Nord', '2024-11-23 16:43:13', '2024-11-23 16:43:13', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reports`
--

CREATE TABLE `reports` (
  `uuid` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `report_date` date NOT NULL,
  `generated_by` varchar(36) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `uuid` varchar(36) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `role` enum('admin','utilisateur','gestionnaire') DEFAULT 'utilisateur',
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vehicles`
--

CREATE TABLE `vehicles` (
  `uuid` varchar(36) NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `vehicle_type` enum('camion','minibus','voiture') NOT NULL,
  `capacity` decimal(10,2) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `driver_phone_number` varchar(15) DEFAULT NULL,
  `current_location` varchar(255) DEFAULT NULL,
  `status` enum('en cours','disponible','en panne','en réparation') DEFAULT 'disponible',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `region_uuid` (`region_uuid`);

--
-- Index pour la table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `package_uuid` (`package_uuid`),
  ADD KEY `departure_city_uuid` (`departure_city_uuid`),
  ADD KEY `destination_city_uuid` (`destination_city_uuid`);

--
-- Index pour la table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `city_uuid` (`city_uuid`);

--
-- Index pour la table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `tracking_number` (`tracking_number`),
  ADD KEY `sender_uuid` (`sender_uuid`),
  ADD KEY `receiver_uuid` (`receiver_uuid`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `package_uuid` (`package_uuid`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`uuid`);

--
-- Index pour la table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `generated_by` (`generated_by`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Index pour la table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`uuid`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`region_uuid`) REFERENCES `regions` (`uuid`);

--
-- Contraintes pour la table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`package_uuid`) REFERENCES `packages` (`uuid`),
  ADD CONSTRAINT `deliveries_ibfk_2` FOREIGN KEY (`departure_city_uuid`) REFERENCES `cities` (`uuid`),
  ADD CONSTRAINT `deliveries_ibfk_3` FOREIGN KEY (`destination_city_uuid`) REFERENCES `cities` (`uuid`);

--
-- Contraintes pour la table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  ADD CONSTRAINT `neighborhoods_ibfk_1` FOREIGN KEY (`city_uuid`) REFERENCES `cities` (`uuid`);

--
-- Contraintes pour la table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`sender_uuid`) REFERENCES `users` (`uuid`),
  ADD CONSTRAINT `packages_ibfk_2` FOREIGN KEY (`receiver_uuid`) REFERENCES `users` (`uuid`);

--
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`package_uuid`) REFERENCES `packages` (`uuid`);

--
-- Contraintes pour la table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`generated_by`) REFERENCES `users` (`uuid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
