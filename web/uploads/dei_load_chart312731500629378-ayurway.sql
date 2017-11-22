CREATE DATABASE  IF NOT EXISTS `ayurway` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ayurway`;
-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: ayurway
-- ------------------------------------------------------
-- Server version	5.5.55-0ubuntu0.14.04.1

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
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT '0',
  `gender` enum('male','female','other') DEFAULT NULL,
  `cancer_type` varchar(255) DEFAULT NULL,
  `cancer_stage` varchar(45) DEFAULT NULL,
  `chemo_pack_type` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'testuser','testuser@test.com','1234567890','tet','te',25,'male','Chondrosarcoma','second','','2017-07-17 07:56:55'),(2,'testuser','testuser@test.com','1234567890','tet','te',22,'male','Chronic myelogenous leukemia','first','','2017-07-17 08:02:10'),(3,'testuser','testuser@test.com','1234567890','tet','d',25,'male','Cervical cancer','second','','2017-07-17 08:27:42'),(4,'','','','','',0,'male','','','','2017-07-17 08:32:27'),(5,'testuser','testuser@test.com','1234567890','tet','te',25,'male','Chronic lymphocytic leukemia','second','','2017-07-17 08:39:37'),(6,'testuser','testuser@test.com','1234567890','tet','te',20,'male','Cervical cancer','second','','2017-07-17 08:44:30'),(7,'testuser','testuser@test.com','1234567890','tet','d',25,'male','Chronic myeloproliferative disorders','te','Pre Chemo Pack','2017-07-17 08:56:08'),(8,'testuser','testuser@test.com','1234567890','tet','te',4,'male','Cervical cancer','first','After Chemo Pack','2017-07-17 08:58:53'),(9,'testuser','adf@daf.com','1234567890','tet','d',25,'male','Bone tumor, osteosarcoma/malignant fibrous histiocytoma','second','During Chemo Pack','2017-07-17 09:01:50'),(10,'testuser','testuser@test.com','1234567890','tet','te',25,'male','Chondrosarcoma','second','During Chemo Pack','2017-07-17 09:05:36'),(11,'testuser','adf@daf.com','1234567890','tet','te',25,'male','Breast cancer','second','Pre Chemo Pack','2017-07-17 09:07:52'),(12,'testuser','testuser@test.com','1234567890','tet','d',25,'male','Osteosarcoma/malignant fibrous histiocytoma of bone','first','Pre Chemo Pack','2017-07-17 09:12:48'),(13,'testuser','testuser@test.com','1234567890','tet','te',25,'male','Carcinoid tumor, gastrointestinal','second','Pre Chemo Pack','2017-07-17 10:08:10'),(14,'testuser','testuser@test.com','1234567890','tet','te',25,'male','Chondrosarcoma','second','After Chemo Pack','2017-07-17 10:09:26'),(15,'testuser','testuser11@test.com','1234567890','tet','te',25,'male','Chondrosarcoma','second','During Chemo Pack','2017-07-17 10:11:05'),(16,'111asdfaf','testuser@test.com','1234567890','af','te',25,'male','Cervical cancer','second','During Chemo Pack','2017-07-17 10:12:43'),(17,'4444444','testuser@test.com','1234567890','tet','te',25,'male','Central nervous system lymphoma, primary','second','After Chemo Pack','2017-07-17 10:13:42'),(18,'44444444','testuser@test.com','1234567890','tet','te',25,'male','Bone tumor, osteosarcoma/malignant fibrous histiocytoma','second','After Chemo Pack','2017-07-17 10:20:02'),(19,'6666666','testuser@test.com','1234567890','tet','te',25,'male','Chronic lymphocytic leukemia','second','During Chemo Pack','2017-07-17 10:20:50'),(20,'55555','adf@daf.com','1234567890','tet','te',25,'male','Chondrosarcoma','second','During Chemo Pack','2017-07-17 10:32:47'),(21,'testuser3434','testuser@test.com','1234567890','tet','te',25,'male','Carcinoid tumor, gastrointestinal','second','During Chemo Pack','2017-07-17 10:34:14'),(22,'testuser','testuser@test.com','1234567890','tet','te',25,'male','Carcinoid tumor, gastrointestinal','second','Pre Chemo Pack','2017-07-17 10:50:42'),(23,'testuser','testuser@test.com','1234567890','tet','te',25,'male','Carcinoid tumor, gastrointestinal','second','Pre Chemo Pack','2017-07-17 10:51:18');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_images`
--

DROP TABLE IF EXISTS `order_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_images`
--

LOCK TABLES `order_images` WRITE;
/*!40000 ALTER TABLE `order_images` DISABLE KEYS */;
INSERT INTO `order_images` VALUES (1,1,'akram-wheel.jpg'),(2,1,'DEI_v1_Logo.png'),(3,5,'5711500280777.jpg'),(4,5,'87131500280777.png'),(5,5,'18201500280777.png'),(6,6,'18261500281070.jpg'),(7,6,'33341500281070.png'),(8,7,'15841500281768.jpg'),(9,7,'64291500281768.png'),(10,7,'89931500281768.png'),(11,8,'51921500281933.png'),(12,8,'22941500281933.png'),(13,9,'82671500282110.png'),(14,10,'19941500282336.png'),(15,11,'6001500282472.jpg'),(16,12,'70921500282768.jpg'),(17,13,'69901500286090.png'),(18,15,'4241500286265.jpg'),(19,16,'46921500286363.png'),(20,17,'72981500286422.png'),(21,18,'20021500286802.png'),(22,19,'24961500286850.png'),(23,20,'43691500287567.jpg'),(24,21,'34081500287654.jpg'),(25,22,'67121500288642.jpg'),(26,23,'57711500288678.jpg');
/*!40000 ALTER TABLE `order_images` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-17 16:53:29
