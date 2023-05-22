CREATE DATABASE  IF NOT EXISTS `metro-inventory`;
USE `metro-inventory`;

DROP TABLE IF EXISTS `user-groups`;
CREATE TABLE `user-groups` (
  `groupID` int NOT NULL AUTO_INCREMENT,
  `group` varchar(45) NOT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `e-mail` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `groupID` int NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `groupID_idx` (`groupID`),
  CONSTRAINT `groupID` FOREIGN KEY (`groupID`) REFERENCES `user-groups` (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `stock-items`;
CREATE TABLE `stock-items` (
  `itemID` int NOT NULL AUTO_INCREMENT,
  `item` varchar(45) NOT NULL,
  `category` enum('IT','SERVICE') NOT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `storage-units`;
CREATE TABLE `storage-units` (
  `warehouseID` int NOT NULL AUTO_INCREMENT,
  `warehouse` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  PRIMARY KEY (`warehouseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4  ;

DROP TABLE IF EXISTS `items-quantities`;
CREATE TABLE `items-quantities` (
  `itemID` int NOT NULL,
  `warehouseID` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  KEY `warehouseID_idx` (`warehouseID`),
  KEY `itemID_idx` (`itemID`),
  CONSTRAINT `itemID` FOREIGN KEY (`itemID`) REFERENCES `stock-items` (`itemID`),
  CONSTRAINT `warehouseID` FOREIGN KEY (`warehouseID`) REFERENCES `storage-units` (`warehouseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
    `ticketID` INT NOT NULL AUTO_INCREMENT,
    `message` VARCHAR(300) NOT NULL DEFAULT '',
    `msg-status` ENUM('READ', 'UNREAD') NOT NULL DEFAULT 'UNREAD',
    `status` ENUM('ACTIVE', 'COMPLETED') NOT NULL DEFAULT 'ACTIVE',
    `date-time-created` VARCHAR(45) NOT NULL,
    `date-time-modified` VARCHAR(45) NOT NULL,
    `groupID` INT NOT NULL,
    `senderID` INT NOT NULL,
    `user-modifier-ID` INT NOT NULL,
    PRIMARY KEY (`ticketID`),
    KEY `group-ticket-ID_idx` (`groupID`),
    KEY `user-ticket-ID_idx` (`senderID`),
    KEY `modifier-ticket-ID_idx` (`user-modifier-ID`),
    CONSTRAINT `group-ticket-ID` FOREIGN KEY (`groupID`)
        REFERENCES `user-groups` (`groupID`),
    CONSTRAINT `modifier-ticket-ID` FOREIGN KEY (`user-modifier-ID`)
        REFERENCES `users` (`userID`),
    CONSTRAINT `sender-ticket-ID` FOREIGN KEY (`senderID`)
        REFERENCES `users` (`userID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `transactionID` int NOT NULL AUTO_INCREMENT,
  `type` enum('ADDITION','REMOVAL','TRANSFER') NOT NULL,
  `date-time` varchar(30) NOT NULL,
  `notes` varchar(200) NOT NULL DEFAULT '',
  `userID` int NOT NULL,
  `warehouse-from-ID` int NOT NULL,
  `warehouse-to-ID` int NOT NULL,
  PRIMARY KEY (`transactionID`),
  KEY `userID_idx` (`userID`),
  KEY `warehouse-from_idx` (`warehouse-from-ID`),
  KEY `warehouse-to_idx` (`warehouse-to-ID`),
  CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  CONSTRAINT `warehouse-from` FOREIGN KEY (`warehouse-from-ID`) REFERENCES `storage-units` (`warehouseID`),
  CONSTRAINT `warehouse-to` FOREIGN KEY (`warehouse-to-ID`) REFERENCES `storage-units` (`warehouseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `transaction-items`;
CREATE TABLE `transaction-items` (
  `transaction-item-ID` int NOT NULL AUTO_INCREMENT,
  `quantity` int NOT NULL,
  `itemID` int NOT NULL,
  `transactionID` int NOT NULL,
  PRIMARY KEY (`transaction-item-ID`),
  KEY `item-transaction-ID_idx` (`itemID`),
  KEY `transactionID_idx` (`transactionID`),
  CONSTRAINT `item-transaction-ID` FOREIGN KEY (`itemID`) REFERENCES `stock-items` (`itemID`),
  CONSTRAINT `transactionID` FOREIGN KEY (`transactionID`) REFERENCES `transactions` (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4  ;





