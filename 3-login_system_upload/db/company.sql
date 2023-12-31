-- --------------------------------------------------------
-- Anfitrião:                    localhost
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for company
CREATE DATABASE IF NOT EXISTS `company` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `company`;

-- Dumping structure for table company.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `idcategory` int(10) unsigned NOT NULL,
  `assignment` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcategory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table company.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`idcategory`, `assignment`, `created_at`) VALUES
	(1, 'Geral', '2022-11-30 11:14:10'),
	(2, 'Administrativo', '2022-11-30 11:14:10');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table company.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `email_verification_link` varchar(200) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(80) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `idcategory` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_users_categories` (`idcategory`),
  CONSTRAINT `FK_users_categories` FOREIGN KEY (`idcategory`) REFERENCES `categories` (`idcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table company.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `status`, `email`, `email_verification_link`, `email_verified_at`, `photo`, `created_at`, `update_at`, `idcategory`) VALUES
	(1, 'Raul', '$2y$10$YLjsNBiX2wp1mSVlXqLxcOUDRDI4.mawZEtwaDCNz8rn8HEkuAr5y', 0, 'ra@sapo.pt', NULL, NULL, NULL, '2021-12-21 11:34:25', '2021-12-21 12:01:07', NULL),
	(2, 'adelino', '$2y$10$RPiZdvi01hT8ogttmS8IH.77itE3Wy80.40kFtfD3Ex1ZHjxpUiP.', 0, 'adel@gmail.com', NULL, NULL, NULL, '2022-01-13 12:06:36', '2022-01-13 12:06:36', NULL),
	(3, 'carlos_batista', '$2y$10$nsTsyrocVDheLgb6cpoxBODMuIseXvjSHT1.iA05FQUVgQVdPVba2', 0, 'ca@sapo.pt', NULL, NULL, NULL, '2022-01-20 16:11:03', '2022-01-20 16:11:03', NULL),
	(4, 'pedro', '$2y$10$Yil3Yi6W.OJuQf4/oEP3N.zkNuxTJh/loj4ef4NpzakIC7yikjCdq', 0, 'pedro@gmail.com', 'c3b7f393410fe6185ba5d966a213a38f204', '2022-02-11 09:18:10', NULL, '2022-02-11 09:17:59', '2022-02-11 09:17:59', NULL),
	(5, 'joao', '$2y$10$T.TkZ8iUeZPxzQ5tuw.EDOy7G8psFF086.K/i4LyivxoncWuFEi3q', 0, NULL, NULL, NULL, 'ver.drawio.png', '2022-02-27 22:07:30', '2022-02-27 22:07:30', 2),
	(6, 'Charles', '$2y$10$FjJSR7g1ionmK5ndNutn5uWy98yublvqk3x59jGK78euu.S.AKOpO', 0, NULL, NULL, NULL, 'urso.jpg', '2022-02-28 12:20:24', '2022-02-28 12:20:24', 2),
	(7, 'Goa', '$2y$10$QHu7MgMbNo5ZpYRu9bbGjuvDuRmCNy6AT8WksnIBD7ryEsqGPEM8C', 0, NULL, NULL, NULL, 'galo.jpg', '2023-01-06 19:08:16', '2023-01-06 19:08:16', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
