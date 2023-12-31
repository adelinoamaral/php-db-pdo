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

-- Dumping structure for table company.persons
CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idcategory` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_idcategory` (`idcategory`),
  CONSTRAINT `FK_idcategory` FOREIGN KEY (`idcategory`) REFERENCES `categories` (`idcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table company.persons: ~15 rows (approximately)
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` (`id`, `first_name`, `last_name`, `email`, `created_at`, `idcategory`) VALUES
	(1, 'Peter', 'Parker', 'peterparker@mail.com', '2022-01-17 10:46:00', 1),
	(2, 'John', 'Rambo', 'johnrambo@mail.com', '2022-01-17 10:46:00', 1),
	(3, 'Clark', 'Kent', 'clarkkent@mail.com', '2022-01-17 10:46:00', 1),
	(4, 'John', 'Carter', 'johncarter@mail.com', '2022-01-17 10:46:00', 1),
	(5, 'Harry', 'Potter', 'harrypotter@mail.com', '2022-01-17 10:46:00', 1),
	(6, 'Adelino', 'Amaral', 'adelino@gmail.com', '2022-01-17 10:46:00', 1),
	(7, 'Fernando', 'Carvalho', 'fer@sapo.pt', '2022-01-17 10:46:00', 1),
	(10, 'Pedro', 'Almeida', 'pa@sapo.pt', '2022-01-17 10:46:00', 1),
	(11, 'Raul', 'Amaral', 'ra@gmail.com', '2022-01-17 10:46:00', 1),
	(12, 'Rafael', 'Pina', 'rp@sapo.pt', '2022-01-17 10:46:36', 1),
	(13, 'Diogo', 'Gomes', 'dg@mail.com', '2022-11-30 11:22:46', 1),
	(14, 'Bogas', 'Mendes', 'bogas@sapo.pt', '2022-11-30 11:33:36', 1),
	(15, 'Joana', 'Gomes', 'joana@sapo.pt', '2022-12-04 09:43:31', 1),
	(16, 'Carvalho', 'Machado', 'carvalho@ipv.pt', '2022-12-04 09:44:24', 1),
	(17, 'Hermione', 'Granger', 'hermionegranger@mail.com', '2022-12-04 09:51:56', 1);
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
