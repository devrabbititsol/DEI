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
-- Table structure for table `core_comments`
--

DROP TABLE IF EXISTS `core_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_description` text NOT NULL,
  `comment_type` smallint(5) NOT NULL COMMENT '1=user, 2=orders, 3=payments, 4=products, 5=ads,6=contact,7=feedback,8=getquote',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `comment_belongs_to` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_comments`
--

LOCK TABLES `core_comments` WRITE;
/*!40000 ALTER TABLE `core_comments` DISABLE KEYS */;
INSERT INTO `core_comments` VALUES (1,'tests',4,'2017-09-18 11:45:01',1009,56),(2,'asdfasdf',4,'2017-09-18 11:45:14',1009,56),(3,'asdfasdf',4,'2017-09-18 11:46:26',1009,56),(4,'asdfasdf',4,'2017-09-18 11:46:58',1009,56),(5,'asdfasdf',4,'2017-09-18 11:52:36',1009,56),(6,'asdfasdfasdfasf',4,'2017-09-18 12:16:38',1004,56),(7,'teste',2,'2017-09-22 05:16:25',1009,15),(8,'asdfasdf',2,'2017-09-22 09:51:30',1009,15),(9,'testtttt',2,'2017-09-22 12:34:52',1009,58),(10,'asdfasdfas',2,'2017-09-22 12:35:54',1009,58),(11,'asdgfasdfasfasfasfa',2,'2017-09-22 12:35:59',1009,58),(12,'sdfasdf',6,'2017-09-23 11:16:01',1009,11),(13,'asdfasdfasdf',8,'2017-09-23 11:50:11',1009,2),(14,'asdfasdfasdfasdf',8,'2017-09-23 11:50:54',1009,2);
/*!40000 ALTER TABLE `core_comments` ENABLE KEYS */;
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
  `contact_status` int(5) NOT NULL DEFAULT '0' COMMENT '0=Inactive,1=Active',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_contact_details`
--

LOCK TABLES `core_contact_details` WRITE;
/*!40000 ALTER TABLE `core_contact_details` DISABLE KEYS */;
INSERT INTO `core_contact_details` VALUES (1,'eshwar','basaveswar.allaka@devrabbit.com','1234567890','','2017-08-02 09:50:30',0),(2,'eshwar','basaveswar.allaka@devrabbit.com','1234567890','','2017-08-02 09:51:32',0),(3,'eshwar','basaveswar.allaka@devrabbit.com','1234567890','test','2017-08-02 09:53:41',0),(4,'testuser','basaveswar.allaka@devrabbit.com','1234567890','test','2017-08-02 09:55:30',0),(5,'basaveswar','basaveswar.allaka@devrabbit.com','958658585','test','2017-08-02 09:57:26',0),(6,'basaveswar','basaveswar.allaka@devrabbit.com','9030880086','test','2017-08-16 11:27:38',0),(7,'basaveswar','basaveswar.allaka@devrabbit.com','9030880086','test','2017-08-16 11:28:18',0),(8,'basaveswar','basaveswar.allaka@devrabbit.com','9030880086','','2017-08-16 11:34:24',0),(9,'basaveswar','basaveswar.allaka@devrabbit.com','9030880086','','2017-08-16 11:34:52',0),(10,'basaveswar','basaveswar.allaka@devrabbit.com','9030880086','','2017-08-16 11:36:04',0),(11,'testuser','testuser@test.com','9030880086','test1','2017-08-17 06:14:53',1);
/*!40000 ALTER TABLE `core_contact_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_districts`
--

DROP TABLE IF EXISTS `core_districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_districts` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(45) NOT NULL,
  `district_status` smallint(5) NOT NULL COMMENT '0=Inactive, 1- Active',
  `state_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `date_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `zone_id` int(5) NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_districts`
--

LOCK TABLES `core_districts` WRITE;
/*!40000 ALTER TABLE `core_districts` DISABLE KEYS */;
INSERT INTO `core_districts` VALUES (1,'East Godavari',1,1,'2017-09-12 18:30:00',1,'2017-09-21 05:29:07',1007,1),(2,'West Godavari',1,1,'2017-09-12 18:30:00',1,'2017-09-15 06:21:47',1009,0),(3,'Hyderabad',1,2,'2017-09-12 18:30:00',1,'2017-09-15 06:13:58',1009,0),(4,'chennai',1,3,'2017-09-12 18:30:00',1,'2017-09-13 05:49:24',NULL,0),(5,'Krishna',1,1,'2017-09-15 06:23:37',1009,'2017-09-15 06:23:37',1009,0);
/*!40000 ALTER TABLE `core_districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_feedback_details`
--

DROP TABLE IF EXISTS `core_feedback_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_feedback_details` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `message` text,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `feedback_status` smallint(5) NOT NULL COMMENT '0=Inactive,1=Active\n',
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_feedback_details`
--

LOCK TABLES `core_feedback_details` WRITE;
/*!40000 ALTER TABLE `core_feedback_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_feedback_details` ENABLE KEYS */;
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
  `employee_id` int(11) DEFAULT '0',
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_orders`
--

LOCK TABLES `core_orders` WRITE;
/*!40000 ALTER TABLE `core_orders` DISABLE KEYS */;
INSERT INTO `core_orders` VALUES (1,1,1000,'2017-07-27 00:00:00','2017-07-30 00:00:00','2017-07-27 10:19:22','',0,1,'ZCVG28292QLO1',3,0,NULL,NULL),(2,1,1000,'2017-07-26 00:00:00','2017-07-29 00:00:00','2017-07-27 10:20:10','',0,1,'QEQQG17WHXWW2',3,0,NULL,NULL),(3,1,1000,'2017-07-26 00:00:00','2017-07-29 00:00:00','2017-07-27 10:20:13','',0,1,'NWDQXZSM1DTU3',3,0,NULL,NULL),(4,1,1000,'2017-07-27 00:00:00','2017-07-28 00:00:00','2017-07-27 10:22:13','',0,1,'CMT525KJ910G4',1,0,NULL,NULL),(5,2,1000,'2017-07-28 00:00:00','2017-08-01 00:00:00','2017-07-28 07:36:03','',0,1,'XB51VP479Z045',4,0,NULL,NULL),(6,2,1000,'2017-07-31 00:00:00','2017-10-01 00:00:00','2017-07-31 13:15:03','',0,1,'OA3HIUQWFTS56',2,0,NULL,NULL),(7,2,1000,'2017-07-31 00:00:00','2017-10-01 00:00:00','2017-07-31 13:16:05','',0,1,'GRZH0WNHJ50E7',2,0,NULL,NULL),(8,2,1000,'2017-07-31 00:00:00','2017-10-31 00:00:00','2017-07-31 13:19:45','',0,1,'43TK809N13U98',3,0,NULL,NULL),(9,2,1000,'2017-07-31 00:00:00','2017-12-01 00:00:00','2017-07-31 13:22:05','',0,1,'NBWSUEO1VE8M9',4,0,NULL,NULL),(10,2,1000,'2017-07-31 00:00:00','2017-10-01 00:00:00','2017-07-31 13:27:59','',0,1,'0MUAIKEDEYN10',2,0,NULL,NULL),(11,2,1000,'2017-08-01 00:00:00','2017-11-01 00:00:00','2017-08-01 08:53:16','',0,1,'NRUL4LYOL6Z11',3,0,NULL,NULL),(12,2,1000,'2017-08-01 00:00:00','2017-08-03 00:00:00','2017-08-01 08:54:59','',0,1,'Q94EM7SZNY512',2,0,NULL,NULL),(13,7,1000,'2017-08-31 00:00:00',NULL,'2017-08-01 12:50:26','',1,1,'5I0K8UBM3DW13',0,0,NULL,NULL),(14,5,1000,'2017-08-09 00:00:00','2017-09-08 00:00:00','2017-08-08 07:22:24','',0,6,'CAT2000X0000E',30,0,NULL,NULL),(15,5,1000,'2017-08-11 00:00:00','2017-08-13 00:00:00','2017-08-09 12:33:20','',0,1,NULL,2,0,NULL,NULL),(16,5,1000,'2017-08-17 00:00:00','2017-08-20 00:00:00','2017-08-09 12:34:12','',0,1,'CAT0080X00010',3,0,NULL,NULL),(17,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-09 12:34:58','',0,1,'CAT0080X00011',2,0,NULL,NULL),(18,5,1000,'2017-08-11 00:00:00','2017-08-13 00:00:00','2017-08-09 12:35:29','',0,1,'CAT0080X00012',2,0,NULL,NULL),(19,5,1000,'2017-08-17 00:00:00','2017-08-19 00:00:00','2017-08-09 12:36:29','',0,1,'CAT0080X00013',2,0,NULL,NULL),(20,5,1000,'2017-08-17 00:00:00','2017-08-19 00:00:00','2017-08-09 12:37:23','',0,1,'CAT0080X00014',2,0,NULL,NULL),(21,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-09 12:38:16','',0,1,'CAT0080X00015',2,0,NULL,NULL),(22,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-09 12:39:05','',0,1,'CAT0080X00016',2,0,NULL,NULL),(23,5,1000,'2017-08-09 00:00:00','2017-08-11 00:00:00','2017-08-09 12:42:09','',0,1,NULL,2,0,NULL,NULL),(24,5,1000,'2017-08-11 00:00:00','2017-08-13 00:00:00','2017-08-09 12:43:40','',0,1,NULL,2,0,NULL,NULL),(25,5,1000,'2017-08-11 00:00:00','2017-08-13 00:00:00','2017-08-09 12:44:05','',0,1,'CAT2000X00019',2,0,NULL,NULL),(26,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-09 12:45:08','',0,1,'CAT2000X0001A',2,0,NULL,NULL),(27,2,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-09 12:45:12','',0,1,'CAT0080X0001B',2,0,NULL,NULL),(28,5,1000,'2017-08-11 00:00:00','2017-08-13 00:00:00','2017-08-09 13:31:54','test',0,1,'CAT2000X0001C',2,0,NULL,NULL),(29,5,1000,'2017-08-17 00:00:00','2017-08-19 00:00:00','2017-08-09 13:34:29','test2',0,1,'CAT2000X0001D',2,0,NULL,NULL),(30,2,1000,'2017-08-17 00:00:00','2017-08-19 00:00:00','2017-08-09 13:34:36','test2',0,1,'CAT0080X0001E',2,0,NULL,NULL),(31,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-10 05:06:53','',0,1,'CAT2000X0001F',2,0,NULL,NULL),(32,5,1000,'2017-08-10 00:00:00','2017-08-11 00:00:00','2017-08-10 05:31:37','',0,1,'CAT2000X00020',1,0,NULL,NULL),(33,5,1000,'2017-08-11 00:00:00','2017-08-12 00:00:00','2017-08-10 05:32:45','',0,1,'CAT2000X00021',1,0,NULL,NULL),(34,5,1000,'2017-08-10 00:00:00','2017-08-11 00:00:00','2017-08-10 05:36:02','',0,1,'CAT2000X00022',1,0,NULL,NULL),(35,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-10 05:44:26','',0,1,'CAT2000X00023',2,0,NULL,NULL),(36,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-10 05:46:42','',0,1,'CAT2000X00024',2,0,NULL,NULL),(37,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-10 05:49:29','',0,1,'CAT2000X00025',2,0,NULL,NULL),(38,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-10 05:52:57','',0,1,'CAT2000X00026',2,0,NULL,NULL),(39,5,1000,'2017-08-10 00:00:00','2017-08-12 00:00:00','2017-08-10 05:56:55','',0,1,'CAT2000X00027',2,0,NULL,NULL),(40,2,1000,'2017-08-17 00:00:00','2017-10-17 00:00:00','2017-08-16 09:34:02','test',0,1,'CAT0080X00028',2,0,NULL,NULL),(41,7,1000,'2017-08-16 00:00:00',NULL,'2017-08-16 09:34:45','test2',1,1,'CAT2000Y00029',0,0,NULL,NULL),(42,2,1000,'2017-08-16 00:00:00','2017-09-16 00:00:00','2017-08-16 11:00:50','',0,1,'CAT0080X0002A',1,0,NULL,NULL),(43,2,1000,'2017-08-17 00:00:00','2017-10-17 00:00:00','2017-08-16 11:03:06','',0,1,'CAT0080X0002B',2,0,NULL,NULL),(44,2,1000,'2017-08-17 00:00:00','2017-10-17 00:00:00','2017-08-16 11:04:45','',0,1,'CAT0080X0002C',2,0,NULL,NULL),(45,2,1000,'2017-08-17 00:00:00','2017-09-17 00:00:00','2017-08-16 11:10:13','',0,1,'CAT0080X0002D',1,0,NULL,NULL),(46,2,1000,'2017-08-17 00:00:00','2017-10-17 00:00:00','2017-08-16 11:11:24','',0,1,'CAT0080X0002E',2,0,NULL,NULL),(47,2,1000,'2017-08-16 00:00:00','2017-10-16 00:00:00','2017-08-16 11:14:47','',0,1,'CAT0080X0002F',2,0,NULL,NULL),(48,2,1000,'2017-08-23 00:00:00','2017-10-23 00:00:00','2017-08-16 11:16:34','',0,1,'CAT0080X00030',2,0,NULL,NULL),(49,2,1000,'2017-08-16 00:00:00','2017-10-16 00:00:00','2017-08-16 11:17:57','',0,1,'CAT0080X00031',2,0,NULL,NULL),(50,5,1000,'2017-08-29 00:00:00','2017-10-29 00:00:00','2017-08-17 14:17:59','test',0,1,'CAT2000X00032',2,0,NULL,NULL),(51,5,1000,'2017-08-23 00:00:00','1970-01-01 00:00:00','2017-08-17 14:20:16','test',1,1,'CAT2000Y00033',NULL,0,NULL,NULL),(52,5,1000,'2017-08-31 00:00:00','2017-10-31 00:00:00','2017-08-17 14:20:59','test',0,1,'CAT2000X00034',2,0,NULL,NULL),(53,65,1000,'2018-05-16 00:00:00','2018-05-19 00:00:00','2017-09-15 12:26:14','',0,3,'CAT2000X00035',3,0,1000,'2017-09-25 16:00:54'),(54,65,1000,'2017-09-19 00:00:00','1970-01-01 05:30:00','2017-09-15 13:14:32','',1,1,'CAT2000Y00036',NULL,0,NULL,NULL),(55,3,1000,'2017-09-27 00:00:00','2017-10-01 00:00:00','2017-09-18 06:27:09','',1,3,'PRH2000Y00037',4,1031,1000,'2017-09-25 16:03:46'),(56,3,1000,'2017-09-21 00:00:00','2017-10-25 00:00:00','2017-09-18 06:27:55','',0,6,'PRH2000X00038',34,0,NULL,NULL),(57,65,1000,'2017-09-27 00:00:00','2017-09-29 00:00:00','2017-09-18 06:28:40','',0,6,'CAT2000X00039',2,0,NULL,NULL),(58,102,1009,'2017-09-22 00:00:00','2017-10-24 00:00:00','2017-09-22 12:12:39','adsfasdf',0,1,'CCT0234X0003A',32,0,NULL,NULL),(59,102,1009,'2017-09-22 00:00:00','2018-05-14 00:00:00','2017-09-22 14:06:09','asdfasdf',0,0,'CCT0234X0003B',234,1031,NULL,NULL);
/*!40000 ALTER TABLE `core_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_payments`
--

DROP TABLE IF EXISTS `core_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `before_order_id` varchar(13) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount_actual` float NOT NULL,
  `amount_paid` float NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `tracking_id` varchar(25) DEFAULT NULL,
  `failure_message` varchar(255) DEFAULT NULL,
  `billing_name` varchar(50) DEFAULT NULL,
  `billing_phone` varchar(20) DEFAULT NULL,
  `billing_email` varchar(100) DEFAULT NULL,
  `billing_comments` varchar(255) DEFAULT NULL,
  `billing_time` datetime DEFAULT NULL,
  `bank_reference_number` varchar(20) DEFAULT NULL,
  `after_order_id` varchar(25) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_status` varchar(45) DEFAULT NULL,
  `response` text,
  `payment_type` enum('1','2') NOT NULL COMMENT '1=Product,2=Advertisements',
  `payment_for` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1039 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_payments`
--

LOCK TABLES `core_payments` WRITE;
/*!40000 ALTER TABLE `core_payments` DISABLE KEYS */;
INSERT INTO `core_payments` VALUES (1000,'DEI17PA100008','2017-08-17 13:44:37',50000,50000,'1','1502977477',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-17 13:44:37',NULL,NULL,0,NULL,NULL,'1',0),(1001,'DEI17PA100009','2017-08-17 14:12:53',50000,50000,'1','1502979173',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-17 14:12:53',NULL,NULL,0,NULL,NULL,'1',0),(1002,'DEI17PA30000A','2017-08-18 05:34:20',300000,0,'1','1503034460',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-18 05:34:20',NULL,NULL,0,NULL,NULL,'1',0),(1003,'DEI17PS200047','2017-08-18 06:13:12',5000,0,'1','1503036792',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-18 06:13:12',NULL,NULL,0,NULL,NULL,'1',0),(1004,'DEI17PX20004D','2017-08-21 12:24:06',10000,0,'Not Paid','1503318246',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-21 12:24:06',NULL,NULL,1000,NULL,NULL,'1',0),(1005,'DEI17PA10000B','2017-08-21 12:25:55',50000,0,'Not Paid','1503318355',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-21 12:25:55',NULL,NULL,1000,NULL,NULL,'1',0),(1006,'DEI17PA10000F','2017-08-22 05:46:06',5000,0,'Not Paid','1503380766',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 05:46:06',NULL,NULL,1000,NULL,NULL,'1',0),(1007,'DEI17PA100010','2017-08-22 05:46:27',5000,0,'Not Paid','1503380787',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 05:46:27',NULL,NULL,1000,NULL,NULL,'1',0),(1008,'DEI17PA100016','2017-08-22 06:02:56',5000,0,'Not Paid','1503381776',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 06:02:56',NULL,NULL,1000,NULL,NULL,'1',0),(1009,'DEI17PA100018','2017-08-22 06:18:30',5000,0,'Not Paid','1503382710',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 06:18:30',NULL,NULL,1000,NULL,NULL,'1',0),(1010,'DEI17PA200019','2017-08-22 06:19:03',15000,0,'Not Paid','1503382743',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 06:19:03',NULL,NULL,1000,NULL,NULL,'1',0),(1011,'DEI17PA20001A','2017-08-22 06:31:30',15000,0,'Not Paid','1503383490',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 06:31:30',NULL,NULL,1000,NULL,NULL,'1',0),(1012,'DEI17PA10001B','2017-08-22 06:32:14',5000,0,'Not Paid','1503383534',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 06:32:14',NULL,NULL,1000,NULL,NULL,'1',0),(1013,'DEI17PX200051','2017-08-22 07:47:30',5000,0,'Not Paid','1503388050',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 07:47:30',NULL,NULL,1000,NULL,NULL,'1',0),(1014,'DEI17PA20001C','2017-08-22 08:32:23',15000,0,'Not Paid','1503390743',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 08:32:23',NULL,NULL,1000,'Initiated',NULL,'1',0),(1015,'DEI17PS200052','2017-08-22 08:34:20',5000,0,'Not Paid','1503390860',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 08:34:20',NULL,NULL,1000,'Initiated',NULL,'1',0),(1016,'DEI17PA10001D','2017-08-22 08:53:29',5000,0,'Not Paid','1503392009',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 08:53:29',NULL,NULL,1000,'Initiated',NULL,'1',0),(1017,'DEI17PA20001E','2017-08-22 08:53:49',15000,0,'Not Paid','1503392029',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 08:53:49',NULL,NULL,1000,'Initiated',NULL,'1',0),(1018,'DEI17PA10001F','2017-08-22 09:06:59',5000,0,'Not Paid','1503392819',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 09:06:59',NULL,NULL,1000,'Initiated',NULL,'1',0),(1019,'DEI17PA100020','2017-08-22 09:36:03',5000,0,'Not Paid','1503394562',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 09:36:02',NULL,NULL,1000,'Initiated',NULL,'1',0),(1020,'DEI17PA100021','2017-08-22 09:37:28',5000,0,'Not Paid','1503394648',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 09:37:28',NULL,NULL,1000,'Initiated',NULL,'1',0),(1021,'DEI17PA100022','2017-08-22 09:40:38',5000,0,'Not Paid','1503394838',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 09:40:38',NULL,NULL,1000,'Initiated',NULL,'1',0),(1022,'DEI17PA000023','2017-08-22 14:02:07',0,0,'Not Paid','1503410527',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 14:02:07',NULL,NULL,1000,'Initiated',NULL,'1',0),(1023,'DEI17PA100026','2017-08-22 14:11:39',50000,0,'Not Paid','1503411099',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 14:11:39',NULL,NULL,1000,'Initiated',NULL,'1',0),(1024,'DEI17PX200056','2017-08-22 14:32:41',5000,0,'Not Paid','1503412361',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 14:32:41',NULL,NULL,1000,'Initiated',NULL,'1',0),(1025,'DEI17PA100027','2017-08-22 15:03:54',50000,0,'Not Paid','1503414234',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-22 15:03:54',NULL,NULL,1000,'Initiated',NULL,'1',0),(1026,'DEI17PA400029','2017-08-23 04:41:06',400000,0,'Not Paid','1503463266',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-23 04:41:06',NULL,NULL,1000,'Initiated',NULL,'1',0),(1027,'DEI17PA10002A','2017-08-23 04:48:55',50000,0,'Not Paid','1503463735',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-23 04:48:55',NULL,NULL,1000,'Initiated',NULL,'1',0),(1028,'DEI17PA10002B','2017-08-23 04:53:08',50000,0,'Not Paid','1503463988',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-23 04:53:08',NULL,NULL,1000,'Initiated',NULL,'1',0),(1029,'DEI17PA10002C','2017-08-23 04:54:02',50000,0,'Not Paid','1503464042',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-23 04:54:02',NULL,NULL,1000,'Initiated',NULL,'1',0),(1030,'DEI17PA100031','2017-08-23 06:15:46',50000,0,'Not Paid','1503468946',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-23 06:15:46',NULL,NULL,1000,'Initiated',NULL,'1',0),(1031,'DEI17PA100033','2017-08-23 06:31:15',50000,0,'Not Paid','1503469875',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-23 06:31:15',NULL,NULL,1000,'Initiated',NULL,'1',0),(1032,'DEI17PX200059','2017-08-23 06:32:21',5000,0,'Not Paid','1503469941',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-08-23 06:32:21',NULL,NULL,1000,'Initiated',NULL,'1',0),(1033,'DEI17PA100002','2017-09-15 10:50:36',50000,0,'Not Paid','1505472636',NULL,'super admin','1234567890','sa@devrabbit.com','','2017-09-15 16:20:36',NULL,NULL,1009,'Initiated',NULL,'1',0),(1034,'DEI17PA100007','2017-09-20 12:42:03',50000,0,'Not Paid','1505911323',NULL,'zonal sales manager','1234567890','zsm@devrabbit.com','','2017-09-20 18:12:03',NULL,NULL,1007,'Initiated',NULL,'1',0),(1035,'DEI17PA100008','2017-09-20 12:44:14',50000,0,'Not Paid','1505911454',NULL,'zonal sales manager','1234567890','zsm@devrabbit.com','','2017-09-20 18:14:14',NULL,NULL,1007,'Initiated',NULL,'1',0),(1036,'DEI17PA100009','2017-09-20 12:44:40',50000,0,'Not Paid','1505911480',NULL,'zonal sales manager','1234567890','zsm@devrabbit.com','','2017-09-20 18:14:40',NULL,NULL,1007,'Initiated',NULL,'1',0),(1037,'DEI17PS200067','2017-09-25 09:21:25',5000,0,'Not Paid','1506331285',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-09-25 14:51:25',NULL,NULL,1000,'Initiated',NULL,'1',103),(1038,'DEI17PA10000A','2017-09-25 09:24:32',50000,0,'Not Paid','1506331472',NULL,'basaveswar','9030880086','basaveswar.allaka@devrabbit.com','','2017-09-25 14:54:32',NULL,NULL,1000,'Initiated',NULL,'2',10);
/*!40000 ALTER TABLE `core_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_permissions`
--

DROP TABLE IF EXISTS `core_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_action_name` varchar(45) NOT NULL,
  `permission_display_name` varchar(45) NOT NULL,
  `permission_description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_permissions`
--

LOCK TABLES `core_permissions` WRITE;
/*!40000 ALTER TABLE `core_permissions` DISABLE KEYS */;
INSERT INTO `core_permissions` VALUES (1,'user_action','User Actions',NULL),(2,'employee_action','Employee Actions',NULL),(3,'order_action','Order Actions',NULL),(4,'product_action','Product Actions',NULL),(5,'advertisement_action','Advertisement Actions',NULL),(6,'payment_action','Payment Actions',NULL),(7,'image_action','Image Actions',NULL),(8,'corporate_action','Corporate Actions',NULL),(9,'setup_action','Setup Actions',NULL),(10,'role_action','Role and Permission Actions',NULL);
/*!40000 ALTER TABLE `core_permissions` ENABLE KEYS */;
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
  `ad_weblink` varchar(250) NOT NULL,
  `ad_expire` datetime NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_post_ads`
