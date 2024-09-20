-- MariaDB dump 10.19  Distrib 10.6.7-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bit.supplierportal
-- ------------------------------------------------------
-- Server version	10.6.7-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_mst_category`
--

DROP TABLE IF EXISTS `tbl_mst_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `status_category` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_category`
--

LOCK TABLES `tbl_mst_category` WRITE;
/*!40000 ALTER TABLE `tbl_mst_category` DISABLE KEYS */;
INSERT INTO `tbl_mst_category` VALUES (1,'Welding','tes',1,'2024-09-19 13:00:00','1',NULL,NULL),(2,'Stamping','Dss',1,'2024-09-19 08:42:40',NULL,'2024-09-19 08:46:33',NULL);
/*!40000 ALTER TABLE `tbl_mst_part` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_supplier`
--

DROP TABLE IF EXISTS `tbl_mst_supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` varchar(100) DEFAULT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status_supplier` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_supplier_unique` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_supplier`
--

LOCK TABLES `tbl_mst_supplier` WRITE;
/*!40000 ALTER TABLE `tbl_mst_supplier` DISABLE KEYS */;
INSERT INTO `tbl_mst_supplier` VALUES (1,'BTI','Bonecom Tricom','123456','bonecom@mail.com','Jl Selayar',1,'2024-10-10 13:00:00',NULL,NULL,NULL),(2,'RIM','Ravalia Inti Mandiri','6276767','rim@mail.com','Jl Jawa Karang Timur',1,'2024-10-10 13:00:00',NULL,NULL,NULL),(4,'BIT','Bonecom Inti Technology','8737346374','email@pass','Jl Raya Mangga Dua',1,'2024-09-18 14:23:47',NULL,'2024-09-18 14:26:28',NULL);
/*!40000 ALTER TABLE `tbl_mst_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_units`
--

DROP TABLE IF EXISTS `tbl_mst_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_unit` varchar(100) DEFAULT NULL,
  `code_unit` varchar(100) DEFAULT NULL,
  `status_unit` int(11) DEFAULT 1 COMMENT '1 AKTIF , 0 INACTIVE',
  `unit_level` int(3) DEFAULT NULL,
  `parent_id` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_units_unique` (`name_unit`),
  UNIQUE KEY `tbl_mst_units_unique_1` (`code_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_units`
--

LOCK TABLES `tbl_mst_units` WRITE;
/*!40000 ALTER TABLE `tbl_mst_units` DISABLE KEYS */;
INSERT INTO `tbl_mst_units` VALUES (1,'KANBAN','KBN',1,1,'*','tes','2024-07-30 13:26:27','1',NULL,NULL),(2,'PIECES','PCS',1,NULL,'1','-','2024-07-30 13:26:27','1','2024-09-19 08:22:35',NULL);
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-20  9:11:15
