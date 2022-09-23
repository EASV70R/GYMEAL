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