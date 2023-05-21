CREATE DATABASE  IF NOT EXISTS `metro-inventory` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `metro-inventory`;
-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: metro-inventory
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `items-quantities`
--

DROP TABLE IF EXISTS `items-quantities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items-quantities` (
  `itemID` int NOT NULL,
  `warehouseID` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  KEY `warehouseID_idx` (`warehouseID`),
  KEY `itemID_idx` (`itemID`),
  CONSTRAINT `itemID` FOREIGN KEY (`itemID`) REFERENCES `stock-items` (`itemID`),
  CONSTRAINT `warehouseID` FOREIGN KEY (`warehouseID`) REFERENCES `storage-units` (`warehouseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stock-items`
--

DROP TABLE IF EXISTS `stock-items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock-items` (
  `itemID` int NOT NULL AUTO_INCREMENT,
  `item` varchar(45) NOT NULL,
  `category` enum('IT','SERVICE') NOT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `storage-units`
--

DROP TABLE IF EXISTS `storage-units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storage-units` (
  `warehouseID` int NOT NULL AUTO_INCREMENT,
  `warehouse` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  PRIMARY KEY (`warehouseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `ticketID` int NOT NULL AUTO_INCREMENT,
  `message` varchar(300) NOT NULL DEFAULT '',
  `msg-status` enum('READ','UNREAD') NOT NULL DEFAULT 'UNREAD',
  `status` enum('ACTIVE','COMPLETED') NOT NULL DEFAULT 'ACTIVE',
  `date-time-created` varchar(45) NOT NULL,
  `date-time-modified` varchar(45) NOT NULL,
  `groupID` int NOT NULL,
  `senderID` int NOT NULL,
  `user-modifier-ID` int NOT NULL,
  PRIMARY KEY (`ticketID`),
  KEY `group-ticket-ID_idx` (`groupID`),
  KEY `user-ticket-ID_idx` (`senderID`),
  KEY `modifier-ticket-ID_idx` (`user-modifier-ID`),
  CONSTRAINT `group-ticket-ID` FOREIGN KEY (`groupID`) REFERENCES `user-groups` (`groupID`),
  CONSTRAINT `modifier-ticket-ID` FOREIGN KEY (`user-modifier-ID`) REFERENCES `users` (`userID`),
  CONSTRAINT `sender-ticket-ID` FOREIGN KEY (`senderID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `transaction-items`
--

DROP TABLE IF EXISTS `transaction-items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user-groups`
--

DROP TABLE IF EXISTS `user-groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user-groups` (
  `groupID` int NOT NULL AUTO_INCREMENT,
  `group` varchar(45) NOT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-21 22:23:41
