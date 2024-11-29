-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 nov. 2024 à 16:45
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
-- Structure de la table `app`
--

CREATE TABLE `app` (
  `ad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE `cities` (
  `uuid` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `region_uuid` varchar(36) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `cities`
--

INSERT INTO `cities` (`uuid`, `name`, `region_uuid`, `created_at`, `updated_at`, `is_deleted`) VALUES
('0e154262-ae6a-4991-a897-a0788a37bf22', 'Nsimalen', '0d136871-b8f5-42ec-98fa-cc0975a0e55a', '2024-11-26 10:49:48', '2024-11-26 10:49:48', 0),
('1d5ba262-42d7-49e6-8c04-d35c21d0c5c9', 'Banganté ', '158b80f3-d5f9-43ca-963d-66badfa20d8b', '2024-11-26 10:45:49', '2024-11-26 10:45:49', 0),
('1db483b7-0761-4faa-bcb0-aa47bfa30dd8', 'Bastos', '0d136871-b8f5-42ec-98fa-cc0975a0e55a', '2024-11-26 10:20:51', '2024-11-26 10:20:51', 0),
('217f6b3f-0099-4acd-9b4a-3007e814b6fa', 'Dibombari', '53956824-9f83-4a1a-aadc-67ee4eedd53f', '2024-11-29 13:13:05', '2024-11-29 13:13:05', 0),
('268901f9-9ab3-44dd-8fab-d0321be0a5be', 'Loum', '53956824-9f83-4a1a-aadc-67ee4eedd53f', '2024-11-29 13:12:47', '2024-11-29 13:12:47', 0),
('2d8e6980-2275-4347-a5d2-6731b47eea56', 'Djoum', '0d136871-b8f5-42ec-98fa-cc0975a0e55a', '2024-11-26 10:49:01', '2024-11-26 10:49:01', 0),
('42c713a6-bdb4-47d4-8168-32f15f22613f', 'Obala', '0d136871-b8f5-42ec-98fa-cc0975a0e55a', '2024-11-26 10:49:37', '2024-11-26 10:49:37', 0),
('595e80ef-2cc4-408d-b885-da3639a51c2f', 'Yaoundé', '0d136871-b8f5-42ec-98fa-cc0975a0e55a', '2024-11-26 10:22:30', '2024-11-26 10:22:30', 0),
('663ca5c7-07f8-4fae-96a8-b78bd0d7eee1', 'Lomé', '0d136871-b8f5-42ec-98fa-cc0975a0e55a', '2024-11-26 10:48:50', '2024-11-26 10:48:50', 0),
('8bea0421-5f04-468d-bf8c-57e13f7b62a8', 'Douala', '53956824-9f83-4a1a-aadc-67ee4eedd53f', '2024-11-26 10:22:45', '2024-11-26 10:22:45', 0),
('dd6c8f89-abfd-49ca-8130-56e7ace67d58', 'Ebolowa', '0d136871-b8f5-42ec-98fa-cc0975a0e55a', '2024-11-26 10:48:28', '2024-11-26 10:48:28', 0),
('e44809aa-749b-4f0c-8cf5-8f5e3e75086c', 'Nkongsamba', '53956824-9f83-4a1a-aadc-67ee4eedd53f', '2024-11-29 13:12:37', '2024-11-29 13:12:37', 0),
('e556ad99-f420-401c-a190-4ec87b7502cd', 'Mbalmayo', '0d136871-b8f5-42ec-98fa-cc0975a0e55a', '2024-11-26 10:48:40', '2024-11-26 10:48:40', 0),
('fa29c7a9-890a-4065-9a0e-4c9d74802f6a', 'Bafia', '0d136871-b8f5-42ec-98fa-cc0975a0e55a', '2024-11-26 10:49:28', '2024-11-26 10:49:28', 0),
('fb0cb9d0-df53-4f51-8ee5-b7aa38c3c8b2', 'Edéa', '53956824-9f83-4a1a-aadc-67ee4eedd53f', '2024-11-29 13:12:56', '2024-11-29 13:12:56', 0);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
-- Structure de la table `delivery_agents`
--

CREATE TABLE `delivery_agents` (
  `uuid` varchar(36) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `status` enum('Available','Busy') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `drivers`
--

CREATE TABLE `drivers` (
  `uuid` char(36) NOT NULL,
  `warehouse_uuid` char(36) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` char(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `num_drivers` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `drivers`
--

INSERT INTO `drivers` (`uuid`, `warehouse_uuid`, `firstname`, `lastname`, `phone`, `email`, `created_at`, `added_by`, `is_deleted`, `num_drivers`, `photo`) VALUES
('2b84acc2-3007-4d42-a903-fa9b91ba8ec1', '560efa1f-e0c7-44cd-b82f-ee441771285c', 'Ebony', 'Terrell', '+237690127890', 'julopycat@mailinator.com', '2024-11-26 08:00:53', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 1, 'DRV202437089', '../uploads/drivers/2b84acc2-3007-4d42-a903-fa9b91ba8ec1_fde49370ef426c11e9f4d5e442f43986.jpg'),
('4b588954-0db1-4c66-b698-8e8bc52f849c', 'df5cc3b6-3b7e-4059-ad5e-7ffa7549a8e5', 'Zacharie', 'Dogo', '+237698743576', '', '2024-11-26 07:55:14', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 0, 'DRV2024A493B', NULL),
('945229c4-3ccd-4251-b18f-b7017fcb7ef8', 'c5924af0-a819-4f7e-97ab-ba301ab4e359', 'Allistair', 'Melton', '+2376341277890', 'dygoboxe@mailinator.com', '2024-11-26 09:20:14', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 0, 'DRV202468D82', NULL),
('eb61d0a0-e1d1-4ff4-8e41-a6e55d0d05c1', 'df5cc3b6-3b7e-4059-ad5e-7ffa7549a8e5', 'Farrah', 'Carney', '+237654123498', 'poter@mailinator.com', '2024-11-26 09:20:01', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 0, 'DRV2024C65FA', NULL),
('fc1809d3-f79a-40cd-8312-ded17bce2e14', 'df5cc3b6-3b7e-4059-ad5e-7ffa7549a8e5', 'Reuben', 'Sandoval', '+237678537901', 'gediwes@mailinator.com', '2024-11-26 07:51:16', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 0, 'DRV2024118F8', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `languages`
--

CREATE TABLE `languages` (
  `uuid` varchar(36) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `flag_image` varchar(255) NOT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `languages`
--

INSERT INTO `languages` (`uuid`, `code`, `name`, `flag_image`, `added_by`, `is_deleted`, `is_active`) VALUES
('1635acef-99e6-4c0a-a28f-28beaec374ec', 'de', 'Allemand', 'https://upload.wikimedia.org/wikipedia/commons/b/ba/Flag_of_Germany.svg', NULL, 0, 1),
('7b9cfbdd-dc59-4d74-bc11-f8e4d8099771', 'es', 'Espagnol', 'https://upload.wikimedia.org/wikipedia/commons/9/9a/Flag_of_Spain.svg', NULL, 0, 1),
('97bddd89-e16f-4244-b008-c00d9ec87fb6', 'fr', 'Français', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Flag_of_France.svg/2560px-Flag_of_France.svg.png', NULL, 0, 1),
('fdf4d846-2c9a-4077-9aa0-fa1ab58be807', 'en', 'English', 'https://upload.wikimedia.org/wikipedia/commons/a/a4/Flag_of_the_United_States.svg', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `neighborhoods`
--

CREATE TABLE `neighborhoods` (
  `uuid` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_uuid` varchar(36) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `neighborhoods`
--

INSERT INTO `neighborhoods` (`uuid`, `name`, `city_uuid`, `created_at`, `updated_at`, `is_deleted`) VALUES
('06c460c9-486a-4a8b-be0f-b2e5bc263adc', 'Bilongué', 'fb0cb9d0-df53-4f51-8ee5-b7aa38c3c8b2', '2024-11-29 13:17:19', '2024-11-29 13:17:19', 0),
('12b8d4ce-4ec9-479d-998c-e56391c649f6', 'Nkongsamba 2e', 'e44809aa-749b-4f0c-8cf5-8f5e3e75086c', '2024-11-29 13:15:42', '2024-11-29 13:15:42', 0),
('17a177f9-957f-4d1c-aee3-c6eb97cedfb8', 'Akwa', '8bea0421-5f04-468d-bf8c-57e13f7b62a8', '2024-11-29 13:14:04', '2024-11-29 13:14:04', 0),
('1d07d557-eeb7-41cc-af3c-40a4e808a32d', 'Bonabéri', '8bea0421-5f04-468d-bf8c-57e13f7b62a8', '2024-11-29 13:14:14', '2024-11-29 13:14:14', 0),
('2651dae9-dd49-4553-b3e1-0671d4541c19', 'Quartier Général (QG)', 'fb0cb9d0-df53-4f51-8ee5-b7aa38c3c8b2', '2024-11-29 13:16:37', '2024-11-29 13:16:37', 0),
('2a8ffe9f-23da-44b7-a9f3-ce6f8d2a89cd', 'Ngousso', '595e80ef-2cc4-408d-b885-da3639a51c2f', '2024-11-26 11:25:58', '2024-11-26 11:25:58', 0),
('2f3870b9-cf78-4610-bd6b-ded67fd1b536', 'Deido', '8bea0421-5f04-468d-bf8c-57e13f7b62a8', '2024-11-29 13:15:17', '2024-11-29 13:15:17', 0),
('30f505f4-fa79-4e1a-9c48-9a9d748f3ca7', 'Akok-Bekoe', 'e556ad99-f420-401c-a190-4ec87b7502cd', '2024-11-29 13:20:28', '2024-11-29 13:20:28', 0),
('3e57b805-3040-4fad-8f97-35096ee0dff7', 'Oyom-Abang', 'e556ad99-f420-401c-a190-4ec87b7502cd', '2024-11-29 13:21:23', '2024-11-29 13:21:23', 0),
('42a1832c-5bf1-44f3-8873-44a94fe4c747', 'Nkongmondo', 'fb0cb9d0-df53-4f51-8ee5-b7aa38c3c8b2', '2024-11-29 13:16:51', '2024-11-29 13:16:51', 0),
('4983911d-7292-41f5-8ff8-89b4d2990cd6', 'Bafia Sud', 'fa29c7a9-890a-4065-9a0e-4c9d74802f6a', '2024-11-26 11:27:02', '2024-11-26 11:27:02', 0),
('536dc30a-6e20-46c2-9a9e-ec7b872bb177', 'Centre Urbain', 'e44809aa-749b-4f0c-8cf5-8f5e3e75086c', '2024-11-29 13:16:02', '2024-11-29 13:16:02', 0),
('5a4ba08c-5ab8-4a5a-99ac-182274234fbe', 'Etoudi', '595e80ef-2cc4-408d-b885-da3639a51c2f', '2024-11-26 11:26:11', '2024-11-26 11:26:11', 0),
('5c8bf0bc-996f-47e4-ab5c-523de1a5d1bd', 'Baré-Bakem', 'e44809aa-749b-4f0c-8cf5-8f5e3e75086c', '2024-11-29 13:16:12', '2024-11-29 13:16:12', 0),
('633ee067-b7a0-4b81-863a-b99de2b57a19', 'Nkolndongo', 'e556ad99-f420-401c-a190-4ec87b7502cd', '2024-11-29 13:20:16', '2024-11-29 13:20:16', 0),
('88d39b56-ac04-40fe-8d84-c7fd602bfddb', 'Nkolbisson', '0e154262-ae6a-4991-a897-a0788a37bf22', '2024-11-29 13:20:59', '2024-11-29 13:20:59', 0),
('8d2adaeb-2477-4b80-82a5-def37c93d6de', 'Bafia Nord', 'fa29c7a9-890a-4065-9a0e-4c9d74802f6a', '2024-11-26 11:27:13', '2024-11-26 11:27:13', 0),
('8e10849c-5fdd-4bb0-a46d-4aa0752c23cb', 'Nkongsamba 3e', 'e44809aa-749b-4f0c-8cf5-8f5e3e75086c', '2024-11-29 13:15:53', '2024-11-29 13:15:53', 0),
('92342716-e4e9-4947-88b8-2eb486681e4f', 'Makepe', '8bea0421-5f04-468d-bf8c-57e13f7b62a8', '2024-11-29 13:15:04', '2024-11-29 13:15:04', 0),
('a3b101e1-c5fc-4503-943e-47ba2675ecee', 'Centre Ville', 'fb0cb9d0-df53-4f51-8ee5-b7aa38c3c8b2', '2024-11-29 13:17:33', '2024-11-29 13:17:33', 0),
('b2698907-049b-4074-bc22-f846ff6d1d8b', 'Ahala', 'e556ad99-f420-401c-a190-4ec87b7502cd', '2024-11-29 13:20:38', '2024-11-29 13:20:38', 0),
('be86d0a1-a409-4777-82e3-a11ad747b9c2', 'Nkongsamba 1er', 'e44809aa-749b-4f0c-8cf5-8f5e3e75086c', '2024-11-29 13:15:30', '2024-11-29 13:15:30', 0),
('c08420b0-1203-439a-bd4e-2a85d78ff07a', 'Mvog-Ada', '595e80ef-2cc4-408d-b885-da3639a51c2f', '2024-11-29 13:19:18', '2024-11-29 13:19:18', 0),
('c277e386-f52a-48a2-aeb3-0d62e50e625a', 'Nkolfoulou', 'e556ad99-f420-401c-a190-4ec87b7502cd', '2024-11-29 13:21:12', '2024-11-29 13:21:12', 0),
('c72d10b1-6f6c-4f05-b752-387c98b30e68', 'Essos', 'fb0cb9d0-df53-4f51-8ee5-b7aa38c3c8b2', '2024-11-29 13:17:03', '2024-11-29 13:17:03', 0),
('cc23ce43-ff16-45b1-b043-eaef82deebd9', 'Bonamoussadi', '8bea0421-5f04-468d-bf8c-57e13f7b62a8', '2024-11-29 13:13:55', '2024-11-29 13:13:55', 0),
('e098eb3b-752b-424b-9b50-f6c24ee97147', 'Nkoldongo', '595e80ef-2cc4-408d-b885-da3639a51c2f', '2024-11-26 11:25:36', '2024-11-26 11:25:36', 0),
('e4fe9602-2044-432d-b741-86db67e74a8c', 'Nkometou', 'fa29c7a9-890a-4065-9a0e-4c9d74802f6a', '2024-11-26 11:26:46', '2024-11-26 11:26:46', 0);

-- --------------------------------------------------------

--
-- Structure de la table `packages`
--

CREATE TABLE `packages` (
  `uuid` varchar(36) NOT NULL,
  `sender_uuid` varchar(36) NOT NULL,
  `receiver_uuid` varchar(36) NOT NULL,
  `weight` int(100) NOT NULL,
  `dimensions` varchar(255) DEFAULT NULL,
  `status` enum('en attente','en cours','livré','perdu','annulé') DEFAULT 'en attente',
  `tracking_number` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 1500.00,
  `scheduled_delivery_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(36) DEFAULT NULL,
  `region_uuid` varchar(36) NOT NULL,
  `city_uuid` varchar(36) NOT NULL,
  `neighborhoods_uuid` varchar(36) NOT NULL,
  `package_image` varchar(255) DEFAULT NULL,
  `package_type` varchar(255) DEFAULT NULL,
  `declared_value` varchar(255) DEFAULT NULL,
  `content_description` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `package_code` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `packages`
--

INSERT INTO `packages` (`uuid`, `sender_uuid`, `receiver_uuid`, `weight`, `dimensions`, `status`, `tracking_number`, `price`, `scheduled_delivery_date`, `delivery_date`, `created_at`, `updated_at`, `created_by`, `region_uuid`, `city_uuid`, `neighborhoods_uuid`, `package_image`, `package_type`, `declared_value`, `content_description`, `is_deleted`, `package_code`, `qr_code`) VALUES
('15a78d8c-9ba1-41c4-b150-504258048bb0', '811cdab2-c1d6-475b-9443-5d20bbeb0e97', '4b7fd519-d3b5-4e27-8985-e65b33b5353e', 57, '25x15x8', 'en attente', '20247807365725', 1500.00, NULL, NULL, '2024-11-28 11:27:04', '2024-11-28 11:27:04', NULL, '0d136871-b8f5-42ec-98fa-cc0975a0e55a', 'fa29c7a9-890a-4065-9a0e-4c9d74802f6a', 'e4fe9602-2044-432d-b741-86db67e74a8c', '1732793224_ColisTrack(2).jpg', 'Colis encombrant', '57', 'Facilis sunt nisi eu', 0, 'COL2024F06AE', '15a78d8c-9ba1-41c4-b150-504258048bb0.png'),
('3a38d815-6dde-49cf-8192-f68b5762d457', '811cdab2-c1d6-475b-9443-5d20bbeb0e97', 'b0a0ab1e-497e-4a67-a2af-e18024329d4a', 25, '20x10x5', 'en cours', '20249669188577', 1500.00, NULL, NULL, '2024-11-28 15:09:48', '2024-11-29 14:37:58', NULL, '0d136871-b8f5-42ec-98fa-cc0975a0e55a', 'fa29c7a9-890a-4065-9a0e-4c9d74802f6a', '4983911d-7292-41f5-8ff8-89b4d2990cd6', '1732806588_1585a3194f4881272fbd6ffb318b163e.jpg', 'Colis fragile', '10000', 'Distinctio Iusto ad', 0, 'COL202410756', '3a38d815-6dde-49cf-8192-f68b5762d457.png'),
('5dfa0e20-1050-4aaf-bf35-7879ae75b734', '73b48e81-352d-4c81-9e6d-f070c4ae4a4b', '975b4ed8-9506-4578-ac80-2e2adad4f96c', 20, '45x35x18', 'en cours', '20242060091217', 1500.00, NULL, NULL, '2024-11-29 13:24:23', '2024-11-29 14:33:41', NULL, '53956824-9f83-4a1a-aadc-67ee4eedd53f', '8bea0421-5f04-468d-bf8c-57e13f7b62a8', 'cc23ce43-ff16-45b1-b043-eaef82deebd9', '1732886663_3260736a48a82948672b87ad4f5ce834.jpg', 'Colis cadeau', '25000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate expedita non inventore neque, corrupti nesciunt aperiam optio fugiat quae, voluptate harum? Minima perspiciatis explicabo neque modi nostrum laborum nisi omnis.', 0, 'COL2024591C1', '5dfa0e20-1050-4aaf-bf35-7879ae75b734.png');

-- --------------------------------------------------------

--
-- Structure de la table `package_warehouse`
--

CREATE TABLE `package_warehouse` (
  `uuid` varchar(255) NOT NULL,
  `package_uuid` varchar(36) NOT NULL,
  `warehouse_uuid` varchar(36) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `package_warehouse`
--

INSERT INTO `package_warehouse` (`uuid`, `package_uuid`, `warehouse_uuid`, `added_by`, `is_deleted`, `created_at`) VALUES
('1e716e4c-7d04-43dd-a17d-600fe16b8168', '3a38d815-6dde-49cf-8192-f68b5762d457', 'c5924af0-a819-4f7e-97ab-ba301ab4e359', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 0, '2024-11-29 14:38:44'),
('8cd9a5bc-40ea-4d79-9e9d-718eac80f452', '3a38d815-6dde-49cf-8192-f68b5762d457', 'c5924af0-a819-4f7e-97ab-ba301ab4e359', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 0, '2024-11-29 14:37:58'),
('bfaf4715-ccfc-429b-a66f-a390607b76b3', '5dfa0e20-1050-4aaf-bf35-7879ae75b734', '560efa1f-e0c7-44cd-b82f-ee441771285c', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 0, '2024-11-29 14:33:19'),
('e6f68a2a-c484-4921-a43f-db35fad64043', '5dfa0e20-1050-4aaf-bf35-7879ae75b734', '560efa1f-e0c7-44cd-b82f-ee441771285c', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 0, '2024-11-29 14:33:41');

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
('0d136871-b8f5-42ec-98fa-cc0975a0e55a', 'Centre', '2024-11-26 09:45:56', '2024-11-26 09:45:56', 0),
('158b80f3-d5f9-43ca-963d-66badfa20d8b', 'Ouest', '2024-11-26 09:56:17', '2024-11-26 09:56:17', 0),
('4b905e31-8002-4105-9e3e-061775ba881b', 'Nord', '2024-11-26 09:56:40', '2024-11-26 09:56:40', 0),
('53956824-9f83-4a1a-aadc-67ee4eedd53f', 'Littoral', '2024-11-26 09:55:10', '2024-11-26 09:55:10', 0),
('9453b580-c233-4ec0-98c1-994a09c9478a', 'Sud', '2024-11-26 09:57:09', '2024-11-26 09:57:09', 0),
('9b5f634d-482b-413e-a440-4bc3cb7da583', 'Nord-Ouest', '2024-11-26 09:56:08', '2024-11-26 09:56:08', 0),
('9e048e4a-4e02-4076-a3ca-ccf2adb796bc', 'Sud-Ouest', '2024-11-26 09:56:28', '2024-11-26 09:56:28', 0),
('c0c8f359-284d-4c59-88d1-9164f40fb1e0', 'Adamaoua', '2024-11-26 09:51:01', '2024-11-26 09:51:01', 0),
('e203b43d-fec5-4ed2-841f-1ba660c67c7b', 'Est', '2024-11-26 09:55:00', '2024-11-26 09:55:00', 0);

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
-- Structure de la table `smtp_settings`
--

CREATE TABLE `smtp_settings` (
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` int(11) NOT NULL,
  `encryption` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `smtp_settings`
--

INSERT INTO `smtp_settings` (`uuid`, `username`, `email`, `name`, `host`, `port`, `encryption`, `created_at`, `updated_at`, `is_deleted`) VALUES
('473906ca-ab16-11ef-a582-8f45aa88a8b2', 'laurentalphonsewilfried@gmail.com', 'laurentalphonsewilfried@gmail.com', 'ColisTrack', 'smtp.gmail.com', 587, 'tls', '2024-11-25 10:16:04', '2024-11-25 10:17:32', 0);

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
  `region` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `quartier` varchar(255) DEFAULT NULL,
  `role` enum('admin','expediteur','gestionnaire','destinataire') DEFAULT 'expediteur',
  `is_deleted` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `num_users` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`uuid`, `firstname`, `lastname`, `email`, `password`, `photo`, `region`, `ville`, `quartier`, `role`, `is_deleted`, `is_active`, `num_users`, `created_at`, `updated_at`, `phone_number`) VALUES
('4b7fd519-d3b5-4e27-8985-e65b33b5353e', 'Cheyenne', 'Parker', 'pabux@mailinator.com', '', NULL, NULL, NULL, NULL, 'destinataire', 0, 0, NULL, '2024-11-28 11:27:04', '2024-11-28 11:27:04', '+237678536884'),
('73b48e81-352d-4c81-9e6d-f070c4ae4a4b', 'Jane', 'Smith', 'jane.smith@example.com', '$2y$10$Wmhm0UBPgPW1cZfO2LYsk.Bvn13TEMfUT5YsavfbGCFx6xpau2kgy', 'WhatsApp Image 2024-10-10 à 14.46.29_43e913f3.jpg', 'Centre', 'Yaoundé', 'Bastos', 'expediteur', 0, 0, '458875526D6169C00EC99B1E3159CE3A', '2024-11-29 13:08:58', '2024-11-29 13:42:02', '+237123456789'),
('811cdab2-c1d6-475b-9443-5d20bbeb0e97', 'Maneuh', 'Fernando', 'maneuh@gmail.com', '$2y$10$38HtELV7oyPUpmbLHbdG.umPQr7VL7pe.DydmTtyQ8grNiZbK4oW2', 'Photolab-376666105.jpeg', 'Centre', 'Yaoundé', 'simbock', 'expediteur', 0, 0, '6EBBB8B1B871EBAA1D450B8245252A53', '2024-11-26 15:18:39', '2024-11-29 10:50:32', '+237654238912'),
('975b4ed8-9506-4578-ac80-2e2adad4f96c', 'Deo', 'John', 'infos@pnvcameroun.cm', '', NULL, NULL, NULL, NULL, 'destinataire', 0, 0, NULL, '2024-11-29 13:24:23', '2024-11-29 13:24:23', '651890912'),
('b0a0ab1e-497e-4a67-a2af-e18024329d4a', 'Elaine', 'Weeks', 'laurentalphonsewilfried@gmail.com', '', NULL, NULL, NULL, NULL, 'destinataire', 0, 0, NULL, '2024-11-28 15:09:48', '2024-11-28 15:09:48', '+1 (915) 287-9869'),
('d5284c86-94bb-49f8-99cf-d5190c95d799', 'Amaya', 'Gray', 'cowimu@mailinator.com', '$2y$10$wKudYi1dTCR2k0jpYQ8JSeuTOLF8JkNRuu4w/vfEPXHoOFjqMA8kK', NULL, NULL, NULL, NULL, 'admin', 0, 0, '8219C1E2A813D223EA9CC98AAA62BAC4', '2024-11-25 08:01:06', '2024-11-29 15:30:13', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vehicles`
--

CREATE TABLE `vehicles` (
  `uuid` varchar(255) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `fuel_type` enum('Essence','Diesel','Electrique','Hybride') NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` enum('Disponible','Occupé') DEFAULT 'Disponible',
  `driver_uuid` varchar(255) DEFAULT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `num_vehicles` varchar(255) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `vehicles`
--

INSERT INTO `vehicles` (`uuid`, `license_plate`, `fuel_type`, `capacity`, `status`, `driver_uuid`, `qr_code_path`, `created_at`, `updated_at`, `is_deleted`, `num_vehicles`, `added_by`, `description`) VALUES
('04be3ec3-bf27-4495-8bb2-3311d9fde46d', 'STU901', 'Essence', 25, 'Disponible', 'fc1809d3-f79a-40cd-8312-ded17bce2e14', '04be3ec3-bf27-4495-8bb2-3311d9fde46d.png', '2024-11-27 15:11:29', '2024-11-27 15:11:29', 0, 'CAR2024B4A3', 'd5284c86-94bb-49f8-99cf-d5190c95d799', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Cum atque delectus iusto itaque adipisci odio, numquam deleniti vero minima, tempora quos veniam quidem sequi reiciendis! Iure maxime corporis sint fugit.'),
('1380ee61-f7c5-4b34-bd06-da5981a19791', 'MNO345', 'Diesel', 65, 'Disponible', 'eb61d0a0-e1d1-4ff4-8e41-a6e55d0d05c1', '1380ee61-f7c5-4b34-bd06-da5981a19791.png', '2024-11-27 15:12:56', '2024-11-27 15:38:40', 0, 'CAR2024BCFB', 'd5284c86-94bb-49f8-99cf-d5190c95d799', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Cum atque delectus iusto itaque adipisci odio, numquam deleniti vero minima, tempora quos veniam quidem sequi reiciendis! Iure maxime corporis sint fugit.'),
('19b4e83d-8e58-4fd4-8898-322b4080b6b0', 'Eius deleniti Nam es', 'Hybride', 25, 'Disponible', 'fc1809d3-f79a-40cd-8312-ded17bce2e14', '19b4e83d-8e58-4fd4-8898-322b4080b6b0.png', '2024-11-27 16:49:55', '2024-11-27 16:49:55', 0, 'CAR20244AD1', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 'Dignissimos repellen'),
('4fb3ee3e-413b-4ada-ba52-7237c4b463c5', 'Voluptatem numquam a', 'Essence', 77, 'Disponible', 'eb61d0a0-e1d1-4ff4-8e41-a6e55d0d05c1', '4fb3ee3e-413b-4ada-ba52-7237c4b463c5.png', '2024-11-27 17:21:52', '2024-11-27 17:21:52', 0, 'CAR20242CF3', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 'Dolorum laborum duci'),
('8ec31b0e-652e-485c-bb13-61631a319fa5', 'Voluptate dolore ass', 'Electrique', 44, 'Disponible', '945229c4-3ccd-4251-b18f-b7017fcb7ef8', '8ec31b0e-652e-485c-bb13-61631a319fa5.png', '2024-11-27 16:50:39', '2024-11-27 16:50:39', 0, 'CAR2024E5C2', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 'Non maxime ea dolore'),
('c533d9ab-3678-4840-a620-1057c28eedbc', 'GHI789', 'Electrique', 100, 'Disponible', '4b588954-0db1-4c66-b698-8e8bc52f849c', 'c533d9ab-3678-4840-a620-1057c28eedbc.png', '2024-11-27 15:38:06', '2024-11-27 16:49:38', 1, 'CAR20240DB4', 'd5284c86-94bb-49f8-99cf-d5190c95d799', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem quo fugit facilis sequi ratione architecto exercitationem quos nesciunt voluptatem modi aspernatur corrupti voluptates molestias laudantium ea ut, consectetur atque est.');

-- --------------------------------------------------------

--
-- Structure de la table `warehouses`
--

CREATE TABLE `warehouses` (
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','inactive') DEFAULT 'active',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `added_by` char(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `num_warehouses` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `warehouses`
--

INSERT INTO `warehouses` (`uuid`, `name`, `address`, `capacity`, `phone`, `email`, `created_at`, `updated_at`, `status`, `is_deleted`, `added_by`, `logo`, `num_warehouses`, `deleted_at`) VALUES
('560efa1f-e0c7-44cd-b82f-ee441771285c', 'Entrepôt Nord', '45 Avenue des Montagnes, Garoua', 40, '+237 699 000 002', 'nord@warehouse.cm', '2024-11-25 14:38:26', '2024-11-25 14:38:26', 'active', 0, 'd5284c86-94bb-49f8-99cf-d5190c95d799', '94fd6934d2d2925da1eab9d17f0aa536.jpg', 'WH20240A5CA', NULL),
('85e85a9b-d9b1-423c-8340-8cf2005c8f71', 'Entrepôt Littoral', '15 Avenue Portuaire, Douala', 25, '+237 699 000 006', 'littoral@warehouse.cm', '2024-11-25 14:42:47', '2024-11-25 14:47:01', 'inactive', 0, 'd5284c86-94bb-49f8-99cf-d5190c95d799', NULL, 'WH2024F13DB', NULL),
('c5924af0-a819-4f7e-97ab-ba301ab4e359', 'Entrepôt Central', '123 Rue Principale, Yaoundé', 41, '+237 699 000 001', 'central@warehouse.cm', '2024-11-25 14:34:45', '2024-11-25 14:34:45', 'active', 0, 'd5284c86-94bb-49f8-99cf-d5190c95d799', '3eaa69a4785c7779cdd20b75899e8179.jpg', 'WH2024C9322', NULL),
('df5cc3b6-3b7e-4059-ad5e-7ffa7549a8e5', 'Entrepôt Centre', '30 Rue de la Paix, Yaoundé', 100, '+237 699 000 007', 'centre@warehouse.cm', '2024-11-25 14:44:38', '2024-11-25 14:44:38', 'active', 0, 'd5284c86-94bb-49f8-99cf-d5190c95d799', NULL, 'WH20249177D', NULL),
('e2632639-a572-441c-949f-d9c0e52c03c4', 'Entrepôt Ouest', '90 Place des Marchés, Bafoussam', 150, '+237 699 000 005', 'ouest@warehouse.cm', '2024-11-25 14:46:38', '2024-11-25 18:03:15', 'active', 0, 'd5284c86-94bb-49f8-99cf-d5190c95d799', NULL, 'WH202424192', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`ad`);

--
-- Index pour la table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `fk_region_uuid` (`region_uuid`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Index pour la table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `package_uuid` (`package_uuid`),
  ADD KEY `departure_city_uuid` (`departure_city_uuid`),
  ADD KEY `destination_city_uuid` (`destination_city_uuid`);

--
-- Index pour la table `delivery_agents`
--
ALTER TABLE `delivery_agents`
  ADD PRIMARY KEY (`uuid`);

--
-- Index pour la table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `warehouse_uuid` (`warehouse_uuid`),
  ADD KEY `added_by` (`added_by`);

--
-- Index pour la table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `added_by` (`added_by`);

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
  ADD KEY `region_uuid` (`region_uuid`),
  ADD KEY `city_uuid` (`city_uuid`),
  ADD KEY `neighborhoods_uuid` (`neighborhoods_uuid`),
  ADD KEY `sender_uuid` (`sender_uuid`),
  ADD KEY `receiver_uuid` (`receiver_uuid`);

--
-- Index pour la table `package_warehouse`
--
ALTER TABLE `package_warehouse`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `package_uuid` (`package_uuid`),
  ADD KEY `warehouse_uuid` (`warehouse_uuid`),
  ADD KEY `added_by` (`added_by`);

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
-- Index pour la table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  ADD PRIMARY KEY (`uuid`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `driver_uuid` (`driver_uuid`),
  ADD KEY `added_by` (`added_by`);

--
-- Index pour la table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `added_by` (`added_by`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `app`
--
ALTER TABLE `app`
  MODIFY `ad` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk_region_uuid` FOREIGN KEY (`region_uuid`) REFERENCES `regions` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`package_uuid`) REFERENCES `packages` (`uuid`),
  ADD CONSTRAINT `deliveries_ibfk_2` FOREIGN KEY (`departure_city_uuid`) REFERENCES `cities` (`uuid`),
  ADD CONSTRAINT `deliveries_ibfk_3` FOREIGN KEY (`destination_city_uuid`) REFERENCES `cities` (`uuid`);

--
-- Contraintes pour la table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`warehouse_uuid`) REFERENCES `warehouses` (`uuid`) ON DELETE CASCADE,
  ADD CONSTRAINT `drivers_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`uuid`);

--
-- Contraintes pour la table `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `languages_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`uuid`);

--
-- Contraintes pour la table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  ADD CONSTRAINT `neighborhoods_ibfk_1` FOREIGN KEY (`city_uuid`) REFERENCES `cities` (`uuid`);

--
-- Contraintes pour la table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`region_uuid`) REFERENCES `regions` (`uuid`),
  ADD CONSTRAINT `packages_ibfk_2` FOREIGN KEY (`city_uuid`) REFERENCES `cities` (`uuid`),
  ADD CONSTRAINT `packages_ibfk_3` FOREIGN KEY (`neighborhoods_uuid`) REFERENCES `neighborhoods` (`uuid`),
  ADD CONSTRAINT `packages_ibfk_4` FOREIGN KEY (`sender_uuid`) REFERENCES `users` (`uuid`),
  ADD CONSTRAINT `packages_ibfk_5` FOREIGN KEY (`receiver_uuid`) REFERENCES `users` (`uuid`);

--
-- Contraintes pour la table `package_warehouse`
--
ALTER TABLE `package_warehouse`
  ADD CONSTRAINT `package_warehouse_ibfk_1` FOREIGN KEY (`package_uuid`) REFERENCES `packages` (`uuid`),
  ADD CONSTRAINT `package_warehouse_ibfk_2` FOREIGN KEY (`warehouse_uuid`) REFERENCES `warehouses` (`uuid`),
  ADD CONSTRAINT `package_warehouse_ibfk_3` FOREIGN KEY (`added_by`) REFERENCES `users` (`uuid`);

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

--
-- Contraintes pour la table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`driver_uuid`) REFERENCES `drivers` (`uuid`),
  ADD CONSTRAINT `vehicles_ibfk_3` FOREIGN KEY (`added_by`) REFERENCES `users` (`uuid`);

--
-- Contraintes pour la table `warehouses`
--
ALTER TABLE `warehouses`
  ADD CONSTRAINT `warehouses_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`uuid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
