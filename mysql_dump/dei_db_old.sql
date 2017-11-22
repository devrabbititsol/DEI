CREATE DATABASE  IF NOT EXISTS `dei_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dei_db`;
-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: dei_db
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
-- Table structure for table `core_city`
--

DROP TABLE IF EXISTS `core_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  `region_id` int(11) NOT NULL,
  `city_status` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1= active, 2=in-active',
  PRIMARY KEY (`city_id`),
  KEY `region_id` (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_city`
--

LOCK TABLES `core_city` WRITE;
/*!40000 ALTER TABLE `core_city` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_contact_details`
--

DROP TABLE IF EXISTS `core_contact_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_contact_details` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `message` text,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_contact_details`
--

LOCK TABLES `core_contact_details` WRITE;
/*!40000 ALTER TABLE `core_contact_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_contact_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_job_applicants`
--

DROP TABLE IF EXISTS `core_job_applicants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_job_applicants` (
  `applicant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `expert_at` int(11) NOT NULL,
  `equipment_capacity_id` varchar(45) DEFAULT NULL,
  `home_experience` int(11) DEFAULT '0',
  `abroad_experience` int(11) DEFAULT '0',
  `technical_skill` varchar(45) DEFAULT NULL,
  `current_salary` int(11) DEFAULT '0',
  `expected_salary` int(11) DEFAULT '0',
  `father_name` varchar(45) NOT NULL,
  `date_of_birth` date NOT NULL,
  `marital_status` enum('married','unmarried') NOT NULL,
  `nationality` varchar(45) DEFAULT 'IN',
  `permanant_address` text NOT NULL,
  `emergency_number` varchar(45) NOT NULL,
  `blood_group` varchar(30) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `education` varchar(45) NOT NULL,
  `aadhar` varchar(255) NOT NULL COMMENT 'aadhar file path',
  `license` varchar(255) NOT NULL COMMENT 'license file path',
  `resume` varchar(45) NOT NULL COMMENT 'resume file path',
  `photo` varchar(45) NOT NULL COMMENT 'photo file path',
  `passport` varchar(45) DEFAULT NULL COMMENT 'passport file path',
  `certificates` varchar(255) NOT NULL COMMENT 'certificates files path',
  `applicant_type` int(11) NOT NULL COMMENT '1=operator, 2=helper',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_job_applicants`
--

LOCK TABLES `core_job_applicants` WRITE;
/*!40000 ALTER TABLE `core_job_applicants` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_job_applicants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_job_applicants_language`
--

DROP TABLE IF EXISTS `core_job_applicants_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_job_applicants_language` (
  `applicant_language_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `language_name` varchar(45) NOT NULL,
  `language_read` enum('biginner','expert') NOT NULL,
  `language_write` enum('biginner','expert') NOT NULL,
  `language_speak` enum('biginner','expert') NOT NULL,
  PRIMARY KEY (`applicant_language_id`),
  KEY `applicant_id` (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_job_applicants_language`
--

LOCK TABLES `core_job_applicants_language` WRITE;
/*!40000 ALTER TABLE `core_job_applicants_language` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_job_applicants_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_job_applications`
--

DROP TABLE IF EXISTS `core_job_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_job_applications` (
  `application_id` int(11) NOT NULL,
  `job_id` varchar(45) NOT NULL,
  `applicant_id` varchar(45) NOT NULL,
  `applied_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`application_id`),
  KEY `job_id` (`job_id`),
  KEY `applicant_id` (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_job_applications`
--

LOCK TABLES `core_job_applications` WRITE;
/*!40000 ALTER TABLE `core_job_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_job_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_job_equipment_capacity`
--

DROP TABLE IF EXISTS `core_job_equipment_capacity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_job_equipment_capacity` (
  `equipment_capacity_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_equipment_id` int(11) NOT NULL,
  `equipment_capacity_title` varchar(45) NOT NULL,
  PRIMARY KEY (`equipment_capacity_id`),
  KEY `sub_equipment_id` (`sub_equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_job_equipment_capacity`
--

LOCK TABLES `core_job_equipment_capacity` WRITE;
/*!40000 ALTER TABLE `core_job_equipment_capacity` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_job_equipment_capacity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_job_equipments`
--

DROP TABLE IF EXISTS `core_job_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_job_equipments` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_title` varchar(45) NOT NULL,
  PRIMARY KEY (`equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_job_equipments`
--

LOCK TABLES `core_job_equipments` WRITE;
/*!40000 ALTER TABLE `core_job_equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_job_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_job_sub_equipment_subtype`
--

DROP TABLE IF EXISTS `core_job_sub_equipment_subtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_job_sub_equipment_subtype` (
  `sub_equipment_subtype_id` int(11) NOT NULL,
  `sub_equipment_id` int(11) NOT NULL,
  `equipment_subtype_title` varchar(45) NOT NULL,
  PRIMARY KEY (`sub_equipment_subtype_id`),
  KEY `sub_equipment_id` (`sub_equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_job_sub_equipment_subtype`
--

LOCK TABLES `core_job_sub_equipment_subtype` WRITE;
/*!40000 ALTER TABLE `core_job_sub_equipment_subtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_job_sub_equipment_subtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_job_sub_equipments`
--

DROP TABLE IF EXISTS `core_job_sub_equipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_job_sub_equipments` (
  `sub_equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_equipment_title` varchar(250) NOT NULL COMMENT 'Only contains Need Helper or Need\nOperator',
  `equipment_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_equipment_id`),
  KEY `equipment_id` (`equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_job_sub_equipments`
--

LOCK TABLES `core_job_sub_equipments` WRITE;
/*!40000 ALTER TABLE `core_job_sub_equipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_job_sub_equipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_jobs`
--

DROP TABLE IF EXISTS `core_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(45) NOT NULL,
  `contact_person_name` varchar(45) NOT NULL,
  `contact_person_email` varchar(45) NOT NULL,
  `contact_person_phone` varchar(45) NOT NULL,
  `company_name` varchar(45) NOT NULL,
  `company_email` varchar(45) NOT NULL,
  `designation` varchar(45) NOT NULL,
  `company_address` text,
  `company_logo` varchar(45) DEFAULT NULL,
  `need_expert_on` int(11) NOT NULL,
  `experience` int(11) NOT NULL DEFAULT '0',
  `salary` int(11) NOT NULL DEFAULT '0',
  `number_of_vacancies` int(11) NOT NULL DEFAULT '0',
  `job_description` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL COMMENT 'job posted by',
  `job_type` int(11) NOT NULL COMMENT '1=operator, 2=helper',
  PRIMARY KEY (`job_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_jobs`
--

LOCK TABLES `core_jobs` WRITE;
/*!40000 ALTER TABLE `core_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_order_lifecycle`
--

DROP TABLE IF EXISTS `core_order_lifecycle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_order_lifecycle` (
  `order_lifecycle_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Updated by',
  `order_status` int(11) NOT NULL,
  `date_approved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_lifecycle_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_order_lifecycle`
--

LOCK TABLES `core_order_lifecycle` WRITE;
/*!40000 ALTER TABLE `core_order_lifecycle` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_order_lifecycle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_orders`
--

DROP TABLE IF EXISTS `core_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text,
  `type` int(11) NOT NULL COMMENT '0=hire, 1=sale, 2=both',
  `order_status` int(11) NOT NULL COMMENT '1=pending (approve by sales ex), 2= approved by\nsales manager, 3=approved, 4=rejected, 5 = re-initialized, 6=closed',
  `manual_order_code` varchar(20) DEFAULT NULL,
  `no_of_days` int(11) DEFAULT '0',
  PRIMARY KEY (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_orders`
--

LOCK TABLES `core_orders` WRITE;
/*!40000 ALTER TABLE `core_orders` DISABLE KEYS */;
INSERT INTO `core_orders` VALUES (1,1,1000,'2017-07-13 00:00:00','2017-07-15 00:00:00','2017-07-25 07:38:13','teesst',0,1,'YFC935A117VK1',2),(2,1,1018,'2017-07-20 00:00:00','2017-07-27 00:00:00','2017-07-25 08:19:54','dsafasdfasdfasdfa sdf ',0,1,'QCVZ4IEG4KYG2',7),(3,1,1018,'2017-07-20 00:00:00','2017-07-27 00:00:00','2017-07-25 08:22:15','dsafasdfasdfasdfa sdf ',0,1,'RQ9QEFTD8OE03',7),(4,1,1019,'2017-07-13 00:00:00','2017-08-26 00:00:00','2017-07-25 08:32:26','asdfasdfasdf',0,1,'BMQ84JP64E1D4',44),(5,5,1019,'2017-07-13 00:00:00',NULL,'2017-07-25 08:33:56','sdfadfasfd',1,1,'J87TXDADDRHJ5',0),(6,4,1019,'2017-07-05 00:00:00',NULL,'2017-07-25 08:38:46','asdfasdfadf',1,1,'ALIOQ8URLAQF6',0),(7,5,1019,'2017-07-06 00:00:00',NULL,'2017-07-25 08:43:51','asdfasdfasf',1,1,'J5CEA3HJ2F3P7',0),(8,5,1019,'2017-07-05 00:00:00',NULL,'2017-07-25 09:12:23','asdfasdf',1,1,'J3TMK0WLC4ZS8',0),(9,4,1019,'2017-07-05 00:00:00',NULL,'2017-07-25 09:12:23','asdfasdf',1,1,'2KADLRJVMLZN9',0),(10,5,1019,'2017-07-07 00:00:00',NULL,'2017-07-25 09:14:13','asdfasfasdfasdf',1,1,'F7W7DQNMJ6Z10',0),(11,4,1019,'2017-07-07 00:00:00',NULL,'2017-07-25 09:14:13','asdfasfasdfasdf',1,1,'UXL60FWI86J11',0),(12,5,1019,'2017-07-13 00:00:00',NULL,'2017-07-25 09:15:40','asdfasdfa',1,1,'CH0L2DWSQ1P12',0),(13,4,1019,'2017-07-13 00:00:00',NULL,'2017-07-25 09:15:40','asdfasdfa',1,1,'DZTTD53AVOX13',0),(14,5,1019,'2017-07-20 00:00:00',NULL,'2017-07-25 09:16:30','asdfasdf',1,1,'6KOB6WA26CA14',0),(15,5,1000,'2017-07-06 00:00:00',NULL,'2017-07-25 14:23:43','',1,1,'YVTVLBQTKV515',0),(16,5,1000,'2017-07-06 00:00:00',NULL,'2017-07-25 14:40:28','asdfasdf',1,1,'1JAYI4AWY4W16',0),(17,5,1000,'2017-07-06 00:00:00',NULL,'2017-07-25 14:41:01','dfasdfasdf',1,1,'HJXP1V6H1U217',0),(18,5,1000,'2017-07-06 00:00:00',NULL,'2017-07-25 14:42:01','adfadf',1,1,'LGDMXWWISOR18',0),(19,30,1000,'2017-07-06 00:00:00','2017-07-09 00:00:00','2017-07-25 14:44:19','sadf',0,1,'SD0MDMA88II19',3),(20,24,1000,'2017-07-21 00:00:00','2017-07-26 00:00:00','2017-07-25 14:45:40','adfaf',0,1,'WYAHUH9FAKL20',5),(21,24,1000,'2017-07-20 00:00:00','2017-07-23 00:00:00','2017-07-25 14:47:03','adfsa',0,1,'EX91KHJYZ2221',3);
/*!40000 ALTER TABLE `core_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_post_ads`
--

DROP TABLE IF EXISTS `core_post_ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_post_ads` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ad_title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL,
  `ad_status` int(11) NOT NULL COMMENT '0=Pending,1=Approved',
  `ad_weblink` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_post_ads`
--

LOCK TABLES `core_post_ads` WRITE;
/*!40000 ALTER TABLE `core_post_ads` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_post_ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_product_capacity`
--

DROP TABLE IF EXISTS `core_product_capacity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_product_capacity` (
  `capacity_id` int(11) NOT NULL AUTO_INCREMENT,
  `capacity_name` varchar(255) DEFAULT NULL,
  `capacity_range` varchar(50) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `capacity_status` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1= active, 2=in-active',
  `values1` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`capacity_id`),
  KEY `category_id` (`category_id`),
  KEY `sub_category_id` (`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_capacity`
--

LOCK TABLES `core_product_capacity` WRITE;
/*!40000 ALTER TABLE `core_product_capacity` DISABLE KEYS */;
INSERT INTO `core_product_capacity` VALUES (1,'0 to 50 Tons','0 and 50',1,1,1,'50',5000.00),(2,'51 to 70 Tons','51 and 70',1,1,1,'70',5000.00),(3,'71 to 100 Tons','71 and 100',1,1,1,'100',10000.00),(4,'101 to 125 Tons','101 and 125',1,1,1,'125',10000.00),(5,'126 to 150 Tons','126 and 150',1,1,1,'150',10000.00),(6,'151 to 200 Tons','151 and 200',1,1,1,'200',25000.00),(7,'201 to 250 Tons','201 and 250',1,1,1,'250',25000.00),(8,' 251 to 300 Tons','251 and 300',1,1,1,'300',25000.00),(9,'301 to 350 Tons','301 and 350',1,1,1,'350',25000.00),(10,'351 to 400 Tons','351 and 400',1,1,1,'400',25000.00),(11,'401 to 500 Tons','401 and 500',1,1,1,'500',25000.00),(12,'500 Tons above','>500',1,1,1,'501',25000.00),(13,'0 to 50 Tons','0 and 50',2,1,1,'50',5000.00),(14,'51 to 70 Tons','51 and 70',2,1,1,'70',5000.00),(15,'71 to 100 Tons','71 and 100',2,1,1,'100',10000.00),(16,'101 to 125 Tons','101 and 125',2,1,1,'125',10000.00),(17,'125 to 150 Tons','125 and 150',2,1,1,'150',10000.00),(18,'151 to 200 Tons','151 and 200',2,1,1,'200',10000.00),(19,'201 to 250 Tons','201 and 250',2,1,1,'250',25000.00),(20,'251 to 300 Tons','251 and 300',2,1,1,'300',0.00),(21,'301 to 350 Tons','301 and 350',2,1,1,'350',0.00),(22,'351 to 400 Tons','351 and 400',2,1,1,'400',0.00),(23,'401 to 500 Tons','401 and 500',2,1,1,'500',0.00),(24,'500 Tons above','>500',2,1,1,'501',0.00),(25,'0 to 50 Tons','0 and 50',3,1,1,'50',0.00),(26,'51 to 70 Tons','51 and 70',3,1,1,'70',0.00),(27,'71 to 100 Tons','71 and 100',3,1,1,'100',0.00),(28,'101 to 125 Tons','101 and 125',3,1,1,'125',0.00),(29,'126 to 150 Tons','126 and 150',3,1,1,'150',0.00),(30,'151 to 200 Tons','151 and 200',3,1,1,'200',0.00),(31,'201 to 250 Tons','201 and 250',3,1,1,'250',0.00),(32,'251 to 300 Tons','251 and 300',3,1,1,'300',0.00),(33,'301 to 350 Tons','301 and 350',3,1,1,'350',0.00),(34,'351 to 400 Tons','351 and 400',3,1,1,'400',0.00),(35,'401 to 500 Tons','401 and 500',3,1,1,'500',0.00),(36,'500 Tons above','>500',3,1,1,'501',0.00),(37,'0 to 50 Tons','0 and 50',4,1,1,'50',0.00),(38,'51 to 70 Tons','51 and 70',4,1,1,'70',0.00),(39,'71 to 100 Tons','71 and 100',4,1,1,'100',0.00),(40,'101 to 125 Tons','101 and 125',4,1,1,'125',0.00),(41,'126 to 150 Tons','126 and 150',4,1,1,'150',0.00),(42,'151 to 200 Tons','151 and 200',4,1,1,'200',0.00),(43,'201 to 250 Tons','201 and 250',4,1,1,'250',0.00),(44,'251 to 300 Tons','251 and 300',4,1,1,'300',0.00),(45,'301 to 350 Tons','301 and 350',4,1,1,'350',0.00),(46,'351 to 400 Tons','351 and 400',4,1,1,'400',0.00),(47,'401 to 500 Tons','401 and 500',4,1,1,'500',0.00),(48,'500 Tons & above','>500',4,1,1,'501',0.00),(49,'0 to 2 Tons','0 and 2',5,1,1,'2',0.00),(51,'3 Tons above','>3',5,1,1,'4',0.00),(52,'0 to 99 Tons','0 and 99',6,1,1,'100',0.00),(53,'100 Tons above','>100',6,1,1,'101',0.00),(54,'0 to 1 Tons','0 and 1',7,1,1,'1',0.00),(55,'2 to 3 Tons','2 and 3',7,1,1,'2',0.00),(57,'4 Tons above','>4',7,1,1,'4',0.00),(58,'0 to 25 Tons','0 and 25',10,1,1,'25',0.00),(59,'26 Tons Above','>26',10,1,1,'26',0.00),(60,'0 to 35 Tons','0 and 35',33,1,1,'35',0.00),(61,'35 Tons Above','>35',33,1,1,'36',0.00),(62,'0-130 KN','0 and 130',29,5,1,'130',0.00),(63,'131-180 KN','131 and 180',29,5,1,'180',0.00),(64,'181-360 KN','181 and 360',29,5,1,'360',0.00),(65,'361 KN above','>361',29,5,1,'361',0.00),(66,'0-70 KVA','0 and 70',23,4,1,'70',0.00),(67,'71-80 KVA','71 and 80',23,4,1,'80',0.00),(68,'81-125 KVA','81 and 125',23,4,1,'125',0.00),(69,'126-160 KVA','126 and 160',23,4,1,'160',0.00),(70,'161-225 KVA','161 and 225',23,4,1,'225',0.00),(71,'226-250 KVA','226 and 250',23,4,1,'250',0.00),(72,'251-320 KVA','251 and 320',23,4,1,'320',0.00),(73,'321-400 KVA','321 and 400',23,4,1,'400',0.00),(74,'401-500 KVA','401 and 500',23,4,1,'500',0.00),(75,'501-750 KVA','501 and 750',23,4,1,'750',0.00),(76,'751-810 KVA','751 and 810',23,4,1,'810',0.00),(77,'811-1010 KVA','811 and 1010',23,4,1,'1010',0.00),(78,'1250-1500 KVA','1250 and 1500',23,4,1,'1500',0.00),(79,'1501-1750 KVA','1501 and 1750',23,4,1,'1750',0.00),(80,'1875-2250 KVA','1875 and 2250',23,4,1,'2250',0.00),(81,'2750-3750 KVA','2750 and 3750',23,4,1,'3750',0.00),(82,'3750 KVA above','>3750',23,4,1,'3751',0.00),(83,'0-70 KVA','0 and 70',24,4,1,'70',0.00),(84,'71-80 KVA','71 and 80',24,4,1,'80',0.00),(85,'81-125 KVA','81 and 125',24,4,1,'125',0.00),(86,'126-160 KVA','126 and 160',24,4,1,'160',0.00),(87,'161-225 KVA','161 and 225',24,4,1,'225',0.00),(88,'226-250 KVA','226 and 250',24,4,1,'250',0.00),(89,'251-320 KVA','251 and 320',24,4,1,'320',0.00),(90,'321-400 KVA','321 and 400',24,4,1,'400',0.00),(91,'401-500 KVA','401 and 500',24,4,1,'500',0.00),(92,'501-750 KVA','501 and 750',24,4,1,'750',0.00),(93,'751-810 KVA','751 and 810',24,4,1,'810',0.00),(94,'811-1010 KVA','811 and 1010',24,4,1,'1010',0.00),(95,'1250-1500 KVA','1250 and 1500',24,4,1,'1500',0.00),(96,'1501-1750 KVA','1501 and 1750',24,4,1,'1750',0.00),(97,'1875-2250 KVA','1875 and 2250',24,4,1,'2250',0.00),(98,'2750-3750 KVA','2750 and 3750',24,4,1,'3750',0.00),(99,'3751 KVA above','>3751',24,4,1,'3751',0.00),(100,'0-70 KVA','0 and 70',25,4,1,'70',0.00),(101,'71-80 KVA','71 and 80',25,4,1,'80',0.00),(102,'81-125 KVA','81 and 125',25,4,1,'125',0.00),(103,'126-160 KVA','126 and 160',25,4,1,'160',0.00),(104,'161-225 KVA','161 and 225',25,4,1,'225',0.00),(105,'226-250 KVA','226 and 250',25,4,1,'250',0.00),(106,'251-320 KVA','251 and 320',25,4,1,'320',0.00),(107,'321-400 KVA','321 and 400',25,4,1,'400',0.00),(108,'401-500 KVA','401 and 500',25,4,1,'500',0.00),(109,'501-750 KVA','501 and 750',25,4,1,'750',0.00),(110,'751-810 KVA','751 and 810',25,4,1,'810',0.00),(111,'811-1010 KVA','811 and 1010',25,4,1,'1010',0.00),(112,'1250-1500 KVA','1250 and 1500',25,4,1,'1500',0.00),(113,'1501-1750 KVA','1501 and 1750',25,4,1,'1750',0.00),(114,'1875-2250 KVA','1875 and 2250',25,4,1,'2250',0.00),(115,'2750-3750 KVA','2750 and 3750',25,4,1,'3750',0.00),(116,'3751 KVA above','>3751',25,4,1,'3751',0.00),(117,'0-70 KVA','0 and 70',26,4,1,'70',0.00),(118,'71-80 KVA','71 and 80',26,4,1,'80',0.00),(119,'81-125 KVA','81 and 125',26,4,1,'125',0.00),(120,'126-160 KVA','126 and 160',26,4,1,'160',0.00),(121,'161-225 KVA','161 and 225',26,4,1,'225',0.00),(122,'226-250 KVA','226 and 250',26,4,1,'250',0.00),(123,'251-320 KVA','251 and 320',26,4,1,'320',0.00),(124,'321-400 KVA','321 and 400',26,4,1,'400',0.00),(125,'401-500 KVA','401 and 500',26,4,1,'500',0.00),(126,'501-750 KVA','501 and 750',26,4,1,'750',0.00),(127,'751-810 KVA','751 and 810',26,4,1,'810',0.00),(128,'811-1010 KVA','811 and 1010',26,4,1,'1010',0.00),(129,'1250-1500 KVA','1250 and 1500',26,4,1,'1500',0.00),(130,'1501-1750 KVA','1501 and 1750',26,4,1,'1750',0.00),(131,'1875-2250 KVA','1875 and 2250',26,4,1,'2250',0.00),(132,'2750-3750 KVA','2750 and 3750',26,4,1,'3750',0.00),(133,'3751 KVA above','>3751',26,4,1,'3751',0.00),(134,'0-70 KVA','0 and 70',27,4,1,'70',0.00),(135,'71-80 KVA','71 and 80',27,4,1,'80',0.00),(136,'81-125 KVA','81 and 125',27,4,1,'125',0.00),(137,' 126-160 KVA','126 and 160',27,4,1,'160',0.00),(138,'161-225 KVA','161 and 225',27,4,1,'225',0.00),(139,' 226-250 KVA','226 and 250',27,4,1,'260',0.00),(140,'251-320 KVA','251 and 320',27,4,1,'320',0.00),(141,'321-400 KVA','321 and 400',27,4,1,'400',0.00),(142,'401-500 KVA','401 and 500',27,4,1,'500',0.00),(143,'501-750 KVA','501 and 750',27,4,1,'750',0.00),(144,'751-810 KVA','751 and 810',27,4,1,'810',0.00),(145,'811-1010 KVA','811 and 1010',27,4,1,'1010',0.00),(146,'1250-1500 KVA','1250 and 1500',27,4,1,'1500',0.00),(147,'1501-1750 KVA','1501 and 1750',27,4,1,'1750',0.00),(148,'1875-2250 KVA','1875 and 2250',27,4,1,'2250',0.00),(149,'2750-3750 KVA','2750 and 3750',27,4,1,'3750',0.00),(150,'3751 KVA above','>3751',27,4,1,'3751',0.00),(151,'50-70 KVA','50 and 70',28,4,1,'70',0.00),(152,'70-80 KVA','70 and 80',28,4,1,'80',0.00),(153,'80-125 KVA','80 and 125',28,4,1,'125',0.00),(154,'125-160 KVA','125 and 160',28,4,1,'160',0.00),(155,'160-225 KVA','160 and 225',28,4,1,'225',0.00),(156,'225-250 KVA','225 and 250',28,4,1,'250',0.00),(157,'250-320 KVA','250 and 320',28,4,1,'320',0.00),(158,'320-400 KVA','320 and 400',28,4,1,'400',0.00),(159,'400-500 KVA','400 and 500',28,4,1,'500',0.00),(160,'500-750 KVA','500 and 750',28,4,1,'750',0.00),(161,'750-810 KVA','750 and 810',28,4,1,'810',0.00),(162,'810-1010 KVA','810 and 1010',28,4,1,'1010',0.00),(163,'1250-1500 KVA','1250 and 1500',28,4,1,'1500',0.00),(164,'1500-1750 KVA','1500 and 1750',28,4,1,'1750',0.00),(165,'1875-2250 KVA','1875 and 2250',28,4,1,'2250',0.00),(166,'2750-3750 KVA','2750 and 3750',28,4,1,'3750',0.00),(167,'3750 KVA above','>3750',28,4,1,'3751',0.00),(168,'0 - 1 Tons','0 and 1',17,3,1,'2',0.00),(169,'2 Tons Above','>2',17,3,1,'3',0.00),(174,'0-20 Tons','0 and 20',21,3,1,'20',0.00),(175,'21-50 Tons','21 and 50',21,3,1,'50',0.00),(176,'51-80 Tons','51 and 80',21,3,1,'80',0.00),(177,'81 Tons Above','>81',21,3,1,'81',0.00),(178,'0-10 Tons','0 and 10',12,2,1,'10',0.00),(179,'11-40 Tons','11 and 40',12,2,1,'39',0.00),(180,'41 & above','>41',12,2,1,'40',0.00),(181,'0-10 Tons','0 and 10',13,2,1,'10',0.00),(182,'11-40 Tons','11 and 40',13,2,1,'39',0.00),(183,'41 & above','>41',13,2,1,'40',0.00),(184,'0-10 Tons','0 and 10',14,2,1,'10',0.00),(185,'11-40 Tons','11 and 40',14,2,1,'39',0.00),(186,'41 & above','>41',14,2,1,'40',0.00),(187,'0-10 Tons','0 and 10',15,2,1,'10',0.00),(188,'11-40 Tons','11 and 40',15,2,1,'39',0.00),(189,'41 & above','>41',15,2,1,'40',0.00),(190,'0-10 Tons','0 and 10',16,2,1,'10',0.00),(191,'11-40 Tons','11 and 40',16,2,1,'39',0.00),(192,'41 & above','>41',16,2,1,'40',0.00);
/*!40000 ALTER TABLE `core_product_capacity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_product_categories`
--

DROP TABLE IF EXISTS `core_product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_product_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_slug` varchar(250) DEFAULT NULL,
  `category_fields` varchar(1000) DEFAULT NULL,
  `category_status` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1= active, 2=in-active',
  `display_order` int(11) DEFAULT NULL,
  `metric` varchar(10) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_categories`
--

LOCK TABLES `core_product_categories` WRITE;
/*!40000 ALTER TABLE `core_product_categories` DISABLE KEYS */;
INSERT INTO `core_product_categories` VALUES (1,'Cranes','cranes','boomlength,fly_jib,model,luffing_jib,load_chart,register_num,life_tax_details',1,1,'Tons'),(2,'Dumpers','dumper','life_tax_details,register_num,model,no_axles',1,4,'Tons'),(3,'Excavators','excavators','model,arm_length,bucket_capacity',1,3,'Tons'),(4,'Generators','generators','model',1,5,'KVA'),(5,'Piling Rigs','piling rigs','model,kelly_length',1,2,'KN');
/*!40000 ALTER TABLE `core_product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_product_images`
--

DROP TABLE IF EXISTS `core_product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_product_images` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `image_type` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1= gallery, 2=load_chart',
  `image_status` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1= active, 2=in-active',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_image_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_images`
--

LOCK TABLES `core_product_images` WRITE;
/*!40000 ALTER TABLE `core_product_images` DISABLE KEYS */;
INSERT INTO `core_product_images` VALUES (1,1,'dei_77981500895213','uploads/dei_77981500895213',1,1,'2017-07-24 11:20:23'),(2,1,'dei_load_chart57751500895217','uploads/dei_load_chart57751500895217',2,1,'2017-07-24 11:20:23'),(3,2,'dei_183851500895869','uploads/dei_183851500895869',1,1,'2017-07-24 11:31:14'),(4,2,'dei_load_chart353741500895777','uploads/dei_load_chart353741500895777',2,1,'2017-07-24 11:31:14'),(5,3,'dei_62231500902722','/uploads/dei_62231500902722',1,1,'2017-07-24 13:25:29'),(6,4,'dei_338071500902973','/uploads/dei_338071500902973',1,1,'2017-07-24 13:34:03'),(7,5,'dei_104461500904728','/uploads/dei_104461500904728',1,1,'2017-07-24 14:00:14'),(8,5,'dei_430981500904732','/uploads/dei_430981500904732',1,1,'2017-07-24 14:00:14'),(9,5,'dei_94401500904741','/uploads/dei_94401500904741',1,1,'2017-07-24 14:00:14'),(10,6,'/tmp/phpwU2e09','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 05:04:54'),(11,6,'/tmp/phpFCczUT','http://localhost:8080/uploads/dei_330301500959076',1,1,'2017-07-25 05:04:54'),(12,7,'bc_96891494576315-8602.jpg','http://localhost:8080/uploads/dei_397321500959667',1,1,'2017-07-25 05:14:43'),(13,7,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(14,8,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(15,9,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(16,10,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(17,11,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(18,12,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(19,13,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(20,14,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(21,15,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(22,16,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_134691500959667',1,1,'2017-07-25 05:14:43'),(23,24,'bc_98151494361660-Lighthouse.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 10:59:50'),(24,24,'bc_98151494361660-Lighthouse.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 10:59:50'),(25,24,'bc_98351494570002-30212_en_99133_33094_cat-blasthole-drill.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 10:59:50'),(26,24,'bc_98151494361660-Lighthouse.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 10:59:50'),(27,24,'bc_96891494576315-8602.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 10:59:50'),(28,24,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 10:59:50'),(29,25,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:03:05'),(30,25,'bc_98351494570002-30212_en_99133_33094_cat-blasthole-drill.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:03:05'),(31,25,'bc_98151494361660-Lighthouse.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:03:06'),(32,25,'bc_99821494318693-komatsu-pc8000.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:03:06'),(33,25,'bc_98351494570002-30212_en_99133_33094_cat-blasthole-drill.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:03:06'),(34,25,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:03:06'),(35,26,'bc_99821494318693-komatsu-pc8000.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:04:31'),(36,26,'bc_98351494570002-30212_en_99133_33094_cat-blasthole-drill.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:04:31'),(37,26,'bc_96891494576315-8602.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:04:31'),(38,26,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:04:31'),(39,27,'bc_98151494361660-Lighthouse.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:08:18'),(40,27,'bc_98351494570002-30212_en_99133_33094_cat-blasthole-drill.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:08:18'),(41,28,'bc_97441494571319-3818754282_ccfaf481d6_b.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:09:25'),(42,29,'bc_99821494318693-komatsu-pc8000.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:15:06'),(43,29,'bc_96931494571429-image 2.JPG','http://localhost:8080/uploads/dei_154821500959076',2,1,'2017-07-25 13:15:06'),(44,29,'bc_98151494361660-Lighthouse.jpg','http://localhost:8080/uploads/dei_154821500959076',2,1,'2017-07-25 13:15:07'),(45,29,'bc_98351494570002-30212_en_99133_33094_cat-blasthole-drill.jpg','http://localhost:8080/uploads/dei_154821500959076',2,1,'2017-07-25 13:15:07'),(46,30,'bc_99821494318693-komatsu-pc8000.jpg','http://localhost:8080/uploads/dei_154821500959076',1,1,'2017-07-25 13:16:24'),(47,30,'bc_98351494570002-30212_en_99133_33094_cat-blasthole-drill.jpg','http://localhost:8080/uploads/dei_154821500959076',2,1,'2017-07-25 13:16:24');
/*!40000 ALTER TABLE `core_product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_product_lifecycle`
--

DROP TABLE IF EXISTS `core_product_lifecycle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_product_lifecycle` (
  `product_lifecycle_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Updated by',
  `product_status` int(11) NOT NULL,
  `date_approved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_lifecycle_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_lifecycle`
--

LOCK TABLES `core_product_lifecycle` WRITE;
/*!40000 ALTER TABLE `core_product_lifecycle` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_product_lifecycle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_product_locations`
--

DROP TABLE IF EXISTS `core_product_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_product_locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `location_type` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1=current location, 2=serving\nlocation',
  `longitude` varchar(20) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(20) NOT NULL DEFAULT 'IN',
  `input_location` text COMMENT 'user - selected location',
  `google_place_id` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`location_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_locations`
--

LOCK TABLES `core_product_locations` WRITE;
/*!40000 ALTER TABLE `core_product_locations` DISABLE KEYS */;
INSERT INTO `core_product_locations` VALUES (1,1,1,'80.6480153','16.5061743','Vijayawada','Andhra Pradesh','India',NULL,'ChIJS5QtSPnvNToRZQJKq4R-m5M'),(2,1,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4'),(3,2,1,'78.4982741','17.4399295','Secunderabad','Telangana','India',NULL,'ChIJKV0lSK2EyzsRMzSbmRqEEAQ'),(4,2,2,'76.7794179','30.7333148','Chandigarh','Chandigarh','India',NULL,'ChIJa8lu5gvtDzkR_hlzUvln_6U'),(5,2,2,'71.1923805','22.258652',NULL,'Gujarat','India',NULL,'ChIJlfcOXx8FWTkRLlJU7YfYG4Y'),(6,3,1,'80.43654019999997','16.30665249999999','Guntur','Andhra Pradesh','India',NULL,'ChIJhXd4sVx1SjoRlObxkN2ZeZ8'),(7,4,1,'83.21848150000005','17.6868159','Visakhapatnam','Andhra Pradesh','India',NULL,'ChIJP5fmiRNDOToRaIRJlQPC2ZI'),(8,5,1,'83.21848150000005','17.6868159','Visakhapatnam','Andhra Pradesh','India',NULL,'ChIJP5fmiRNDOToRaIRJlQPC2ZI'),(9,6,1,'79.5940544','17.9689008','Warangal','Telangana','India',NULL,'ChIJ50te1wtFMzoRN8F7J5yQBpM'),(10,6,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4'),(11,6,2,'79.7399875','15.9128998',NULL,'Andhra Pradesh','India',NULL,'ChIJf9STrvhGNToRg82tlb670TM'),(12,7,1,'78.40701519999993','17.4325235','Hyderabad','Telangana','India',NULL,'ChIJE3aoYsyWyzsRSb5iI6J_Mag'),(13,24,1,'83.21848150000005','17.6868159','Visakhapatnam','Andhra Pradesh','India',NULL,'ChIJP5fmiRNDOToRaIRJlQPC2ZI'),(14,24,2,'79.7399875','15.9128998',NULL,'Andhra Pradesh','India',NULL,'ChIJf9STrvhGNToRg82tlb670TM'),(15,24,2,'94.7277528','28.2179994',NULL,'Arunachal Pradesh','India',NULL,'ChIJJ3IcakZDQDcR8pKaL1VutXY'),(16,25,1,'78.44343290000006','17.4526898','Hyderabad','Telangana','India',NULL,'ChIJcaUsIu-QyzsReYoQ9DzkjvU'),(17,25,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4'),(18,25,2,'94.7277528','28.2179994',NULL,'Arunachal Pradesh','India',NULL,'ChIJJ3IcakZDQDcR8pKaL1VutXY'),(19,26,1,'78.40701519999993','17.4325235','Hyderabad','Telangana','India',NULL,'ChIJE3aoYsyWyzsRSb5iI6J_Mag'),(20,26,2,'79.7399875','15.9128998',NULL,'Andhra Pradesh','India',NULL,'ChIJf9STrvhGNToRg82tlb670TM'),(21,27,1,'79.01929969999992','18.1124372','','Telangana','India',NULL,'ChIJQ-0plNtQMzoRWUBZQad772M'),(22,27,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4'),(23,28,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(24,28,2,'79.7399875','15.9128998',NULL,'Andhra Pradesh','India',NULL,'ChIJf9STrvhGNToRg82tlb670TM'),(25,28,2,'92.9375739','26.2006043',NULL,'Assam','India',NULL,'ChIJYy0xTMkWRTcR-xlnc7tzGtE'),(26,29,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(27,29,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4'),(28,30,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(29,30,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4'),(30,31,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(31,31,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4');
/*!40000 ALTER TABLE `core_product_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_product_models`
--

DROP TABLE IF EXISTS `core_product_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_product_models` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(255) DEFAULT NULL,
  `sub_category_id` int(11) NOT NULL,
  `model_status` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1= active, 2=in-active',
  PRIMARY KEY (`model_id`),
  KEY `sub_category_id` (`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_models`
--

LOCK TABLES `core_product_models` WRITE;
/*!40000 ALTER TABLE `core_product_models` DISABLE KEYS */;
INSERT INTO `core_product_models` VALUES (1,'Grove',1,1),(2,'Terex',1,1),(3,'Link - Belt',1,1),(4,'Locatelli',1,1),(5,'P&H',1,1),(6,'Ppm',1,1),(7,'Tadano',1,1),(8,'Bendini',1,1),(9,'Koehring',1,1),(10,'Koering',1,1),(11,'Little Giant',1,1),(12,'Lorain',1,1),(13,'Mannesmann Dematic',1,1),(14,'Pettibone',1,1),(15,'Demag',1,1),(16,'Liebherr',1,1),(17,'Faun',1,1),(18,'Franna',1,1),(19,'Corradini',1,1),(20,'Zoomlion',1,1),(21,'Sany',1,1),(22,'Xcmg',1,1),(23,'American',1,1),(24,'Daewoo',1,1),(25,'Manitowoc',1,1),(26,'Kobelco',1,1),(27,'Mantis',1,1),(28,'Broderson',1,1),(29,'Masco',1,1),(30,'Cinomatic',1,1),(31,'Benazzato',1,1),(32,'Ace',1,1),(33,'Escorts',1,1),(34,'Aakash',1,1),(35,'Jcb',1,1),(36,'Grove',2,1),(37,'Terex',2,1),(38,'Link - Belt',2,1),(39,'Locatelli',2,1),(40,'P&H',2,1),(41,'Ppm',2,1),(42,'Tadano',2,1),(43,'Bendini',2,1),(44,'Koehring',2,1),(45,'Koering',2,1),(46,'Little Giant',2,1),(47,'Lorain',2,1),(48,'Mannesmann Dematic',2,1),(49,'Pettibone',2,1),(50,'Demag',2,1),(51,'Liebherr',2,1),(52,'Faun',2,1),(53,'Franna',2,1),(54,'Corradini',2,1),(55,'Zoomlion',2,1),(56,'Sany',2,1),(57,'Xcmg',2,1),(58,'American',2,1),(59,'Daewoo',2,1),(60,'Manitowoc',2,1),(61,'Kobelco',2,1),(62,'Mantis',2,1),(63,'Broderson',2,1),(64,'Masco',2,1),(65,'Cinomatic',2,1),(66,'Benazzato',2,1),(67,'Ace',2,1),(68,'Escorts',2,1),(69,'Aakash',2,1),(70,'Jcb',2,1),(71,'Grove',3,1),(72,'Terex',3,1),(73,'Link - Belt',3,1),(74,'Locatelli',3,1),(75,'P&H',3,1),(76,'Ppm',3,1),(77,'Tadano',3,1),(78,'Bendini',3,1),(79,'Koehring',3,1),(80,'Koering',3,1),(81,'Little Giant',3,1),(82,'Lorain',3,1),(83,'Mannesmann Dematic',3,1),(84,'Pettibone',3,1),(85,'Demag',3,1),(86,'Liebherr',3,1),(87,'Faun',3,1),(88,'Franna',3,1),(89,'Corradini',3,1),(90,'Zoomlion',3,1),(91,'Sany',3,1),(92,'Xcmg',3,1),(93,'American',3,1),(94,'Daewoo',3,1),(95,'Manitowoc',3,1),(96,'Kobelco',3,1),(97,'Mantis',3,1),(98,'Broderson',3,1),(99,'Masco',3,1),(100,'Cinomatic',3,1),(101,'Benazzato',3,1),(102,'Ace',3,1),(103,'Escorts',3,1),(104,'Aakash',3,1),(105,'Jcb',3,1),(106,'Grove',4,1),(107,'Terex',4,1),(108,'Link - Belt',4,1),(109,'Locatelli',4,1),(110,'P&H',4,1),(111,'Ppm',4,1),(112,'Tadano',4,1),(113,'Bendini',4,1),(114,'Koehring',4,1),(115,'Koering',4,1),(116,'Little Giant',4,1),(117,'Lorain',4,1),(118,'Mannesmann Dematic',4,1),(119,'Pettibone',4,1),(120,'Demag',4,1),(121,'Liebherr',4,1),(122,'Faun',4,1),(123,'Franna',4,1),(124,'Corradini',4,1),(125,'Zoomlion',4,1),(126,'Sany',4,1),(127,'Xcmg',4,1),(128,'American',4,1),(129,'Daewoo',4,1),(130,'Manitowoc',4,1),(131,'Kobelco',4,1),(132,'Mantis',4,1),(133,'Broderson',4,1),(134,'Masco',4,1),(135,'Cinomatic',4,1),(136,'Benazzato',4,1),(137,'Ace',4,1),(138,'Escorts',4,1),(139,'Aakash',4,1),(140,'Jcb',4,1),(141,'Masco',5,1),(142,'Demag',5,1),(143,'Grove',6,1),(144,'American',6,1),(145,'Link - Belt',6,1),(146,'P&H',6,1),(147,'Cinomatic',7,1),(148,'Benazzato',7,1),(149,'Ace',7,1),(150,'Zoomlion',7,1),(151,'Ace',10,1),(152,'Escorts',10,1),(153,'Aakash',10,1),(154,'Xcmg',10,1),(155,'Jcb',10,1),(156,'Komatsu',17,1),(157,'L&T',17,1),(158,'Hitachi',17,1),(159,'Jcb',17,1),(160,'Sany',17,1),(161,'Hyundai',17,1),(162,'Kobelko',17,1),(163,'Volvo',17,1),(164,'Tata Hitachi',17,1),(165,'Caterpillar',17,1),(166,'Terex',17,1),(167,'Komatsu',18,1),(168,'L&T',18,1),(169,'Hitachi',18,1),(170,'Jcb',18,1),(171,'Sany',18,1),(172,'Hyundai',18,1),(173,'Kobelko',18,1),(174,'Volvo',18,1),(175,'Tata Hitachi',18,1),(176,'Caterpillar',18,1),(177,'Terex',18,1),(178,'Komatsu',19,1),(179,'L&T',19,1),(180,'Hitachi',19,1),(181,'Jcb',19,1),(182,'Sany',19,1),(183,'Hyundai',19,1),(184,'Kobelko',19,1),(185,'Volvo',19,1),(186,'Tata Hitachi',19,1),(187,'Caterpillar',19,1),(188,'Terex',19,1),(189,'Komatsu',20,1),(190,'L&T',20,1),(191,'Hitachi',20,1),(192,'Jcb',20,1),(193,'Sany',20,1),(194,'Hyundai',20,1),(195,'Kobelko',20,1),(196,'Volvo',20,1),(197,'Tata Hitachi',20,1),(198,'Caterpillar',20,1),(199,'Terex',20,1),(200,'Komatsu',21,1),(201,'L&T',21,1),(202,'Hitachi',21,1),(203,'Jcb',21,1),(204,'Sany',21,1),(205,'Hyundai',21,1),(206,'Kobelko',21,1),(207,'Volvo',21,1),(208,'Tata Hitachi',21,1),(209,'Caterpillar',21,1),(210,'Terex',21,1),(211,'Komatsu',22,1),(212,'L&T',22,1),(213,'Hitachi',22,1),(214,'Jcb',22,1),(215,'Sany',22,1),(216,'Hyundai',22,1),(217,'Kobelko',22,1),(218,'Volvo',22,1),(219,'Tata Hitachi',22,1),(220,'Caterpillar',22,1),(221,'Terex',22,1),(222,'Ashok Leyland',23,1),(223,'Cummins - Kirloskar',23,1),(224,'Caterpillar',23,1),(225,'Chicago Pneumatic',23,1),(226,'Honda',23,1),(227,'Alpha',23,1),(228,'Genesis',23,1),(229,'L&T',23,1),(230,'Esab',23,1),(231,'Kala Genset',23,1),(232,'Realco',23,1),(233,'Siskan Power Systems',23,1),(234,'Powerica',23,1),(235,'Greaves Cotton',23,1),(236,'Ra Powergen Engineers Pvt Ltd',23,1),(237,'Vinayak Enterprises',23,1),(238,'Ashok Leyland',24,1),(239,'Cummins - Kirloskar',24,1),(240,'Caterpillar',24,1),(241,'Chicago Pneumatic',24,1),(242,'Honda',24,1),(243,'Alpha',24,1),(244,'Genesis',24,1),(245,'L&T',24,1),(246,'Esab',24,1),(247,'Ashok Leyland',25,1),(248,'Cummins - Kirloskar',25,1),(249,'Caterpillar',25,1),(250,'Chicago Pneumatic',25,1),(251,'Honda',25,1),(252,'Alpha',25,1),(253,'Genesis',25,1),(254,'L&T',25,1),(255,'Esab',25,1),(256,'Ashok Leyland',26,1),(257,'Cummins - Kirloskar',26,1),(258,'Caterpillar',26,1),(259,'Chicago Pneumatic',26,1),(260,'Honda',26,1),(261,'Alpha',26,1),(262,'Genesis',26,1),(263,'L&T',26,1),(264,'Esab',26,1),(265,'Ashok Leyland',27,1),(266,'Cummins - Kirloskar',27,1),(267,'Caterpillar',27,1),(268,'Chicago Pneumatic',27,1),(269,'Honda',27,1),(270,'Alpha',27,1),(271,'Genesis',27,1),(272,'L&T',27,1),(273,'Esab',27,1),(274,'Mait',29,1),(275,'Sany',29,1),(276,'Bauer',29,1),(277,'Soilmec',29,1),(278,'Liebherr',29,1),(279,'Casa Grande',29,1),(280,'Imt',29,1),(281,'Mait',30,1),(282,'Sany',30,1),(283,'Bauer',30,1),(284,'Soilmec',30,1),(285,'Liebherr',30,1),(286,'Casa Grande',30,1),(287,'Imt',30,1),(288,'Mait',31,1),(289,'Sany',31,1),(290,'Bauer',31,1),(291,'Soilmec',31,1),(292,'Liebherr',31,1),(293,'Casa Grande',31,1),(294,'Imt',31,1),(295,'Mait',32,1),(296,'Sany',32,1),(297,'Bauer',32,1),(298,'Soilmec',32,1),(299,'Liebherr',32,1),(300,'Casa Grande',32,1),(301,'Imt',32,1),(302,'Tata',12,1),(303,'Volvo',12,1),(304,'Benz',12,1),(305,'Ashok Leyland',12,1),(306,'Tata',13,1),(307,'Volvo',13,1),(308,'Benz',13,1),(309,'Ashok Leyland',13,1),(310,'Tata',14,1),(311,'Volvo',14,1),(312,'Benz',14,1),(313,'Ashok Leyland',14,1),(314,'Tata',15,1),(315,'Volvo',15,1),(316,'Benz',15,1),(317,'Ashok Leyland',15,1),(318,'Tata',16,1),(319,'Volvo',16,1),(320,'Benz',16,1),(321,'Ashok Leyland',16,1),(322,'LIEBHERR',17,1),(323,'LIEBHERR',17,0),(324,'Custom',33,1);
/*!40000 ALTER TABLE `core_product_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_product_sub_categories`
--

DROP TABLE IF EXISTS `core_product_sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_product_sub_categories` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_status` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1= active, 2=in-active',
  PRIMARY KEY (`sub_category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_sub_categories`
--

LOCK TABLES `core_product_sub_categories` WRITE;
/*!40000 ALTER TABLE `core_product_sub_categories` DISABLE KEYS */;
INSERT INTO `core_product_sub_categories` VALUES (1,'Rough Terrain Crane',1,1),(2,'All Terrain Crane',1,1),(3,'Hydraulic Truck Crane',1,1),(4,'Crawler Crane',1,1),(5,'Overhead Crane',1,1),(6,'Conventional Truck Crane',1,1),(7,'Tower Crane',1,1),(8,'Crawler Dragline',1,0),(9,'Gantry Crane',1,0),(10,'Hydra Cranes',1,1),(12,'Agricultural',2,1),(13,'Water Disposal',2,1),(14,'Construction',2,1),(15,'Mining',2,1),(16,'Road Construction',2,1),(17,'Back Hoe Loader (JCB)',3,1),(18,'Drag Line',3,1),(19,'Suction Type',3,1),(20,'Long Reach/Long Arm',3,1),(21,'Crawlers&Compact',3,1),(22,'Power Shovels',3,1),(23,'Event',4,1),(24,'Industry',4,1),(25,'Civil Work',4,1),(26,'Agriculture',4,1),(27,'Alternative Power',4,1),(29,'Rotary Hydraulic',5,1),(30,'Conventional',5,1),(31,'Truck Mounted',5,1),(32,'Diaphragm Wall',5,1),(33,'P&H 325/335',1,1);
/*!40000 ALTER TABLE `core_product_sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_products`
--

DROP TABLE IF EXISTS `core_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` int(11) NOT NULL COMMENT '0=Hire,1=Sale,2=Hire/Sale\n',
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `capacity` varchar(45) NOT NULL,
  `equipment_title` varchar(250) NOT NULL,
  `manual_product_code` varchar(45) DEFAULT NULL,
  `model_other` varchar(45) DEFAULT NULL,
  `model_id` int(11) DEFAULT '0',
  `boom_length` int(11) DEFAULT '0',
  `fly_jib` varchar(255) DEFAULT NULL,
  `luffing_jib` varchar(255) DEFAULT NULL,
  `registered_number` varchar(60) DEFAULT NULL,
  `life_tax_details` varchar(45) DEFAULT NULL,
  `condition` text,
  `bucket_capacity` varchar(255) DEFAULT NULL,
  `manufacture_year` varchar(15) DEFAULT NULL,
  `manufacturer` varchar(45) DEFAULT NULL,
  `price_type` tinyint(11) DEFAULT '0' COMMENT '1=daily, 2=monthly',
  `hire_price` decimal(10,2) DEFAULT NULL,
  `kelly_length` varchar(255) DEFAULT NULL,
  `arm_length` varchar(255) DEFAULT NULL,
  `numberof_axles` varchar(45) DEFAULT NULL,
  `dimensions` varchar(50) NOT NULL,
  `description` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `product_status` int(11) NOT NULL COMMENT '1=pending / waiting for approval, 2 = approved\nby data operator, 3=approved by sales ex, 4= PUBLIC (approved by sales manager), 5=rejected, 6 =\nre-initialized, 7=closed',
  `sale_price` decimal(10,2) DEFAULT NULL,
  `package_type` tinyint(5) NOT NULL COMMENT '1=free, 2 = paid',
  `package_amount` decimal(10,2) DEFAULT NULL,
  `current_location` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `user_id` (`user_id`),
  KEY `product_status` (`product_status`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_products`
--

LOCK TABLES `core_products` WRITE;
/*!40000 ALTER TABLE `core_products` DISABLE KEYS */;
INSERT INTO `core_products` VALUES (1,0,1,3,'2000 Tons','jcb cranes','MCWE2HSPKT9I1','',86,444,'20','20','reg','2,3','','','1995','',1,555555.00,'','','','12x12x12','tste','2017-07-24 11:20:23',1000,1,0.00,0,0.00,'Vijayawada, Andhra Pradesh, India'),(2,0,3,17,'1500 Tons','title','V9AIIQ1WRB1U2','',156,NULL,'','','',NULL,'','3333','1980','',2,5555.00,'','222','','12x12x12','test','2017-07-24 11:31:14',1000,1,0.00,0,0.00,'Secunderabad, Telangana, India'),(3,1,5,29,'100 KN','title','W1HP905JJ5SD3','',NULL,NULL,'','','',NULL,'','','1994','',NULL,0.00,'','','','12x12x12','tstsadas asdf asdf asdf asd fasdf asdf ','2017-07-24 13:25:29',1000,1,2000.00,0,NULL,'Guntur, Andhra Pradesh, India'),(4,1,2,12,'20 Tons','title','ANSBV0RNN9OE4','',302,NULL,'','','reg','7','','','1984','',NULL,0.00,'','','20','12x12x12','asdfasf daf a a','2017-07-24 13:34:03',1000,1,2000.00,0,0.00,'Vizag, Andhra Pradesh, India'),(5,1,2,13,'2000 Tons','title','T8ZFZCKS16MD5','',NULL,NULL,'','','',NULL,'','','1985','',NULL,0.00,'','','','12x12x12','asdfasdfasf','2017-07-24 14:00:14',1000,1,2000.00,0,0.00,'Vizag, Andhra Pradesh, India'),(6,2,4,23,'25 KVA','generator','2B8563T96STV6','',222,NULL,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfasdfsaf','2017-07-25 05:04:54',1000,1,2000.00,0,NULL,'Warangal, Telangana, India'),(7,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',NULL,NULL,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(8,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(9,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(10,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(11,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(12,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(13,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(14,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(15,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(16,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(17,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(18,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(19,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(20,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(21,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(22,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(23,2,4,24,'2000 KVA','title','2XPLVFRLH1397','',0,0,'','','',NULL,'','','1980','',1,555555.00,'','','','12x12x12','asdfasdfas','2017-07-25 05:14:43',1000,1,2000.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(24,0,5,29,'2000 KN','title','H21KRK4VGYV24','',274,NULL,'','','',NULL,'','','1981','',2,555555.00,'2000','','','12x12x12','asdfasdf','2017-07-25 10:59:49',1019,1,0.00,0,0.00,'Visakhapatnam, Andhra Pradesh, India'),(25,0,2,12,'2000 Tons','title','ZJK0CH2C4G525','',303,NULL,'','','reg','2','','','1981','',1,555555.00,'','','33','33x33x33','asdfadfa','2017-07-25 13:03:05',1000,1,0.00,0,0.00,'Sanath Nagar, Hyderabad, Telangana, India'),(26,0,2,12,'2000 Tons','title','88DQJ7CPVYH26','',302,NULL,'','','reg','2','','','1980','',2,555555.00,'','','33','33x44x44','asdfasdf','2017-07-25 13:04:30',1000,1,0.00,0,0.00,'Jubilee Hills, Hyderabad, Telangana, India'),(27,0,3,17,'2000 Tons','title','VUK5KMDDP7J27','',157,NULL,'','','',NULL,'','44','1982','',1,333.00,'','33','','12x12x12','asdfasdf','2017-07-25 13:08:18',1000,1,0.00,0,0.00,'Telangana, India'),(28,0,3,18,'2000 Tons','title','SKORO50M7G728','',167,NULL,'','','',NULL,'','44','1995','',1,555555.00,'','33','','12x12x12','adfdf','2017-07-25 13:09:24',1000,1,0.00,0,0.00,'Hyderabad, Telangana, India'),(29,0,1,1,'2000 Tons','title','7ADKDGZBPAT29','',2,444,'20','20','reg','2','','','1981','',1,555555.00,'','','','12x12x12','asdfasdfasfd','2017-07-25 13:15:06',1000,1,0.00,0,0.00,'Hyderabad, Telangana, India'),(30,0,1,1,'2000 Tons','title','9IG0UE6S0KE30','',1,444,'20','20','reg','2','','','1982','',1,555555.00,'','','','12x12x12','asdfasdf','2017-07-25 13:16:24',1000,1,0.00,0,0.00,'Hyderabad, Telangana, India'),(31,0,1,1,'2000 Tons','title','JS1OLZPP9TV31','',1,444,'20','20','reg','2','','','1982','',1,555555.00,'','','','12x12x12','asdfasdf','2017-07-25 13:21:28',1000,1,0.00,0,0.00,'Hyderabad, Telangana, India');
/*!40000 ALTER TABLE `core_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_quotation`
--

DROP TABLE IF EXISTS `core_quotation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_quotation` (
  `quotation_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `location` text NOT NULL,
  `quotation_type` enum('hire','sale') NOT NULL,
  `start_date` date DEFAULT NULL,
  `duration_type` enum('days','week','month') DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `comments` text,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `job_description` enum('commercial','doit_yourself') NOT NULL,
  PRIMARY KEY (`quotation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_quotation`
--

LOCK TABLES `core_quotation` WRITE;
/*!40000 ALTER TABLE `core_quotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_quotation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_regions`
--

DROP TABLE IF EXISTS `core_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_regions` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT,
  `region_name` varchar(255) NOT NULL,
  `region_value` varchar(255) NOT NULL,
  `region_status` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1= active, 2=in-active',
  PRIMARY KEY (`region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_regions`
--

LOCK TABLES `core_regions` WRITE;
/*!40000 ALTER TABLE `core_regions` DISABLE KEYS */;
INSERT INTO `core_regions` VALUES (1,'India','All India',0),(2,'Andaman and Nicobar Islands','Andaman and Nicobar Islands',1),(3,'Andhra Pradesh','Andhra Pradesh',1),(4,'Arunachal Pradesh','Arunachal Pradesh',1),(5,'Assam','Assam',1),(6,'Bihar','Bihar',1),(7,'Chandigarh','Chandigarh',1),(8,'Chhattisgarh','Chhattisgarh',1),(9,'Dadra and Nagar Haveli','Dadra and Nagar Haveli',1),(10,'Daman and Diu','Daman and Diu',1),(11,'Delhi','Delhi',1),(12,'Goa','Goa',1),(13,'Gujarat','Gujarat',1),(14,'Haryana','Haryana',1),(15,'Himachal Pradesh','Himachal Pradesh',1),(16,'Jammu and Kashmir','Jammu and Kashmir',1),(17,'Jharkhand','Jharkhand',1),(18,'Karnataka','Karnataka',1),(20,'Kerala','Kerala',1),(21,'Lakshadweep','Lakshadweep',1),(22,'Madhya Pradesh','Madhya Pradesh',1),(23,'Maharashtra','Maharashtra',1),(24,'Manipur','Manipur',1),(25,'Meghalaya','Meghalaya',1),(26,'Mizoram','Mizoram',1),(27,'Nagaland','Nagaland',1),(30,'Odisha','Odisha',1),(32,'Pondicherry','Pondicherry',1),(33,'Punjab','Punjab',1),(34,'Rajasthan','Rajasthan',1),(35,'Sikkim','Sikkim',1),(36,'Tamil Nadu','Tamil Nadu',1),(37,'Telangana','Telangana',1),(38,'Tripura','Tripura',1),(39,'Uttar Pradesh','Uttar Pradesh',1),(40,'Uttarakhand','Uttarakhand',1),(42,'West Bengal','West Bengal',1);
/*!40000 ALTER TABLE `core_regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_sessions`
--

DROP TABLE IF EXISTS `core_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_sessions` (
  `session_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `authentication_token` varchar(32) NOT NULL,
  `session_status` int(1) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL,
  `date_expiration` datetime NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(30) NOT NULL,
  `last_page_visited` varchar(200) DEFAULT NULL,
  `mode` tinyint(3) NOT NULL COMMENT '1=web, 2= iPhone, 3 = Andriod',
  `http_user_agent` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`session_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_sessions`
--

LOCK TABLES `core_sessions` WRITE;
/*!40000 ALTER TABLE `core_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user_roles`
--

DROP TABLE IF EXISTS `core_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_roles`
--

LOCK TABLES `core_user_roles` WRITE;
/*!40000 ALTER TABLE `core_user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_user_x_roles`
--

DROP TABLE IF EXISTS `core_user_x_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_user_x_roles` (
  `user_role_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL COMMENT 'created user - id details for reference',
  PRIMARY KEY (`user_role_id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_x_roles`
--

LOCK TABLES `core_user_x_roles` WRITE;
/*!40000 ALTER TABLE `core_user_x_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_user_x_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_users`
--

DROP TABLE IF EXISTS `core_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `company_name` varchar(45) DEFAULT NULL,
  `company_address` text,
  `designation` varchar(35) DEFAULT NULL,
  `company_email` varchar(50) DEFAULT NULL,
  `user_status` int(11) NOT NULL COMMENT '1=registered, 2=verified OTP / active, 3=inactive',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `otp_code` varchar(45) DEFAULT NULL,
  `user_type` varchar(45) DEFAULT NULL COMMENT '1=public user, 2=data-operator, 3=salesexecutive,\n4=sales-manager, 5=admin, 6=super-admin',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1020 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_users`
--

LOCK TABLES `core_users` WRITE;
/*!40000 ALTER TABLE `core_users` DISABLE KEYS */;
INSERT INTO `core_users` VALUES (1000,'basaveswar','basaveswar.allaka@devrabbit.com','25f9e794323b453885f5181f1b624d0b','9030880086','Devrabbit','hyderabad','Senior Developer','basaveswar.allaka@devrabbit.com',2,'2017-07-20 04:58:05','0000-00-00 00:00:00','234732','1'),(1002,'testuser','testuser@test.com','25f9e794323b453885f5181f1b624d0b','5555555555','test company','','','',2,'2017-07-20 14:15:29','0000-00-00 00:00:00','289304','1'),(1003,'testuser','testuser@test.co','25f9e794323b453885f5181f1b624d0b','8888888888','test company','','ceo','test@testcompany.com',1,'2017-07-21 06:57:30','0000-00-00 00:00:00','261720','1'),(1004,'testuser','testuser@test.co','25f9e794323b453885f5181f1b624d0b','8888888888','test company','','ceo','test@testcompany.com',1,'2017-07-21 06:57:35','0000-00-00 00:00:00','261720','1'),(1005,'testuser','testuser@test.co','25f9e794323b453885f5181f1b624d0b','8888888888','test company','','ceo','test@testcompany.com',1,'2017-07-21 06:57:36','0000-00-00 00:00:00','261720','1'),(1006,'testuser','testuse3r@test.com','25f9e794323b453885f5181f1b624d0b','8888888888','test company','hyderabasd','des','test@testcompany.com',1,'2017-07-21 06:58:44','0000-00-00 00:00:00','261720','1'),(1007,'test','testuser44@test.com','25f9e794323b453885f5181f1b624d0b','8888888888','test company','','','',1,'2017-07-21 12:18:43','0000-00-00 00:00:00','261720','1'),(1008,'te','testuser@test.comdd','25f9e794323b453885f5181f1b624d0b','9999999999','123456789','','','',1,'2017-07-21 12:20:27','0000-00-00 00:00:00','199365','1'),(1009,'dsfasf','testuser444@test.com','25f9e794323b453885f5181f1b624d0b','4561565123','tasfasf','','','',1,'2017-07-21 12:24:26','0000-00-00 00:00:00','968747','1'),(1010,'tst','testuser@test.com55','25f9e794323b453885f5181f1b624d0b','9648678645','asdfasf','','','',2,'2017-07-21 12:32:14','0000-00-00 00:00:00','904388','1'),(1011,'dtete','testuser@test.comddd','25f9e794323b453885f5181f1b624d0b','8945615123','asdfasdf','','','',2,'2017-07-21 12:36:34','0000-00-00 00:00:00','279918','1'),(1018,'test','testuser@test.comaa','25f9e794323b453885f5181f1b624d0b','8888554521','asdasdf','','','',2,'2017-07-25 08:19:24','0000-00-00 00:00:00','822412','1'),(1019,'sdfasf','testuser@test.comss','25f9e794323b453885f5181f1b624d0b','8456165186','asdfasf','','','',2,'2017-07-25 08:31:27','0000-00-00 00:00:00','243581','1');
/*!40000 ALTER TABLE `core_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-26 14:00:12
