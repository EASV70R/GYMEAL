

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `email` (`email`)
);

INSERT INTO `user` (`uid`, `username`, `password`, `email`, `createdAt`) VALUES
(1, 'easv', '$2y$10$uMkFYilGKgW/vETBK3cStOYjGLfywHi4UyoljFXB9NtKEdO3FFoC.', 'easv@easv.dk', current_timestamp());

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `addressId` int NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postalCode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`addressId`)
);

INSERT INTO `address` (`addressId`, `street`, `city`, `postalCode`, `country`) VALUE
('1', 'EASV', 'EASV', '420', 'USA');

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `companyId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `smalldesc` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `addressId` int NOT NULL,
  PRIMARY KEY (`companyId`),
  FOREIGN KEY (`addressId`) REFERENCES `address`(`addressId`)
);

INSERT INTO `company` (`companyId`, `name`, `email`, `phone`, `desc`, `smalldesc`, `image`, `addressId`) VALUE
('1', 'FIT', 'test@test.dk', '+4512345678',  'GOOD FOOD', 'GOOD FOOD', 'GOOD FOOD', '1');

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `quantity` int(2) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `addressId` int NOT NULL,
  PRIMARY KEY (`productId`),
  FOREIGN KEY (`addressId`) REFERENCES `company`(`addressId`)
);

INSERT INTO `product` (`productId`, `title`, `quantity`, `desc`, `image`, `price`, `addressId`) VALUE
('1', 'Burger', '10', 'Good Burger', 'burger.jpg', '100', '1');

DROP TABLE IF EXISTS `has`;
CREATE TABLE IF NOT EXISTS `has` (
  `productId` int NOT NULL,
  `orderId` int NOT NULL,
  CONSTRAINT PK_Has PRIMARY KEY (`productId`, `orderId`),
  FOREIGN KEY (`productId`) REFERENCES `product`(`productId`),
  FOREIGN KEY (`orderId`) REFERENCES `order`(`orderId`)
);

INSERT INTO `has` (`productId`, `orderId`) VALUE
('1', '1');

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `orderId` int NOT NULL AUTO_INCREMENT,
  `orderDate` timestamp NULL DEFAULT current_timestamp(),
  `customerId` int NOT NULL,
  PRIMARY KEY (`orderId`),
  FOREIGN KEY (`customerId`) REFERENCES `customer`(`customerId`)
);

INSERT INTO `order` (`orderId`, `orderDate`, `customerId`) VALUE
('1', '2019-01-01 00:00:00', '1');

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerId` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `addressId` int NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`customerId`),
  FOREIGN KEY (`addressId`) REFERENCES `address`(`addressId`),
  FOREIGN KEY (`uid`) REFERENCES `user`(`uid`)
);

DROP TABLE IF EXISTS `worksFor`;
CREATE TABLE IF NOT EXISTS `worksFor` (
  `companyId` int NOT NULL,
  `employeeId` int NOT NULL,
  CONSTRAINT PK_WorksFor PRIMARY KEY (`companyId`, `employeeId`),
  FOREIGN KEY (`companyId`) REFERENCES `company`(`companyId`),
  FOREIGN KEY (`employeeId`) REFERENCES `employee`(`employeeId`)
);

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employeeId` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `addressId` int NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`employeeId`),
  FOREIGN KEY (`addressId`) REFERENCES `address`(`addressId`),
  FOREIGN KEY (`uid`) REFERENCES `user`(`uid`)
);
INSERT INTO `employee` (`employeeId`, `firstName`, `lastName`, `phone`, `addressId`, `uid`) VALUE
('1', 'John', 'Doe', '12345678', '1', '1');

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `phone`, `addressId`, `uid`) VALUE
('1', 'admin', 'admin', '12345678', '1', '1');

DROP TABLE IF EXISTS `userrole`;
CREATE TABLE IF NOT EXISTS `userrole` (
  `uid` int NOT NULL,
  `roleid` int(1) NOT NULL,
  CONSTRAINT PK_UserRole PRIMARY KEY (`uid`, `roleid`),
  FOREIGN KEY (`uid`) REFERENCES `user`(`uid`)
);

INSERT INTO `userrole` (`uid`, `roleid`) VALUE
('1', '1');