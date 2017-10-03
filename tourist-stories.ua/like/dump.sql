-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.65-community-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2014-01-22 21:10:50
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table test_db.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `small_text` varchar(255) NOT NULL,
  `big_text` text NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL,
  `count_like` int(10) NOT NULL,
  `count_dislike` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table test_db.news: ~5 rows (approximately)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `small_text`, `big_text`, `date_create`, `is_active`, `count_like`, `count_dislike`) VALUES
	(1, 'Новость 1', 'короткое описание 1', 'полный текст', '2014-01-18 17:36:02', 1, 0, 0),
	(2, 'Новость 2', 'короткое описание', 'полный текст', '2014-01-18 17:36:02', 1, 0, 0),
	(3, 'Новость 3', 'короткое описание', 'полный текст', '2014-01-18 17:36:25', 1, 0, 0),
	(4, 'Новость 4', 'короткое описание', 'полный текст', '2014-01-22 20:59:53', 1, 0, 0),
	(5, 'Новость 5', 'короткое описание', 'полный текст', '2014-01-22 20:59:52', 1, 0, 0);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Dumping structure for table test_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table test_db.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `pass`) VALUES
	(1, 'test', 'pass');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table test_db.votes_news2user
CREATE TABLE IF NOT EXISTS `votes_news2user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_news` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table test_db.votes_news2user: ~2 rows (approximately)
/*!40000 ALTER TABLE `votes_news2user` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes_news2user` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
