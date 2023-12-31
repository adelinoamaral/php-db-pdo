/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `demo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `demo`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `email_verification_link` varchar(200) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `status`, `email`, `email_verification_link`, `email_verified_at`, `created_at`, `update_at`, `idcategory`) VALUES
	(1, 'Raul', '$2y$10$YLjsNBiX2wp1mSVlXqLxcOUDRDI4.mawZEtwaDCNz8rn8HEkuAr5y', 0, 'ra@sapo.pt', NULL, NULL, '2021-12-21 11:34:25', '2021-12-21 12:01:07', NULL),
	(2, 'adelino', '$2y$10$jOCgQTqPznNWJ2HUoM1speumV5CrhOFLpPfAaAHDodqXa75nJmdYq', 0, 'adel@gmail.com', NULL, NULL, '2022-01-13 12:06:36', '2022-01-13 12:06:36', NULL),
	(3, 'carlos_batista', '$2y$10$nsTsyrocVDheLgb6cpoxBODMuIseXvjSHT1.iA05FQUVgQVdPVba2', 0, 'ca@sapo.pt', NULL, NULL, '2022-01-20 16:11:03', '2022-01-20 16:11:03', NULL),
	(4, 'pedro', '$2y$10$Yil3Yi6W.OJuQf4/oEP3N.zkNuxTJh/loj4ef4NpzakIC7yikjCdq', 0, 'pedro@gmail.com', 'c3b7f393410fe6185ba5d966a213a38f204', '2022-02-11 09:18:10', '2022-02-11 09:17:59', '2022-02-11 09:17:59', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
