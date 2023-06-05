SET foreign_key_checks = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP TABLE IF EXISTS `stockItems`;
CREATE TABLE `stockItems` (
  `itemID` int NOT NULL,
  `item` varchar(45) COLLATE latin1_bin NOT NULL,
  `category` enum('IT','SERVICE') COLLATE latin1_bin NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `warehouseID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

DROP TABLE IF EXISTS `storageUnits`;
CREATE TABLE `storageUnits` (
  `warehouseID` int NOT NULL,
  `warehouse` varchar(45) COLLATE latin1_bin NOT NULL,
  `address` varchar(45) COLLATE latin1_bin NOT NULL,
  `city` varchar(45) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

TRUNCATE TABLE `storageUnits`;

INSERT INTO `storageUnits` (`warehouseID`, `warehouse`, `address`, `city`) VALUES(1, 'G1 305', 'Sotir Kolea', 'Tirane');
INSERT INTO `storageUnits` (`warehouseID`, `warehouse`, `address`, `city`) VALUES(2, 'G1 205', 'Sotir Kolea', 'Tirane');
INSERT INTO `storageUnits` (`warehouseID`, `warehouse`, `address`, `city`) VALUES(3, 'G2 107', 'Sotir Kolea', 'Tirane');
INSERT INTO `storageUnits` (`warehouseID`, `warehouse`, `address`, `city`) VALUES(4, 'G2 305', 'Sotir Kolea', 'Tirane');

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `ticketID` int NOT NULL,
  `title` varchar(20) COLLATE latin1_bin NOT NULL,
  `message` varchar(300) COLLATE latin1_bin NOT NULL DEFAULT '',
  `msgStatus` enum('READ','UNREAD') COLLATE latin1_bin NOT NULL DEFAULT 'UNREAD',
  `status` enum('OPEN','CLOSED') COLLATE latin1_bin NOT NULL DEFAULT 'OPEN',
  `datetimeCreated` varchar(45) COLLATE latin1_bin NOT NULL,
  `datetimeModified` varchar(45) COLLATE latin1_bin NOT NULL,
  `groupID` int NOT NULL,
  `senderID` int NOT NULL,
  `umodifierID` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

DROP TABLE IF EXISTS `transactionItems`;
CREATE TABLE `transactionItems` (
  `transaction-item-ID` int NOT NULL,
  `quantity` int NOT NULL,
  `itemID` int NOT NULL,
  `transactionID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `transactionID` int NOT NULL,
  `type` enum('ADDITION','REMOVAL','TRANSFER') COLLATE latin1_bin NOT NULL,
  `date-time` varchar(30) COLLATE latin1_bin NOT NULL,
  `notes` varchar(200) COLLATE latin1_bin NOT NULL DEFAULT '',
  `userID` int NOT NULL,
  `whfromID` int NOT NULL,
  `wtoID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

DROP TABLE IF EXISTS `ugroups`;
CREATE TABLE `ugroups` (
  `groupID` int NOT NULL,
  `ugroup` varchar(45) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

TRUNCATE TABLE `ugroups`;

INSERT INTO `ugroups` (`groupID`, `ugroup`) VALUES(1, 'ADMIN');
INSERT INTO `ugroups` (`groupID`, `ugroup`) VALUES(2, 'IT');
INSERT INTO `ugroups` (`groupID`, `ugroup`) VALUES(3, 'SERVICE');
INSERT INTO `ugroups` (`groupID`, `ugroup`) VALUES(4, 'FINANCE');
INSERT INTO `ugroups` (`groupID`, `ugroup`) VALUES(5, 'USER');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int NOT NULL,
  `name` varchar(45) COLLATE latin1_bin NOT NULL,
  `surname` varchar(45) COLLATE latin1_bin NOT NULL,
  `email` varchar(45) COLLATE latin1_bin NOT NULL,
  `password` varchar(45) COLLATE latin1_bin NOT NULL,
  `groupID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

TRUNCATE TABLE `users`;

INSERT INTO `users` (`userID`, `name`, `surname`, `email`, `password`, `groupID`) VALUES(1, 'Klei', 'Jahaj', 'klei.jahaj21@umt.edu.al', '1234', 1);
INSERT INTO `users` (`userID`, `name`, `surname`, `email`, `password`, `groupID`) VALUES(2, 'Eljon', 'Zagradi', 'ezagradi20@umt.edu.al', '1234', 1);
INSERT INTO `users` (`userID`, `name`, `surname`, `email`, `password`, `groupID`) VALUES(3, 'Angjelos', 'Goga', 'angjelos.goga21@umt.edu.al', '1234', 1);
INSERT INTO `users` (`userID`, `name`, `surname`, `email`, `password`, `groupID`) VALUES(4, 'Admin', 'User', 'admin@umt.edu.al', '1234', 1);

ALTER TABLE `stockItems`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `warehouseID_idx` (`warehouseID`);

ALTER TABLE `storageUnits`
  ADD PRIMARY KEY (`warehouseID`);

ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `group_ticket_ID_idx` (`groupID`),
  ADD KEY `user_ticket_ID_idx` (`senderID`);

ALTER TABLE `transactionItems`
  ADD PRIMARY KEY (`transaction-item-ID`),
  ADD KEY `item_transaction_ID_idx` (`itemID`),
  ADD KEY `transactionID_idx` (`transactionID`);

ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `userID_idx` (`userID`),
  ADD KEY `warehouse_from_idx` (`whfromID`),
  ADD KEY `warehouse_to_idx` (`wtoID`);

ALTER TABLE `ugroups`
  ADD PRIMARY KEY (`groupID`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `groupID_idx` (`groupID`);

ALTER TABLE `stockItems`
  MODIFY `itemID` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `storageUnits`
  MODIFY `warehouseID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `tickets`
  MODIFY `ticketID` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `transactionItems`
  MODIFY `transaction-item-ID` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `transactions`
  MODIFY `transactionID` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `ugroups`
  MODIFY `groupID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `stockItems`
  ADD CONSTRAINT `warehouse_ID` FOREIGN KEY (`warehouseID`) REFERENCES `storageUnits` (`warehouseID`);

ALTER TABLE `tickets`
  ADD CONSTRAINT `groupTicketID` FOREIGN KEY (`groupID`) REFERENCES `ugroups` (`groupID`),
  ADD CONSTRAINT `senderTicketID` FOREIGN KEY (`senderID`) REFERENCES `users` (`userID`);

ALTER TABLE `transactionItems`
  ADD CONSTRAINT `item-transactionID` FOREIGN KEY (`itemID`) REFERENCES `stockItems` (`itemID`),
  ADD CONSTRAINT `transaction_ID` FOREIGN KEY (`transactionID`) REFERENCES `transactions` (`transactionID`);

ALTER TABLE `transactions`
  ADD CONSTRAINT `userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `warehouse_from` FOREIGN KEY (`whfromID`) REFERENCES `storageUnits` (`warehouseID`),
  ADD CONSTRAINT `warehouse_to` FOREIGN KEY (`wtoID`) REFERENCES `storageUnits` (`warehouseID`);

ALTER TABLE `users`
  ADD CONSTRAINT `fk_groupID` FOREIGN KEY (`groupID`) REFERENCES `ugroups` (`groupID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
SET foreign_key_checks = 1;
