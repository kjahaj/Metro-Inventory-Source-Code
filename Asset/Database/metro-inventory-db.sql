DROP DATABASE IF EXISTS `metro-inventory`;
CREATE SCHEMA `metro-inventory`;
USE `metro-inventory`;

DROP TABLE IF EXISTS `ugroups`;
CREATE TABLE `ugroups` (
    `groupID` INT NOT NULL AUTO_INCREMENT,
    `ugroup` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`groupID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `userID` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `surname` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `password` VARCHAR(45) NOT NULL,
    `groupID` INT NOT NULL,
    PRIMARY KEY (`userID`),
    KEY `groupID_idx` (`groupID`),
    CONSTRAINT `fk_groupID` FOREIGN KEY (`groupID`)
        REFERENCES `ugroups` (`groupID`)
        ON DELETE CASCADE ON UPDATE CASCADE
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;


DROP TABLE IF EXISTS `storageUnits`;
CREATE TABLE `storageUnits` (
    `warehouseID` INT NOT NULL AUTO_INCREMENT,
    `warehouse` VARCHAR(45) NOT NULL,
    `address` VARCHAR(45) NOT NULL,
    `city` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`warehouseID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `stockItems`;
CREATE TABLE `stockItems` (
    `itemID` INT NOT NULL AUTO_INCREMENT,
    `item` VARCHAR(45) NOT NULL,
    `category` ENUM('IT', 'SERVICE') NOT NULL,
    `quantity` INT NOT NULL DEFAULT '0',
    `warehouseID` INT NOT NULL,
    PRIMARY KEY (`itemID`),
    KEY `warehouseID_idx` (`warehouseID`),
    CONSTRAINT `warehouseID` FOREIGN KEY (`warehouseID`)
        REFERENCES `storageUnits` (`warehouseID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
    `ticketID` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(20) NOT NULL,
    `message` VARCHAR(300) NOT NULL DEFAULT '',
    `msgStatus` ENUM('READ', 'UNREAD') NOT NULL DEFAULT 'UNREAD',
    `status` ENUM('OPEN', 'CLOSED') NOT NULL DEFAULT 'OPEN',
    `datetimeCreated` VARCHAR(45) NOT NULL,
    `datetimeModified` VARCHAR(45) NOT NULL,
    `groupID` INT NOT NULL,
    `senderID` INT NOT NULL,
    `umodifierID` INT NOT NULL DEFAULT '0',
    PRIMARY KEY (`ticketID`),
    KEY `group_ticket_ID_idx` (`groupID`),
    KEY `user_ticket_ID_idx` (`senderID`),
    CONSTRAINT `groupTicketID` FOREIGN KEY (`groupID`)
        REFERENCES `ugroups` (`groupID`),
    CONSTRAINT `senderTicketID` FOREIGN KEY (`senderID`)
        REFERENCES `users` (`userID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
    `transactionID` INT NOT NULL AUTO_INCREMENT,
    `type` ENUM('ADDITION', 'REMOVAL', 'TRANSFER') NOT NULL,
    `date-time` VARCHAR(30) NOT NULL,
    `notes` VARCHAR(200) NOT NULL DEFAULT '',
    `userID` INT NOT NULL,
    `whfromID` INT NOT NULL,
    `wtoID` INT NOT NULL,
    PRIMARY KEY (`transactionID`),
    KEY `userID_idx` (`userID`),
    KEY `warehouse_from_idx` (`whfromID`),
    KEY `warehouse_to_idx` (`wtoID`),
    CONSTRAINT `userID` FOREIGN KEY (`userID`)
        REFERENCES `users` (`userID`),
    CONSTRAINT `warehouse_from` FOREIGN KEY (`whfromID`)
        REFERENCES `storageUnits` (`warehouseID`),
    CONSTRAINT `warehouse_to` FOREIGN KEY (`wtoID`)
        REFERENCES `storageUnits` (`warehouseID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `transactionItems`;
CREATE TABLE `transactionItems` (
    `transaction-item-ID` INT NOT NULL AUTO_INCREMENT,
    `quantity` INT NOT NULL,
    `itemID` INT NOT NULL,
    `transactionID` INT NOT NULL,
    PRIMARY KEY (`transaction-item-ID`),
    KEY `item_transaction_ID_idx` (`itemID`),
    KEY `transactionID_idx` (`transactionID`),
    CONSTRAINT `item-transaction-ID` FOREIGN KEY (`itemID`)
        REFERENCES `stockItems` (`itemID`),
    CONSTRAINT `transactionID` FOREIGN KEY (`transactionID`)
        REFERENCES `transactions` (`transactionID`)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8MB4;

INSERT INTO `ugroups` (`groupID`, `ugroup`) VALUES
(1, 'ADMIN'),
(2, 'IT'),
(3, 'SERVICE'),
(4, 'FINANCE'),
(5, 'USER');

INSERT INTO `users`( `userID`, `name`, `surname`, `email`, `password`, `groupID` ) VALUES
( 1, 'Klei', 'Jahaj', 'klei.jahaj21@umt.edu.al', '1234', 1 ),
( 2, 'Eljon', 'Zagradi', 'ezagradi20@umt.edu.al', '1234', 1 ),
( 3, 'Angjelos', 'Goga', 'angjelos.goga21@umt.edu.al', '1234', 1 );