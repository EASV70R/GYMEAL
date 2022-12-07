

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `email` (`email`)
);

INSERT INTO `user` (`uid`, `username`, `password`, `email`, `createdAt`) VALUES
(1, 'easv', '$2y$10$R/LZ8/ojdHpO3xCw60albOtj5uECEaLS1SSyLEJvYy5D7vwAnSb.m', 'easv@easv.dk', current_timestamp());


DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `countryId` int NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  `postalCode` int NOT NULL,
  `country` varchar(25) NOT NULL,
  PRIMARY KEY (`countryId`)
);

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `addressId` int NOT NULL AUTO_INCREMENT,
  `street` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `postalCode` int NOT NULL,
  PRIMARY KEY (`addressId`)
  FOREIGN KEY (`countryId`) REFERENCES `country`(`countryId`)
);

INSERT INTO `address` (`addressId`, `street`, `city`, `postalCode`, `country`) VALUE
('1', 'Erhvervsakademi Sydvest, Spangsbjerg Kirkevej 103', 'Esbjerg', '6700 ', 'Denmark');

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `companyId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int NOT NULL,
  `desc` varchar(255) NOT NULL,
  `smalldesc` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  `addressId` int NOT NULL,
  PRIMARY KEY (`companyId`),
  FOREIGN KEY (`addressId`) REFERENCES `address`(`addressId`)
);

INSERT INTO `company` (`companyId`, `name`, `email`, `phone`, `desc`, `smalldesc`, `image`, `addressId`) VALUE
('1', 'GYMEAL', 'test@test.dk', '+4512345678',  'Meals catered to your body', 'Meals catered to your body', 'http://fitdwp.dk/assets/img/represent.jpg', '1');

DROP TABLE IF EXISTS `productfilter`;
CREATE TABLE IF NOT EXISTS `productfilter` (
  `productFilterId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`productFilterId`)
);

