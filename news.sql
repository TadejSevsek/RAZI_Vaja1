-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for news
DROP DATABASE IF EXISTS `news`;
CREATE DATABASE IF NOT EXISTS `news` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `news`;

-- Dumping structure for table news.articles
DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci NOT NULL,
  `abstract` text CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- Dumping data for table news.articles: ~4 rows (approximately)
INSERT INTO `articles` (`id`, `title`, `abstract`, `text`, `date`, `user_id`) VALUES
	(4, 'theo1', 'moje besedilo', 'lorem ipsum', '2025-03-13 12:11:46', 9),
	(5, 'theo2', 'ho', 'HO', '2025-03-13 12:12:02', 9),
	(9, 'se ena novica ', 'novica 2', 'to je od aurore', '2025-03-13 19:03:41', 8);

-- Dumping structure for table news.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int unsigned NOT NULL,
  `article_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- Dumping data for table news.comments: ~11 rows (approximately)
INSERT INTO `comments` (`id`, `text`, `date`, `user_id`, `article_id`) VALUES
	(4, 'nek komentar', '2025-03-13 15:31:35', 8, 5),
	(5, 'nek drug komentar', '2025-03-13 15:32:03', 8, 4),
	(6, 'drug uporabnik', '2025-03-13 15:32:45', 9, 4),
	(7, 'drug uporabnik', '2025-03-13 15:34:35', 9, 4),
	(8, 'drug uporabnik', '2025-03-13 15:42:10', 9, 4),
	(9, 'drug uporabnik', '2025-03-13 15:43:12', 9, 4),
	(10, 'drug uporabnik', '2025-03-13 15:43:36', 9, 4),
	(11, 'nek dejanski test komentarjev', '2025-03-13 15:44:01', 9, 4),
	(12, 'ho', '2025-03-13 15:50:54', 9, 5),
	(13, 'hey', '2025-03-13 19:04:17', 9, 9),
	(14, 'sup ', '2025-03-13 19:04:55', 10, 9);

-- Dumping structure for table news.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

-- Dumping data for table news.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
	(8, 'aurora', 'falsenaurora@gmail.com', '$2y$10$jQZmHqGiv0xz7tWW1HIONOB4glOdFY7AwlMaKX2aq7Rn/E8TEFyQ6'),
	(9, 'theo', 'tadej.sevsek123@gmail.com', '$2y$10$8SoDM1v2ZIXj91GdRllbN.xxH9VsYY3VpIkDg.Bot8R.wqAsplZY6'),
	(10, 'root', 'root@gmail.com', '$2y$10$75bamd8fViNlJrvUxsCKYOnj5MOdWEikzg4jwbvf.RgUuuBy.Hgpi');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
