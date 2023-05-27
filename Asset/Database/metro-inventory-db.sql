DROP DATABASE  IF EXISTS `metro-inventory`;
CREATE SCHEMA `metro-inventory`;
USE `metro-inventory`;

DROP TABLE IF EXISTS `user-groups`;
CREATE TABLE `user-groups` (
    `groupID` INT NOT NULL AUTO_INCREMENT,
    `group` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`groupID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `userID` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `surname` VARCHAR(45) NOT NULL,
    `e-mail` VARCHAR(45) NOT NULL,
    `password` VARCHAR(45) NOT NULL,
    `groupID` INT NOT NULL,
    PRIMARY KEY (`userID`),
    KEY `groupID_idx` (`groupID`),
    CONSTRAINT `groupID` FOREIGN KEY (`groupID`)
        REFERENCES `user-groups` (`groupID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `storage-units`;
CREATE TABLE `storage-units` (
    `warehouseID` INT NOT NULL AUTO_INCREMENT,
    `warehouse` VARCHAR(45) NOT NULL,
    `address` VARCHAR(45) NOT NULL,
    `city` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`warehouseID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `stock-items`;
CREATE TABLE `stock-items` (
    `itemID` INT NOT NULL AUTO_INCREMENT,
    `item` VARCHAR(45) NOT NULL,
    `category` ENUM('IT', 'SERVICE') NOT NULL,
    `quantity` INT NOT NULL DEFAULT '0',
    `warehouseID` INT NOT NULL,
    PRIMARY KEY (`itemID`),
    KEY `warehouseID_idx` (`warehouseID`),
    CONSTRAINT `warehouseID` FOREIGN KEY (`warehouseID`)
        REFERENCES `storage-units` (`warehouseID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
    `ticketID` INT(11) NOT NULL,
    `tittle` VARCHAR(20) NOT NULL,
    `message` VARCHAR(300) NOT NULL DEFAULT '',
    `msg-status` ENUM('READ', 'UNREAD') NOT NULL DEFAULT 'UNREAD',
    `status` ENUM('ACTIVE', 'COMPLETED') NOT NULL DEFAULT 'ACTIVE',
    `date-time-created` VARCHAR(45) NOT NULL,
    `date-time-modified` VARCHAR(45) NOT NULL,
    `groupID` INT(11) NOT NULL,
    `senderID` INT(11) NOT NULL,
    `user-modifier-ID` INT(11) NOT NULL,
    PRIMARY KEY (`ticketID`),
    KEY `group-ticket-ID_idx` (`groupID`),
    KEY `user-ticket-ID_idx` (`senderID`),
    CONSTRAINT `group-ticket-ID` FOREIGN KEY (`groupID`)
        REFERENCES `user-groups` (`groupID`),
    CONSTRAINT `sender-ticket-ID` FOREIGN KEY (`senderID`)
        REFERENCES `users` (`userID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
    `transactionID` INT NOT NULL AUTO_INCREMENT,
    `type` ENUM('ADDITION', 'REMOVAL', 'TRANSFER') NOT NULL,
    `date-time` VARCHAR(30) NOT NULL,
    `notes` VARCHAR(200) NOT NULL DEFAULT '',
    `userID` INT NOT NULL,
    `warehouse-from-ID` INT NOT NULL,
    `warehouse-to-ID` INT NOT NULL,
    PRIMARY KEY (`transactionID`),
    KEY `userID_idx` (`userID`),
    KEY `warehouse-from_idx` (`warehouse-from-ID`),
    KEY `warehouse-to_idx` (`warehouse-to-ID`),
    CONSTRAINT `userID` FOREIGN KEY (`userID`)
        REFERENCES `users` (`userID`),
    CONSTRAINT `warehouse-from` FOREIGN KEY (`warehouse-from-ID`)
        REFERENCES `storage-units` (`warehouseID`),
    CONSTRAINT `warehouse-to` FOREIGN KEY (`warehouse-to-ID`)
        REFERENCES `storage-units` (`warehouseID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `transaction-items`;
CREATE TABLE `transaction-items` (
    `transaction-item-ID` INT NOT NULL AUTO_INCREMENT,
    `quantity` INT NOT NULL,
    `itemID` INT NOT NULL,
    `transactionID` INT NOT NULL,
    PRIMARY KEY (`transaction-item-ID`),
    KEY `item-transaction-ID_idx` (`itemID`),
    KEY `transactionID_idx` (`transactionID`),
    CONSTRAINT `item-transaction-ID` FOREIGN KEY (`itemID`)
        REFERENCES `stock-items` (`itemID`),
    CONSTRAINT `transactionID` FOREIGN KEY (`transactionID`)
        REFERENCES `transactions` (`transactionID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

INSERT INTO `user-groups` (`groupID`, `group`) VALUES
(1, 'ADMIN'),
(2, 'IT'),
(3, 'SERVICE'),
(4, 'HR'),
(5, 'FINANCE'),
(6, 'USER');

INSERT INTO `users`( `userID`, `name`, `surname`, `e-mail`, `password`, `groupID` ) VALUES
( 1, 'Klei', 'Jahaj', 'klei.jahaj21@umt.edu.al', '1234', 1 ),
( 2, 'Eljon', 'Zagradi', 'ezagradi20@umt.edu.al', '1234', 1 ),
( 3, 'Angjelos', 'Goga', 'angjelos.goga21@umt.edu.al', '1234', 1 );