INSERT INTO `productfilter` (`productFilterId`, `name`) VALUE
('1', 'Meals'),
('2', 'Drinks'),
('3', 'Other');

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productId` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `code` varchar(25) NOT NULL,
  `quantity` int(2) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `productFilterId` int NOT NULL,
  PRIMARY KEY (`productId`),
  FOREIGN KEY (`productFilterId`) REFERENCES `productfilter`(`productFilterId`),
  UNIQUE KEY `product_code` (`code`)
);

insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (1, 'Mushroom - Morel Frozen', 'AS232', 9, 'Pork - Sausage, Medium', 'http://dummyimage.com/112x100.png/5fa2dd/ffffff', 45, 3);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (2, 'Ham - Proscuitto', 'GGA22', 3, 'Nantucket - 518ml', 'http://dummyimage.com/105x100.png/5fa2dd/ffffff', 82, 3);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (3, 'Gelatine Leaves - Bulk', 'SAA22', 2, 'Water - Spring Water 500ml', 'http://dummyimage.com/143x100.png/cc0000/ffffff', 18, 3);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (4, 'Cookie Double Choco', '2AS2', 2, 'Beef - Rib Roast, Capless', 'http://dummyimage.com/217x100.png/ff4444/ffffff', 71, 2);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (5, 'Carbonated Water - Orange', 'SDASA', 4, 'Cheese - Shred Cheddar / Mozza', 'http://dummyimage.com/163x100.png/5fa2dd/ffffff', 57, 2);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (6, 'Lemonade - Natural, 591 Ml', '232A', 3, 'Bread - Ciabatta Buns', 'http://dummyimage.com/120x100.png/cc0000/ffffff', 53, 2);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (7, 'Wine - Chablis J Moreau Et Fils', '22AS', 10, 'Vodka - Moskovskaya', 'http://dummyimage.com/146x100.png/5fa2dd/ffffff', 20, 3);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (8, 'Soup V8 Roasted Red Pepper', 'AAA2', 7, 'Cornstarch', 'http://dummyimage.com/112x100.png/cc0000/ffffff', 81, 2);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (9, 'Cookie Double Choco', '123A', 9, 'Soup Bowl Clear 8oz92008', 'http://dummyimage.com/122x100.png/dddddd/000000', 74, 2);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (10, 'Red Currants', 'AA22', 4, 'Silicone Parch. 16.3x24.3', 'http://dummyimage.com/249x100.png/ff4444/ffffff', 27, 1);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (11, 'Clam - Cherrystone', '55AA', 4, 'Raisin - Dark', 'http://dummyimage.com/101x100.png/ff4444/ffffff', 67, 2);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (12, 'Langers - Mango Nectar', 'ABC2', 6, 'Rice - Wild', 'http://dummyimage.com/170x100.png/5fa2dd/ffffff', 13, 3);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (13, 'Salmon Atl.whole 8 - 10 Lb', 'DFG2', 9, 'Beef Ground Medium', 'http://dummyimage.com/207x100.png/cc0000/ffffff', 40, 2);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (14, 'Chivas Regal - 12 Year Old', 'AA2222', 8, 'Turkey - Oven Roast Breast', 'http://dummyimage.com/190x100.png/ff4444/ffffff', 43, 1);
insert into product (`productId`, `title`, `code`, `quantity`, `desc`, `image`, `price`, `productFilterId`) values (15, 'Wine - Red, Gamay Noir', 'GSAA2', 9, 'Pickle - Dill', 'http://dummyimage.com/160x100.png/cc0000/ffffff', 85, 3);

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerId` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `phone` int NOT NULL,
  `addressId` int NOT NULL,
  `uid` int NOT NULL,
  PRIMARY KEY (`customerId`),
  FOREIGN KEY (`addressId`) REFERENCES `address`(`addressId`),
  FOREIGN KEY (`uid`) REFERENCES `user`(`uid`)
);

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `orderId` int NOT NULL AUTO_INCREMENT,
  `orderDate` timestamp NULL DEFAULT current_timestamp(),
  `customerId` int NOT NULL,
  PRIMARY KEY (`orderId`),
  FOREIGN KEY (`customerId`) REFERENCES `customer`(`customerId`)
);

DROP TABLE IF EXISTS `has`;
CREATE TABLE IF NOT EXISTS `has` (
  `productId` int NOT NULL,
  `orderId` int NOT NULL,
  CONSTRAINT PK_Has PRIMARY KEY (`productId`, `orderId`),
  FOREIGN KEY (`productId`) REFERENCES `product`(`productId`),
  FOREIGN KEY (`orderId`) REFERENCES `order`(`orderId`)
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

DROP TABLE IF EXISTS `worksFor`;
CREATE TABLE IF NOT EXISTS `worksFor` (
  `companyId` int NOT NULL,
  `employeeId` int NOT NULL,
  CONSTRAINT PK_WorksFor PRIMARY KEY (`companyId`, `employeeId`),
  FOREIGN KEY (`companyId`) REFERENCES `company`(`companyId`),
  FOREIGN KEY (`employeeId`) REFERENCES `employee`(`employeeId`)
);

DROP TABLE IF EXISTS `userrole`;
CREATE TABLE IF NOT EXISTS `userrole` (
  `uid` int NOT NULL,
  `roleid` int(1) NOT NULL,
  CONSTRAINT PK_UserRole PRIMARY KEY (`uid`),
  FOREIGN KEY (`uid`) REFERENCES `user`(`uid`)
);

INSERT INTO `userrole` (`uid`, `roleid`) VALUE
('1', '1');

INSERT INTO `order` (`orderId`, `orderDate`, `customerId`) VALUE
('1', '2019-01-01 00:00:00', '1');

INSERT INTO `has` (`productId`, `orderId`) VALUE
('1', '1');

DELIMITER //
Create Trigger before_inser_productqty BEFORE INSERT ON product FOR EACH ROW
BEGIN
IF NEW.quantity < 0 OR NEW.quantity > 20 THEN SET NEW.quantity = 0;
END IF;
END