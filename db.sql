SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
COMMIT;

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `firstName`, `lastName`, `phone`, `admin`, `createdAt`) VALUES
(1, 'easv', '$2y$10$uMkFYilGKgW/vETBK3cStOYjGLfywHi4UyoljFXB9NtKEdO3FFoC.', 'easv@easv.dk', 'test', 'test', '+451234567', 1, current_timestamp());
COMMIT;

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `firstName`, `lastName`, `phone`, `admin`, `createdAt`) VALUES
(2, 'easv2', '$2y$10$uMkFYilGKgW/vETBK3cStOYjGLfywHi4UyoljFXB9NtKEdO3FFoC.', 'easv@easv.dk', 'test', 'test', '+451234567', 1, current_timestamp());
COMMIT;

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `invoiceId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `region` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `itemId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`invoiceID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
COMMIT;

INSERT INTO `invoices` (`invoiceId`, `userId`, `country`, `city`, `region`, `address`, `phone`, `itemName`, `itemId`, `price`, `status`, `createdAt`) VALUES
(1, 1, 'test', 'test', 1232, 'test', '+4512345678', 'test', 1, 120, 0, current_timestamp());
COMMIT;

INSERT INTO `invoices` (`invoiceId`, `userId`, `country`, `city`, `region`, `address`, `phone`, `itemName`, `itemId`, `price`, `status`, `createdAt`) VALUES
(2, 1, 'test2', 'test2', 1232, 'test2', '+4512345678', 'test2', 1, 120, 1, current_timestamp());
COMMIT;

INSERT INTO `invoices` (`invoiceId`, `userId`, `country`, `city`, `region`, `address`, `phone`, `itemName`, `itemId`, `price`, `status`, `createdAt`) VALUES
(3, 2, 'test', 'test', 1232, 'test', '+4512345678', 'test', 1, 120, 0, current_timestamp());
COMMIT;

INSERT INTO `invoices` (`invoiceId`, `userId`, `country`, `city`, `region`, `address`, `phone`, `itemName`, `itemId`, `price`, `status`, `createdAt`) VALUES
(4, 2, 'test2', 'test2', 1232, 'test2', '+4512345678', 'test2', 1, 120, 1, current_timestamp());
COMMIT;

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `footerDesc` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
COMMIT;

INSERT INTO `company` (`id`, `title`, `desc`, `footerDesc`, `address`, `mail`, `phone`, `image`) VALUES
(1, 'Meals catered to your body', 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet', 'Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita', 'Erhvervsakademi Sydvest, Spangsbjerg Kirkevej 103, 6700 Esbjerg', 'easv@easv.dk', '+45 76 13 32 00', 'represent.jpg');
COMMIT;