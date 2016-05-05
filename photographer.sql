-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: IntersogLabs2
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `album/clients`
--

DROP TABLE IF EXISTS `album/clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album/clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `access` enum('read','grant') NOT NULL DEFAULT 'read',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `initiator` (`access`),
  KEY `album` (`album`,`user`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album/clients`
--

LOCK TABLES `album/clients` WRITE;
/*!40000 ALTER TABLE `album/clients` DISABLE KEYS */;
INSERT INTO `album/clients` VALUES (1,1,7,'read','2016-04-04 08:36:55'),(2,1,7,'read','2016-04-04 08:36:55'),(3,1,7,'read','2016-04-04 08:36:55'),(4,1,7,'read','2016-04-04 08:36:55'),(5,1,7,'read','2016-04-04 08:36:55'),(6,2,8,'read','2016-04-04 08:36:55'),(7,2,9,'read','2016-04-04 08:36:55'),(8,3,11,'read','2016-04-04 08:36:55'),(9,4,12,'read','2016-04-04 08:36:55'),(10,4,13,'read','2016-04-04 08:36:55'),(11,5,14,'read','2016-04-04 08:36:55'),(12,6,15,'read','2016-04-04 08:36:55'),(13,6,16,'read','2016-04-04 08:36:55'),(14,6,7,'read','2016-04-04 08:36:55'),(15,6,8,'read','2016-04-04 08:36:55'),(16,5,9,'read','2016-04-04 08:36:55'),(17,5,10,'read','2016-04-04 08:36:55');
/*!40000 ALTER TABLE `album/clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album/images`
--

DROP TABLE IF EXISTS `album/images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album/images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album` int(10) unsigned NOT NULL,
  `image` longblob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `album` (`album`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album/images`
--

LOCK TABLES `album/images` WRITE;
/*!40000 ALTER TABLE `album/images` DISABLE KEYS */;
INSERT INTO `album/images` VALUES (1,1,'img1','2016-04-04 08:36:55'),(2,1,'img2','2016-04-04 08:36:55'),(3,1,'img3','2016-04-04 08:36:55'),(4,1,'img4','2016-04-04 08:36:55'),(5,1,'img5','2016-04-04 08:36:55'),(6,1,'img6','2016-04-04 08:36:55'),(7,4,'img7','2016-04-04 08:36:55'),(8,2,'img1','2016-04-04 08:36:55'),(9,3,'img1','2016-04-04 08:36:55'),(10,5,'img2','2016-04-04 08:36:55'),(11,6,'img3','2016-04-04 08:36:55'),(12,6,'img4','2016-04-04 08:36:55'),(13,6,'img5','2016-04-04 08:36:55');
/*!40000 ALTER TABLE `album/images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `user_2` (`user`),
  CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES (3,3,'a',1,'2016-04-04 08:36:55',NULL),(4,5,'b',1,'2016-04-04 08:36:55',NULL),(5,5,'d',1,'2016-04-04 08:36:55',NULL),(6,6,'c1',1,'2016-04-04 08:36:55',NULL),(7,3,'t',1,'2016-04-07 00:44:23',NULL),(9,6,'1',1,'2016-04-07 00:48:15',NULL),(10,88,'test',1,'2016-04-26 13:53:03',NULL),(11,88,'test',1,'2016-04-26 13:57:23',NULL),(12,88,'test',1,'2016-04-26 13:57:23',NULL),(13,88,'88',1,'2016-04-26 14:04:26',NULL),(14,88,'88',1,'2016-04-26 14:04:26',NULL),(15,88,'88',1,'2016-04-26 14:04:34',NULL),(16,88,'88',1,'2016-04-26 14:04:34',NULL),(17,88,'88',1,'2016-04-26 14:04:40',NULL),(18,88,'88',1,'2016-04-26 14:04:40',NULL),(19,88,'88',1,'2016-04-26 14:04:41',NULL),(20,88,'88',1,'2016-04-26 14:04:41',NULL),(21,88,'88',1,'2016-04-26 14:04:42',NULL),(22,88,'88',1,'2016-04-26 14:04:42',NULL),(23,88,'88',1,'2016-04-26 14:04:46',NULL),(24,88,'88',1,'2016-04-26 14:04:46',NULL),(25,88,'88',1,'2016-04-26 14:04:47',NULL),(26,88,'88',1,'2016-04-26 14:04:47',NULL),(27,88,'88',1,'2016-04-26 14:04:49',NULL),(28,88,'88',1,'2016-04-26 14:04:49',NULL),(29,88,'test',1,'2016-04-26 14:25:00',NULL),(30,88,'test',1,'2016-04-26 14:25:02',NULL),(31,88,'test',1,'2016-04-26 14:25:03',NULL),(32,88,'test',1,'2016-04-26 14:25:05',NULL),(33,88,'test',1,'2016-04-26 14:25:11',NULL),(34,88,'test',1,'2016-04-26 14:25:11',NULL);
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'news 1','1','news 1'),(2,'news 2','2','news 2'),(3,'news3','news3','news3'),(4,'/','','1=1');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `status` enum('new','in progress','reject','done') NOT NULL DEFAULT 'new',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,7,'new',1,'2016-04-04 08:36:55',NULL),(2,7,'new',1,'2016-04-04 11:39:32',NULL),(3,8,'new',1,'2016-04-04 11:39:32',NULL),(4,15,'new',1,'2016-04-04 11:39:32',NULL),(5,16,'new',1,'2016-04-04 11:39:32',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` smallint(5) unsigned NOT NULL,
  `limitation` smallint(5) unsigned NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (1,1,'a',1,10,NULL,1,'2016-04-04 08:36:55',NULL),(2,1,'b',1,100,NULL,1,'2016-04-04 08:36:55',NULL),(3,1,'c',1,1000,NULL,1,'2016-04-04 08:36:55',NULL);
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user/packages`
--

DROP TABLE IF EXISTS `user/packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user/packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `package` (`package`) USING BTREE,
  KEY `user` (`user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user/packages`
--

LOCK TABLES `user/packages` WRITE;
/*!40000 ALTER TABLE `user/packages` DISABLE KEYS */;
INSERT INTO `user/packages` VALUES (6,1,2,'2016-04-04 11:21:49'),(7,1,3,'2016-04-04 11:21:49'),(8,2,4,'2016-04-04 11:21:49'),(9,2,5,'2016-04-04 11:21:49'),(10,3,6,'2016-04-04 11:21:49');
/*!40000 ALTER TABLE `user/packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('client','photographer','admin') NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `token` varchar(64) NOT NULL,
  `phone` char(12) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','ann','ann','ann','24cc65df753de47ba1352bd44883fa71c2751ba1d6d197c94a4378e26b695ce6',NULL,NULL,'2016-04-04 08:36:55'),(3,'photographer','kat','ron','ron','57589e4c86d954f50cd28a1b6cd5322360db68c99a3c55a5d1fe283cdc9a0bfe',NULL,NULL,'2016-04-04 08:36:55'),(5,'photographer','nick','nick','nick','',NULL,NULL,'2016-04-04 08:36:55'),(6,'photographer','ray','ray','ray','',NULL,NULL,'2016-04-04 08:36:55'),(7,'client','client1','client1','client1','',NULL,NULL,'2016-04-04 08:36:55'),(8,'client','client2','client2','client2','',NULL,NULL,'2016-04-04 08:36:55'),(71,'client','client1000','client1009','111','',NULL,NULL,'2016-04-10 21:10:40'),(72,'client','client1000','client100999','111','',NULL,NULL,'2016-04-11 05:34:19'),(73,'client','client1000','client10010','111','',NULL,NULL,'2016-04-11 05:35:20'),(74,'client','client1000','client1010','111','','2147483647',NULL,'2016-04-11 05:48:52'),(75,'client','client1000','client1011','1234567891','','123456789123',NULL,'2016-04-11 05:50:11'),(76,'client','client1000','client1022','1234567891','','123456789123',NULL,'2016-04-11 12:44:49'),(77,'client','client1000','client1026','1234567891','','123456789123',NULL,'2016-04-11 12:46:18'),(78,'client','aaa','aaa','aaa','',NULL,NULL,'2016-04-14 07:45:07'),(79,'client','test','test','test','','111111111111',NULL,'2016-04-14 11:55:53'),(80,'client','test','test2','test','','111111111111',NULL,'2016-04-14 11:57:50'),(81,'','test8','','','',NULL,NULL,'2016-04-14 12:04:29'),(82,'client','client','client2000','client2000','',NULL,NULL,'2016-04-25 06:39:04'),(83,'client','111','111','111','','111111111111',NULL,'2016-04-26 12:01:36'),(84,'client','111','1111','111','',NULL,NULL,'2016-04-26 12:04:19'),(85,'client','111','1121','111','',NULL,NULL,'2016-04-26 12:05:25'),(86,'client','111','1131','111','','111111111111',NULL,'2016-04-26 12:05:33'),(87,'client','111','1141','111','','',NULL,'2016-04-26 12:05:59'),(88,'photographer','test','test1','test','',NULL,NULL,'2016-04-26 13:52:39'),(89,'client','1','1','1','','',NULL,'2016-04-26 14:05:31'),(90,'client','1','11','1','','',NULL,'2016-04-26 14:05:38'),(91,'client','1','11111','1','','',NULL,'2016-04-26 14:05:50'),(92,'client','1','111111','1','','',NULL,'2016-04-26 14:05:55');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-27 11:46:14