--

LOCK TABLES `core_post_ads` WRITE;
/*!40000 ALTER TABLE `core_post_ads` DISABLE KEYS */;
INSERT INTO `core_post_ads` VALUES (1,'super admin',1009,'DEI ad1','asdf','',0,'','2017-10-31 23:59:59'),(2,'super admin',1009,'DEI ad2','','',1,'','2017-10-15 16:20:36'),(3,'super admin',1009,'DEI ad3','','',0,'','2017-10-31 23:59:59'),(4,'basaveswar',1000,'adf','','',0,'','2017-10-31 23:59:59'),(5,'zonal sales manager',1007,'asdf','','',0,'','2017-10-31 23:59:59'),(6,'zonal sales manager',1007,'sdafaf','','',1,'','2017-10-20 17:21:00'),(7,'zonal sales manager',1007,'React Base Fiddle (JSX)','','',1,'','2017-10-20 18:12:03'),(8,'zonal sales manager',1007,'Test equipment title','','',1,'http://asdf.com','2017-10-20 18:14:14'),(9,'zonal sales manager',1007,'asdfasdf','','',1,'','2017-10-20 18:14:40'),(10,'basaveswar',1000,'asdfasf','','',1,'','2017-10-25 14:54:32');
/*!40000 ALTER TABLE `core_post_ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_post_ads_images`
--

DROP TABLE IF EXISTS `core_post_ads_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_post_ads_images` (
  `ads_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `ad_image_name` varchar(45) NOT NULL,
  `ad_image_url` varchar(250) NOT NULL,
  `ad_image_expire` datetime NOT NULL,
  `ad_image_status` int(5) NOT NULL COMMENT '0=Inacive,1=Active.2=Deleted',
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`ads_image_id`),
  KEY `ad_id` (`ad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_post_ads_images`
--

LOCK TABLES `core_post_ads_images` WRITE;
/*!40000 ALTER TABLE `core_post_ads_images` DISABLE KEYS */;
INSERT INTO `core_post_ads_images` VALUES (1,1,'fb_85411505472613.jpg','http://localhost/dei/web/uploads/fb_85411505472613.jpg','2017-10-31 23:59:59',0,NULL,NULL),(2,1,'fb_22131505472613.jpg','http://localhost/dei/web/uploads/fb_22131505472613.jpg','2017-10-31 23:59:59',0,NULL,NULL),(3,2,'fb_8631505472634.jpg','http://localhost/dei/web/uploads/fb_8631505472634.jpg','2017-10-15 16:20:36',1,NULL,NULL),(4,3,'fb_40911505472659.png','http://localhost/dei/web/uploads/fb_40911505472659.png','2017-10-31 23:59:59',0,NULL,NULL),(5,4,'fb_91111505884556.jpg','http://localhost/dei/web/uploads/fb_91111505884556.jpg','2017-10-31 23:59:59',3,1000,'2017-09-25 16:21:08'),(6,5,'fb_79271505907541.jpg','http://localhost/dei/web/uploads/fb_79271505907541.jpg','2017-10-31 23:59:59',0,NULL,NULL),(7,7,'fb_44041505911320.jpg','http://localhost:8080/uploads/fb_44041505911320.jpg','2017-10-20 18:12:03',1,NULL,NULL),(8,8,'fb_4561505911452.jpg','http://localhost:8080/uploads/fb_4561505911452.jpg','2017-10-20 18:14:14',1,NULL,NULL),(9,9,'fb_20661505911473.jpg','http://localhost:8080/uploads/fb_20661505911473.jpg','2017-10-20 18:14:40',1,NULL,NULL),(10,10,'fb_84491506331469.jpg','http://localhost:8080/uploads/fb_84491506331469.jpg','2017-10-25 14:54:32',1,NULL,NULL);
/*!40000 ALTER TABLE `core_post_ads_images` ENABLE KEYS */;
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
  `range_value` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`capacity_id`),
  KEY `category_id` (`category_id`),
  KEY `sub_category_id` (`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_capacity`
--

LOCK TABLES `core_product_capacity` WRITE;
/*!40000 ALTER TABLE `core_product_capacity` DISABLE KEYS */;
INSERT INTO `core_product_capacity` VALUES (1,'0 to 50 Tons','0 and 50',1,1,1,'50',5000.00),(2,'51 to 100 Tons','51 and 100',1,1,1,'100',10000.00),(3,'101 to 150 Tons','101 and 150',1,1,1,'150',10000.00),(4,'151 to 200 Tons','151 and 200',1,1,1,'200',10000.00),(5,'201 to 300 Tons','201 and 300',1,1,1,'300',10000.00),(6,'301 to 400 Tons','301 and 400',1,1,1,'400',10000.00),(7,'401 to 500 Tons','401 and 500',1,1,1,'500',10000.00),(8,'500 Tons above','>500',1,1,1,'501',10000.00),(9,'0 to 50 Tons','0 and 50',2,1,1,'50',5000.00),(10,'51 to 100 Tons','51 and 100',2,1,1,'100',10000.00),(11,'101 to 150 Tons','101 and 150',2,1,1,'150',10000.00),(12,'151 to 200 Tons','151 and 200',2,1,1,'200',10000.00),(13,'201 to 300 Tons','201 and 300',2,1,1,'300',10000.00),(14,'301 to 400 Tons','301 and 400',2,1,1,'400',10000.00),(15,'401 to 500 Tons','401 and 500',2,1,1,'500',10000.00),(16,'500 Tons above','>500',2,1,1,'501',10000.00),(17,'0 to 50 Tons','0 and 50',3,1,1,'50',5000.00),(18,'51 to 100 Tons','51 and 100',3,1,1,'100',10000.00),(19,'101 to 150 Tons','101 and 150',3,1,1,'150',10000.00),(20,'151 to 200 Tons','151 and 200',3,1,1,'200',10000.00),(21,'201 to 300 Tons','201 and 300',3,1,1,'300',10000.00),(22,'301 to 400 Tons','301 and 400',3,1,1,'400',10000.00),(23,'401 to 500 Tons','401 and 500',3,1,1,'500',10000.00),(24,'500 Tons above','>500',3,1,1,'501',10000.00),(25,'0 to 50 Tons','0 and 50',4,1,1,'50',5000.00),(26,'51 to 100 Tons','51 and 100',4,1,1,'100',10000.00),(27,'101 to 150 Tons','101 and 150',4,1,1,'150',10000.00),(28,'151 to 200 Tons','151 and 200',4,1,1,'200',10000.00),(29,'201 to 300 Tons','201 and 300',4,1,1,'300',10000.00),(30,'301 to 400 Tons','301 and 400',4,1,1,'400',10000.00),(31,'401 to 500 Tons','401 and 500',4,1,1,'500',10000.00),(32,'500 Tons above','>500',4,1,1,'501',10000.00),(33,'0 to 50 Tons','0 and 50',6,1,1,'50',5000.00),(34,'51 to 100 Tons','51 and 100',6,1,1,'100',10000.00),(35,'101 to 150 Tons','101 and 150',6,1,1,'150',10000.00),(36,'151 to 200 Tons','151 and 200',6,1,1,'200',10000.00),(37,'201 to 300 Tons','201 and 300',6,1,1,'300',10000.00),(38,'301 to 400 Tons','301 and 400',6,1,1,'400',10000.00),(39,'401 to 500 Tons','401 and 500',6,1,1,'500',10000.00),(40,'500 Tons above','>500',6,1,1,'501',10000.00),(41,'0 to 2 Tons','0 and 2',7,1,1,'2',5000.00),(42,'3 to 50 Tons','3 and 50',7,1,0,'50',5000.00),(43,'3 Tons above','>3',7,1,1,'4',10000.00),(44,'0 to 100 KN','0 and 100',29,5,1,'100',10000.00),(45,'101 to 180 KN','101 and 180',29,5,1,'180',10000.00),(46,'181 to 360 KN','181 and 360',29,5,1,'360',10000.00),(47,'361 KN above','>360',29,5,1,'361',10000.00),(48,'0 to 2 Tons','0 and 2',17,3,1,'2',5000.00),(49,'3 to 20 Tons','3 and 20',20,3,1,'20',10000.00),(50,'21 to 50 Tons','21 and 50',20,3,1,'50',10000.00),(51,'51 to 80 Tons','51 and 80',20,3,1,'80',10000.00),(52,'3 to 20 Tons','3 and 20',21,3,1,'20',10000.00),(53,'21 to 50 Tons','21 and 50',21,3,1,'50',10000.00),(54,'51 to 80 Tons','51 and 80',21,3,1,'80',10000.00),(55,'3 to 20 Tons','3 and 20',22,3,1,'20',10000.00),(56,'21 to 50 Tons','21 and 50',22,3,1,'50',10000.00),(57,'51 to 80 Tons','51 and 80',22,3,1,'80',10000.00),(58,'0 to 10 Tons','0 and 10',12,2,1,'10',5000.00),(59,'11 to 40 Tons','11 and 40',12,2,1,'40',5000.00),(60,'41 Tons above','>40',12,2,1,'41',5000.00),(61,'0 to 10 Tons','0 and 10',13,2,1,'10',5000.00),(62,'11 to 40 Tons','11 and 40',13,2,1,'40',5000.00),(63,'41 Tons above','>40',13,2,1,'41',5000.00),(64,'0 to 10 Tons','0 and 10',14,2,1,'10',5000.00),(65,'11 to 40 Tons','11 and 40',14,2,1,'40',5000.00),(66,'41 Tons above','>40',14,2,1,'41',5000.00),(67,'0 to 10 Tons','0 and 10',15,2,1,'10',5000.00),(68,'11 to 40 Tons','11 and 40',15,2,1,'40',5000.00),(69,'41 Tons above','>40',15,2,1,'41',5000.00),(70,'0 to 10 Tons','0 and 10',16,2,1,'10',5000.00),(71,'11 to 40 Tons','11 and 40',16,2,1,'40',5000.00),(72,'41 Tons above','>40',16,2,1,'41',5000.00),(73,'0 to 250 KVA','0 and 10',23,4,1,'250',5000.00),(74,'251 to 500 KVA','11 and 40',23,4,1,'500',5000.00),(75,'501 KVA above','>500',23,4,1,'501',5000.00),(76,'0 to 250 KVA','0 and 10',24,4,1,'250',5000.00),(77,'251 to 500 KVA','11 and 40',24,4,1,'500',5000.00),(78,'501 KVA above','>500',24,4,1,'501',5000.00),(79,'0 to 250 KVA','0 and 10',25,4,1,'250',5000.00),(80,'251 to 500 KVA','11 and 40',25,4,1,'500',5000.00),(81,'501 KVA above','>500',25,4,1,'501',5000.00),(82,'0 to 250 KVA','0 and 10',26,4,1,'250',5000.00),(83,'251 to 500 KVA','11 and 40',26,4,1,'500',5000.00),(84,'501 KVA above','>500',26,4,1,'501',5000.00),(85,'0 to 250 KVA','0 and 10',27,4,1,'250',5000.00),(86,'251 to 500 KVA','11 and 40',27,4,1,'500',5000.00),(87,'501 KVA above','>500',27,4,1,'501',5000.00),(88,'0 to 25 Tons','0 and 25',10,1,1,'25',5000.00),(89,'26 to 50 Tons','25 and 50',10,1,1,'50',5000.00),(90,'51 Tons above','>50',10,1,1,'51',10000.00),(91,'0 to 25 Tons','0 and 25',33,1,1,'25',5000.00),(92,'26 to 50 Tons','25 and 50',33,1,1,'50',5000.00),(93,'51 Tons above','>50',33,1,1,'51',10000.00),(94,'0 to 50','0 and 50',1,1,2,'0',5000.00),(95,'51 Tons above','>50',1,1,2,'51',10000.00),(96,'0 to 50','0 and 50',2,1,2,'0',5000.00),(97,'51 Tons above','>50',2,1,2,'51',10000.00),(98,'0 to 50','0 and 50',3,1,2,'0',5000.00),(99,'51 Tons above','>50',3,1,2,'51',10000.00),(100,'0 to 50','0 and 50',4,1,2,'0',5000.00),(101,'51 Tons above','>50',4,1,2,'51',10000.00),(102,'0 to 50','0 and 50',5,1,2,'0',5000.00),(103,'51 Tons above','>50',5,1,2,'51',10000.00),(104,'0 to 50','0 and 50',6,1,2,'0',5000.00),(105,'51 Tons above','>50',6,1,2,'51',10000.00),(106,'0 to 50','0 and 50',7,1,2,'0',5000.00),(107,'51 Tons above','>50',7,1,2,'51',10000.00),(108,'0 to 50','0 and 50',8,1,2,'0',5000.00),(109,'51 Tons above','>50',8,1,2,'51',10000.00),(110,'0 to 50','0 and 50',9,1,2,'0',5000.00),(111,'51 Tons above','>50',9,1,2,'51',10000.00),(112,'0 to 50','0 and 50',10,1,2,'0',5000.00),(113,'51 Tons above','>50',10,1,2,'51',10000.00),(114,'0 to 50','0 and 50',33,1,2,'0',5000.00),(115,'51 Tons above','>50',33,1,2,'51',10000.00),(116,'0 KN above','>0',29,5,2,'0',10000.00),(117,'0 KN above','>0',30,5,2,'0',5000.00),(118,'0 KN above','>0',31,5,2,'0',5000.00),(119,'0 KN above','>0',32,5,2,'0',10000.00),(120,'0 TONS above','>0',17,3,2,'0',5000.00),(121,'0 TONS above','>0',18,3,2,'0',10000.00),(122,'0 TONS above','>0',19,3,2,'0',10000.00),(123,'0 TONS above','>0',20,3,2,'0',10000.00),(124,'0 TONS above','>0',21,3,2,'0',10000.00),(125,'0 TONS above','>0',22,3,2,'0',10000.00),(126,'0 TONS above','>0',12,2,2,'0',5000.00),(127,'0 TONS above','>0',13,2,2,'0',5000.00),(128,'0 TONS above','>0',14,2,2,'0',5000.00),(129,'0 TONS above','>0',15,2,2,'0',5000.00),(130,'0 TONS above','>0',16,2,2,'0',5000.00),(131,'0 KVA above','>0',23,4,2,'0',5000.00),(132,'0 KVA above','>0',24,4,2,'0',5000.00),(133,'0 KVA above','>0',25,4,2,'0',5000.00),(134,'0 KVA above','>0',26,4,2,'0',5000.00),(135,'0 KVA above','>0',27,4,2,'0',5000.00);
/*!40000 ALTER TABLE `core_product_capacity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_product_capacity_old`
--

DROP TABLE IF EXISTS `core_product_capacity_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_product_capacity_old` (
  `capacity_id` int(11) NOT NULL AUTO_INCREMENT,
  `capacity_name` varchar(255) DEFAULT NULL,
  `capacity_range` varchar(50) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `capacity_status` tinyint(5) NOT NULL DEFAULT '1' COMMENT '1= active, 2=in-active',
  `range_value` int(7) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`capacity_id`),
  KEY `category_id` (`category_id`),
  KEY `sub_category_id` (`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_capacity_old`
--

LOCK TABLES `core_product_capacity_old` WRITE;
/*!40000 ALTER TABLE `core_product_capacity_old` DISABLE KEYS */;
INSERT INTO `core_product_capacity_old` VALUES (1,'0 to 50 Tons','0 and 50',1,1,1,50,5000.00),(2,'51 to 70 Tons','51 and 70',1,1,1,70,5000.00),(3,'71 to 100 Tons','71 and 100',1,1,1,100,10000.00),(4,'101 to 125 Tons','101 and 125',1,1,1,125,10000.00),(5,'126 to 150 Tons','126 and 150',1,1,1,150,10000.00),(6,'151 to 200 Tons','151 and 200',1,1,1,200,25000.00),(7,'201 to 250 Tons','201 and 250',1,1,1,250,25000.00),(8,' 251 to 300 Tons','251 and 300',1,1,1,300,25000.00),(9,'301 to 350 Tons','301 and 350',1,1,1,350,25000.00),(10,'351 to 400 Tons','351 and 400',1,1,1,400,25000.00),(11,'401 to 500 Tons','401 and 500',1,1,1,500,25000.00),(12,'500 Tons above','>500',1,1,1,501,25000.00),(13,'0 to 50 Tons','0 and 50',2,1,1,50,5000.00),(14,'51 to 70 Tons','51 and 70',2,1,1,70,5000.00),(15,'71 to 100 Tons','71 and 100',2,1,1,100,10000.00),(16,'101 to 125 Tons','101 and 125',2,1,1,125,10000.00),(17,'125 to 150 Tons','125 and 150',2,1,1,150,10000.00),(18,'151 to 200 Tons','151 and 200',2,1,1,200,10000.00),(19,'201 to 250 Tons','201 and 250',2,1,1,250,25000.00),(20,'251 to 300 Tons','251 and 300',2,1,1,300,0.00),(21,'301 to 350 Tons','301 and 350',2,1,1,350,0.00),(22,'351 to 400 Tons','351 and 400',2,1,1,400,0.00),(23,'401 to 500 Tons','401 and 500',2,1,1,500,0.00),(24,'500 Tons above','>500',2,1,1,501,0.00),(25,'0 to 50 Tons','0 and 50',3,1,1,50,0.00),(26,'51 to 70 Tons','51 and 70',3,1,1,70,0.00),(27,'71 to 100 Tons','71 and 100',3,1,1,100,0.00),(28,'101 to 125 Tons','101 and 125',3,1,1,125,0.00),(29,'126 to 150 Tons','126 and 150',3,1,1,150,0.00),(30,'151 to 200 Tons','151 and 200',3,1,1,200,0.00),(31,'201 to 250 Tons','201 and 250',3,1,1,250,0.00),(32,'251 to 300 Tons','251 and 300',3,1,1,300,0.00),(33,'301 to 350 Tons','301 and 350',3,1,1,350,0.00),(34,'351 to 400 Tons','351 and 400',3,1,1,400,0.00),(35,'401 to 500 Tons','401 and 500',3,1,1,500,0.00),(36,'500 Tons above','>500',3,1,1,501,0.00),(37,'0 to 50 Tons','0 and 50',4,1,1,50,0.00),(38,'51 to 70 Tons','51 and 70',4,1,1,70,0.00),(39,'71 to 100 Tons','71 and 100',4,1,1,100,0.00),(40,'101 to 125 Tons','101 and 125',4,1,1,125,0.00),(41,'126 to 150 Tons','126 and 150',4,1,1,150,0.00),(42,'151 to 200 Tons','151 and 200',4,1,1,200,0.00),(43,'201 to 250 Tons','201 and 250',4,1,1,250,0.00),(44,'251 to 300 Tons','251 and 300',4,1,1,300,0.00),(45,'301 to 350 Tons','301 and 350',4,1,1,350,0.00),(46,'351 to 400 Tons','351 and 400',4,1,1,400,0.00),(47,'401 to 500 Tons','401 and 500',4,1,1,500,0.00),(48,'500 Tons & above','>500',4,1,1,501,0.00),(49,'0 to 2 Tons','0 and 2',5,1,1,2,0.00),(51,'3 Tons above','>3',5,1,1,4,0.00),(52,'0 to 99 Tons','0 and 99',6,1,1,100,0.00),(53,'100 Tons above','>100',6,1,1,101,0.00),(54,'0 to 1 Tons','0 and 1',7,1,1,1,0.00),(55,'2 to 3 Tons','2 and 3',7,1,1,2,0.00),(57,'4 Tons above','>4',7,1,1,4,0.00),(58,'0 to 25 Tons','0 and 25',10,1,1,25,0.00),(59,'26 Tons Above','>26',10,1,1,26,0.00),(60,'0 to 35 Tons','0 and 35',33,1,1,35,0.00),(61,'35 Tons Above','>35',33,1,1,36,0.00),(62,'0-130 KN','0 and 130',29,5,1,130,0.00),(63,'131-180 KN','131 and 180',29,5,1,180,0.00),(64,'181-360 KN','181 and 360',29,5,1,360,0.00),(65,'361 KN above','>361',29,5,1,361,0.00),(168,'0 - 1 Tons','0 and 1',17,3,1,2,0.00),(169,'2 Tons Above','>2',17,3,1,3,0.00),(174,'0-20 Tons','0 and 20',21,3,1,20,0.00),(175,'21-50 Tons','21 and 50',21,3,1,50,0.00),(176,'51-80 Tons','51 and 80',21,3,1,80,0.00),(177,'81 Tons Above','>81',21,3,1,81,0.00),(178,'0-10 Tons','0 and 10',12,2,1,10,0.00),(179,'11-40 Tons','11 and 40',12,2,1,39,0.00),(180,'41 & above','>41',12,2,1,40,0.00),(181,'0-10 Tons','0 and 10',13,2,1,10,0.00),(182,'11-40 Tons','11 and 40',13,2,1,39,0.00),(183,'41 & above','>41',13,2,1,40,0.00),(184,'0-10 Tons','0 and 10',14,2,1,10,0.00),(185,'11-40 Tons','11 and 40',14,2,1,39,0.00),(186,'41 & above','>41',14,2,1,40,0.00),(187,'0-10 Tons','0 and 10',15,2,1,10,0.00),(188,'11-40 Tons','11 and 40',15,2,1,39,0.00),(189,'41 & above','>41',15,2,1,40,0.00),(190,'0-10 Tons','0 and 10',16,2,1,10,0.00),(191,'11-40 Tons','11 and 40',16,2,1,39,0.00),(192,'41 & above','>41',16,2,1,40,0.00),(193,'0-250 KVA','0 and 250',23,4,1,250,0.00),(194,'251-500 KVA','251 and 500',23,4,1,500,0.00),(195,'501 & above','>501',23,4,1,501,0.00),(196,'0-250 KVA','0 and 250',24,4,1,250,0.00),(197,'251-500 KVA','251 and 500',24,4,1,500,0.00),(198,'501 & above','>501',24,4,1,501,0.00),(199,'0-250 KVA','0 and 250',25,4,1,250,0.00),(200,'251-500 KVA','251 and 500',25,4,1,500,0.00),(201,'501 & above','>501',25,4,1,501,0.00),(202,'0-250 KVA','0 and 250',26,4,1,250,0.00),(203,'251-500 KVA','251 and 500',26,4,1,500,0.00),(204,'501 & above','>501',26,4,1,501,0.00),(205,'0-250 KVA','0 and 250',27,4,1,250,0.00),(206,'251-500 KVA','251 and 500',27,4,1,500,0.00),(207,'501 & above','>501',27,4,1,501,0.00);
/*!40000 ALTER TABLE `core_product_capacity_old` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_images`
--

LOCK TABLES `core_product_images` WRITE;
/*!40000 ALTER TABLE `core_product_images` DISABLE KEYS */;
INSERT INTO `core_product_images` VALUES (1,1,'dei_496381500991783','http://devrabbitdev.com/dei/web//uploads/dei_238511501150718',1,1,'2017-07-27 10:18:45'),(2,2,'dei_238511501150718','uploads/dei_265751501224592',1,1,'2017-07-28 06:49:59'),(3,3,'fb_68431501074978.jpg','localhost:8080/uploads/2017/Piling Rigs/dei_484001501241784',1,1,'2017-07-28 11:36:35'),(4,4,'bc_22651494569801-705.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_16011501242054',1,1,'2017-07-28 11:40:59'),(5,5,'DEI_AD_1.jpg','localhost:8080/uploads/2017/Cranes/dei_127751501249370',1,1,'2017-07-28 13:43:03'),(6,6,'fb_991501076354.jpg','localhost:8080/uploads/2017/Dumpers/dei_450671501250975',1,1,'2017-07-28 14:09:39'),(7,6,'fb_5841501075935.jpg','localhost:8080/uploads/2017/Dumpers/dei_367931501250975',1,1,'2017-07-28 14:09:39'),(8,6,'fb_80361501075935.jpg','localhost:8080/uploads/2017/Dumpers/dei_316881501250975',1,1,'2017-07-28 14:09:39'),(9,6,'fb_99131501075897.jpg','localhost:8080/uploads/2017/Dumpers/dei_487001501250975',1,1,'2017-07-28 14:09:39'),(10,6,'fb_60631501075217.jpg','localhost:8080/uploads/2017/Dumpers/dei_412861501250975',1,1,'2017-07-28 14:09:39'),(11,7,'fb_5841501075935.jpg','localhost:8080/uploads/2017/Cranes/dei_208191501515001',1,1,'2017-07-31 15:30:09'),(12,7,'fb_99131501075897.jpg','localhost:8080/uploads/2017/Cranes/dei_load_chart183001501515004',2,1,'2017-07-31 15:30:09'),(13,8,'DEI_AD_1.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_419081501590505',1,1,'2017-08-01 12:29:08'),(14,9,'DEI_AD_1.jpg','localhost:8080/uploads/2017/Cranes/dei_373331501590635',1,1,'2017-08-01 12:30:42'),(15,10,'DEI_AD_1.jpg','localhost:8080/uploads/2017/Cranes/dei_169041501590778',1,1,'2017-08-01 12:33:02'),(16,11,'DEI_AD_1.jpg','localhost:8080/uploads/2017/Excavators/dei_265281501597948jpg',1,1,'2017-08-01 14:32:33'),(17,12,'DEI_AD_1.jpg','localhost:8080/uploads/2017/Excavators/dei_303591501598071.jpg',1,1,'2017-08-01 14:34:36'),(18,13,'DEI_AD_1.jpg','localhost:8080/uploads/2017/Cranes/dei_458171501763208.jpg',1,1,'2017-08-03 12:26:56'),(19,14,'fb_40721501242943.jpg','localhost:8080/uploads/2017/Generators/dei_134921501823162.jpg',1,1,'2017-08-04 05:06:05'),(20,15,'fb_99131501075897.jpg','localhost:8080/uploads/2017/Generators/dei_291151501823655.jpg',1,1,'2017-08-04 05:14:19'),(21,23,'59321501074350.jpg','localhost:8080/uploads/2017/Dumpers/dei_150251501824004.jpg',1,1,'2017-08-04 05:20:09'),(22,25,'27671493895233.jpg','localhost:8080/uploads/2017/Excavators/dei_137771501824300.jpg',1,1,'2017-08-04 05:25:04'),(23,27,'12481494394922.jpg','localhost:8080/uploads/2017/Dumpers/dei_91881501824486.jpg',1,1,'2017-08-04 05:28:11'),(24,28,'18251494394922.jpg','localhost:8080/uploads/2017/Dumpers/dei_377571501824533.jpg',1,1,'2017-08-04 05:29:19'),(25,29,'19431493894775.jpg','localhost:8080/uploads/2017/Dumpers/dei_209691501824666.jpg',1,1,'2017-08-04 05:31:08'),(26,30,'21901493894452.jpg','localhost:8080/uploads/2017/Dumpers/dei_469311501824822.jpg',1,1,'2017-08-04 05:33:45'),(27,33,'27671493895233.jpg','localhost:8080/uploads/2017/Dumpers/dei_480271501825282.jpg',1,1,'2017-08-04 05:41:41'),(28,39,'fb_5841501075935.jpg','localhost:8080/uploads/2017/Excavators/dei_61831501826978.jpg',1,1,'2017-08-04 06:11:01'),(29,41,'fb_99131501075897.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_66901501827688.jpg',1,1,'2017-08-04 06:26:31'),(30,48,'fb_5841501075935.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_239291501828819.jpg',1,1,'2017-08-04 06:40:25'),(31,49,'fb_59741501593842.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_195281501828898.jpg',1,1,'2017-08-04 06:41:43'),(32,51,'fb_5841501075935.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_489781501829341.jpg',1,1,'2017-08-04 06:49:05'),(33,52,'fb_59741501593842.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_154831501829742.jpg',1,1,'2017-08-04 06:55:44'),(34,53,'fb_9171501242943.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_210751501829911.jpg',1,1,'2017-08-04 06:58:34'),(35,54,'fb_9171501242943.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_435891501829953.jpg',1,1,'2017-08-04 06:59:15'),(36,55,'fb_9171501242943.jpg','localhost:8080/uploads/2017/Piling_Rigs/dei_339791501831669.jpg',1,1,'2017-08-04 07:27:52'),(37,58,'DEI_v1_Icon.png','localhost:8080/uploads/2017/Generators/dei_460251502175094.png',1,1,'2017-08-08 06:51:43'),(38,62,'DEI_v1_Icon.png','localhost:8080/uploads/2017/Generators/dei_465951502175566.png',1,1,'2017-08-08 06:59:29'),(39,63,'DEI_v1_Icon.png','localhost:8080/uploads/2017/Excavators/dei_165911502183144.png',1,1,'2017-08-08 09:05:49'),(40,64,'loading.gif','localhost/dei/web/uploads/2017/Excavators/dei_272281502366654.gif',1,1,'2017-08-10 12:04:20'),(41,65,'fb_80361501075935.jpg','localhost/dei/web/uploads/2017/Cranes/dei_455661502368308.jpg',1,2,'2017-08-10 12:31:57'),(42,66,'bc_134881494570813-136601.jpg','localhost/dei/web/uploads/2017/Cranes/dei_325951502859139.jpg',1,1,'2017-08-16 04:52:23'),(43,67,'fb_60631501075217.jpg','localhost/dei/web/uploads/2017/Cranes/dei_35571502954795.jpg',1,1,'2017-08-17 07:26:44'),(44,68,'fb_5841501075935.jpg','localhost/dei/web/uploads/2017/Cranes/dei_182231502954898.jpg',1,1,'2017-08-17 07:28:21'),(45,69,'fb_80361501075935.jpg','localhost/dei/web/uploads/2017/Piling_Rigs/dei_200911502955071.jpg',1,1,'2017-08-17 07:31:16'),(46,70,'fb_60631501075217.jpg','localhost/dei/web/uploads/2017/Piling_Rigs/dei_444091502955134.jpg',1,1,'2017-08-17 07:32:17'),(47,71,'fb_39771502979173.jpg','http://localhost:8080/uploads/2017/Cranes/dei_197301503036753.jpg',1,1,'2017-08-18 06:13:12'),(48,72,'bc_160641494307181-1377105397_22aug13-dfccil.jpg','http://localhost:8080/uploads/2017/Excavators/dei_319561503046004.jpg',1,1,'2017-08-18 08:46:50'),(49,73,'bc_22651494569801-705.jpg','http://localhost:8080/uploads/2017/Excavators/dei_300991503046151.jpg',1,1,'2017-08-18 08:49:15'),(50,74,'22431496322352.jpg','http://localhost:8080/uploads/2017/Piling_Rigs/dei_145511503317986.jpg',1,1,'2017-08-21 12:19:52'),(51,75,'bc_394691498820721-bc_218321494574824-69630206-crane-wallpapers.jpg','http://localhost:8080/uploads/2017/Excavators/dei_96811503318099.jpg',1,1,'2017-08-21 12:21:43'),(52,76,'bc_179021494317571-49e7f979971d2b159870e0edf5a73368.jpg','http://localhost:8080/uploads/2017/Excavators/dei_394251503318204.jpg',1,1,'2017-08-21 12:23:28'),(53,77,'bc_337251494361836-Penguins.jpg','http://localhost:8080/uploads/2017/Excavators/dei_163491503318242.jpg',1,1,'2017-08-21 12:24:06'),(54,78,'fb_50031503381013.jpg','http://localhost:8080/uploads/2017/Dumpers/dei_234191503387664.jpg',1,1,'2017-08-22 07:41:07'),(55,79,'fb_81801503380787.jpg','http://localhost:8080/uploads/2017/Dumpers/dei_172191503387785.jpg',1,1,'2017-08-22 07:43:09'),(56,80,'fb_50031503381013.jpg','http://localhost:8080/uploads/2017/Excavators/dei_369991503387934.jpg',1,1,'2017-08-22 07:45:36'),(57,81,'fb_10961503380554.jpg','http://localhost:8080/uploads/2017/Excavators/dei_328101503388001.jpg',1,1,'2017-08-22 07:46:43'),(58,82,'fb_18461503381776.jpg','http://localhost:8080/uploads/2017/Dumpers/dei_67281503390851.jpg',1,1,'2017-08-22 08:34:19'),(59,83,'fb_75371503392819.jpg','http://localhost/dei/web/uploads/2017/Generators/dei_13151503411597.jpg',1,1,'2017-08-22 14:20:07'),(60,84,'fb_55751503394562.jpg','http://localhost/dei/web/uploads/2017/Generators/dei_102901503412068.jpg',1,1,'2017-08-22 14:27:52'),(61,85,'fb_87081503410527.jpg','http://localhost/dei/web/uploads/2017/Generators/dei_260351503412237.jpg',1,1,'2017-08-22 14:30:42'),(62,86,'fb_43981503410527.jpg','http://localhost/dei/web/uploads/2017/Generators/dei_448581503412358.jpg',1,1,'2017-08-22 14:32:41'),(63,87,'46301501674654.jpg','http://localhost/dei/web/uploads/2017/Dumpers/dei_113581503469160.jpg',1,1,'2017-08-23 06:19:31'),(64,88,'46301501674654.jpg','http://localhost/dei/web/uploads/2017/Dumpers/dei_412371503469757.jpg',1,1,'2017-08-23 06:29:21'),(65,89,'46301501674654.jpg','http://localhost/dei/web/uploads/2017/Generators/dei_195541503469937.jpg',1,1,'2017-08-23 06:32:21'),(66,88,'46301501674654.jpg','http://localhost/dei/web/uploads/2017/Cranes/dei_197301503036753.jpg',1,1,'2017-08-23 06:29:21'),(67,82,'Rhino-110C-2.jpg','http://localhost/dei/web/uploads/2017/Dumpers/dei_54071503920138.jpg',1,1,'2017-08-28 11:36:16'),(68,82,'loading.gif','http://localhost/dei/web/uploads/2017/Dumpers/dei_65251503920257.gif',1,1,'2017-08-28 11:38:09'),(69,71,'15XW-banner-2.jpg','http://localhost/dei/web/uploads/2017/Cranes/dei_288831503920859.jpg',1,2,'2017-08-28 11:47:46'),(70,71,'46301501674654.jpg','http://localhost/dei/web/uploads/2017/Cranes/dei_load_chart_260531503920863.jpg',2,1,'2017-08-28 11:47:46'),(71,88,'from_start.jpg','http://localhost:8080/uploads/2017/Cranes/dei_load_chart_328781504083394.jpg',2,1,'2017-08-30 08:56:50'),(72,71,'machine1.jpg','http://localhost:8080/uploads/2017/Cranes/dei_81641504171319.jpg',1,1,'2017-08-31 09:22:04'),(73,90,'machine2.jpg','http://localhost:8080/uploads/2017/Excavators/dei_10271504705488.jpg',1,1,'2017-09-06 13:44:53'),(74,91,'machine1.jpg','http://localhost:8080/uploads/2017/Excavators/dei_376691504705560.jpg',1,1,'2017-09-06 13:46:05'),(75,92,'site_foundation1.jpg','http://localhost:8080/uploads/2017/Excavators/dei_452641504705626.jpg',1,1,'2017-09-06 13:47:09'),(76,93,'site_levelling2.jpg','http://localhost:8080/uploads/2017/Excavators/dei_486481504705679.jpg',1,1,'2017-09-06 13:48:03'),(77,94,'machine1.jpg','http://localhost:8080/uploads/2017/Excavators/dei_498361504705732.jpg',1,1,'2017-09-06 13:48:56'),(78,95,'site_foundation2.jpg','http://localhost:8080/uploads/2017/Excavators/dei_223201504705850.jpg',1,1,'2017-09-06 13:50:53'),(79,96,'from_start.jpg','http://localhost:8080/uploads/2017/Excavators/dei_15391504760900.jpg',1,1,'2017-09-07 05:08:26'),(80,97,'from_start2.jpg','http://localhost:8080/uploads/2017/Excavators/dei_357371504762022.jpg',1,1,'2017-09-07 05:27:06'),(81,98,'from_start.jpg','http://localhost:8080/uploads/2017/Cranes/dei_331231504769687.jpg',1,1,'2017-09-07 07:34:50'),(82,99,'machine2.jpg','http://localhost:8080/uploads/2017/Cranes/dei_280771504773744.jpg',1,1,'2017-09-07 08:42:39'),(83,100,'machine2.jpg','http://localhost:8080/uploads/2017/Piling_Rigs/dei_194331504778477.jpg',1,1,'2017-09-07 10:01:20'),(84,65,'fb_38451503486234.jpg','http://localhost:8080/uploads/2017/Cranes/dei_145271505379302.jpg',1,1,'2017-09-14 08:55:04'),(85,65,'machine3.jpg','http://localhost:8080/uploads/2017/Cranes/dei_454301505380791.jpg',1,1,'2017-09-14 09:19:53'),(86,65,'site_levelling2.jpg','http://localhost:8080/uploads/2017/Cranes/dei_380871505380801.jpg',1,1,'2017-09-14 09:20:13'),(87,101,'Screenshot from 2017-09-15 17:00:44.png','http://localhost:8080/uploads/2017/Dumpers/dei_101011505717759.png',1,1,'2017-09-18 06:56:03'),(88,102,'site_foundation1.jpg','http://localhost:8080/uploads/2017/Cranes/dei_26801505996280.jpg',1,1,'2017-09-21 12:18:05'),(89,102,'15XW-banner-2.jpg','http://localhost:8080/uploads/2017/Cranes/dei_451961506321229.jpg',1,1,'2017-09-25 06:33:51'),(90,102,'rhino90c-banner1.jpg','http://localhost:8080/uploads/2017/Cranes/dei_391951506322447.jpg',1,1,'2017-09-25 06:54:09'),(91,103,'46301501674654.jpg','http://localhost:8080/uploads/2017/Piling_Rigs/dei_108101506331280.jpg',1,1,'2017-09-25 09:21:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_locations`
--

LOCK TABLES `core_product_locations` WRITE;
/*!40000 ALTER TABLE `core_product_locations` DISABLE KEYS */;
INSERT INTO `core_product_locations` VALUES (1,1,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(2,1,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4'),(3,2,1,'83.21848150000005','17.6868159','Visakhapatnam','Andhra Pradesh','India',NULL,'ChIJP5fmiRNDOToRaIRJlQPC2ZI'),(4,2,2,'79.7399875','15.9128998',NULL,'Andhra Pradesh','India',NULL,'ChIJf9STrvhGNToRg82tlb670TM'),(5,3,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(6,3,2,'78.96288','20.593684',NULL,NULL,'India',NULL,'ChIJkbeSa_BfYzARphNChaFPjNc'),(7,4,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(8,5,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(9,5,2,'78.96288','20.593684',NULL,NULL,'India',NULL,'ChIJkbeSa_BfYzARphNChaFPjNc'),(10,6,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(11,7,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(12,7,2,'78.96288','20.593684',NULL,NULL,'India',NULL,'ChIJkbeSa_BfYzARphNChaFPjNc'),(13,8,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(14,9,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(15,10,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(16,11,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(17,12,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(18,13,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(19,14,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(20,15,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(21,16,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(22,17,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(23,18,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(24,19,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(25,20,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(26,21,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(27,22,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(28,23,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(29,24,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(30,25,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(31,26,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(32,27,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(33,28,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(34,29,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(35,30,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(36,31,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(37,32,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(38,33,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(39,34,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(40,35,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(41,36,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(42,37,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(43,38,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(44,39,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(45,40,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(46,41,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(47,42,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(48,43,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(49,44,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(50,45,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(51,46,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(52,47,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(53,48,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(54,49,1,'78.48229820000006','17.3942886','Hyderabad','Telangana','India',NULL,'ChIJzwfxXtmZyzsRMiFMlt7wxBw'),(55,49,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4'),(56,50,1,'78.48229820000006','17.3942886','Hyderabad','Telangana','India',NULL,'ChIJzwfxXtmZyzsRMiFMlt7wxBw'),(57,50,2,'92.6586401','11.7400867',NULL,'Andaman and Nicobar Islands','India',NULL,'ChIJ8w9lKw-gZDARLMv8SFYFgM4'),(58,51,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(59,52,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(60,53,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(61,54,1,'78.48229820000006','17.3942886','Hyderabad','Telangana','India',NULL,'ChIJzwfxXtmZyzsRMiFMlt7wxBw'),(62,55,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(63,58,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(64,62,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(65,63,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(66,64,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(68,66,1,'80.43654019999997','16.30665249999999','Guntur','Andhra Pradesh','India',NULL,'ChIJhXd4sVx1SjoRlObxkN2ZeZ8'),(69,67,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(70,68,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(71,69,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(72,70,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(74,72,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(75,73,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(77,75,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(78,76,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(79,77,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(80,78,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(81,79,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(82,80,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(83,81,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(85,83,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(86,84,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(87,85,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(88,86,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(89,87,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(91,89,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(97,82,1,'78.486671','17.385044','','78.486671','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(107,88,1,'78.486671','17.385044','','78.486671','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(108,71,1,'78.486671','17.385044','','78.486671','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(109,71,2,'78.96288','20.593684',NULL,NULL,'India',NULL,'ChIJkbeSa_BfYzARphNChaFPjNc'),(110,90,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(111,91,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(112,92,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(113,93,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(114,94,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(115,95,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(116,96,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(117,96,2,'78.6568942','22.9734229',NULL,'Madhya Pradesh','India',NULL,'ChIJBepa04FzZjkRHhxwTg1rEOA'),(119,98,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(120,99,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(121,100,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(122,97,1,'78.486671','17.385044','','78.486671','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(123,74,1,'78.486671','17.385044','','78.486671','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(128,65,1,'78.486671','17.385044','','78.486671','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(129,101,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(132,102,1,'78.486671','17.385044','','78.486671','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64'),(133,103,1,'78.486671','17.385044','Hyderabad','Telangana','India',NULL,'ChIJx9Lr6tqZyzsRwvu6koO3k64');
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
  `code_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`model_id`),
  KEY `sub_category_id` (`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=341 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_models`
--

LOCK TABLES `core_product_models` WRITE;
/*!40000 ALTER TABLE `core_product_models` DISABLE KEYS */;
INSERT INTO `core_product_models` VALUES (1,'Grove',1,1,NULL),(2,'Terex',1,1,NULL),(3,'Link - Belt',1,1,NULL),(4,'Locatelli',1,1,NULL),(5,'P&H',1,1,NULL),(6,'Ppm',1,1,NULL),(7,'Tadano',1,1,NULL),(8,'Bendini',1,1,NULL),(9,'Koehring',1,1,NULL),(10,'Koering',1,1,NULL),(11,'Little Giant',1,1,NULL),(12,'Lorain',1,1,NULL),(13,'Mannesmann Dematic',1,1,NULL),(14,'Pettibone',1,1,NULL),(15,'Demag',1,1,NULL),(16,'Liebherr',1,1,NULL),(17,'Faun',1,1,NULL),(18,'Franna',1,1,NULL),(19,'Corradini',1,1,NULL),(20,'Zoomlion',1,1,NULL),(21,'Sany',1,1,NULL),(22,'Xcmg',1,1,NULL),(23,'American',1,1,NULL),(24,'Daewoo',1,1,NULL),(25,'Manitowoc',1,1,NULL),(26,'Kobelco',1,1,NULL),(27,'Mantis',1,1,NULL),(28,'Broderson',1,1,NULL),(29,'Masco',1,1,NULL),(30,'Cinomatic',1,1,NULL),(31,'Benazzato',1,1,NULL),(32,'Ace',1,1,NULL),(33,'Escorts',1,1,NULL),(34,'Aakash',1,1,NULL),(35,'Jcb',1,1,NULL),(36,'Grove',2,1,NULL),(37,'Terex',2,1,NULL),(38,'Link - Belt',2,1,NULL),(39,'Locatelli',2,1,NULL),(40,'P&H',2,1,NULL),(41,'Ppm',2,1,NULL),(42,'Tadano',2,1,NULL),(43,'Bendini',2,1,NULL),(44,'Koehring',2,1,NULL),(45,'Koering',2,1,NULL),(46,'Little Giant',2,1,NULL),(47,'Lorain',2,1,NULL),(48,'Mannesmann Dematic',2,1,NULL),(49,'Pettibone',2,1,NULL),(50,'Demag',2,1,NULL),(51,'Liebherr',2,1,NULL),(52,'Faun',2,1,NULL),(53,'Franna',2,1,NULL),(54,'Corradini',2,1,NULL),(55,'Zoomlion',2,1,NULL),(56,'Sany',2,1,NULL),(57,'Xcmg',2,1,NULL),(58,'American',2,1,NULL),(59,'Daewoo',2,1,NULL),(60,'Manitowoc',2,1,NULL),(61,'Kobelco',2,1,NULL),(62,'Mantis',2,1,NULL),(63,'Broderson',2,1,NULL),(64,'Masco',2,1,NULL),(65,'Cinomatic',2,1,NULL),(66,'Benazzato',2,1,NULL),(67,'Ace',2,1,NULL),(68,'Escorts',2,1,NULL),(69,'Aakash',2,1,NULL),(70,'Jcb',2,1,NULL),(71,'Grove',3,1,NULL),(72,'Terex',3,1,NULL),(73,'Link - Belt',3,1,NULL),(74,'Locatelli',3,1,NULL),(75,'P&H',3,1,NULL),(76,'Ppm',3,1,NULL),(77,'Tadano',3,1,NULL),(78,'Bendini',3,1,NULL),(79,'Koehring',3,1,NULL),(80,'Koering',3,1,NULL),(81,'Little Giant',3,1,NULL),(82,'Lorain',3,1,NULL),(83,'Mannesmann Dematic',3,1,NULL),(84,'Pettibone',3,1,NULL),(85,'Demag',3,1,NULL),(86,'Liebherr',3,1,NULL),(87,'Faun',3,1,NULL),(88,'Franna',3,1,NULL),(89,'Corradini',3,1,NULL),(90,'Zoomlion',3,1,NULL),(91,'Sany',3,1,NULL),(92,'Xcmg',3,1,NULL),(93,'American',3,1,NULL),(94,'Daewoo',3,1,NULL),(95,'Manitowoc',3,1,NULL),(96,'Kobelco',3,1,NULL),(97,'Mantis',3,1,NULL),(98,'Broderson',3,1,NULL),(99,'Masco',3,1,NULL),(100,'Cinomatic',3,1,NULL),(101,'Benazzato',3,1,NULL),(102,'Ace',3,1,NULL),(103,'Escorts',3,1,NULL),(104,'Aakash',3,1,NULL),(105,'Jcb',3,1,NULL),(106,'Grove',4,1,NULL),(107,'Terex',4,1,NULL),(108,'Link - Belt',4,1,NULL),(109,'Locatelli',4,1,NULL),(110,'P&H',4,1,NULL),(111,'Ppm',4,1,NULL),(112,'Tadano',4,1,NULL),(113,'Bendini',4,1,NULL),(114,'Koehring',4,1,NULL),(115,'Koering',4,1,NULL),(116,'Little Giant',4,1,NULL),(117,'Lorain',4,1,NULL),(118,'Mannesmann Dematic',4,1,NULL),(119,'Pettibone',4,1,NULL),(120,'Demag',4,1,NULL),(121,'Liebherr',4,1,NULL),(122,'Faun',4,1,NULL),(123,'Franna',4,1,NULL),(124,'Corradini',4,1,NULL),(125,'Zoomlion',4,1,NULL),(126,'Sany',4,1,NULL),(127,'Xcmg',4,1,NULL),(128,'American',4,1,NULL),(129,'Daewoo',4,1,NULL),(130,'Manitowoc',4,1,NULL),(131,'Kobelco',4,1,NULL),(132,'Mantis',4,1,NULL),(133,'Broderson',4,1,NULL),(134,'Masco',4,1,NULL),(135,'Cinomatic',4,1,NULL),(136,'Benazzato',4,1,NULL),(137,'Ace',4,1,NULL),(138,'Escorts',4,1,NULL),(139,'Aakash',4,1,NULL),(140,'Jcb',4,1,NULL),(141,'Masco',5,1,NULL),(142,'Demag',5,1,NULL),(143,'Grove',6,1,NULL),(144,'American',6,1,NULL),(145,'Link - Belt',6,1,NULL),(146,'P&H',6,1,NULL),(147,'Cinomatic',7,1,NULL),(148,'Benazzato',7,1,NULL),(149,'Ace',7,1,NULL),(150,'Zoomlion',7,1,NULL),(151,'Ace',10,1,NULL),(152,'Escorts',10,1,NULL),(153,'Aakash',10,1,NULL),(154,'Xcmg',10,1,NULL),(155,'Jcb',10,1,NULL),(156,'Komatsu',17,1,NULL),(157,'L&T',17,1,NULL),(158,'Hitachi',17,1,NULL),(159,'Jcb',17,1,NULL),(160,'Sany',17,1,NULL),(161,'Hyundai',17,1,NULL),(162,'Kobelko',17,1,NULL),(163,'Volvo',17,1,NULL),(164,'Tata Hitachi',17,1,NULL),(165,'Caterpillar',17,1,NULL),(166,'Terex',17,1,NULL),(167,'Komatsu',18,1,NULL),(168,'L&T',18,1,NULL),(169,'Hitachi',18,1,NULL),(170,'Jcb',18,1,NULL),(171,'Sany',18,1,NULL),(172,'Hyundai',18,1,NULL),(173,'Kobelko',18,1,NULL),(174,'Volvo',18,1,NULL),(175,'Tata Hitachi',18,1,NULL),(176,'Caterpillar',18,1,NULL),(177,'Terex',18,1,NULL),(178,'Komatsu',19,1,NULL),(179,'L&T',19,1,NULL),(180,'Hitachi',19,1,NULL),(181,'Jcb',19,1,NULL),(182,'Sany',19,1,NULL),(183,'Hyundai',19,1,NULL),(184,'Kobelko',19,1,NULL),(185,'Volvo',19,1,NULL),(186,'Tata Hitachi',19,1,NULL),(187,'Caterpillar',19,1,NULL),(188,'Terex',19,1,NULL),(189,'Komatsu',20,1,NULL),(190,'L&T',20,1,NULL),(191,'Hitachi',20,1,NULL),(192,'Jcb',20,1,NULL),(193,'Sany',20,1,NULL),(194,'Hyundai',20,1,NULL),(195,'Kobelko',20,1,NULL),(196,'Volvo',20,1,NULL),(197,'Tata Hitachi',20,1,NULL),(198,'Caterpillar',20,1,NULL),(199,'Terex',20,1,NULL),(200,'Komatsu',21,1,NULL),(201,'L&T',21,1,NULL),(202,'Hitachi',21,1,NULL),(203,'Jcb',21,1,NULL),(204,'Sany',21,1,NULL),(205,'Hyundai',21,1,NULL),(206,'Kobelko',21,1,NULL),(207,'Volvo',21,1,NULL),(208,'Tata Hitachi',21,1,NULL),(209,'Caterpillar',21,1,NULL),(210,'Terex',21,1,NULL),(211,'Komatsu',22,1,NULL),(212,'L&T',22,1,NULL),(213,'Hitachi',22,1,NULL),(214,'Jcb',22,1,NULL),(215,'Sany',22,1,NULL),(216,'Hyundai',22,1,NULL),(217,'Kobelko',22,1,NULL),(218,'Volvo',22,1,NULL),(219,'Tata Hitachi',22,1,NULL),(220,'Caterpillar',22,1,NULL),(221,'Terex',22,1,NULL),(222,'Ashok Leyland',23,1,NULL),(223,'Cummins - Kirloskar',23,1,NULL),(224,'Caterpillar',23,1,NULL),(225,'Chicago Pneumatic',23,1,NULL),(226,'Honda',23,1,NULL),(227,'Alpha',23,1,NULL),(228,'Genesis',23,1,NULL),(229,'L&T',23,1,NULL),(230,'Esab',23,1,NULL),(231,'Kala Genset',23,1,NULL),(232,'Realco',23,1,NULL),(233,'Siskan Power Systems',23,1,NULL),(234,'Powerica',23,1,NULL),(235,'Greaves Cotton',23,1,NULL),(236,'Ra Powergen Engineers Pvt Ltd',23,1,NULL),(237,'Vinayak Enterprises',23,1,NULL),(238,'Ashok Leyland',24,1,NULL),(239,'Cummins - Kirloskar',24,1,NULL),(240,'Caterpillar',24,1,NULL),(241,'Chicago Pneumatic',24,1,NULL),(242,'Honda',24,1,NULL),(243,'Alpha',24,1,NULL),(244,'Genesis',24,1,NULL),(245,'L&T',24,1,NULL),(246,'Esab',24,1,NULL),(247,'Ashok Leyland',25,1,NULL),(248,'Cummins - Kirloskar',25,1,NULL),(249,'Caterpillar',25,1,NULL),(250,'Chicago Pneumatic',25,1,NULL),(251,'Honda',25,1,NULL),(252,'Alpha',25,1,NULL),(253,'Genesis',25,1,NULL),(254,'L&T',25,1,NULL),(255,'Esab',25,1,NULL),(256,'Ashok Leyland',26,1,NULL),(257,'Cummins - Kirloskar',26,1,NULL),(258,'Caterpillar',26,1,NULL),(259,'Chicago Pneumatic',26,1,NULL),(260,'Honda',26,1,NULL),(261,'Alpha',26,1,NULL),(262,'Genesis',26,1,NULL),(263,'L&T',26,1,NULL),(264,'Esab',26,1,NULL),(265,'Ashok Leyland',27,1,NULL),(266,'Cummins - Kirloskar',27,1,NULL),(267,'Caterpillar',27,1,NULL),(268,'Chicago Pneumatic',27,1,NULL),(269,'Honda',27,1,NULL),(270,'Alpha',27,1,NULL),(271,'Genesis',27,1,NULL),(272,'L&T',27,1,NULL),(273,'Esab',27,1,NULL),(274,'Mait',29,1,NULL),(275,'Sany',29,1,NULL),(276,'Bauer',29,1,NULL),(277,'Soilmec',29,1,NULL),(278,'Liebherr',29,1,NULL),(279,'Casa Grande',29,1,NULL),(280,'Imt',29,1,NULL),(281,'Mait',30,1,NULL),(282,'Sany',30,1,NULL),(283,'Bauer',30,1,NULL),(284,'Soilmec',30,1,NULL),(285,'Liebherr',30,1,NULL),(286,'Casa Grande',30,1,NULL),(287,'Imt',30,1,NULL),(288,'Mait',31,1,NULL),(289,'Sany',31,1,NULL),(290,'Bauer',31,1,NULL),(291,'Soilmec',31,1,NULL),(292,'Liebherr',31,1,NULL),(293,'Casa Grande',31,1,NULL),(294,'Imt',31,1,NULL),(295,'Mait',32,1,NULL),(296,'Sany',32,1,NULL),(297,'Bauer',32,1,NULL),(298,'Soilmec',32,1,NULL),(299,'Liebherr',32,1,NULL),(300,'Casa Grande',32,1,NULL),(301,'Imt',32,1,NULL),(302,'Tata',12,1,NULL),(303,'Volvo',12,1,NULL),(304,'Benz',12,1,NULL),(305,'Ashok Leyland',12,1,NULL),(306,'Tata',13,1,NULL),(307,'Volvo',13,1,NULL),(308,'Benz',13,1,NULL),(309,'Ashok Leyland',13,1,NULL),(310,'Tata',14,1,NULL),(311,'Volvo',14,1,NULL),(312,'Benz',14,1,NULL),(313,'Ashok Leyland',14,1,NULL),(314,'Tata',15,1,NULL),(315,'Volvo',15,1,NULL),(316,'Benz',15,1,NULL),(317,'Ashok Leyland',15,1,NULL),(318,'Tata',16,1,NULL),(319,'Volvo',16,1,NULL),(320,'Benz',16,1,NULL),(321,'Ashok Leyland',16,1,NULL),(322,'LIEBHERR',17,1,NULL),(323,'LIEBHERR',17,0,NULL),(324,'Custom',50,1,NULL),(333,'KATO',1,1,NULL),(334,'KATO',2,1,NULL),(335,'KATO',3,1,NULL),(336,'KATO',4,1,NULL),(337,'KATO',6,1,NULL),(338,'KATO',7,1,NULL),(339,'KATO',10,1,NULL),(340,'KATO',33,1,NULL);
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
  `code_name` varchar(45) NOT NULL,
  PRIMARY KEY (`sub_category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_product_sub_categories`
--

LOCK TABLES `core_product_sub_categories` WRITE;
/*!40000 ALTER TABLE `core_product_sub_categories` DISABLE KEYS */;
INSERT INTO `core_product_sub_categories` VALUES (1,'Rough Terrain Crane',1,1,'RT'),(2,'All Terrain Crane',1,1,'AT'),(3,'Hydraulic Truck Crane',1,1,'HT'),(4,'Crawler Crane',1,1,'CR'),(5,'Overhead Crane',1,0,'OC'),(6,'Conventional Truck Crane',1,1,'CT'),(7,'Tower Crane',1,1,'TC'),(8,'Crawler Dragline',1,0,'CD'),(9,'Gantry Crane',1,0,'GC'),(10,'Hydra Cranes',1,1,'HD'),(12,'Agricultural',2,1,'AG'),(13,'Water Disposal',2,1,'WD'),(14,'Construction',2,1,'CO'),(15,'Mining',2,1,'MI'),(16,'Road Construction',2,1,'RC'),(17,'Back Hoe Loader (JCB)',3,1,'BH'),(18,'Drag Line',3,1,'DL'),(19,'Suction Type',3,1,'ST'),(20,'Long Reach/Long Arm',3,1,'LR'),(21,'Crawlers&Compact',3,1,'CC'),(22,'Power Shovels',3,1,'PS'),(23,'Event',4,1,'EV'),(24,'Industry',4,1,'IN'),(25,'Civil Work',4,1,'CW'),(26,'Agriculture',4,1,'AE'),(27,'Alternative Power',4,1,'AP'),(29,'Rotary Hydraulic',5,1,'RH'),(30,'Conventional',5,1,'CL'),(31,'Truck Mounted',5,1,'TM'),(32,'Diaphragm Wall',5,1,'DW'),(33,'P&H 325/335',1,1,'PH');
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
  `boom_length` float DEFAULT '0',
  `fly_jib` float DEFAULT '0',
  `luffing_jib` float DEFAULT '0',
  `registered_number` varchar(60) DEFAULT NULL,
  `life_tax_details` varchar(45) DEFAULT NULL,
  `condition` text,
  `bucket_capacity` float DEFAULT '0',
  `manufacture_year` varchar(15) DEFAULT NULL,
  `manufacturer` varchar(45) DEFAULT NULL,
  `price_type` tinyint(11) DEFAULT '0' COMMENT '1=daily, 2=monthly',
  `hire_price` decimal(10,2) DEFAULT NULL,
  `kelly_length` varchar(255) DEFAULT NULL,
  `arm_length` varchar(255) DEFAULT NULL,
  `numberof_axles` smallint(5) DEFAULT '0',
  `dimensions` varchar(50) NOT NULL,
  `description` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `product_status` int(11) NOT NULL COMMENT '1=pending / waiting for approval, 2 = approved\nby data operator, 3=approved by sales ex, 4= PUBLIC (approved by sales manager), 5=rejected, 6 =\nre-initialized, 7=closed',
  `sale_price` decimal(10,2) DEFAULT NULL,
  `package_type` tinyint(5) NOT NULL COMMENT '1=free, 2 = paid',
  `package_amount` decimal(10,2) DEFAULT NULL,
  `current_location` varchar(300) DEFAULT NULL,
  `product_expires_on` datetime NOT NULL,
  `employee_id` int(5) DEFAULT NULL,
  `zone_id` int(5) DEFAULT NULL,
  `state_id` int(5) DEFAULT NULL,
  `district_id` int(5) DEFAULT NULL,
  `territory_id` int(5) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `user_id` (`user_id`),
  KEY `product_status` (`product_status`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_products`
--

LOCK TABLES `core_products` WRITE;
/*!40000 ALTER TABLE `core_products` DISABLE KEYS */;
INSERT INTO `core_products` VALUES (2,0,1,2,'80 Tons','Excavator for sale or hire','Y20LPMYBPFYE2','',1,34,2,NULL,'Reg#123','2','',NULL,'1982','',2,12000.00,'','',NULL,'12x12x12','test','2017-07-28 06:49:58',1001,1,0.00,0,0.00,'Visakhapatnam, Andhra Pradesh, India','2017-08-21 00:00:00',1031,NULL,NULL,NULL,NULL,NULL,NULL),(3,2,5,29,'2000 KN','RIg for hire','VG2TFSJ9RK3I3','',274,NULL,NULL,NULL,'',NULL,'',NULL,'1996','',1,15000.00,'2000','',NULL,'12x12x12','RIg for hire desc','2017-07-28 11:36:35',1001,1,2000.00,0,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,5,30,'1000 KN','Rig for sale','3SOWRE43TETC4','',282,444,NULL,NULL,'',NULL,'',NULL,'1997','',NULL,0.00,'2000','',NULL,'12x12x12','Rig for sale desc','2017-07-28 11:40:59',1000,1,2000.00,0,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,2,1,2,'2000 Tons','generator','ZLBIQTSQB2KK5','',2,444,20,20,'reg','2','',NULL,'1980','',2,555555.00,'','',NULL,'12x12x12','','2017-07-28 13:43:03',1001,1,0.00,0,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,1,2,12,'2000 Tons','title','BI7GRWRT58CO6','',302,NULL,NULL,NULL,'reg','1','',NULL,'1982','',NULL,0.00,'','',12,'12x12x12','','2017-07-28 14:09:38',1000,1,2000.00,0,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,1,1,2,'2000 Tons','title','QFFAFSB1BW6Q7','',69,444,NULL,20,'Reg#123','2','',NULL,'1995','',1,1500.00,'','',NULL,'12x12x12','','2017-07-31 15:30:09',1001,1,0.00,0,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,1,5,29,'34 KN','title','NOVPAR5N9PZ48','',276,NULL,NULL,NULL,'',NULL,'',NULL,'1960','',1,12000.00,'2000','',NULL,'12x12x12','','2017-08-01 12:29:08',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,1,1,2,'2000 Tons','custom model crane','NIBK7SJ1WWYF9','34',324,444,NULL,NULL,'',NULL,'',NULL,'','',1,34.00,'','',NULL,'','','2017-08-01 12:30:42',1000,1,0.00,1,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,0,1,2,'34 Tons','cccc3333','B3GPXU3J94110','cccc3333',324,444,20,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-01 12:33:02',1000,1,0.00,1,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,0,3,21,'444 Tons','generator','HM4IGBY3VSC11','',324,NULL,NULL,NULL,'',NULL,'',34,'','',1,555555.00,'','',NULL,'','','2017-08-01 14:32:33',1000,1,0.00,1,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,0,3,21,'2000 Tons','asdfasdf','M3QVU1UF36812','asdfasfd',324,NULL,NULL,NULL,'',NULL,'',34,'','',1,555555.00,'','',NULL,'','','2017-08-01 14:34:36',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,0,1,2,'2000 Tons','title','TZSPH08OC2X13','',69,444,20,20,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-03 12:26:55',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,0,4,26,'23 KVA','title','3LCP4FBG9R214','',256,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',1,15000.00,'','',NULL,'','','2017-08-04 05:06:05',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,0,4,26,'34 KVA','generator','JM0DJYA2OSH15','',261,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',1,12000.00,'','',NULL,'','','2017-08-04 05:14:19',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,0,4,26,'34 KVA','generator','WIGBL8YU2AX16','',261,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',1,12000.00,'','',NULL,'','','2017-08-04 05:14:33',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,0,4,26,'34 KVA','generator','H43JB304OAH17','',261,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',1,12000.00,'','',NULL,'','','2017-08-04 05:17:06',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,0,4,26,'34 KVA','generator','EDQ3DJHWQ3518','',261,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',1,12000.00,'','',NULL,'','','2017-08-04 05:17:12',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,0,4,26,'34 KVA','generator','W4GVT1OUPWO19','',261,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',1,12000.00,'','',NULL,'','','2017-08-04 05:17:56',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,0,4,26,'34 KVA','generator','I5QCWKQWSU020','',261,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',1,12000.00,'','',NULL,'','','2017-08-04 05:18:20',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,0,4,26,'34 KVA','generator','8O4HVQYPMLK21','',261,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',1,12000.00,'','',NULL,'','','2017-08-04 05:18:39',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,0,4,26,'34 KVA','generator','S74KLOZ738322','',261,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',1,12000.00,'','',NULL,'','','2017-08-04 05:19:09',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,1,2,14,'34 Tons','dumopet','APVQCDB2CPX23','',313,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-04 05:20:09',1000,1,2000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,1,2,14,'34 Tons','dumopet','KBE9RQK29IW24','',313,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-04 05:20:40',1000,1,2000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,1,3,21,'23 Tons','Excavators','TB8R57KF7Z025','',202,NULL,NULL,NULL,'',NULL,'',23,'','',NULL,0.00,'','',NULL,'','','2017-08-04 05:25:04',1000,1,12000000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,1,3,21,'23 Tons','Excavators','O24QU66IG8M26','',202,NULL,NULL,NULL,'',NULL,'',23,'','',NULL,0.00,'','',NULL,'','','2017-08-04 05:27:16',1000,1,12000000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,0,2,14,'12 Tons','Dumpers 1','P3QI2Z4BJ6A27','',313,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,12000.00,'','',NULL,'','','2017-08-04 05:28:11',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,0,2,12,'2000 Tons','Dumpers','17B641XJTSZ28','',304,NULL,NULL,NULL,'',NULL,'',NULL,'','',2,12000.00,'','',NULL,'','','2017-08-04 05:29:19',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,0,2,14,'34 Tons','Dumpers','VMVUZ19SIHK29','',312,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,2344.00,'','',NULL,'','','2017-08-04 05:31:08',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,0,2,15,'332 Tons','Dumpers7','CMG9M70K9XF30','',316,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-04 05:33:45',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,0,2,15,'332 Tons','Dumpers7','1LOL3EQI03331','',316,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-04 05:33:58',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,0,2,15,'332 Tons','Dumpers7','KSVJB3RM1UY32','',316,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-04 05:40:08',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,1,2,15,'23 Tons','Dumpers10','TB6KL68QXJ533','',317,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-04 05:41:41',1000,1,2000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,1,2,15,'23 Tons','Dumpers10','9D9PL0IEA1034','',317,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-04 05:41:48',1000,1,2000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,1,2,15,'23 Tons','Dumpers10','K2U2ELM3K6435','',317,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-04 05:44:37',1000,1,2000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,1,2,15,'23 Tons','Dumpers10','GHGCFX0OS0R36','',317,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-04 05:44:43',1000,1,2000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,1,2,14,'34 Tons','dumopet','SF3IO8IFYT737','',313,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-04 06:02:13',1000,1,2000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,1,2,14,'34 Tons','dumopet','ILCTX54UZA138','',313,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-04 06:02:21',1000,1,2000.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,0,3,18,'34 Tons','Excavators','6S4LBU3T0W239','',324,NULL,NULL,NULL,'',NULL,'',34,'','',1,12000.00,'','',NULL,'','','2017-08-04 06:11:01',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,0,3,18,'34 Tons','Excavators','EUBJJUHR5JB40','',324,NULL,NULL,NULL,'',NULL,'',34,'','',1,12000.00,'','',NULL,'','','2017-08-04 06:11:11',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,0,5,30,'34 KN','Piling Rigs','5D365ZA2I4E41','',286,NULL,NULL,NULL,'',NULL,'',NULL,'','',2,12000.00,'','',NULL,'','','2017-08-04 06:26:30',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,0,5,30,'34 KN','Piling Rigs','JP83FVWKGXT42','',286,NULL,NULL,NULL,'',NULL,'',NULL,'','',2,12000.00,'','',NULL,'','','2017-08-04 06:27:07',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,0,5,30,'34 KN','Piling Rigs','PH06D97WE3043','',286,NULL,NULL,NULL,'',NULL,'',NULL,'','',2,12000.00,'','',NULL,'','','2017-08-04 06:27:31',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(44,0,5,30,'34 KN','Piling Rigs','7ZVXZO5USF944','',286,NULL,NULL,NULL,'',NULL,'',NULL,'','',2,12000.00,'','',NULL,'','','2017-08-04 06:28:08',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(45,0,5,30,'34 KN','Piling Rigs','R8FCUPII9XP45','',286,NULL,NULL,NULL,'',NULL,'',NULL,'','',2,12000.00,'','',NULL,'','','2017-08-04 06:38:08',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(46,0,5,30,'34 KN','Piling Rigs','0US0SF4L52B46','',286,NULL,NULL,NULL,'',NULL,'',NULL,'','',2,12000.00,'','',NULL,'','','2017-08-04 06:38:48',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(47,0,5,30,'34 KN','Piling Rigs','RP05LLOQL5P47','',286,NULL,NULL,NULL,'',NULL,'',NULL,'','',2,12000.00,'','',NULL,'','','2017-08-04 06:39:09',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(48,0,5,31,'2000 KN','title','896GI63XXNG48','',324,NULL,NULL,NULL,'',NULL,'',NULL,'1971','',1,23123.00,'','',NULL,'','','2017-08-04 06:40:25',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(49,0,5,32,'2000 KN','title','6LIHGAIYQ9U49','',324,NULL,NULL,NULL,'',NULL,'',NULL,'1971','',1,23123.00,'','',NULL,'','','2017-08-04 06:41:43',1000,1,0.00,2,0.00,'Hyderguda, Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(50,0,5,32,'2000 KN','title','1K8IV4XC2X950','',324,NULL,NULL,NULL,'',NULL,'',NULL,'1971','',1,23123.00,'','',NULL,'','','2017-08-04 06:41:52',1000,1,0.00,2,0.00,'Hyderguda, Hyderabad, Telangana, India','2017-10-31 00:00:00',1031,NULL,NULL,NULL,NULL,NULL,NULL),(51,0,5,29,'34 KN','Piling Rigs4','553TSHZ6DAE51','',279,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,3466.00,'','',NULL,'','','2017-08-04 06:49:05',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',1031,NULL,NULL,NULL,NULL,NULL,NULL),(52,0,5,32,'34 KN','generator','HFT5WSPN3OV52','',324,NULL,NULL,NULL,'',NULL,'',NULL,'1963','',1,555555.00,'','',NULL,'','','2017-08-04 06:55:44',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',1031,NULL,NULL,NULL,NULL,NULL,NULL),(53,0,5,32,'2000 KN','generator','JJRC6QB2M4L53','',324,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-04 06:58:33',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',1031,NULL,NULL,NULL,NULL,NULL,NULL),(54,0,5,32,'345 KN','Excavator for sale or hire','BA1EB6PJC8E54','',300,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,15000.00,'','',NULL,'','','2017-08-04 06:59:15',1000,1,0.00,2,0.00,'Hyderguda, Hyderabad, Telangana, India','2017-10-31 00:00:00',1031,NULL,NULL,NULL,NULL,NULL,NULL),(55,0,5,30,'4000 KN','title\\\'s ther`s','RUCK9XZI7GK55','',286,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','ther\\\'s a matter\\\'s on','2017-08-04 07:27:52',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',1031,NULL,NULL,NULL,NULL,NULL,NULL),(56,0,4,27,'50000 KVA','generator',NULL,'',270,NULL,NULL,NULL,'','2','',NULL,'1974','',1,555555.00,'','',NULL,'','','2017-08-08 06:45:38',1000,2,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',1031,NULL,NULL,NULL,NULL,NULL,NULL),(57,0,4,27,'50000 KVA','generator',NULL,'',265,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,12000.00,'','',NULL,'','','2017-08-08 06:47:28',1000,1,0.00,1,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,0,4,26,'2000 KVA','title','4I7WN9T2IV158','',261,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,12000.00,'','',NULL,'','','2017-08-08 06:51:43',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(59,0,4,26,'2000 KVA','title',NULL,'',261,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-08 06:55:41',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(60,0,4,26,'2000 KVA','title',NULL,'',258,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-08 06:56:34',1000,1,0.00,1,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(61,0,4,27,'2000 KVA','title',NULL,'',265,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-08 06:57:12',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(62,0,4,27,'50000 KVA','generator','GAP5000H0003E','',265,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,12000.00,'','',NULL,'','','2017-08-08 06:59:29',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(63,0,3,17,'2000 Tons','title','EBH2000H0003F','20',324,NULL,NULL,NULL,'',NULL,'',20,'','',1,555555.00,'','',NULL,'','','2017-08-08 09:05:49',1000,1,0.00,2,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(64,0,3,17,'23 Tons','te','EBH0023H00040','',324,NULL,NULL,NULL,'',NULL,'',34,'','',1,23.00,'','',NULL,'','','2017-08-10 12:04:20',1000,1,0.00,1,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(65,2,1,2,'2000 Tons','Crane for sale or hire','CAT2000B00041','',69,444,NULL,NULL,'',NULL,'',NULL,'','',1,1500.00,'','',NULL,'','','2017-08-10 12:31:56',1009,1,1500000.00,1,0.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(66,0,1,6,'222 Tons','Crane for hire','CCT0222H00042','',143,22,NULL,NULL,'',NULL,'',NULL,'','',2,15000.00,'','',NULL,'','','2017-08-16 04:52:23',1000,1,0.00,2,0.00,'Guntur, Andhra Pradesh, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(67,0,1,2,'12 Tons','cra','CAT0012H00043','',67,12,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'','','2017-08-17 07:26:44',1000,1,0.00,2,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(68,0,1,2,'2000 Tons','crane222','CAT2000H00044','',67,12,NULL,NULL,'',NULL,'',NULL,'','',1,14666.00,'','',NULL,'','','2017-08-17 07:28:21',1000,1,0.00,2,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(69,0,5,30,'23 KN','RIg for hire','PCL0023H00045','',283,NULL,NULL,NULL,'',NULL,'',NULL,'','',2,234444.00,'','',NULL,'','','2017-08-17 07:31:16',1000,1,0.00,2,NULL,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(70,0,5,30,'234 KN','rig','PCL0234H00046','',324,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,12000.00,'','',NULL,'','','2017-08-17 07:32:17',1000,1,0.00,2,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(71,0,1,2,'210 Tons','title','CAT0200H00047','',69,200,NULL,NULL,'','','',NULL,'','',2,12000.00,'','',NULL,'','','2017-08-18 06:13:12',1000,1,0.00,2,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(72,0,3,21,'233 Tons','title','ECC0233H00048','',324,NULL,NULL,NULL,'',NULL,'',34,'','',1,12.00,'','',NULL,'','','2017-08-18 08:46:50',1000,1,0.00,1,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(73,1,3,21,'34 Tons','Excavator for sale or hire','ECC0034S00049','',324,NULL,NULL,NULL,'',NULL,'',34,'','',NULL,0.00,'','',NULL,'','','2017-08-18 08:49:15',1000,1,12000000.00,1,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(74,0,5,32,'23 KN','Excavator for sale or hire','PDW0023H0004A','',297,NULL,NULL,NULL,'',NULL,'',NULL,'1974','',1,3455.00,'12','',NULL,'','','2017-08-21 12:19:51',1000,1,0.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(75,1,3,17,'12 Tons','title','EBH0012S0004B','',324,NULL,NULL,NULL,'',NULL,'',34,'','',NULL,0.00,'','',NULL,'','','2017-08-21 12:21:43',1000,1,12000000.00,1,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(76,1,3,17,'34 Tons','Excavator for status','EBH0034S0004C','',324,NULL,NULL,NULL,'',NULL,'',345,'','',NULL,0.00,'','',NULL,'','','2017-08-21 12:23:28',1000,1,200033.00,1,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(77,1,3,18,'23 Tons','Excavator for status 2','EDL0023S0004D','',176,NULL,NULL,NULL,'',NULL,'',34,'','',NULL,0.00,'','',NULL,'','','2017-08-21 12:24:06',1000,1,23.00,2,10000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(78,1,2,12,'2000 Tons','test','DAG2000S0004E','',305,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-22 07:41:06',1000,1,233333.00,2,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(79,1,2,14,'23 Tons','title','DCO0023S0004F','',313,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-22 07:43:09',1000,1,2000.00,2,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(80,1,3,21,'34 Tons','3t5e','ECC0034S00050','',209,NULL,NULL,NULL,'',NULL,'',34,'','',NULL,0.00,'','',NULL,'','','2017-08-22 07:45:36',1000,1,2000.00,2,10000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(81,1,3,21,'34 Tons','title','ECC0034S00051','',324,NULL,NULL,NULL,'',NULL,'',345,'','',NULL,0.00,'','',NULL,'','','2017-08-22 07:46:43',1000,1,2000.00,2,10000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(82,0,2,12,'334 Tons','title1','DAG0334H00052','',305,NULL,NULL,NULL,'','2','',NULL,'','',1,12000.00,'','',NULL,'','','2017-08-22 08:34:19',1000,1,0.00,2,5000.00,'Hyderabad, Telangana, India','2017-10-31 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(83,1,4,26,'50 KVA','50 KVA gen for sale','GAE0050S00053','',258,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-22 14:20:07',1000,1,2000.00,1,5000.00,'Hyderabad, Telangana, India','2017-09-21 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(84,1,4,26,'55 KVA','55 KVA Gen for sale','GAE0055S00054','',258,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-22 14:27:52',1000,1,120000.00,1,5000.00,'Hyderabad, Telangana, India','2017-09-21 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(85,1,4,26,'60 KVA','60 KVA gen for sale','GAE0060S00055','',261,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',NULL,0.00,'','',NULL,'','','2017-08-22 14:30:42',1000,1,200000.00,1,5000.00,'Hyderabad, Telangana, India','2017-08-22 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(86,1,4,27,'65 KVA','65 kva gen for sale','GAP0065S00056','',268,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-22 14:32:40',1000,1,200000.00,2,5000.00,'Hyderabad, Telangana, India','2018-08-22 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(87,1,2,12,'34 Tons','title','DAG0034S00057','',305,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-23 06:19:31',1000,1,12000000.00,1,5000.00,'Hyderabad, Telangana, India','2017-10-31 23:10:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(88,1,1,6,'2000 Tons','title','DCO2000S00058','',144,100,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-23 06:29:21',1000,1,12000000.00,1,5000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(89,1,4,25,'332 KVA','title','GCW0332S00059','',252,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-08-23 06:32:21',1000,1,12000000.00,2,5000.00,'Hyderabad, Telangana, India','2018-08-23 06:32:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(90,0,3,17,'345 Tons','asdf','EBH0345H0005A','',158,NULL,NULL,NULL,'',NULL,'',34.34,'','',1,35000000.00,'','',NULL,'','','2017-09-06 13:44:53',1000,1,0.00,1,5000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(91,0,3,21,'34 Tons','title','ECC0034H0005B','',209,NULL,NULL,NULL,'',NULL,'',3.3,'','',1,3.50,'','',NULL,'','','2017-09-06 13:46:04',1000,1,0.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(92,0,3,20,'43 Tons','asdf','ELR0043H0005C','',194,NULL,NULL,NULL,'',NULL,'',234,'','',1,350000.00,'','',NULL,'','','2017-09-06 13:47:09',1000,1,0.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(93,0,3,22,'332 Tons','asdf','EPS0332H0005D','',214,NULL,NULL,NULL,'',NULL,'',34,'','',1,3200.00,'','',NULL,'','','2017-09-06 13:48:03',1000,1,0.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(94,0,3,18,'34 Tons','RIg for hire','EDL0034H0005E','',324,NULL,NULL,NULL,'',NULL,'',34,'','',1,-1.00,'','',NULL,'','','2017-09-06 13:48:55',1000,1,-1.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(95,0,3,20,'45 Tons','dfaf','ELR0045H0005F','',191,NULL,NULL,NULL,'',NULL,'',345,'1973','',1,555555.00,'','',NULL,'','','2017-09-06 13:50:53',1000,1,0.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(96,0,3,18,'34 Tons','adf','EDL0034H00060','',175,NULL,NULL,NULL,'',NULL,'',34,'','',1,-1.00,'','',NULL,'','','2017-09-07 05:08:26',1000,1,-1.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(97,0,3,18,'4 Tons','adsf','EDL0004H00061','',173,NULL,NULL,NULL,'',NULL,'',34,'','',1,2222298.00,'','23',NULL,'','','2017-09-07 05:27:06',1000,1,0.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(98,0,1,6,'234 Tons','asdf','CCT0234H00062','',143,233,3,3,'',NULL,'',NULL,'','',1,-1.00,'','',NULL,'','','2017-09-07 07:34:50',1000,1,0.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(99,2,1,4,'23 Tons','title','CCR0023B00063','',139,23,23,23,'',NULL,'',NULL,'','',1,-1.00,'','',NULL,'','','2017-09-07 08:42:39',1000,1,-1.00,1,5000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(100,1,5,29,'234 KN','asdfasdf','PRH0234S00064','',276,NULL,NULL,NULL,'',NULL,'',NULL,'','',NULL,0.00,'','',NULL,'','','2017-09-07 10:01:20',1000,1,22564534.23,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(101,1,2,12,'234 Tons','adfasdfasdfasf','DAG0234S00065','',304,NULL,NULL,NULL,'',NULL,'',NULL,'1976','',NULL,0.00,'','',23,'12x12x12','','2017-09-18 06:56:02',1000,1,234234.00,1,5000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(102,0,1,6,'234 Tons','asdf','CCT0234H00066','',144,3.4,1.2,1.2,'',NULL,'',NULL,'','',1,2323.00,'','',NULL,'0x0x0','','2017-09-21 12:18:05',1009,0,0.00,1,10000.00,'Hyderabad, Telangana, India','2017-10-31 23:59:59',1031,NULL,NULL,NULL,NULL,NULL,NULL),(103,0,5,30,'23 KN','asdfasdfasdf','PCL0023H00067','',286,NULL,NULL,NULL,'',NULL,'',NULL,'','',1,555555.00,'','',NULL,'0x0x0','','2017-09-25 09:21:25',1000,3,0.00,2,5000.00,'Hyderabad, Telangana, India','2018-09-25 14:51:24',NULL,NULL,NULL,NULL,NULL,1000,'2017-09-25 16:06:35');
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
  `quotation_type` enum('hire','buy') NOT NULL,
  `start_date` date DEFAULT NULL,
  `duration_type` enum('days','week','month') DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `comments` text,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `job_description` enum('commercial','doit_yourself') NOT NULL,
  `job_describes` enum('ready_to_use','planning_for_budgeting') DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `quote_status` int(2) NOT NULL DEFAULT '0' COMMENT '0=Inactive,1=Active,2=Rejected',
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`quotation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_quotation`
--

LOCK TABLES `core_quotation` WRITE;
/*!40000 ALTER TABLE `core_quotation` DISABLE KEYS */;
INSERT INTO `core_quotation` VALUES (1,3,20,'Hyderabad, Telangana, India','hire','2017-09-07','days',4,'test','basaveswar','basaveswar.allaka@devrabbit.com','9030880086','doit_yourself','planning_for_budgeting',NULL,1031,0,NULL,NULL),(2,3,18,'Visakhapatnam, Andhra Pradesh, India','buy','2017-09-07','days',23,'test','basaveswar','basaveswar.allaka@devrabbit.com','9030880086','doit_yourself','planning_for_budgeting',NULL,NULL,2,NULL,NULL),(3,5,29,'Hyderabad, Telangana, India','buy','2017-09-07',NULL,NULL,'test','basaveswar','basaveswar.allaka@devrabbit.com','9030880086','doit_yourself','planning_for_budgeting',NULL,NULL,0,NULL,NULL),(4,3,21,'Hyderabad, Telangana, India','hire','2017-09-27','days',3,'asdf','asdfa@adf.com','asdfa@adf.com','8645612312','commercial','ready_to_use',NULL,NULL,0,NULL,NULL);
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
  `authentication_token` varchar(255) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_sessions`
--

LOCK TABLES `core_sessions` WRITE;
/*!40000 ALTER TABLE `core_sessions` DISABLE KEYS */;
INSERT INTO `core_sessions` VALUES (1,1000,'4J0PHI4X6Tl0LQBpjB22XAGPB-3vLAET2TrglZF03ODDe8121X_pOixeflrmfvb1Uqx3cJWcI3eA3CODGCQP-Q==',1,'2017-08-08 07:46:32','2017-08-08 07:46:32','2017-08-08 07:46:32','127.0.0.1',NULL,0,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36'),(2,1000,'u4ssicm8qdm49cv1im3i7k5u03',1,'2017-08-08 08:56:21','2017-08-08 08:56:21','2017-08-08 08:56:21','127.0.0.1',NULL,0,'Google Chrome'),(3,1000,'4uuk2uc942npqhhglc3l0oj9s5',1,'2017-08-08 11:32:59','2017-08-08 11:32:59','2017-08-08 11:32:59','127.0.0.1',NULL,0,'Google Chrome'),(4,1000,'suqf8ngo50oh3ejv67e3i2iv53',1,'2017-08-08 11:33:08','2017-08-08 11:33:08','2017-08-08 11:33:08','127.0.0.1',NULL,0,'Google Chrome'),(5,1000,'t1m48obp30cpvqip1cbi9omnt5',1,'2017-08-08 13:18:43','2017-08-08 13:18:43','2017-08-08 13:18:43','127.0.0.1',NULL,0,'Google Chrome'),(6,1000,'gm0qpumt00k57d0qd5nm4e5au2',1,'2017-08-09 08:44:20','2017-08-09 08:44:20','2017-08-09 08:44:20','127.0.0.1',NULL,0,'Google Chrome'),(7,1000,'emded5v0viekqft06td8bpes70',1,'2017-08-09 12:32:19','2017-08-09 12:32:19','2017-08-09 12:32:19','127.0.0.1',NULL,0,'Google Chrome'),(8,1000,'lueh1gg2hocatdta3df3l37m80',1,'2017-08-10 05:06:40','2017-08-10 05:06:40','2017-08-10 05:06:40','127.0.0.1',NULL,0,'Google Chrome'),(9,1000,'ubcbp023f2fqv9ht61ctknl522',1,'2017-08-10 08:41:41','2017-08-10 08:41:41','2017-08-10 08:41:41','127.0.0.1',NULL,0,'Google Chrome'),(10,1000,'6qaklils7819cujjq0qvs6tnb2',1,'2017-08-10 08:43:07','2017-08-10 08:43:07','2017-08-10 08:43:07','127.0.0.1',NULL,0,'Google Chrome'),(11,1000,'ue44ubu2f2rdl3n8a205gm30v2',1,'2017-08-10 09:13:02','2017-08-10 09:13:02','2017-08-10 09:13:02','127.0.0.1',NULL,0,'Google Chrome'),(12,1000,'cnlj8lnmgp8lc4gfjfqafqigh5',1,'2017-08-10 12:03:00','2017-08-10 12:03:00','2017-08-10 12:03:00','127.0.0.1',NULL,0,'Google Chrome'),(13,1000,'e1ieqg6dje60ipdokt24qoo2r0',1,'2017-08-16 04:51:05','2017-08-16 04:51:05','2017-08-16 04:51:05','127.0.0.1',NULL,0,'Google Chrome'),(14,1000,'2e97csd2m2n1jjv2dnabr4a4v3',1,'2017-08-16 04:58:44','2017-08-16 04:58:44','2017-08-16 04:58:44','127.0.0.1',NULL,0,'Google Chrome'),(15,1000,'ng8kjmks9437ng5na8s2sr16k5',1,'2017-08-16 04:58:59','2017-08-16 04:58:59','2017-08-16 04:58:59','127.0.0.1',NULL,0,'Google Chrome'),(16,1000,'en7t6h7sg3khkqbf5jft6bth30',1,'2017-08-16 05:33:18','2017-08-16 05:33:18','2017-08-16 05:33:18','127.0.0.1',NULL,0,'Google Chrome'),(17,1000,'pi3plmms9vba45rqgju8cs5nt5',1,'2017-08-16 06:25:00','2017-08-16 06:25:00','2017-08-16 06:25:00','127.0.0.1',NULL,0,'Google Chrome'),(18,1000,'sogjkv9r69ulqmqpslpdfidev5',1,'2017-08-16 06:43:10','2017-08-16 06:43:10','2017-08-16 06:43:10','127.0.0.1',NULL,0,'Google Chrome'),(19,1000,'4kvjlscs4o1gk0rkdok29t2si3',1,'2017-08-16 08:50:56','2017-08-16 08:50:56','2017-08-16 08:50:56','127.0.0.1',NULL,0,'Google Chrome'),(20,1000,'vnqsqnna3s1i8ts6s267ctdvr7',1,'2017-08-16 11:00:35','2017-08-16 11:00:35','2017-08-16 11:00:35','127.0.0.1',NULL,0,'Google Chrome'),(21,1000,'oau09dcara3s40inme5a5neou3',1,'2017-08-17 04:39:53','2017-08-17 04:39:53','2017-08-17 04:39:53','127.0.0.1',NULL,0,'Google Chrome'),(22,1000,'46favef0seogfi22r74hf6cno1',1,'2017-08-17 04:52:58','2017-08-17 04:52:58','2017-08-17 04:52:58','127.0.0.1',NULL,0,'Google Chrome'),(23,1000,'j9gu5gugjgeuf8gmvhero0qnv7',1,'2017-08-17 05:39:47','2017-08-17 05:39:47','2017-08-17 05:39:47','127.0.0.1',NULL,0,'Google Chrome'),(24,1000,'9rv5mci2i621t0a52t6itbldn7',1,'2017-08-17 07:26:04','2017-08-17 07:26:04','2017-08-17 07:26:04','127.0.0.1',NULL,0,'Google Chrome'),(25,1000,'jvvn8o7pss3u9o0d17l2irvaq6',1,'2017-08-17 11:49:46','2017-08-17 11:49:46','2017-08-17 11:49:46','127.0.0.1',NULL,0,'Google Chrome'),(26,1000,'p9qgsvptf668c82lmvt2jgsgs2',1,'2017-08-18 05:33:46','2017-08-18 05:33:46','2017-08-18 05:33:46','127.0.0.1',NULL,0,'Google Chrome'),(27,1000,'pqj84k43p72s68p5fdr7kupim1',1,'2017-08-18 06:12:01','2017-08-18 06:12:01','2017-08-18 06:12:01','127.0.0.1',NULL,0,'Google Chrome'),(28,1000,'ithfejggm0hrnh5jvm2ih1pq84',1,'2017-08-18 08:46:10','2017-08-18 08:46:10','2017-08-18 08:46:10','127.0.0.1',NULL,0,'Google Chrome'),(29,1000,'o89tc0f0ihovv5akk0hro755m4',1,'2017-08-18 11:37:13','2017-08-18 11:37:13','2017-08-18 11:37:13','127.0.0.1',NULL,0,'Google Chrome'),(30,1000,'qf450gv7gck1n71gvlhjp2hhj4',1,'2017-08-21 09:22:50','2017-08-21 09:22:50','2017-08-21 09:22:50','127.0.0.1',NULL,0,'Google Chrome'),(31,1000,'n2ih8q8ps5jokj6mc7t36k7l71',1,'2017-08-21 12:19:21','2017-08-21 12:19:21','2017-08-21 12:19:21','127.0.0.1',NULL,0,'Google Chrome'),(32,1000,'kvc6qfishv06c0pnh7rvmd5s62',1,'2017-08-21 13:46:53','2017-08-21 13:46:53','2017-08-21 13:46:53','127.0.0.1',NULL,0,'Google Chrome'),(33,1000,'39l2lj75mu4i3q3kdufubimpa2',1,'2017-08-22 05:42:19','2017-08-22 05:42:19','2017-08-22 05:42:19','127.0.0.1',NULL,0,'Google Chrome'),(34,1000,'j9peh14rnpcqsrbrrgnntc38a0',1,'2017-08-22 07:40:45','2017-08-22 07:40:45','2017-08-22 07:40:45','127.0.0.1',NULL,0,'Google Chrome'),(35,1000,'d94kk5s3glrsdicdmnminsf287',1,'2017-08-22 13:01:56','2017-08-22 13:01:56','2017-08-22 13:01:56','127.0.0.1',NULL,0,'Google Chrome'),(36,1000,'rt2s2ernml0b2hums88olpaa02',1,'2017-08-23 04:39:05','2017-08-23 04:39:05','2017-08-23 04:39:05','127.0.0.1',NULL,0,'Google Chrome'),(37,1000,'i1quakc438717ol6lvjoiq8mn3',1,'2017-08-23 14:52:03','2017-08-23 14:52:03','2017-08-23 09:22:03','127.0.0.1',NULL,0,'Google Chrome'),(38,1000,'jr8blkjo4v1tfu132t28ug89u6',1,'2017-08-23 15:01:04','2017-08-23 15:01:04','2017-08-23 09:31:04','127.0.0.1',NULL,0,'Google Chrome'),(39,1000,'2ok4k32i8knos91jj8hit5tmu1',1,'2017-08-23 15:03:03','2017-08-23 15:03:03','2017-08-23 09:33:03','127.0.0.1',NULL,0,'Google Chrome'),(40,1000,'8i3nl4h7u7fk5foccc0h5gj3d5',1,'2017-08-23 15:07:41','2017-08-23 15:07:41','2017-08-23 09:37:41','127.0.0.1',NULL,0,'Google Chrome'),(41,1000,'ff88pkps6r91em61t7s733geu5',1,'2017-08-23 15:09:46','2017-08-23 15:09:46','2017-08-23 09:39:46','127.0.0.1',NULL,0,'Google Chrome'),(42,1000,'bno95d5gdgt0ifc18fjr789hd3',1,'2017-08-23 15:11:28','2017-08-23 15:11:28','2017-08-23 09:41:28','127.0.0.1',NULL,0,'Google Chrome'),(43,1000,'cpuq28bhm9sqoleug00ap3lb63',1,'2017-08-23 15:11:55','2017-08-23 15:11:55','2017-08-23 09:41:55','127.0.0.1',NULL,0,'Google Chrome'),(44,1000,'6sdpv8tjhr804ot0cpc8cb4f86',1,'2017-08-23 15:16:04','2017-08-23 15:16:04','2017-08-23 09:46:04','127.0.0.1',NULL,0,'Google Chrome'),(45,1000,'8d1p395j74dshkhq3b15sol993',1,'2017-08-23 15:16:21','2017-08-23 15:16:21','2017-08-23 09:46:21','127.0.0.1',NULL,0,'Google Chrome'),(46,1000,'9oge00garqqnj6u1hovdc2cpn2',1,'2017-08-23 15:17:54','2017-08-23 15:17:54','2017-08-23 09:47:54','127.0.0.1',NULL,0,'Google Chrome'),(47,1000,'as86tbqkqkl39gkr7udgpu4dn2',1,'2017-08-23 15:32:49','2017-08-23 15:32:49','2017-08-23 10:02:49','127.0.0.1',NULL,0,'Google Chrome'),(48,1000,'l3hcgrrumbtjbmebuh876ttdr3',1,'2017-08-23 15:33:05','2017-08-23 15:33:05','2017-08-23 10:03:05','127.0.0.1',NULL,0,'Google Chrome'),(49,1000,'g8v52nta8tqc1gk25g9p4oelf4',1,'2017-08-23 15:56:41','2017-08-23 15:56:41','2017-08-23 10:26:41','127.0.0.1',NULL,0,'Google Chrome'),(50,1000,'cv0gqg4p4c59ta34kgafhlsuj4',1,'2017-08-23 18:14:06','2017-08-23 18:14:06','2017-08-23 12:44:06','127.0.0.1',NULL,0,'Google Chrome'),(51,1000,'v7t4c2t2qqkor92ai6ftfc8nt5',1,'2017-08-23 18:18:13','2017-08-23 18:18:13','2017-08-23 12:48:13','127.0.0.1',NULL,0,'Google Chrome'),(52,1000,'rterclv8h8jpe331sisepbo9h7',1,'2017-08-23 18:19:17','2017-08-23 18:19:17','2017-08-23 12:49:17','127.0.0.1',NULL,0,'Google Chrome'),(53,1000,'rhacgarlsodtuv8g8qmt7qacb5',1,'2017-08-23 18:19:48','2017-08-23 18:19:48','2017-08-23 12:49:48','127.0.0.1',NULL,0,'Google Chrome'),(54,1000,'ik7ptvffpd97roiojl0pk27jb0',1,'2017-08-23 18:28:59','2017-08-23 18:28:59','2017-08-23 12:58:59','127.0.0.1',NULL,0,'Google Chrome'),(55,1000,'57nc69fu8p5mhv0vjfp2pmve82',1,'2017-08-23 18:39:29','2017-08-23 18:39:29','2017-08-23 13:09:29','127.0.0.1',NULL,0,'Google Chrome'),(56,1000,'to2r1gqjlothcko88vsi5atbs6',1,'2017-08-24 10:55:19','2017-08-24 10:55:19','2017-08-24 05:25:19','127.0.0.1',NULL,0,'Google Chrome'),(57,1000,'9c1taclakkrv0du64grfe56vq4',1,'2017-08-24 12:01:47','2017-08-24 12:01:47','2017-08-24 06:31:47','127.0.0.1',NULL,0,'Google Chrome'),(58,1000,'ujjmee7l148c3d5fmv9vuop7c7',1,'2017-08-24 14:07:17','2017-08-24 14:07:17','2017-08-24 08:37:17','127.0.0.1',NULL,0,'Google Chrome'),(59,1000,'gkpdnuab6f4dpurnbl655crvc4',1,'2017-08-24 14:18:59','2017-08-24 14:18:59','2017-08-24 08:48:59','127.0.0.1',NULL,0,'Google Chrome'),(60,1000,'69laqu6o5phv0lr9vgoc66lge7',1,'2017-08-24 15:45:43','2017-08-24 15:45:43','2017-08-24 10:15:43','127.0.0.1',NULL,0,'Google Chrome'),(61,1000,'20tm63vscv6koiqh5amr7588n1',1,'2017-08-24 15:48:52','2017-08-24 15:48:52','2017-08-24 10:18:52','127.0.0.1',NULL,0,'Google Chrome'),(62,1000,'aqgqcmrmfanuo0gf6t60ie2b73',1,'2017-08-24 15:49:34','2017-08-24 15:49:34','2017-08-24 10:19:34','127.0.0.1',NULL,0,'Google Chrome'),(63,1000,'9jnvl0e7l6999t2oaci39mbjp4',1,'2017-08-28 09:59:06','2017-08-28 09:59:06','2017-08-28 04:29:07','127.0.0.1',NULL,0,'Google Chrome'),(64,1000,'per6g06e324nmc3ads83t5iv03',1,'2017-08-28 10:00:54','2017-08-28 10:00:54','2017-08-28 04:30:54','127.0.0.1',NULL,0,'Google Chrome'),(65,1000,'06a0qvjikdsccmcfaq6u5f2qh6',1,'2017-08-28 10:02:43','2017-08-28 10:02:43','2017-08-28 04:32:43','127.0.0.1',NULL,0,'Google Chrome'),(66,1000,'nk0bnk6bc3jkjuqaor2runq707',1,'2017-08-28 10:02:58','2017-08-28 10:02:58','2017-08-28 04:32:58','127.0.0.1',NULL,0,'Google Chrome'),(67,1000,'3fgm6gkkuam1b1vsv8rktm6ko5',1,'2017-08-28 10:08:04','2017-08-28 10:08:04','2017-08-28 04:38:04','127.0.0.1',NULL,0,'Google Chrome'),(68,1000,'4n1ucbkijj2blgb0o2fr0efbs6',1,'2017-08-28 10:08:12','2017-08-28 10:08:12','2017-08-28 04:38:12','127.0.0.1',NULL,0,'Google Chrome'),(69,1000,'vrv9rjiv6tsr23k4h1auhinli1',1,'2017-08-28 10:08:50','2017-08-28 10:08:50','2017-08-28 04:38:50','127.0.0.1',NULL,0,'Google Chrome'),(70,1000,'o0ouvbk2f8bqp4m41o6jrokk00',1,'2017-08-28 10:14:33','2017-08-28 10:14:33','2017-08-28 04:44:33','127.0.0.1',NULL,0,'Google Chrome'),(71,1000,'kd75hgeuc3d5c60s8fs3le3s00',1,'2017-08-28 11:19:44','2017-08-28 11:19:44','2017-08-28 05:49:44','127.0.0.1',NULL,0,'Google Chrome'),(72,1000,'2d0lelck3lq5ppu509c4e6n300',1,'2017-08-28 12:13:14','2017-08-28 12:13:14','2017-08-28 06:43:14','127.0.0.1',NULL,0,'Google Chrome'),(73,1000,'lodkj8r6eapppo0h41old731d3',1,'2017-08-28 14:08:23','2017-08-28 14:08:23','2017-08-28 08:38:23','127.0.0.1',NULL,0,'Google Chrome'),(74,1000,'bblmkdnd4o4h191r2tgibkj1f1',1,'2017-08-29 10:38:14','2017-08-29 10:38:14','2017-08-29 05:08:14','127.0.0.1',NULL,0,'Google Chrome'),(75,1000,'u2u27h3ki5s04il4mu90s94cq0',1,'2017-08-29 12:54:41','2017-08-29 12:54:41','2017-08-29 07:24:41','127.0.0.1',NULL,0,'Google Chrome'),(76,1000,'cmja2o1pod78hd9ipclr363h50',1,'2017-08-29 14:12:49','2017-08-29 14:12:49','2017-08-29 08:42:49','127.0.0.1',NULL,0,'Google Chrome'),(77,1000,'bukaimc3l0becuueqmndg4gpg4',1,'2017-08-29 17:49:52','2017-08-29 17:49:52','2017-08-29 12:19:52','127.0.0.1',NULL,0,'Mozilla Firefox'),(78,1000,'hjtd9j0kgagc8q9ardk5p1vbs0',1,'2017-08-30 10:24:19','2017-08-30 10:24:19','2017-08-30 04:54:19','127.0.0.1',NULL,0,'Google Chrome'),(79,1000,'c8j3a9md3noiscp02lmk26akn4',1,'2017-08-30 12:53:50','2017-08-30 12:53:50','2017-08-30 07:23:50','127.0.0.1',NULL,0,'Google Chrome'),(80,1000,'psamrrf0rimnovfdvj9bhp33u3',1,'2017-08-30 14:14:40','2017-08-30 14:14:40','2017-08-30 08:44:40','127.0.0.1',NULL,0,'Google Chrome'),(81,1000,'c9r4fmtqovm622323pj3ikrln0',1,'2017-08-31 10:34:34','2017-08-31 10:34:34','2017-08-31 05:04:34','127.0.0.1',NULL,0,'Google Chrome'),(82,1000,'58uooq1cfu0ckemqmma09te9r2',1,'2017-08-31 12:07:28','2017-08-31 12:07:28','2017-08-31 06:37:28','127.0.0.1',NULL,0,'Google Chrome'),(83,1000,'ipq4gd3n5oq2uvia2gt9uhiu36',1,'2017-08-31 14:16:35','2017-08-31 14:16:35','2017-08-31 08:46:35','127.0.0.1',NULL,0,'Google Chrome'),(84,1000,'43uefo097npvcohdo2jabf8330',1,'2017-09-01 11:13:39','2017-09-01 11:13:39','2017-09-01 05:43:39','127.0.0.1',NULL,0,'Google Chrome'),(85,1000,'gk2b9k9a95tq5ph1ithgr9t7q3',1,'2017-09-01 18:03:46','2017-09-01 18:03:46','2017-09-01 12:33:46','127.0.0.1',NULL,0,'Google Chrome'),(86,1000,'74r7moqtjnu3p4vu7u3pl9fen0',1,'2017-09-04 10:44:18','2017-09-04 10:44:18','2017-09-04 05:14:18','127.0.0.1',NULL,0,'Google Chrome'),(87,1000,'iai7de62j6rurnca85dpsbaam7',1,'2017-09-06 11:14:42','2017-09-06 11:14:42','2017-09-06 05:44:42','127.0.0.1',NULL,0,'Google Chrome'),(88,1000,'aft35ektj9aiuecjcjggb121f5',1,'2017-09-06 18:21:10','2017-09-06 18:21:10','2017-09-06 12:51:10','127.0.0.1',NULL,0,'Google Chrome'),(89,1000,'jq9c25sv5ahlkhvpm8g99qull2',1,'2017-09-07 10:27:11','2017-09-07 10:27:11','2017-09-07 04:57:11','127.0.0.1',NULL,0,'Google Chrome'),(90,1000,'s57to3qmqdmebisfn2icesueb6',1,'2017-09-07 13:01:56','2017-09-07 13:01:56','2017-09-07 07:31:56','127.0.0.1',NULL,0,'Google Chrome'),(91,1000,'2kk2l79be20s3j8hfteif3lh75',1,'2017-09-07 14:12:02','2017-09-07 14:12:02','2017-09-07 08:42:02','127.0.0.1',NULL,0,'Google Chrome'),(92,1000,'86791ikv8d1p52qmn64sfub2q6',1,'2017-09-07 17:56:24','2017-09-07 17:56:24','2017-09-07 12:26:24','127.0.0.1',NULL,0,'Google Chrome'),(93,1000,'6bqulrg0cu5n1tc238c4ngnic3',1,'2017-09-11 15:58:44','2017-09-11 15:58:44','2017-09-11 10:28:44','127.0.0.1',NULL,0,'Google Chrome'),(94,1000,'akjrgtf8ktah3hq6id65ka12o3',1,'2017-09-11 17:01:58','2017-09-11 17:01:58','2017-09-11 11:31:58','127.0.0.1',NULL,0,'Google Chrome'),(95,1000,'0okg68rt91c782m5m2f15enfh0',1,'2017-09-12 12:10:39','2017-09-12 12:10:39','2017-09-12 06:40:39','127.0.0.1',NULL,0,'Google Chrome'),(96,1002,'0okg68rt91c782m5m2f15enfh0',1,'2017-09-12 15:50:45','2017-09-12 15:50:45','2017-09-12 10:20:45','127.0.0.1',NULL,0,'Google Chrome'),(97,1000,'2uamphr2dugdfe0tn1513h2g71',1,'2017-09-13 15:40:00','2017-09-13 15:40:00','2017-09-13 10:10:00','127.0.0.1',NULL,0,'Google Chrome'),(98,1000,'03u97ulbj7eaut48ari8fh1kt5',1,'2017-09-13 16:18:52','2017-09-13 16:18:52','2017-09-13 10:48:52','127.0.0.1',NULL,0,'Google Chrome'),(99,1000,'hs60tng54780vqcli90uq3mkm4',1,'2017-09-13 17:40:33','2017-09-13 17:40:33','2017-09-13 12:10:33','127.0.0.1',NULL,0,'Google Chrome'),(100,1000,'aqvg5r2s3udg3o5cgims82l3g7',1,'2017-09-13 18:37:06','2017-09-13 18:37:06','2017-09-13 13:07:06','127.0.0.1',NULL,0,'Google Chrome'),(101,1000,'l118ros4gg99du225prj8agrr1',1,'2017-09-13 18:55:50','2017-09-13 18:55:50','2017-09-13 13:25:50','127.0.0.1',NULL,0,'Google Chrome'),(102,1000,'ks7krnsrmmi501nfkon6frrmj6',1,'2017-09-13 18:58:53','2017-09-13 18:58:53','2017-09-13 13:28:53','127.0.0.1',NULL,0,'Google Chrome'),(103,1000,'7tbq2a9eu8e40bh8dc5p8fb7m3',1,'2017-09-13 19:18:12','2017-09-13 19:18:12','2017-09-13 13:48:12','127.0.0.1',NULL,0,'Google Chrome'),(104,1009,'elmdbdmln94bl75jein7dq1q21',1,'2017-09-14 11:16:28','2017-09-14 11:16:28','2017-09-14 05:46:28','127.0.0.1',NULL,0,'Google Chrome'),(105,1009,'jqupc8f198aukiua42dhs90p22',1,'2017-09-14 11:17:51','2017-09-14 11:17:51','2017-09-14 05:47:51','127.0.0.1',NULL,0,'Google Chrome'),(106,1000,'gohbefqbls6uf77kmp6n4s5th0',1,'2017-09-14 11:19:19','2017-09-14 11:19:19','2017-09-14 05:49:19','127.0.0.1',NULL,0,'Google Chrome'),(107,1009,'jpa3chjtevvcslqnuadpfg4t87',1,'2017-09-14 11:19:40','2017-09-14 11:19:40','2017-09-14 05:49:40','127.0.0.1',NULL,0,'Google Chrome'),(108,1009,'lbh35kqptatvuaqgruj28j4su7',1,'2017-09-14 11:26:27','2017-09-14 11:26:27','2017-09-14 05:56:27','127.0.0.1',NULL,0,'Google Chrome'),(109,1008,'dho5q5fcj1nfumr21g7iojihs3',1,'2017-09-14 11:26:40','2017-09-14 11:26:40','2017-09-14 05:56:40','127.0.0.1',NULL,0,'Google Chrome'),(110,1000,'74euf0sb199fs8d9rrvnhh1nu5',1,'2017-09-14 11:47:59','2017-09-14 11:47:59','2017-09-14 06:17:59','127.0.0.1',NULL,0,'Google Chrome'),(111,1009,'659gupgei5u51lu4b4nodqdud5',1,'2017-09-14 11:49:11','2017-09-14 11:49:11','2017-09-14 06:19:11','127.0.0.1',NULL,0,'Google Chrome'),(112,1008,'bvgj1pkqkjtruvr5fvq0tpon05',1,'2017-09-14 11:51:44','2017-09-14 11:51:44','2017-09-14 06:21:44','127.0.0.1',NULL,0,'Google Chrome'),(113,1008,'s8nesqeotpk64lk8bovlkgqae3',1,'2017-09-14 12:01:35','2017-09-14 12:01:35','2017-09-14 06:31:35','127.0.0.1',NULL,0,'Google Chrome'),(114,1009,'8m77pudd0a28iu0ol82eue0s90',1,'2017-09-14 12:25:25','2017-09-14 12:25:25','2017-09-14 06:55:25','127.0.0.1',NULL,0,'Google Chrome'),(115,1009,'pd0suemnp524ov7ppmjeee3he1',1,'2017-09-14 14:23:04','2017-09-14 14:23:04','2017-09-14 08:53:04','127.0.0.1',NULL,0,'Google Chrome'),(116,1009,'e56vleht20avkih70nnno9v6s7',1,'2017-09-14 14:59:15','2017-09-14 14:59:15','2017-09-14 09:29:15','127.0.0.1',NULL,0,'Google Chrome'),(117,1008,'c3q3vlqfcb9a0aq6cpmq6kahn4',1,'2017-09-14 14:59:31','2017-09-14 14:59:31','2017-09-14 09:29:31','127.0.0.1',NULL,0,'Google Chrome'),(118,1009,'a6i5p1gjtadtfjuriaptnn9524',1,'2017-09-14 15:37:55','2017-09-14 15:37:55','2017-09-14 10:07:55','127.0.0.1',NULL,0,'Google Chrome'),(119,1008,'gf3pq00bifjebh68pt30fbkkv6',1,'2017-09-14 17:58:44','2017-09-14 17:58:44','2017-09-14 12:28:44','127.0.0.1',NULL,0,'Google Chrome'),(120,1009,'qn68qnoklr3g06dgmqhip02ad0',1,'2017-09-14 18:42:16','2017-09-14 18:42:16','2017-09-14 13:12:16','127.0.0.1',NULL,0,'Google Chrome'),(121,1009,'k3srpdrt3j7fumgv82c0p64tr4',1,'2017-09-15 10:21:23','2017-09-15 10:21:23','2017-09-15 04:51:23','127.0.0.1',NULL,0,'Google Chrome'),(122,1009,'c893eaep4et59tbv1ngmq9fi36',1,'2017-09-15 15:16:25','2017-09-15 15:16:25','2017-09-15 09:46:25','127.0.0.1',NULL,0,'Google Chrome'),(123,1000,'btqqqsau6ietgakll0pui0snv3',1,'2017-09-15 17:43:17','2017-09-15 17:43:17','2017-09-15 12:13:17','127.0.0.1',NULL,0,'Google Chrome'),(124,1000,'nt4v6la5bgdjmufie3s5vkobe2',1,'2017-09-15 17:55:35','2017-09-15 17:55:35','2017-09-15 12:25:35','127.0.0.1',NULL,0,'Google Chrome'),(125,1000,'2f1k8pb5jeq5c8t5p74bcu7tm6',1,'2017-09-15 18:43:51','2017-09-15 18:43:51','2017-09-15 13:13:51','127.0.0.1',NULL,0,'Google Chrome'),(126,1000,'ehs2nf9favq3as61e3f10700u6',1,'2017-09-18 11:33:21','2017-09-18 11:33:21','2017-09-18 06:03:21','127.0.0.1',NULL,0,'Google Chrome'),(127,1000,'98u0de8u4stq0ag8nnt58fn2f5',1,'2017-09-18 12:06:03','2017-09-18 12:06:03','2017-09-18 06:36:03','127.0.0.1',NULL,0,'Google Chrome'),(128,1000,'c0ufahipe1d17uv89mjo4eipk2',1,'2017-09-18 12:47:21','2017-09-18 12:47:21','2017-09-18 07:17:21','127.0.0.1',NULL,0,'Google Chrome'),(129,1009,'4dnog962rv427dm2j57mp2pcr6',1,'2017-09-18 12:47:39','2017-09-18 12:47:39','2017-09-18 07:17:39','127.0.0.1',NULL,0,'Google Chrome'),(130,1009,'au4ee7u00pvgrfdm0psoalu6q5',1,'2017-09-18 15:16:33','2017-09-18 15:16:33','2017-09-18 09:46:33','127.0.0.1',NULL,0,'Google Chrome'),(131,1009,'s9rak1rafv9dej6lgn4d4otnv7',1,'2017-09-18 15:17:33','2017-09-18 15:17:33','2017-09-18 09:47:33','127.0.0.1',NULL,0,'Google Chrome'),(132,1004,'pdp673vlqp89bp8t0ervks98l6',1,'2017-09-18 17:46:31','2017-09-18 17:46:31','2017-09-18 12:16:31','127.0.0.1',NULL,0,'Google Chrome'),(133,1009,'rh5iin4tu2a8oig1hua6ogftj5',1,'2017-09-18 18:40:05','2017-09-18 18:40:05','2017-09-18 13:10:05','127.0.0.1',NULL,0,'Google Chrome'),(134,1009,'o0ms5t55uccaglnjf9roi3tk65',1,'2017-09-19 10:41:31','2017-09-19 10:41:31','2017-09-19 05:11:31','127.0.0.1',NULL,0,'Google Chrome'),(135,1009,'pqbkb55jlt895jr21632qtg0u7',1,'2017-09-19 13:16:24','2017-09-19 13:16:24','2017-09-19 07:46:24','127.0.0.1',NULL,0,'Google Chrome'),(136,1008,'ctro0kvolaom7dviftihb897t5',1,'2017-09-19 13:21:21','2017-09-19 13:21:21','2017-09-19 07:51:21','127.0.0.1',NULL,0,'Google Chrome'),(137,1007,'ipf6gmj13gd6uqhke3737o97k6',1,'2017-09-19 13:21:36','2017-09-19 13:21:36','2017-09-19 07:51:36','127.0.0.1',NULL,0,'Google Chrome'),(138,1006,'m4eclldmqb1g2jucfic7ql65t7',1,'2017-09-19 14:29:35','2017-09-19 14:29:35','2017-09-19 08:59:35','127.0.0.1',NULL,0,'Google Chrome'),(139,1005,'np68firkv7e23f743jf0hq2bg1',1,'2017-09-19 14:29:53','2017-09-19 14:29:53','2017-09-19 08:59:53','127.0.0.1',NULL,0,'Google Chrome'),(140,1004,'f4mjtoh62rgcelb91j9rvkukf3',1,'2017-09-19 14:30:17','2017-09-19 14:30:17','2017-09-19 09:00:17','127.0.0.1',NULL,0,'Google Chrome'),(141,1008,'vd2j9i7a8rgl1945ubat35far6',1,'2017-09-19 14:35:16','2017-09-19 14:35:16','2017-09-19 09:05:16','127.0.0.1',NULL,0,'Google Chrome'),(142,1007,'524tjl8lki9r8vv3j0332ajr36',1,'2017-09-19 14:35:47','2017-09-19 14:35:47','2017-09-19 09:05:47','127.0.0.1',NULL,0,'Google Chrome'),(143,1006,'rfq0r610p65e1mviau5g9hcja4',1,'2017-09-19 14:54:08','2017-09-19 14:54:08','2017-09-19 09:24:08','127.0.0.1',NULL,0,'Google Chrome'),(144,1007,'b91e4r2d78gldimlanjg3o2vs6',1,'2017-09-19 15:13:47','2017-09-19 15:13:47','2017-09-19 09:43:47','127.0.0.1',NULL,0,'Google Chrome'),(145,1009,'j51goab24cbqngrcbd868uq211',1,'2017-09-19 16:44:22','2017-09-19 16:44:22','2017-09-19 11:14:22','127.0.0.1',NULL,0,'Google Chrome'),(146,1009,'vv4rachst4g51o82arqertmsu3',1,'2017-09-19 18:37:17','2017-09-19 18:37:17','2017-09-19 13:07:17','127.0.0.1',NULL,0,'Google Chrome'),(147,1000,'rml44lv52lht72daovr5qqaas4',1,'2017-09-20 10:28:31','2017-09-20 10:28:31','2017-09-20 04:58:31','127.0.0.1',NULL,0,'Google Chrome'),(148,1009,'rs4pspmplugvmueut3c69rnt40',1,'2017-09-20 10:58:02','2017-09-20 10:58:02','2017-09-20 05:28:02','127.0.0.1',NULL,0,'Google Chrome'),(149,1007,'e7ft7i1jkl9o2dh09l3alm3ug0',1,'2017-09-20 11:59:12','2017-09-20 11:59:12','2017-09-20 06:29:12','127.0.0.1',NULL,0,'Google Chrome'),(150,1009,'pg2p8616a6ve40ihm6t4k45o37',1,'2017-09-20 18:30:18','2017-09-20 18:30:18','2017-09-20 13:00:18','127.0.0.1',NULL,0,'Google Chrome'),(151,1007,'volo5uav0ap8ijd4ocuuepi3t2',1,'2017-09-20 18:37:35','2017-09-20 18:37:35','2017-09-20 13:07:35','127.0.0.1',NULL,0,'Google Chrome'),(152,1009,'iev6otdo4m2m0ie7hg1mih5ut1',1,'2017-09-20 18:38:00','2017-09-20 18:38:00','2017-09-20 13:08:00','127.0.0.1',NULL,0,'Google Chrome'),(153,1007,'9duajcqvqcftdu18ond8b70d10',1,'2017-09-20 19:19:57','2017-09-20 19:19:57','2017-09-20 13:49:57','127.0.0.1',NULL,0,'Google Chrome'),(154,1006,'vegiv4hsdic214q6ndshessuv6',1,'2017-09-20 19:31:33','2017-09-20 19:31:33','2017-09-20 14:01:33','127.0.0.1',NULL,0,'Google Chrome'),(155,1009,'0j9r9qri5ju1fi35ptmbc2mi61',1,'2017-09-21 09:44:01','2017-09-21 09:44:01','2017-09-21 04:14:01','127.0.0.1',NULL,0,'Google Chrome'),(156,1007,'jbggtlmu4730utulvqefhgmeh1',1,'2017-09-21 10:19:48','2017-09-21 10:19:48','2017-09-21 04:49:48','127.0.0.1',NULL,0,'Google Chrome'),(157,1021,'omcfdidgfug3t4o9i9jfulp334',1,'2017-09-21 11:20:05','2017-09-21 11:20:05','2017-09-21 05:50:05','127.0.0.1',NULL,0,'Google Chrome'),(158,1023,'e9ufujjkpk7jsjjquvju0qdbv3',1,'2017-09-21 11:21:10','2017-09-21 11:21:10','2017-09-21 05:51:10','127.0.0.1',NULL,0,'Google Chrome'),(159,1023,'c4nrr6u1v8sqp4vqt1qad86tv3',1,'2017-09-21 11:30:35','2017-09-21 11:30:35','2017-09-21 06:00:35','127.0.0.1',NULL,0,'Mozilla Firefox'),(160,1021,'ajil1q857li7a446vss5726pv2',1,'2017-09-21 11:30:57','2017-09-21 11:30:57','2017-09-21 06:00:57','127.0.0.1',NULL,0,'Mozilla Firefox'),(161,1024,'dbnka202b7q4cts0g9bcddmai4',1,'2017-09-21 11:46:01','2017-09-21 11:46:01','2017-09-21 06:16:01','127.0.0.1',NULL,0,'Mozilla Firefox'),(162,1009,'nri0e92gr6hanfnqdani47iqj0',1,'2017-09-21 12:55:22','2017-09-21 12:55:22','2017-09-21 07:25:22','127.0.0.1',NULL,0,'Google Chrome'),(163,1021,'703j6gre8uaosvvfnomk31cn17',1,'2017-09-21 13:00:00','2017-09-21 13:00:00','2017-09-21 07:30:00','127.0.0.1',NULL,0,'Mozilla Firefox'),(164,1024,'otrk5mub6n68ruor625r1pef02',1,'2017-09-21 13:06:57','2017-09-21 13:06:57','2017-09-21 07:36:57','127.0.0.1',NULL,0,'Mozilla Firefox'),(165,1025,'qcmj67dvkcqfkstig3sqjggmn2',1,'2017-09-21 13:08:40','2017-09-21 13:08:40','2017-09-21 07:38:40','127.0.0.1',NULL,0,'Mozilla Firefox'),(166,1021,'v66a67s8t8qfgvtd2un84a8tp0',1,'2017-09-21 14:05:13','2017-09-21 14:05:13','2017-09-21 08:35:13','127.0.0.1',NULL,0,'Mozilla Firefox'),(167,1009,'5k0482c72imk4pvu44b49e9of4',1,'2017-09-21 14:13:52','2017-09-21 14:13:52','2017-09-21 08:43:52','127.0.0.1',NULL,0,'Google Chrome'),(168,1021,'6opojkf268fmovshhpqjofosl0',1,'2017-09-21 14:34:41','2017-09-21 14:34:41','2017-09-21 09:04:41','127.0.0.1',NULL,0,'Google Chrome'),(169,1009,'sdd025m9i5vqdn73473dbpq3m4',1,'2017-09-21 15:44:31','2017-09-21 15:44:31','2017-09-21 10:14:31','127.0.0.1',NULL,0,'Mozilla Firefox'),(170,1000,'uve6jul5l8m7cjjceco7ugbd56',1,'2017-09-21 17:33:22','2017-09-21 17:33:22','2017-09-21 12:03:22','127.0.0.1',NULL,0,'Google Chrome'),(171,1000,'5f63usj888dptedictce0mldj5',1,'2017-09-21 17:49:47','2017-09-21 17:49:47','2017-09-21 12:19:47','127.0.0.1',NULL,0,'Mozilla Firefox'),(172,1009,'use3ii4sce1d2m5qjtdiuf4u27',1,'2017-09-21 18:13:52','2017-09-21 18:13:52','2017-09-21 12:43:52','127.0.0.1',NULL,0,'Google Chrome'),(173,1009,'h64ukibqajs7ilrh4i15hr05u4',1,'2017-09-22 10:23:44','2017-09-22 10:23:44','2017-09-22 04:53:44','127.0.0.1',NULL,0,'Google Chrome'),(174,1000,'tejqftg6aa7tdjm83ffum89b47',1,'2017-09-22 14:50:15','2017-09-22 14:50:15','2017-09-22 09:20:15','127.0.0.1',NULL,0,'Google Chrome'),(175,1000,'qc8hchovsa1bmagot1jrtkp3d3',1,'2017-09-22 15:16:07','2017-09-22 15:16:07','2017-09-22 09:46:07','127.0.0.1',NULL,0,'Google Chrome'),(176,1009,'3t6thrv0042nc73ti0l7dnaaj1',1,'2017-09-22 15:21:20','2017-09-22 15:21:20','2017-09-22 09:51:20','127.0.0.1',NULL,0,'Google Chrome'),(177,1009,'7aka9685cv88nf5d4gbvbh6gc7',1,'2017-09-22 17:00:28','2017-09-22 17:00:28','2017-09-22 11:30:28','127.0.0.1',NULL,0,'Google Chrome'),(178,1000,'g01r3iu4u7lql26uvv05d20hj0',1,'2017-09-22 19:27:06','2017-09-22 19:27:06','2017-09-22 13:57:06','127.0.0.1',NULL,0,'Google Chrome'),(179,1009,'i8otfrbmffigmk6omua6tjkg83',1,'2017-09-23 10:29:37','2017-09-23 10:29:37','2017-09-23 04:59:37','127.0.0.1',NULL,0,'Google Chrome'),(180,1000,'jgnu6n9rhmjh8bsdvm5eql8b55',1,'2017-09-23 10:45:03','2017-09-23 10:45:03','2017-09-23 05:15:03','127.0.0.1',NULL,0,'Google Chrome'),(181,1009,'3lmo8c59pca5tih5d901aanho6',1,'2017-09-23 14:31:14','2017-09-23 14:31:14','2017-09-23 09:01:14','127.0.0.1',NULL,0,'Google Chrome'),(182,1020,'d94tor3rjst00tat2cs5d818d2',1,'2017-09-23 15:44:42','2017-09-23 15:44:42','2017-09-23 10:14:42','127.0.0.1',NULL,0,'Google Chrome'),(183,1009,'3ogsmo4mqelfuj6hlit0cfsrl2',1,'2017-09-25 09:58:07','2017-09-25 09:58:07','2017-09-25 04:28:07','127.0.0.1',NULL,0,'Google Chrome'),(184,1009,'0bitvktuqoseobn2k9j59u8p91',1,'2017-09-25 10:15:17','2017-09-25 10:15:17','2017-09-25 04:45:17','127.0.0.1',NULL,0,'Google Chrome'),(185,1009,'1r1ssssbr9v13v9vh3h9gbeid6',1,'2017-09-25 13:18:32','2017-09-25 13:18:32','2017-09-25 07:48:32','127.0.0.1',NULL,0,'Google Chrome'),(186,1000,'d7slgtqmldsdm7fpge4ptmcva5',1,'2017-09-25 14:50:59','2017-09-25 14:50:59','2017-09-25 09:20:59','127.0.0.1',NULL,0,'Google Chrome'),(187,1009,'3jo35r7nal5fbcb1qf428r50j7',1,'2017-09-25 14:56:38','2017-09-25 14:56:38','2017-09-25 09:26:38','127.0.0.1',NULL,0,'Google Chrome'),(188,1000,'b19j4aq4hdtthqb7rrmmeonlq5',1,'2017-09-25 15:58:13','2017-09-25 15:58:13','2017-09-25 10:28:13','127.0.0.1',NULL,0,'Google Chrome'),(189,1009,'jv756ig0ms6ooc4a15uke6pno2',1,'2017-09-25 18:22:57','2017-09-25 18:22:57','2017-09-25 12:52:57','127.0.0.1',NULL,0,'Google Chrome');
/*!40000 ALTER TABLE `core_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_states`
--

DROP TABLE IF EXISTS `core_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_states` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(45) NOT NULL,
  `state_status` smallint(5) NOT NULL COMMENT '0=Inactive, 1- Active',
  `zone_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `date_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_states`
--

LOCK TABLES `core_states` WRITE;
/*!40000 ALTER TABLE `core_states` DISABLE KEYS */;
INSERT INTO `core_states` VALUES (1,'Andhra Pradesh',1,1,'2017-09-12 18:30:00',1,'2017-09-15 06:16:30',1009),(2,'Telangana',1,1,'2017-09-12 18:30:00',1,'2017-09-15 06:16:20',1009),(3,'Tamilnadu',1,1,'2017-09-12 18:30:00',1,'2017-09-15 06:16:12',1009),(4,'Kerala',1,1,'2017-09-12 18:30:00',1,'2017-09-15 06:15:56',1009),(5,'West Bengal',1,3,'2017-09-14 13:20:57',1009,'2017-09-15 06:15:47',1009),(6,'Kashmir',1,3,'2017-09-15 06:24:44',1009,'2017-09-15 06:24:44',1009),(7,'Jammu',1,5,'2017-09-19 07:48:57',1009,'2017-09-19 07:48:57',1009);
/*!40000 ALTER TABLE `core_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_territories`
--

DROP TABLE IF EXISTS `core_territories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_territories` (
  `territory_id` int(11) NOT NULL AUTO_INCREMENT,
  `territory_name` varchar(45) NOT NULL,
  `territory_status` smallint(5) NOT NULL COMMENT '0=Inactive, 1- Active',
  `district_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `date_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `state_id` int(5) NOT NULL,
  `zone_id` int(5) NOT NULL,
  PRIMARY KEY (`territory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_territories`
--

LOCK TABLES `core_territories` WRITE;
/*!40000 ALTER TABLE `core_territories` DISABLE KEYS */;
INSERT INTO `core_territories` VALUES (1,'banjarahills',1,3,'2017-09-12 18:30:00',1,'2017-09-20 09:05:29',1007,2,1),(2,'secunderabad',1,3,'2017-09-12 18:30:00',1,'2017-09-20 09:05:32',1007,2,1),(3,'Rajahmundry',1,1,'2017-09-12 18:30:00',1,'2017-09-20 09:05:35',1007,2,1),(4,'Tnagar',1,4,'2017-09-15 06:18:16',1009,'2017-09-20 09:05:40',1007,3,1);
/*!40000 ALTER TABLE `core_territories` ENABLE KEYS */;
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
  `permission_ids` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_user_roles`
--

LOCK TABLES `core_user_roles` WRITE;
/*!40000 ALTER TABLE `core_user_roles` DISABLE KEYS */;
INSERT INTO `core_user_roles` VALUES (1,'Public User',''),(2,'Super Admin','1,2,3,4,5,6,7,8,9,10'),(3,'Admin','1,2,8,9'),(4,'Zonal Sales Manager','2,3,4,5,6'),(5,'State Sales Manager','2,3,4,5,6'),(6,'District Sales Manager','2,3,4,5,6'),(7,'Sales Executive','3,4,5'),(8,'Data Operator','1,3,4,5,6,7');
/*!40000 ALTER TABLE `core_user_roles` ENABLE KEYS */;
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
  `company_email` varchar(150) DEFAULT NULL,
  `user_status` int(11) NOT NULL COMMENT '1=registered, 2=verified OTP / active, 3=inactive',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `otp_code` varchar(45) DEFAULT NULL,
  `user_type` tinyint(5) DEFAULT NULL COMMENT '1=public user, 2=data-operator, 3=salesexecutive,\n4=sales-manager, 5=admin, 6=super-admin',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1032 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_users`
--

LOCK TABLES `core_users` WRITE;
/*!40000 ALTER TABLE `core_users` DISABLE KEYS */;
INSERT INTO `core_users` VALUES (1000,'basaveswar','basaveswar.allaka@devrabbit.com','25f9e794323b453885f5181f1b624d0b','9030880086','Devrabbit','hyderabad','Senior Developer','basaveswar.allaka@devrabbit.com',2,'2017-07-20 04:58:05','0000-00-00 00:00:00','140058',1),(1002,'eshwar','eshwar.allaka@gmail.com','25f9e794323b453885f5181f1b624d0b','8341489596','devrabbit','','','',2,'2017-09-12 10:19:24','0000-00-00 00:00:00','988849',1),(1009,'super admin','sa@devrabbit.com','25f9e794323b453885f5181f1b624d0b','1234567890','devrabbit','hyderabad','super admin',NULL,2,'2017-09-12 18:30:00','0000-00-00 00:00:00','',2),(1020,'admin','admin@devrabbit.com','25f9e794323b453885f5181f1b624d0b','8646515312','devrabbit','','','',2,'2017-09-21 05:47:37','2017-09-21 05:47:37',NULL,3),(1021,'Zonal Sales Manager','zsm@devrabbit.com','25f9e794323b453885f5181f1b624d0b','8974561231','devrabbit','','','',2,'2017-09-21 05:48:09','2017-09-21 05:48:09',NULL,4),(1029,'state sales manager','ssm@devrabbit.com','25f9e794323b453885f5181f1b624d0b','6846512302','asdf','','1','',2,'2017-09-21 09:15:44','2017-09-21 09:15:44',NULL,5),(1030,'District sales manager','dsm@devrabbit.com','25f9e794323b453885f5181f1b624d0b','6845612312','asdfadf','','','',2,'2017-09-21 09:52:19','2017-09-21 09:52:19',NULL,6),(1031,'Sales executive','se@devrabbit.com','25f9e794323b453885f5181f1b624d0b','8456156465','asdfasdf','','','',2,'2017-09-21 09:53:03','2017-09-21 09:53:03',NULL,7);
/*!40000 ALTER TABLE `core_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_zones`
--

DROP TABLE IF EXISTS `core_zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_zones` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(45) NOT NULL,
  `zone_status` smallint(5) NOT NULL COMMENT '0=Inactive, 1- Active',
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `date_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_zones`
--

LOCK TABLES `core_zones` WRITE;
/*!40000 ALTER TABLE `core_zones` DISABLE KEYS */;
INSERT INTO `core_zones` VALUES (1,'South Zone',1,'2017-09-12 18:30:00',1009,'2017-09-14 12:29:15',1009),(2,'West Zone',1,'2017-09-14 12:01:59',1009,'2017-09-14 12:28:23',1009),(3,'East Zone',1,'2017-09-14 12:01:59',1009,'2017-09-14 12:28:52',1008),(4,'North Zone',0,'2017-09-14 12:01:59',1009,'2017-09-14 12:01:59',1009),(5,'North East zone',1,'2017-09-19 07:48:31',1009,'2017-09-19 07:48:31',1009);
/*!40000 ALTER TABLE `core_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_x_roles`
--

DROP TABLE IF EXISTS `user_x_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_x_roles` (
  `employee_x_roles_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL,
  `user_zone_id` int(11) NOT NULL,
  `user_zone_name` varchar(45) NOT NULL,
  `user_state_id` int(11) DEFAULT '0',
  `user_state_name` varchar(45) DEFAULT NULL,
  `user_district_id` int(11) DEFAULT '0',
  `user_district_name` varchar(45) DEFAULT NULL,
  `user_territory_id` int(11) DEFAULT '0',
  `user_territory_name` varchar(45) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`employee_x_roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_x_roles`
--

LOCK TABLES `user_x_roles` WRITE;
/*!40000 ALTER TABLE `user_x_roles` DISABLE KEYS */;
INSERT INTO `user_x_roles` VALUES (7,1021,'Zonal Sales Manager',2,1,'South Zone',0,NULL,0,NULL,0,NULL,'2017-09-21 05:48:09',1009),(29,1030,'District sales manager',2,1,'South Zone',1,'Andhra Pradesh',1,'East Godavari',0,NULL,'2017-09-21 09:52:20',1009),(30,1031,'Sales executive',2,1,'South Zone',1,'Andhra Pradesh',1,'East Godavari',3,'Rajahmundry','2017-09-21 09:53:03',1009),(31,1029,'state sales manager',5,1,'South Zone',1,'Andhra Pradesh',0,NULL,0,NULL,'2017-09-21 11:53:19',1009),(32,1029,'state sales manager',5,1,'South Zone',2,'Telangana',0,NULL,0,NULL,'2017-09-21 11:53:19',1009);
/*!40000 ALTER TABLE `user_x_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-25 18:27:48
