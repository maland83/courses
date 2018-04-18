-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.37 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица courses_n.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_access` timestamp NOT NULL,
  `full_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы courses_n.users: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `username`, `email`, `password`, `status`, `created`, `last_access`, `full_name`) VALUES
	(7, '23', 'faaf', 'df', 1, '2018-04-17 23:12:55', '0000-00-00 00:00:00', 'full_name'),
	(8, 'devinua', 'andrei_x@ukr.net', '6364', 0, '2018-04-18 03:42:12', '0000-00-00 00:00:00', 'Andrei Mal'),
	(9, 'devinua', 'andrei_x@ukr.net', 'c20ad4d76fe97759aa27a0c99bff6710', 0, '2018-04-18 03:44:41', '0000-00-00 00:00:00', 'Andrei Mal'),
	(10, 'devinua', 'andrei_x@ukr.net', '182', 0, '2018-04-18 03:45:50', '0000-00-00 00:00:00', 'Andrei Mal'),
	(11, 'devinua', 'andrei_x@ukr.net', '182', 0, '2018-04-18 03:47:07', '0000-00-00 00:00:00', 'Andrei Mal');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
