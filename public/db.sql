-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for game_store
CREATE DATABASE IF NOT EXISTS `game_store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `game_store`;

-- Dumping structure for table game_store.address
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `province` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.address: ~3 rows (approximately)
INSERT INTO `address` (`id`, `country`, `province`) VALUES
	(1, 'Indonesia', 'Jawa Timur'),
	(3, 'Malaysia', 'Johor'),
	(4, 'Malaysia', 'Penang'),
	(6, 'Indonesia', 'Jawa Barat'),
	(7, 'Indonesia', 'Kalimantan Utara');

-- Dumping structure for table game_store.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `id_address` int DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `address` text,
  PRIMARY KEY (`id`),
  KEY `customers_ibfk_1` (`user_id`),
  KEY `FK_customers_address` (`id_address`),
  CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_customers_address` FOREIGN KEY (`id_address`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.customers: ~8 rows (approximately)
INSERT INTO `customers` (`id`, `user_id`, `id_address`, `full_name`, `address`) VALUES
	(1, 11, 1, 'John Doe', NULL),
	(2, 12, 1, 'Jane Doe', 'Canada'),
	(3, 13, 1, 'Alice Smith', 'UK'),
	(6, 16, 1, 'Dave Wilson', 'France'),
	(7, 17, 1, 'Eve Davis', 'Japan'),
	(8, 18, 3, 'Frank Miller', 'Brazil'),
	(10, 20, 4, 'Heidi Thompson', 'India'),
	(11, 21, 4, 'customer', 'Indonesia');

-- Dumping structure for table game_store.developers
CREATE TABLE IF NOT EXISTS `developers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `company_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `developers_ibfk_1` (`user_id`),
  CONSTRAINT `developers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.developers: ~8 rows (approximately)
INSERT INTO `developers` (`id`, `user_id`, `company_name`) VALUES
	(1, 1, 'Epic Games'),
	(2, 2, 'Valve Corporation'),
	(3, 3, 'Ubisoft'),
	(4, 4, 'Rockstar Games'),
	(5, 5, 'Bethesda Softworks'),
	(6, 6, 'Blizzard Entertainment'),
	(7, 7, 'Electronic Arts'),
	(8, 8, 'CD Projekt Red');

-- Dumping structure for table game_store.downloads
CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `game_id` int NOT NULL,
  `download_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `downloads_ibfk_1` (`customer_id`),
  KEY `downloads_ibfk_2` (`game_id`),
  CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.downloads: ~1 rows (approximately)
INSERT INTO `downloads` (`id`, `customer_id`, `game_id`, `download_date`) VALUES
	(2, 11, 3, '2024-06-10 05:14:06'),
	(49, 11, 2, '2024-06-10 19:12:50'),
	(50, 11, 3, '2024-06-12 01:55:52');

-- Dumping structure for table game_store.games
CREATE TABLE IF NOT EXISTS `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `developer_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `short_desc` text,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `release_date` date NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `games_ibfk_1` (`developer_id`),
  CONSTRAINT `games_ibfk_1` FOREIGN KEY (`developer_id`) REFERENCES `developers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.games: ~12 rows (approximately)
INSERT INTO `games` (`id`, `developer_id`, `title`, `short_desc`, `description`, `price`, `release_date`, `file_path`) VALUES
	(1, 1, 'Fortnite', 'Fortnite is a battle royale game where players fight to be the last one standing.', 'Fortnite is a battle royale game where players fight to be the last one standing. It features a massive online multiplayer mode, where up to 100 players can participate. The game includes building mechanics, allowing players to construct defensive structures. Additionally, Fortnite is known for its vibrant graphics and frequent content updates.', 0.00, '2017-07-25', 'path/to/fortnite.exe'),
	(2, 2, 'Dota 2', 'Dota 2 is a multiplayer online battle arena game.', 'Dota 2 is a multiplayer online battle arena game. Players control heroes with unique abilities and work with their team to destroy the enemy\'s Ancient. The game is highly competitive and has a steep learning curve. Dota 2 also has a thriving eSports scene with major tournaments.', 0.00, '2013-07-09', 'file/KRS Semester 2.pdf'),
	(3, 3, 'Assassin\'s Creed Valhalla', 'Assassin\'s Creed Valhalla is an action role-playing video game.', 'Assassin\'s Creed Valhalla is an action role-playing video game. Players take on the role of Eivor, a Viking warrior, as they explore and conquer new lands. The game features a vast open world, intricate combat mechanics, and a deep storyline. Valhalla also includes settlement building and various side activities.', 59.99, '2020-11-10', 'file/logo uin.png'),
	(4, 4, 'Grand Theft Auto V', 'Grand Theft Auto V is an action-adventure game set in the fictional state of San Andreas.', 'Grand Theft Auto V is an action-adventure game set in the fictional state of San Andreas. The game offers an expansive open world, allowing players to explore urban and rural areas. It features a rich storyline with three main protagonists. GTA V also includes an online multiplayer mode with various activities and missions.', 29.99, '2013-09-17', 'file/KRS Semester 2.pdf'),
	(5, 5, 'The Elder Scrolls V: Skyrim', 'The Elder Scrolls V: Skyrim is an open-world action role-playing game.', 'The Elder Scrolls V: Skyrim is an open-world action role-playing game. Set in the fantasy province of Skyrim, players can explore a vast world filled with quests, dungeons, and diverse characters. The game allows for extensive character customization and skill development. Skyrim also supports modding, providing endless replayability.', 39.99, '2011-11-11', 'file/KRS Semester 2.pdf'),
	(6, 6, 'Overwatch', 'Overwatch is a team-based multiplayer first-person shooter.', 'Overwatch is a team-based multiplayer first-person shooter. Players choose from a diverse roster of heroes, each with unique abilities and playstyles. The game emphasizes teamwork and strategy, with various game modes and objectives. Overwatch is known for its vibrant characters and fast-paced gameplay.', 19.99, '2016-05-24', 'file/KRS Semester 2.pdf'),
	(7, 7, 'FIFA 21', 'FIFA 21 is a football simulation video game.', 'FIFA 21 is a football simulation video game. It offers realistic gameplay, with improved mechanics and player movements. The game includes various modes, such as Career Mode, Ultimate Team, and Volta Football. FIFA 21 also features licensed teams, stadiums, and leagues from around the world.', 49.99, '2020-10-09', 'file/logo uin.png'),
	(8, 8, 'Cyberpunk 2077', 'Cyberpunk 2077 is an open-world, action-adventure story set in Night City.', 'Cyberpunk 2077 is an open-world, action-adventure story set in Night City, a megalopolis obsessed with power, glamour, and body modification. Players take on the role of V, a mercenary outlaw searching for a unique implant that grants immortality. The game offers deep customization options, dynamic gameplay, and a branching narrative. Cyberpunk 2077 also features a vast and immersive world.', 59.99, '2020-12-10', 'file/KRS Semester 2.pdf'),
	(11, 2, 'Half-Life: Alyx', 'Half-Life: Alyx is a VR first-person shooter developed and published by Valve.', 'Half-Life: Alyx is a VR first-person shooter developed and published by Valve. The game takes place between the events of Half-Life and Half-Life 2. Players control Alyx Vance as she battles the alien Combine. Half-Life: Alyx features immersive VR gameplay, detailed environments, and a compelling storyline.', 59.99, '2020-03-06', 'file/KRS Semester 2.pdf'),
	(22, 2, 'tesgamesaja', 'qweqwe', 'qweqweqwe', 30.00, '2024-06-26', 'file/KRS Semester 2.pdf'),
	(28, 2, 'tesss', 'sdadsaas', 'fdsf', 30.00, '2024-06-13', 'file/KRS Semester 2.pdf'),
	(29, 2, 'coba', 'percobaan', 'tes saja', 30.00, '2024-06-13', 'file/KRS Semester 2.xlsx');

-- Dumping structure for table game_store.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_ibfk_1` (`customer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.orders: ~10 rows (approximately)
INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `total`) VALUES
	(8, 11, '2024-06-08 16:23:20', 99.98),
	(11, 6, '2024-06-09 04:41:31', 59.99),
	(14, 11, '2024-06-09 10:48:17', 0.00),
	(15, 11, '2024-06-09 15:35:18', 59.99),
	(16, 11, '2024-06-10 03:18:17', 30.00),
	(17, 11, '2024-06-12 01:51:00', 29.99),
	(18, 11, '2024-06-12 01:53:16', 59.99),
	(19, 11, '2024-06-12 01:55:39', 39.99),
	(20, 11, '2024-06-12 23:40:48', 0.00),
	(21, 11, '2024-06-12 23:48:19', 99.98);

-- Dumping structure for table game_store.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `game_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_ibfk_1` (`order_id`),
  KEY `order_items_ibfk_2` (`game_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.order_items: ~11 rows (approximately)
INSERT INTO `order_items` (`id`, `order_id`, `game_id`) VALUES
	(15, 11, 3),
	(16, 14, 2),
	(17, 15, 3),
	(18, 16, 22),
	(19, 17, 4),
	(20, 18, 8),
	(21, 19, 5),
	(22, 20, 1),
	(23, 21, 29),
	(24, 21, 6),
	(25, 21, 7);

-- Dumping structure for table game_store.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reviews_ibfk_1` (`game_id`),
  KEY `reviews_ibfk_2` (`customer_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_chk_1` CHECK (((`rating` >= 1) and (`rating` <= 5)))
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.reviews: ~17 rows (approximately)
INSERT INTO `reviews` (`id`, `game_id`, `customer_id`, `rating`, `created_at`) VALUES
	(1, 1, 1, '5', '2023-05-30 03:20:00'),
	(2, 1, 2, '4', '2023-05-29 04:25:00'),
	(3, 1, 3, '5', '2023-05-28 05:30:00'),
	(6, 3, 6, '3', '2023-05-25 08:45:00'),
	(7, 3, 7, '2', '2023-05-24 09:50:00'),
	(8, 3, 8, '3', '2023-05-23 10:55:00'),
	(11, 4, 1, '2', '2023-05-20 13:10:00'),
	(12, 6, 2, '5', '2023-05-18 15:20:00'),
	(13, 6, 3, '4', '2023-05-17 16:25:00'),
	(16, 8, 6, '3', '2023-05-14 04:40:00'),
	(17, 8, 7, '4', '2023-05-13 05:45:00'),
	(18, 8, 8, '3', '2023-05-12 06:50:00'),
	(22, 11, 2, '5', '2023-05-08 05:30:00'),
	(23, 11, 3, '4', '2023-05-07 06:35:00'),
	(25, 11, 11, '4', '2024-06-09 08:06:01'),
	(29, 2, 11, '1', '2024-06-09 10:56:50'),
	(30, 3, 11, '3', '2024-06-09 15:35:32'),
	(31, 5, 11, '5', '2024-06-12 01:55:49');

-- Dumping structure for table game_store.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','developer','customer') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.users: ~18 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
	(1, 'epicgames', 'password1', 'support@epicgames.com', 'developer', '2024-06-06 16:19:40'),
	(2, 'valve', 'password2', 'support@valvesoftware.com', 'developer', '2024-06-06 16:19:40'),
	(3, 'ubisoft', 'password3', 'support@ubisoft.com', 'developer', '2024-06-06 16:19:40'),
	(4, 'rockstar', 'password4', 'support@rockstargames.com', 'developer', '2024-06-06 16:19:40'),
	(5, 'bethesda', 'password5', 'support@bethesda.com', 'developer', '2024-06-06 16:19:40'),
	(6, 'blizzard', 'password6', 'support@blizzard.com', 'developer', '2024-06-06 16:19:40'),
	(7, 'ea', 'password7', 'support@ea.com', 'developer', '2024-06-06 16:19:40'),
	(8, 'cdprojekt', 'password8', 'support@cdprojekt.com', 'developer', '2024-06-06 16:19:40'),
	(11, 'johndoe', 'johndoe', 'johndoe@example.com', 'customer', '2024-06-06 16:19:40'),
	(12, 'janedoe', 'janedoe', 'janedoe@example.com', 'customer', '2024-06-06 16:19:40'),
	(13, 'alice', 'alice', 'alice@example.com', 'customer', '2024-06-06 16:19:40'),
	(16, 'dave', 'dave', 'dave@example.com', 'customer', '2024-06-06 16:19:40'),
	(17, 'eve', 'eve', 'eve@example.com', 'customer', '2024-06-06 16:19:40'),
	(18, 'frank', 'frank', 'frank@example.com', 'customer', '2024-06-06 16:19:40'),
	(20, 'heidi', 'heidi', 'heidi@example.com', 'customer', '2024-06-06 16:19:40'),
	(21, 'cust', 'cust', 'cust@example.com', 'customer', '2024-06-06 16:19:40'),
	(22, 'adm', 'adm', 'adm@example.com', 'admin', '2024-06-06 16:19:40');

-- Dumping structure for table game_store.wishlists
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `game_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `wishlists_ibfk_1` (`customer_id`),
  KEY `wishlists_ibfk_2` (`game_id`),
  CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table game_store.wishlists: ~7 rows (approximately)
INSERT INTO `wishlists` (`id`, `customer_id`, `game_id`, `created_at`) VALUES
	(2, 2, 5, '2024-06-06 16:19:40'),
	(73, 11, 6, '2024-06-08 18:14:12'),
	(74, 11, 5, '2024-06-08 18:14:16'),
	(77, 11, 7, '2024-06-08 18:14:26'),
	(78, 11, 4, '2024-06-08 18:14:28'),
	(116, 11, 3, '2024-06-09 15:35:06'),
	(118, 11, 8, '2024-06-12 01:53:09'),
	(119, 11, 1, '2024-06-12 23:40:43');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
