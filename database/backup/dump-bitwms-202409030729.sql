-- MariaDB dump 10.19  Distrib 10.6.7-MariaDB, for Win64 (AMD64)
--
-- Host: 103.172.205.187    Database: bitwms
-- ------------------------------------------------------
-- Server version	10.3.39-MariaDB-0ubuntu0.20.04.2

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
-- Table structure for table `tbl_mst_categories`
--

DROP TABLE IF EXISTS `tbl_mst_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_categories` (
  `id` int(11) NOT NULL,
  `name_categories` varchar(100) DEFAULT NULL,
  `code_categories` varchar(10) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  `CreatedBy` varchar(100) DEFAULT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `UpdatedBy` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_categories`
--

LOCK TABLES `tbl_mst_categories` WRITE;
/*!40000 ALTER TABLE `tbl_mst_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_mst_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_child_units`
--

DROP TABLE IF EXISTS `tbl_mst_child_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_child_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(100) DEFAULT NULL,
  `unit_code` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `headers_unit_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_child_units_unique` (`unit_name`),
  UNIQUE KEY `tbl_mst_child_units_unique_1` (`unit_code`),
  KEY `tbl_mst_child_units_tbl_mst_units_FK` (`headers_unit_id`),
  CONSTRAINT `tbl_mst_child_units_tbl_mst_units_FK` FOREIGN KEY (`headers_unit_id`) REFERENCES `tbl_mst_units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_child_units`
--

LOCK TABLES `tbl_mst_child_units` WRITE;
/*!40000 ALTER TABLE `tbl_mst_child_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_mst_child_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_customers`
--

DROP TABLE IF EXISTS `tbl_mst_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_customers` varchar(100) DEFAULT NULL,
  `code_customers` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_customer` int(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_customers_unique` (`code_customers`),
  UNIQUE KEY `tbl_mst_customers_unique_1` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_customers`
--

LOCK TABLES `tbl_mst_customers` WRITE;
/*!40000 ALTER TABLE `tbl_mst_customers` DISABLE KEYS */;
INSERT INTO `tbl_mst_customers` VALUES (1,'PT. TOYOTA BOSHOKU INDONESIA','TBINA','Kawasan Industri MM2100, Jl. Jawa I No.11, Gandamekar, Kec. Cikarang, Kab. Bekasi, Jawa Barat 17520',NULL,'021-99','sunawan@toyota-boshoku.com',1,'2024-07-27 10:33:41',NULL,'2024-08-26 14:01:47','9');
/*!40000 ALTER TABLE `tbl_mst_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_handling`
--

DROP TABLE IF EXISTS `tbl_mst_handling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_handling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL DEFAULT 0,
  `nameHandling` varchar(100) DEFAULT NULL,
  `status_handling` int(11) DEFAULT 1,
  `remarks` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_handling`
--

LOCK TABLES `tbl_mst_handling` WRITE;
/*!40000 ALTER TABLE `tbl_mst_handling` DISABLE KEYS */;
INSERT INTO `tbl_mst_handling` VALUES (1,15000,'Loading',1,'TES','2024-07-28 10:28:00','1',NULL,NULL);
/*!40000 ALTER TABLE `tbl_mst_handling` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_locationwarehouse`
--

DROP TABLE IF EXISTS `tbl_mst_locationwarehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_locationwarehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(100) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `status_location` int(1) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_mst_locationwarehouse_tbl_mst_warehouse_FK` (`warehouse_id`),
  CONSTRAINT `tbl_mst_locationwarehouse_tbl_mst_warehouse_FK` FOREIGN KEY (`warehouse_id`) REFERENCES `tbl_mst_warehouse` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_locationwarehouse`
--

LOCK TABLES `tbl_mst_locationwarehouse` WRITE;
/*!40000 ALTER TABLE `tbl_mst_locationwarehouse` DISABLE KEYS */;
INSERT INTO `tbl_mst_locationwarehouse` VALUES (1,'RAK-01',1,1,NULL,'2024-06-12 10:00:00','1','2024-08-26 08:29:21','8'),(2,'RAK-02',1,1,NULL,'2024-08-04 08:50:10','1','2024-08-26 08:29:18','8');
/*!40000 ALTER TABLE `tbl_mst_locationwarehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_material`
--

DROP TABLE IF EXISTS `tbl_mst_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_material` varchar(100) DEFAULT NULL,
  `name_material` varchar(100) DEFAULT NULL,
  `uniqueId` varchar(100) NOT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `packaging_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `parentUnitId` int(11) DEFAULT NULL,
  `QtyPerUnit` double DEFAULT NULL,
  `status_material` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_material_unique_2` (`uniqueId`),
  UNIQUE KEY `tbl_mst_material_unique` (`no_material`),
  UNIQUE KEY `tbl_mst_material_unique_1` (`name_material`,`customers_id`),
  KEY `tbl_mst_material_tbl_mst_customers_FK` (`customers_id`),
  KEY `tbl_mst_material_tbl_mst_units_FK` (`unit_id`),
  KEY `tbl_mst_material_tbl_mst_units_FK_1` (`parentUnitId`),
  KEY `tbl_mst_material_tbl_mst_packingstorage_FK` (`packaging_id`),
  KEY `tbl_mst_material_tbl_mst_locationwarehouse_FK` (`location_id`),
  CONSTRAINT `tbl_mst_material_tbl_mst_customers_FK` FOREIGN KEY (`customers_id`) REFERENCES `tbl_mst_customers` (`id`),
  CONSTRAINT `tbl_mst_material_tbl_mst_locationwarehouse_FK` FOREIGN KEY (`location_id`) REFERENCES `tbl_mst_locationwarehouse` (`id`),
  CONSTRAINT `tbl_mst_material_tbl_mst_packingstorage_FK` FOREIGN KEY (`packaging_id`) REFERENCES `tbl_mst_packaging` (`id`),
  CONSTRAINT `tbl_mst_material_tbl_mst_units_FK` FOREIGN KEY (`unit_id`) REFERENCES `tbl_mst_units` (`id`),
  CONSTRAINT `tbl_mst_material_tbl_mst_units_FK_1` FOREIGN KEY (`parentUnitId`) REFERENCES `tbl_mst_units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_material`
--

LOCK TABLES `tbl_mst_material` WRITE;
/*!40000 ALTER TABLE `tbl_mst_material` DISABLE KEYS */;
INSERT INTO `tbl_mst_material` VALUES (49,'HK284-0W104-00','PAPER 104','FES1',1,1,21,2,19,NULL,1,'2024-08-04 09:49:49','1','1','2024-08-04 09:49:49'),(50,'HK284-0W218-00','PAPER 218','FES2',1,1,21,2,19,NULL,1,'2024-08-04 09:51:19','1','1','2024-08-04 09:51:19'),(53,'HK284-0W211-00','PAPER 211','FES3',1,1,21,2,19,NULL,1,'2024-08-28 10:24:52','9','9','2024-08-28 10:24:52'),(54,'HK284-0W132-00','PAPER 132,5','FES4',1,1,21,2,19,NULL,1,'2024-08-28 10:26:47','9','9','2024-08-28 10:26:47'),(55,'HK284-OW570-00','PAPER ACL 715B (570)','FES5',1,1,21,2,19,NULL,1,'2024-08-28 10:28:42','9','9','2024-08-28 10:28:42'),(56,'JKD14311-6781-00','PAPER AF 7623 (580)','-',1,1,21,2,19,NULL,1,'2024-08-28 10:30:01','9','9','2024-08-28 10:30:01'),(62,'N990108-0030-00','FILTER PAPER HV (590WX914)','- -',1,1,21,2,19,NULL,1,'2024-08-28 10:57:02','9','9','2024-08-29 11:28:00');
/*!40000 ALTER TABLE `tbl_mst_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_packaging`
--

DROP TABLE IF EXISTS `tbl_mst_packaging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_packaging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_packaging` varchar(100) DEFAULT NULL,
  `status_packaging` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_packaging`
--

LOCK TABLES `tbl_mst_packaging` WRITE;
/*!40000 ALTER TABLE `tbl_mst_packaging` DISABLE KEYS */;
INSERT INTO `tbl_mst_packaging` VALUES (1,'SKID',1,'2024-07-29 13:00:00','1','2024-08-04 09:48:48','1'),(3,'KANBAN',1,'2024-07-31 08:12:49','1','2024-08-02 14:54:28','1');
/*!40000 ALTER TABLE `tbl_mst_packaging` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_role`
--

DROP TABLE IF EXISTS `tbl_mst_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(100) DEFAULT NULL,
  `code_role` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status_role` int(1) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_role_unique` (`code_role`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_role`
--

LOCK TABLES `tbl_mst_role` WRITE;
/*!40000 ALTER TABLE `tbl_mst_role` DISABLE KEYS */;
INSERT INTO `tbl_mst_role` VALUES (14,'Developer','DEV','2024-08-08 20:18:39','2024-08-12 13:35:41',1,'1','8'),(15,'Administrator','ADM','2024-08-09 16:29:16','2024-08-26 08:34:56',1,'8','8'),(16,'Operator','OPT','2024-08-09 16:29:39','2024-08-26 08:34:51',1,'8','8'),(17,'Customers','CST','2024-08-12 11:12:19','2024-08-26 08:34:39',1,'8','8'),(18,'PCD','PCD','2024-08-28 10:53:13','2024-08-28 10:53:13',1,'9','9'),(19,'FAT','FINANCE','2024-08-30 08:35:25','2024-08-30 08:41:08',1,'9','9');
/*!40000 ALTER TABLE `tbl_mst_role` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_units`
--

LOCK TABLES `tbl_mst_units` WRITE;
/*!40000 ALTER TABLE `tbl_mst_units` DISABLE KEYS */;
INSERT INTO `tbl_mst_units` VALUES (17,'BALE','BAL',1,1,'*',NULL,'2024-07-30 13:26:27','1','2024-07-31 07:54:58','1'),(18,'DRUMS','DRUMS',1,1,'*',NULL,'2024-07-30 13:26:49','1','2024-07-31 07:54:52','1'),(19,'ROLLS','ROLLS',1,1,'*',NULL,'2024-07-30 13:28:43','1','2024-07-31 07:54:49','1'),(20,'PIECES','PCS',1,1,'*',NULL,'2024-07-30 13:28:56','1','2024-08-12 10:41:45','8'),(21,'METER','MTR',1,2,'19',NULL,'2024-07-30 13:31:06','1','2024-08-05 14:49:49','1'),(23,'PIECE','PC',1,2,'20',NULL,'2024-07-30 13:38:51','1','2024-07-31 07:55:22','1'),(25,'LITER','LT',1,2,'18',NULL,'2024-07-30 13:41:56','1','2024-07-31 07:56:12','1'),(26,'KILOGRAM','KG',1,2,'17',NULL,'2024-07-30 13:42:19','1','2024-07-31 07:56:06','1');
/*!40000 ALTER TABLE `tbl_mst_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_users`
--

DROP TABLE IF EXISTS `tbl_mst_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `customers_id` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `lock_user` int(1) DEFAULT 0,
  `status_user` int(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_mst_users_tbl_mst_role_FK` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_users`
--

LOCK TABLES `tbl_mst_users` WRITE;
/*!40000 ALTER TABLE `tbl_mst_users` DISABLE KEYS */;
INSERT INTO `tbl_mst_users` VALUES (8,'dev','dev','$2y$10$UL5rkiGSP/OYybe8zOOkxeLXH7r1NvPEJsVHL3NJHWiN1oBfVEPju',14,'*','dasep@mail.com','123',0,1,'2024-08-09 09:30:56','1','2024-08-12 13:46:03','1'),(9,'admin','admin','$2y$10$sJ93.r8k4yjl1Hey8dQonepacPY8CVbVYrMAIpVhfp6u7Zq0ybtyG',15,'*','admin@mail.com','62767721',0,1,'2024-08-09 16:31:31','1','2024-08-29 07:31:45','8'),(10,'operator','operator','$2y$10$KvG0pSRLs9mgmTFN.rGClOOgIidjyfkAh3WIM9ZDl6JGgtwr1LYb2',16,'*','operator@mail.com','8726',NULL,1,'2024-08-09 16:48:34','1','2024-08-29 07:31:39','8'),(11,'Customer','Customer','$2y$10$h3DDzcBd5Au7rJohRcnAs.QrkyJtJ0C00JfndOc8cv76bOajOtW.y',17,'1','Customer@mail.com','21898',NULL,1,'2024-08-12 11:12:51','1','2024-08-29 07:31:35','8'),(13,'pcd01','Agus','$2y$10$B0abibXVXvhyiueojD1nHeTVAvD6LAK5iEYxICSYjbhyMHqBAFsnq',18,'*','pcd@ravalia.co.id','+62 856-9169-5517',NULL,1,'2024-08-28 10:51:11','9','2024-08-29 09:22:05','9'),(14,'finance','Finance','$2y$10$lxhA6zukOZq7AZE1aLRVdOx/5pcfSEbLvP6.4x.HmzoeHhzrhsKkG',19,'*','accounting@ravalia.co.id','021',NULL,1,'2024-08-30 08:37:27','9','2024-08-30 08:59:45','9');
/*!40000 ALTER TABLE `tbl_mst_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_warehouse`
--

DROP TABLE IF EXISTS `tbl_mst_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NameWarehouse` varchar(100) DEFAULT NULL,
  `Area` varchar(100) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `status_warehouse` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_warehouse`
--

LOCK TABLES `tbl_mst_warehouse` WRITE;
/*!40000 ALTER TABLE `tbl_mst_warehouse` DISABLE KEYS */;
INSERT INTO `tbl_mst_warehouse` VALUES (1,'RIM CIBITUNG','Cibitung','Jl. Arteri, Gandasari, Kec. Cikarang Barat, Kab. Bekasi, Jawa Barat 17530',1,'2022-04-12 13:00:00','1','2024-08-30 07:52:58','9');
/*!40000 ALTER TABLE `tbl_mst_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_accesmenu`
--

DROP TABLE IF EXISTS `tbl_sys_accesmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_accesmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accessmenu_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `add` int(1) DEFAULT NULL,
  `edit` int(1) DEFAULT NULL,
  `delete` int(1) DEFAULT NULL,
  `showAll` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_sys_accesmenu_unique` (`accessmenu_id`,`user_id`),
  KEY `tbl_sys_accesmenu_tbl_mst_users_FK` (`user_id`),
  CONSTRAINT `tbl_sys_accesmenu_tbl_mst_users_FK` FOREIGN KEY (`user_id`) REFERENCES `tbl_mst_users` (`id`),
  CONSTRAINT `tbl_sys_accesmenu_tbl_sys_roleaccessmenu_FK` FOREIGN KEY (`accessmenu_id`) REFERENCES `tbl_sys_roleaccessmenu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1020 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_accesmenu`
--

LOCK TABLES `tbl_sys_accesmenu` WRITE;
/*!40000 ALTER TABLE `tbl_sys_accesmenu` DISABLE KEYS */;
INSERT INTO `tbl_sys_accesmenu` VALUES (640,105,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(641,106,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(642,107,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(643,108,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(644,109,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(645,110,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(646,111,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(647,112,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(648,113,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(649,114,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(650,115,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(651,181,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(652,116,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(653,117,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(654,118,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(655,119,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(656,120,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(657,121,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(658,122,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(659,123,8,1,1,1,NULL,'2024-08-12 13:46:03','1'),(820,162,11,1,1,1,NULL,'2024-08-29 07:31:35','1'),(821,163,11,1,1,1,NULL,'2024-08-29 07:31:35','1'),(822,164,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(823,165,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(824,166,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(825,167,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(826,168,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(827,169,11,1,1,1,NULL,'2024-08-29 07:31:35','1'),(828,170,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(829,171,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(830,172,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(831,184,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(832,173,11,1,1,1,NULL,'2024-08-29 07:31:35','1'),(833,174,11,1,1,1,NULL,'2024-08-29 07:31:35','1'),(834,175,11,1,1,1,NULL,'2024-08-29 07:31:35','1'),(835,176,11,1,1,1,NULL,'2024-08-29 07:31:35','1'),(836,177,11,1,1,1,NULL,'2024-08-29 07:31:35','1'),(837,178,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(838,179,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(839,180,11,0,0,0,NULL,'2024-08-29 07:31:35','1'),(840,143,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(841,144,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(842,145,10,0,0,0,NULL,'2024-08-29 07:31:39','1'),(843,146,10,0,0,0,NULL,'2024-08-29 07:31:39','1'),(844,147,10,0,0,0,NULL,'2024-08-29 07:31:39','1'),(845,148,10,0,0,0,NULL,'2024-08-29 07:31:39','1'),(846,149,10,0,0,0,NULL,'2024-08-29 07:31:39','1'),(847,150,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(848,151,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(849,152,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(850,153,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(851,182,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(852,154,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(853,155,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(854,156,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(855,157,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(856,158,10,1,1,1,NULL,'2024-08-29 07:31:39','1'),(857,159,10,0,0,0,NULL,'2024-08-29 07:31:39','1'),(858,160,10,0,0,0,NULL,'2024-08-29 07:31:39','1'),(859,161,10,0,0,0,NULL,'2024-08-29 07:31:39','1'),(860,124,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(861,125,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(862,126,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(863,127,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(864,128,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(865,129,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(866,130,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(867,131,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(868,132,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(869,133,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(870,134,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(871,183,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(872,135,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(873,136,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(874,137,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(875,138,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(876,139,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(877,140,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(878,141,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(879,142,9,1,1,1,NULL,'2024-08-29 07:31:45','1'),(880,185,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(881,186,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(882,187,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(883,188,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(884,189,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(885,190,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(886,191,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(887,192,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(888,193,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(889,194,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(890,195,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(891,196,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(892,197,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(893,198,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(894,199,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(895,200,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(896,201,13,1,1,1,NULL,'2024-08-29 09:22:05','1'),(897,202,13,0,0,0,NULL,'2024-08-29 09:22:05','1'),(898,203,13,0,0,0,NULL,'2024-08-29 09:22:05','1'),(899,204,13,0,0,0,NULL,'2024-08-29 09:22:05','1'),(1000,205,14,1,1,1,NULL,'2024-08-30 08:59:45','1'),(1001,206,14,1,0,0,NULL,'2024-08-30 08:59:45','1'),(1002,207,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1003,208,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1004,209,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1005,210,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1006,211,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1007,212,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1008,213,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1009,214,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1010,215,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1011,216,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1012,217,14,1,1,1,NULL,'2024-08-30 08:59:45','1'),(1013,218,14,1,1,1,NULL,'2024-08-30 08:59:45','1'),(1014,219,14,1,1,1,NULL,'2024-08-30 08:59:45','1'),(1015,220,14,1,1,1,NULL,'2024-08-30 08:59:45','1'),(1016,221,14,1,1,1,NULL,'2024-08-30 08:59:45','1'),(1017,222,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1018,223,14,0,0,0,NULL,'2024-08-30 08:59:45','1'),(1019,224,14,0,0,0,NULL,'2024-08-30 08:59:45','1');
/*!40000 ALTER TABLE `tbl_sys_accesmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_menu`
--

DROP TABLE IF EXISTS `tbl_sys_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_menu` (
  `Menu_id` varchar(100) NOT NULL,
  `MenuLevel` varchar(100) DEFAULT NULL,
  `MenuUrut` varchar(30) DEFAULT NULL,
  `LevelNumber` varchar(100) DEFAULT NULL,
  `ParentMenu` varchar(100) DEFAULT NULL,
  `MenuName` varchar(100) DEFAULT NULL,
  `MenuIcon` varchar(100) DEFAULT NULL,
  `MenuUrl` varchar(100) DEFAULT NULL,
  `StatusMenu` int(1) DEFAULT 0,
  PRIMARY KEY (`Menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_menu`
--

LOCK TABLES `tbl_sys_menu` WRITE;
/*!40000 ALTER TABLE `tbl_sys_menu` DISABLE KEYS */;
INSERT INTO `tbl_sys_menu` VALUES ('MN-1','Top Menu','MN-1','0','*','Dashboard','fa fa-dashboard','administrator/dashboard',1),('MN-10','Sub Menu','MN-9','2','MN-9','Inbound','#','administrator/inbound',1),('MN-11','Sub Menu','MN-9','2','MN-9','Outbound','#','administrator/outbound',1),('MN-12','Main Menu','MN-12','1','*','Control Stock','fa fa-outdent','#',1),('MN-13','Sub Menu','MN-12','2','MN-12','Summary Stock','#','administrator/summary',1),('MN-14','Main Menu','MN-14','1','*','Reporting','fa fa-file-pdf-o','#',1),('MN-15','Sub Menu','MN-14','2','MN-14','Inbound','#','administrator/reportInbound',1),('MN-16','Sub Menu','MN-14','2','MN-14','Outbound','#','administrator/reportOutbound',1),('MN-17','Main Menu','MN-17','1','*','Tools','fa fa-cogs','#',1),('MN-18','Sub Menu','MN-17','2','MN-17','Roles Manajemen','#','administrator/roles',1),('MN-19','Sub Menu','MN-17','2','MN-17','Users Manajemen','#','administrator/users',1),('MN-2','Main Menu','MN-2','1','*','Catalog','fa fa-cube','#',1),('MN-20','Sub Menu','MN-9','2','MN-9','Adjustment','#','administrator/adjustment',1),('MN-3','Sub Menu','MN-2','2','MN-2','Warehouse','#','administrator/warehouse',1),('MN-4','Sub Menu','MN-2','2','MN-2','Location','#','administrator/location',1),('MN-5','Sub Menu','MN-2','2','MN-2','Units','#','administrator/units',1),('MN-6','Sub Menu','MN-2','2','MN-2','Packaging','#','administrator/packaging',1),('MN-7','Sub Menu','MN-2','2','MN-2','Customers','#','administrator/customers',1),('MN-8','Sub Menu','MN-2','2','MN-2','Material','#','administrator/material',1),('MN-9','Main Menu','MN-9','1','*','Manage Stock','fa fa-exchange','#',1);
/*!40000 ALTER TABLE `tbl_sys_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_roleaccessmenu`
--

DROP TABLE IF EXISTS `tbl_sys_roleaccessmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_roleaccessmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` varchar(11) DEFAULT NULL,
  `enable_menu` float DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_sys_roleaccessmenu_unique` (`role_id`,`menu_id`),
  KEY `tbl_sys_roleaccessmenu_tbl_sys_menu_FK` (`menu_id`),
  CONSTRAINT `tbl_sys_roleaccessmenu_tbl_mst_role_FK` FOREIGN KEY (`role_id`) REFERENCES `tbl_mst_role` (`id`),
  CONSTRAINT `tbl_sys_roleaccessmenu_tbl_sys_menu_FK` FOREIGN KEY (`menu_id`) REFERENCES `tbl_sys_menu` (`Menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_roleaccessmenu`
--

LOCK TABLES `tbl_sys_roleaccessmenu` WRITE;
/*!40000 ALTER TABLE `tbl_sys_roleaccessmenu` DISABLE KEYS */;
INSERT INTO `tbl_sys_roleaccessmenu` VALUES (105,14,'MN-1',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(106,14,'MN-2',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(107,14,'MN-3',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(108,14,'MN-4',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(109,14,'MN-5',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(110,14,'MN-6',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(111,14,'MN-7',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(112,14,'MN-8',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(113,14,'MN-9',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(114,14,'MN-10',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(115,14,'MN-11',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(116,14,'MN-12',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(117,14,'MN-13',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(118,14,'MN-14',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(119,14,'MN-15',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(120,14,'MN-16',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(121,14,'MN-17',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(122,14,'MN-18',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(123,14,'MN-19',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(124,15,'MN-1',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(125,15,'MN-2',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(126,15,'MN-3',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(127,15,'MN-4',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(128,15,'MN-5',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(129,15,'MN-6',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(130,15,'MN-7',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(131,15,'MN-8',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(132,15,'MN-9',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(133,15,'MN-10',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(134,15,'MN-11',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(135,15,'MN-12',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(136,15,'MN-13',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(137,15,'MN-14',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(138,15,'MN-15',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(139,15,'MN-16',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(140,15,'MN-17',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(141,15,'MN-18',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(142,15,'MN-19',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(143,16,'MN-1',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(144,16,'MN-2',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(145,16,'MN-3',0,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(146,16,'MN-4',0,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(147,16,'MN-5',0,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(148,16,'MN-6',0,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(149,16,'MN-7',0,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(150,16,'MN-8',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(151,16,'MN-9',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(152,16,'MN-10',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(153,16,'MN-11',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(154,16,'MN-12',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(155,16,'MN-13',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(156,16,'MN-14',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(157,16,'MN-15',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(158,16,'MN-16',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(159,16,'MN-17',0,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(160,16,'MN-18',0,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(161,16,'MN-19',0,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(162,17,'MN-1',1,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(163,17,'MN-2',1,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(164,17,'MN-3',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(165,17,'MN-4',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(166,17,'MN-5',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(167,17,'MN-6',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(168,17,'MN-7',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(169,17,'MN-8',1,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(170,17,'MN-9',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(171,17,'MN-10',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(172,17,'MN-11',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(173,17,'MN-12',1,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(174,17,'MN-13',1,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(175,17,'MN-14',1,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(176,17,'MN-15',1,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(177,17,'MN-16',1,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(178,17,'MN-17',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(179,17,'MN-18',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(180,17,'MN-19',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(181,14,'MN-20',1,'2024-08-12 13:35:41','8','2024-08-12 13:35:41','8'),(182,16,'MN-20',1,'2024-08-26 08:34:51','8','2024-08-26 08:34:51','8'),(183,15,'MN-20',1,'2024-08-26 08:34:56','8','2024-08-26 08:34:56','8'),(184,17,'MN-20',0,'2024-08-26 08:34:39','8','2024-08-26 08:34:39','8'),(185,18,'MN-1',1,'2024-08-28 10:53:13','1',NULL,NULL),(186,18,'MN-2',1,'2024-08-28 10:53:13','1',NULL,NULL),(187,18,'MN-3',1,'2024-08-28 10:53:13','1',NULL,NULL),(188,18,'MN-4',1,'2024-08-28 10:53:13','1',NULL,NULL),(189,18,'MN-5',1,'2024-08-28 10:53:13','1',NULL,NULL),(190,18,'MN-6',1,'2024-08-28 10:53:13','1',NULL,NULL),(191,18,'MN-7',1,'2024-08-28 10:53:13','1',NULL,NULL),(192,18,'MN-8',1,'2024-08-28 10:53:13','1',NULL,NULL),(193,18,'MN-9',1,'2024-08-28 10:53:13','1',NULL,NULL),(194,18,'MN-10',1,'2024-08-28 10:53:13','1',NULL,NULL),(195,18,'MN-11',1,'2024-08-28 10:53:13','1',NULL,NULL),(196,18,'MN-20',1,'2024-08-28 10:53:13','1',NULL,NULL),(197,18,'MN-12',1,'2024-08-28 10:53:13','1',NULL,NULL),(198,18,'MN-13',1,'2024-08-28 10:53:13','1',NULL,NULL),(199,18,'MN-14',1,'2024-08-28 10:53:13','1',NULL,NULL),(200,18,'MN-15',1,'2024-08-28 10:53:13','1',NULL,NULL),(201,18,'MN-16',1,'2024-08-28 10:53:13','1',NULL,NULL),(202,18,'MN-17',0,'2024-08-28 10:53:13','1',NULL,NULL),(203,18,'MN-18',0,'2024-08-28 10:53:13','1',NULL,NULL),(204,18,'MN-19',0,'2024-08-28 10:53:13','1',NULL,NULL),(205,19,'MN-1',1,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(206,19,'MN-2',1,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(207,19,'MN-3',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(208,19,'MN-4',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(209,19,'MN-5',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(210,19,'MN-6',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(211,19,'MN-7',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(212,19,'MN-8',1,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(213,19,'MN-9',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(214,19,'MN-10',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(215,19,'MN-11',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(216,19,'MN-20',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(217,19,'MN-12',1,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(218,19,'MN-13',1,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(219,19,'MN-14',1,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(220,19,'MN-15',1,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(221,19,'MN-16',1,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(222,19,'MN-17',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(223,19,'MN-18',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9'),(224,19,'MN-19',0,'2024-08-30 08:41:08','9','2024-08-30 08:41:08','9');
/*!40000 ALTER TABLE `tbl_sys_roleaccessmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_detailshipingmaterial`
--

DROP TABLE IF EXISTS `tbl_trn_detailshipingmaterial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_detailshipingmaterial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headers_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `no_material` varchar(100) DEFAULT NULL,
  `name_material` varchar(100) DEFAULT NULL,
  `uniqid` varchar(100) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `units` varchar(100) DEFAULT NULL,
  `packaging` varchar(100) DEFAULT NULL,
  `qtyUnit` double DEFAULT 0,
  `qtyUnits` double DEFAULT 0,
  `qtyPackaging` double DEFAULT 0,
  `begin_stock_unit` double DEFAULT 0,
  `begin_stock_units` double DEFAULT 0,
  `begin_stock_packaging` double DEFAULT 0,
  `details_unit` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_trn_detailshipingmaterial_tbl_mst_material_FK` (`material_id`),
  KEY `tbl_trn_detailshipingmaterial_tbl_trn_shipingmaterial_FK` (`headers_id`),
  CONSTRAINT `tbl_trn_detailshipingmaterial_tbl_mst_material_FK` FOREIGN KEY (`material_id`) REFERENCES `tbl_mst_material` (`id`),
  CONSTRAINT `tbl_trn_detailshipingmaterial_tbl_trn_shipingmaterial_FK` FOREIGN KEY (`headers_id`) REFERENCES `tbl_trn_shipingmaterial` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_detailshipingmaterial`
--

LOCK TABLES `tbl_trn_detailshipingmaterial` WRITE;
/*!40000 ALTER TABLE `tbl_trn_detailshipingmaterial` DISABLE KEYS */;
INSERT INTO `tbl_trn_detailshipingmaterial` VALUES (8,1,49,'HK284-0W104-00','PAPER 104','FES1','ROLLS','METER','SKID',216,98820,3,0,0,0,'','2024-09-02 14:59:19','1','2024-09-02 15:09:12','13'),(9,1,50,'HK284-0W218-00','PAPER 218','FES2','ROLLS','METER','SKID',72,33840,2,0,0,0,'','2024-09-02 14:59:19','1','2024-09-02 15:09:12','13'),(10,1,53,'HK284-0W211-00','PAPER 211','FES3','ROLLS','METER','SKID',101,46460,3,0,0,0,'','2024-09-02 14:59:19','1','2024-09-02 15:09:12','13'),(11,1,56,'JKD14311-6781-00','PAPER AF 7623 (580)','-','ROLLS','METER','SKID',510,229500,34,0,0,0,'','2024-09-02 14:59:19','1','2024-09-02 15:09:12','13'),(12,1,55,'HK284-OW570-00','PAPER ACL 715B (570)','FES5','ROLLS','METER','SKID',12,6921,1,0,0,0,'','2024-09-02 14:59:19','1','2024-09-02 15:09:12','13'),(13,1,62,'N990108-0030-00','FILTER PAPER HV (590WX914)','- -','ROLLS','METER','SKID',4,3656,4,0,0,0,'','2024-09-02 14:59:19','1','2024-09-02 15:09:12','13'),(14,1,54,'HK284-0W132-00','PAPER 132,5','FES4','ROLLS','METER','SKID',0,0,0,0,0,0,'','2024-09-02 14:59:19','1','2024-09-02 15:09:12','13'),(18,2,49,'HK284-0W104-00','PAPER 104','FES1','ROLLS','METER','SKID',144,65760,2,216,98820,3,'2760,2760,2760,2760,2760,2700,2760,2760,2760,2760,2760,2700 / 2760,2760,2760,2760,2700,2700,2760,2760,2700,2700,2700,2700','2024-09-02 17:52:12','13',NULL,NULL),(19,2,53,'HK284-0W211-00','PAPER 211','FES3','ROLLS','METER','SKID',36,16560,1,101,46460,3,'1380,1380,1380,1380,1380,1380,1380,1380,1380,1380,1380,1380','2024-09-02 17:52:12','13',NULL,NULL);
/*!40000 ALTER TABLE `tbl_trn_detailshipingmaterial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_shipingmaterial`
--

DROP TABLE IF EXISTS `tbl_trn_shipingmaterial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_shipingmaterial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `no_surat_jalan` varchar(100) DEFAULT NULL,
  `no_reference` varchar(100) DEFAULT NULL,
  `include_handling` enum('yes','no') DEFAULT NULL,
  `ship_to` varchar(255) DEFAULT NULL,
  `driver` varchar(100) DEFAULT NULL,
  `no_truck` varchar(100) DEFAULT NULL,
  `status` enum('open','close') DEFAULT NULL,
  `date_in` datetime DEFAULT NULL,
  `date_out` datetime DEFAULT NULL,
  `types` enum('in','out') DEFAULT NULL,
  `types_trans` enum('Order','Adjust') DEFAULT NULL,
  `date_trans` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_trn_shipingmaterial_unique` (`no_surat_jalan`),
  KEY `tbl_trn_shipingmaterial_tbl_mst_customers_FK` (`customer_id`),
  CONSTRAINT `tbl_trn_shipingmaterial_tbl_mst_customers_FK` FOREIGN KEY (`customer_id`) REFERENCES `tbl_mst_customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_shipingmaterial`
--

LOCK TABLES `tbl_trn_shipingmaterial` WRITE;
/*!40000 ALTER TABLE `tbl_trn_shipingmaterial` DISABLE KEYS */;
INSERT INTO `tbl_trn_shipingmaterial` VALUES (1,1,'0002/ADJUST/RIM/TBINA/IX/2024',NULL,NULL,NULL,NULL,NULL,'close','2024-09-02 15:09:12','2024-09-02 15:09:12','in','Adjust','2024-09-02 11:34:55','STOK AWAL BULAN SEPTEMBER 2024',NULL,'2024-09-02 14:59:19','2024-09-02 15:09:12','13'),(2,1,'0003/SJ/RIM/TBINA/IX/2024','0180704176',NULL,'-','Bpk.ahid','B9440RM','open',NULL,NULL,'out','Order','2024-09-02 17:52:12',NULL,'13','2024-09-02 17:52:12',NULL,NULL);
/*!40000 ALTER TABLE `tbl_trn_shipingmaterial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_tagihan`
--

DROP TABLE IF EXISTS `tbl_trn_tagihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_tagihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) DEFAULT NULL,
  `tanggal_tagihan` date DEFAULT NULL,
  `status_tagihan` varchar(100) DEFAULT NULL,
  `tanggal_pembayaran` varchar(100) DEFAULT NULL,
  `tagihan_warehouse` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_trn_tagihan_tbl_mst_customers_FK` (`customers_id`),
  CONSTRAINT `tbl_trn_tagihan_tbl_mst_customers_FK` FOREIGN KEY (`customers_id`) REFERENCES `tbl_mst_customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_tagihan`
--

LOCK TABLES `tbl_trn_tagihan` WRITE;
/*!40000 ALTER TABLE `tbl_trn_tagihan` DISABLE KEYS */;
INSERT INTO `tbl_trn_tagihan` VALUES (1,1,'2024-07-30','Belum Bayar',NULL,300000);
/*!40000 ALTER TABLE `tbl_trn_tagihan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vw_sys_menu`
--

DROP TABLE IF EXISTS `vw_sys_menu`;
/*!50001 DROP VIEW IF EXISTS `vw_sys_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_sys_menu` (
  `user_id` tinyint NOT NULL,
  `enable_menu` tinyint NOT NULL,
  `menu_id` tinyint NOT NULL,
  `role_id` tinyint NOT NULL,
  `MenuName` tinyint NOT NULL,
  `MenuLevel` tinyint NOT NULL,
  `MenuIcon` tinyint NOT NULL,
  `LevelNumber` tinyint NOT NULL,
  `ParentMenu` tinyint NOT NULL,
  `MenuUrl` tinyint NOT NULL,
  `add` tinyint NOT NULL,
  `edit` tinyint NOT NULL,
  `delete` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_tbl_adjust`
--

DROP TABLE IF EXISTS `vw_tbl_adjust`;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_adjust`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_tbl_adjust` (
  `id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `types` tinyint NOT NULL,
  `remarks` tinyint NOT NULL,
  `types_trans` tinyint NOT NULL,
  `customer_id` tinyint NOT NULL,
  `name_customers` tinyint NOT NULL,
  `code_customers` tinyint NOT NULL,
  `no_surat_jalan` tinyint NOT NULL,
  `no_reference` tinyint NOT NULL,
  `ship_to` tinyint NOT NULL,
  `driver` tinyint NOT NULL,
  `no_truck` tinyint NOT NULL,
  `date_trans` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_tbl_control_stock`
--

DROP TABLE IF EXISTS `vw_tbl_control_stock`;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_control_stock`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_tbl_control_stock` (
  `id` tinyint NOT NULL,
  `customers_id` tinyint NOT NULL,
  `uniqueId` tinyint NOT NULL,
  `units` tinyint NOT NULL,
  `unit` tinyint NOT NULL,
  `packaging` tinyint NOT NULL,
  `no_material` tinyint NOT NULL,
  `name_material` tinyint NOT NULL,
  `QtyUnit` tinyint NOT NULL,
  `QtyUnits` tinyint NOT NULL,
  `QtyPackaging` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_tbl_control_stock_detail`
--

DROP TABLE IF EXISTS `vw_tbl_control_stock_detail`;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_control_stock_detail`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_tbl_control_stock_detail` (
  `id` tinyint NOT NULL,
  `headers_id` tinyint NOT NULL,
  `types_trans` tinyint NOT NULL,
  `types` tinyint NOT NULL,
  `customer_id` tinyint NOT NULL,
  `material_id` tinyint NOT NULL,
  `unit` tinyint NOT NULL,
  `units` tinyint NOT NULL,
  `packaging` tinyint NOT NULL,
  `QtyUnit` tinyint NOT NULL,
  `QtyUnits` tinyint NOT NULL,
  `QtyPackaging` tinyint NOT NULL,
  `begin_stock_unit` tinyint NOT NULL,
  `begin_stock_units` tinyint NOT NULL,
  `begin_stock_packaging` tinyint NOT NULL,
  `EndStockUnit` tinyint NOT NULL,
  `EndStockUnits` tinyint NOT NULL,
  `EndStockPackaging` tinyint NOT NULL,
  `dates` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_tbl_inbound`
--

DROP TABLE IF EXISTS `vw_tbl_inbound`;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_inbound`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_tbl_inbound` (
  `id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `types` tinyint NOT NULL,
  `types_trans` tinyint NOT NULL,
  `customer_id` tinyint NOT NULL,
  `name_customers` tinyint NOT NULL,
  `code_customers` tinyint NOT NULL,
  `no_surat_jalan` tinyint NOT NULL,
  `no_reference` tinyint NOT NULL,
  `ship_to` tinyint NOT NULL,
  `driver` tinyint NOT NULL,
  `no_truck` tinyint NOT NULL,
  `date_trans` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_tbl_inbound_detail`
--

DROP TABLE IF EXISTS `vw_tbl_inbound_detail`;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_inbound_detail`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_tbl_inbound_detail` (
  `id` tinyint NOT NULL,
  `headers_id` tinyint NOT NULL,
  `material_id` tinyint NOT NULL,
  `no_material` tinyint NOT NULL,
  `name_material` tinyint NOT NULL,
  `uniqid` tinyint NOT NULL,
  `unit` tinyint NOT NULL,
  `units` tinyint NOT NULL,
  `packaging` tinyint NOT NULL,
  `qtyUnit` tinyint NOT NULL,
  `qtyUnits` tinyint NOT NULL,
  `qtyPackaging` tinyint NOT NULL,
  `begin_stock_unit` tinyint NOT NULL,
  `begin_stock_units` tinyint NOT NULL,
  `begin_stock_packaging` tinyint NOT NULL,
  `details_unit` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_tbl_outbound`
--

DROP TABLE IF EXISTS `vw_tbl_outbound`;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_outbound`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_tbl_outbound` (
  `id` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `types` tinyint NOT NULL,
  `types_trans` tinyint NOT NULL,
  `customer_id` tinyint NOT NULL,
  `name_customers` tinyint NOT NULL,
  `code_customers` tinyint NOT NULL,
  `no_surat_jalan` tinyint NOT NULL,
  `no_reference` tinyint NOT NULL,
  `ship_to` tinyint NOT NULL,
  `driver` tinyint NOT NULL,
  `no_truck` tinyint NOT NULL,
  `date_trans` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_tbl_sj`
--

DROP TABLE IF EXISTS `vw_tbl_sj`;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_sj`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_tbl_sj` (
  `headers_id` tinyint NOT NULL,
  `no_surat_jalan` tinyint NOT NULL,
  `name_material` tinyint NOT NULL,
  `no_material` tinyint NOT NULL,
  `qtyUnits` tinyint NOT NULL,
  `qtyPackaging` tinyint NOT NULL,
  `units` tinyint NOT NULL,
  `packaging` tinyint NOT NULL,
  `details_unit` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'bitwms'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_tbl_checkstock` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_tbl_checkstock`(IN material_id_param INT)
begin

	select a.id  ,  a.name_material ,  

	(IFNULL(X.qtyUnit,0) - IFNULL(Y.qtyUnit,0)) qtyUnitBeginStock ,

	(IFNULL(X.qtyUnits,0) - IFNULL(Y.qtyUnits,0)) qtyUnitsBeginStock,

	(IFNULL(X.qtyPackaging,0) - IFNULL(Y.qtyPackaging,0)) qtyPackagingBeginStock

	from tbl_mst_material a 

	left join (

	 	select a.material_id,  sum(a.qtyUnit)qtyUnit , 

		sum(a.qtyUnits)qtyUnits , sum(a.qtyPackaging) qtyPackaging 

		from tbl_trn_detailshipingmaterial a 

		left join tbl_trn_shipingmaterial b on b.id  = a.headers_id  

		where  b.status in ("close") and b.date_in <= now() and b.types = ("in")

		group by  a.material_id 

	)X on X.material_id = a.id 	

	left join (

	 	select a.material_id,  sum(a.qtyUnit) qtyUnit , 

		sum(a.qtyUnits) qtyUnits , sum(a.qtyPackaging) qtyPackaging 

		from tbl_trn_detailshipingmaterial a 

		left join tbl_trn_shipingmaterial b on b.id  = a.headers_id  

		where  b.status in ("close") and b.date_out <= now() and b.types = ("out")

		group by  a.material_id 

	)Y on Y.material_id = a.id 	

	where a.id  = material_id_param ;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vw_sys_menu`
--

/*!50001 DROP TABLE IF EXISTS `vw_sys_menu`*/;
/*!50001 DROP VIEW IF EXISTS `vw_sys_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_sys_menu` AS select `a`.`user_id` AS `user_id`,`b`.`enable_menu` AS `enable_menu`,`b`.`menu_id` AS `menu_id`,`b`.`role_id` AS `role_id`,`c`.`MenuName` AS `MenuName`,`c`.`MenuLevel` AS `MenuLevel`,`c`.`MenuIcon` AS `MenuIcon`,`c`.`LevelNumber` AS `LevelNumber`,`c`.`ParentMenu` AS `ParentMenu`,`c`.`MenuUrl` AS `MenuUrl`,`a`.`add` AS `add`,`a`.`edit` AS `edit`,`a`.`delete` AS `delete` from ((`tbl_sys_accesmenu` `a` join `tbl_sys_roleaccessmenu` `b` on(`b`.`id` = `a`.`accessmenu_id`)) join `tbl_sys_menu` `c` on(`c`.`Menu_id` = `b`.`menu_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_tbl_adjust`
--

/*!50001 DROP TABLE IF EXISTS `vw_tbl_adjust`*/;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_adjust`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_tbl_adjust` AS select `a`.`id` AS `id`,`a`.`status` AS `status`,`a`.`types` AS `types`,`a`.`remarks` AS `remarks`,`a`.`types_trans` AS `types_trans`,`a`.`customer_id` AS `customer_id`,`b`.`name_customers` AS `name_customers`,`b`.`code_customers` AS `code_customers`,`a`.`no_surat_jalan` AS `no_surat_jalan`,`a`.`no_reference` AS `no_reference`,`a`.`ship_to` AS `ship_to`,`a`.`driver` AS `driver`,`a`.`no_truck` AS `no_truck`,`a`.`date_trans` AS `date_trans` from (`tbl_trn_shipingmaterial` `a` left join `tbl_mst_customers` `b` on(`b`.`id` = `a`.`customer_id`)) where `a`.`types_trans` = 'Adjust' order by `a`.`date_trans` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_tbl_control_stock`
--

/*!50001 DROP TABLE IF EXISTS `vw_tbl_control_stock`*/;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_control_stock`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_tbl_control_stock` AS select `a`.`id` AS `id`,`a`.`customers_id` AS `customers_id`,`a`.`uniqueId` AS `uniqueId`,`b`.`name_unit` AS `units`,`c`.`name_unit` AS `unit`,`d`.`name_packaging` AS `packaging`,`a`.`no_material` AS `no_material`,`a`.`name_material` AS `name_material`,ifnull(`x`.`QtyUnit`,0) - ifnull(`y`.`QtyUnit`,0) AS `QtyUnit`,ifnull(`x`.`QtyUnits`,0) - ifnull(`y`.`QtyUnits`,0) AS `QtyUnits`,ifnull(`x`.`QtyPackaging`,0) - ifnull(`y`.`QtyPackaging`,0) AS `QtyPackaging`,coalesce(`y`.`updated_at`,`x`.`updated_at`) AS `updated_at` from (((((`tbl_mst_material` `a` left join `tbl_mst_units` `b` on(`b`.`id` = `a`.`unit_id`)) left join `tbl_mst_units` `c` on(`c`.`id` = `a`.`parentUnitId`)) left join `tbl_mst_packaging` `d` on(`d`.`id` = `a`.`packaging_id`)) left join (select `ttd`.`material_id` AS `material_id`,sum(`ttd`.`qtyUnits`) AS `QtyUnits`,sum(`ttd`.`qtyUnit`) AS `QtyUnit`,sum(`ttd`.`qtyPackaging`) AS `QtyPackaging`,max(`ttd`.`updated_at`) AS `updated_at` from (`tbl_trn_detailshipingmaterial` `ttd` left join `tbl_trn_shipingmaterial` `tts` on(`tts`.`id` = `ttd`.`headers_id`)) where `tts`.`status` = 'close' and `tts`.`types` = 'in' group by `ttd`.`material_id` order by `ttd`.`updated_at` desc) `x` on(`x`.`material_id` = `a`.`id`)) left join (select `ttd`.`material_id` AS `material_id`,ifnull(sum(`ttd`.`qtyUnits`),0) AS `QtyUnits`,sum(`ttd`.`qtyUnit`) AS `QtyUnit`,sum(`ttd`.`qtyPackaging`) AS `QtyPackaging`,max(`ttd`.`updated_at`) AS `updated_at` from (`tbl_trn_detailshipingmaterial` `ttd` left join `tbl_trn_shipingmaterial` `tts` on(`tts`.`id` = `ttd`.`headers_id`)) where `tts`.`status` = 'close' and `tts`.`types` = 'out' group by `ttd`.`material_id`) `y` on(`y`.`material_id` = `a`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_tbl_control_stock_detail`
--

/*!50001 DROP TABLE IF EXISTS `vw_tbl_control_stock_detail`*/;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_control_stock_detail`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_tbl_control_stock_detail` AS select `ttd`.`id` AS `id`,`ttd`.`headers_id` AS `headers_id`,`tts`.`types_trans` AS `types_trans`,`tts`.`types` AS `types`,`tts`.`customer_id` AS `customer_id`,`ttd`.`material_id` AS `material_id`,`ttd`.`unit` AS `unit`,`ttd`.`units` AS `units`,`ttd`.`packaging` AS `packaging`,`ttd`.`qtyUnit` AS `QtyUnit`,`ttd`.`qtyUnits` AS `QtyUnits`,`ttd`.`qtyPackaging` AS `QtyPackaging`,`ttd`.`begin_stock_unit` AS `begin_stock_unit`,`ttd`.`begin_stock_units` AS `begin_stock_units`,`ttd`.`begin_stock_packaging` AS `begin_stock_packaging`,if(`tts`.`types` = 'in',`ttd`.`begin_stock_unit` + `ttd`.`qtyUnit`,`ttd`.`begin_stock_unit` - `ttd`.`qtyUnit`) AS `EndStockUnit`,if(`tts`.`types` = 'in',`ttd`.`begin_stock_units` + `ttd`.`qtyUnits`,`ttd`.`begin_stock_units` - `ttd`.`qtyUnits`) AS `EndStockUnits`,if(`tts`.`types` = 'in',`ttd`.`begin_stock_packaging` + `ttd`.`qtyPackaging`,`ttd`.`begin_stock_packaging` - `ttd`.`qtyPackaging`) AS `EndStockPackaging`,if(`tts`.`types` = 'in',`tts`.`date_in`,`tts`.`date_out`) AS `dates` from (`tbl_trn_detailshipingmaterial` `ttd` left join `tbl_trn_shipingmaterial` `tts` on(`ttd`.`headers_id` = `tts`.`id`)) where `tts`.`status` = 'close' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_tbl_inbound`
--

/*!50001 DROP TABLE IF EXISTS `vw_tbl_inbound`*/;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_inbound`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_tbl_inbound` AS select `a`.`id` AS `id`,`a`.`status` AS `status`,`a`.`types` AS `types`,`a`.`types_trans` AS `types_trans`,`a`.`customer_id` AS `customer_id`,`b`.`name_customers` AS `name_customers`,`b`.`code_customers` AS `code_customers`,`a`.`no_surat_jalan` AS `no_surat_jalan`,`a`.`no_reference` AS `no_reference`,`a`.`ship_to` AS `ship_to`,`a`.`driver` AS `driver`,`a`.`no_truck` AS `no_truck`,`a`.`date_trans` AS `date_trans` from (`tbl_trn_shipingmaterial` `a` left join `tbl_mst_customers` `b` on(`b`.`id` = `a`.`customer_id`)) where `a`.`types` = 'in' and `a`.`types_trans` = 'Order' order by `a`.`date_trans` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_tbl_inbound_detail`
--

/*!50001 DROP TABLE IF EXISTS `vw_tbl_inbound_detail`*/;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_inbound_detail`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_tbl_inbound_detail` AS select `a`.`id` AS `id`,`a`.`headers_id` AS `headers_id`,`a`.`material_id` AS `material_id`,`a`.`no_material` AS `no_material`,`a`.`name_material` AS `name_material`,`a`.`uniqid` AS `uniqid`,`a`.`unit` AS `unit`,`a`.`units` AS `units`,`a`.`packaging` AS `packaging`,`a`.`qtyUnit` AS `qtyUnit`,`a`.`qtyUnits` AS `qtyUnits`,`a`.`qtyPackaging` AS `qtyPackaging`,`a`.`begin_stock_unit` AS `begin_stock_unit`,`a`.`begin_stock_units` AS `begin_stock_units`,`a`.`begin_stock_packaging` AS `begin_stock_packaging`,`a`.`details_unit` AS `details_unit` from (((`tbl_trn_detailshipingmaterial` `a` left join `tbl_mst_material` `b` on(`b`.`id` = `a`.`material_id`)) left join `tbl_mst_units` `c` on(`c`.`id` = `b`.`unit_id`)) left join `tbl_mst_packaging` `d` on(`d`.`id` = `b`.`packaging_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_tbl_outbound`
--

/*!50001 DROP TABLE IF EXISTS `vw_tbl_outbound`*/;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_outbound`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_tbl_outbound` AS select `a`.`id` AS `id`,`a`.`status` AS `status`,`a`.`types` AS `types`,`a`.`types_trans` AS `types_trans`,`a`.`customer_id` AS `customer_id`,`b`.`name_customers` AS `name_customers`,`b`.`code_customers` AS `code_customers`,`a`.`no_surat_jalan` AS `no_surat_jalan`,`a`.`no_reference` AS `no_reference`,`a`.`ship_to` AS `ship_to`,`a`.`driver` AS `driver`,`a`.`no_truck` AS `no_truck`,`a`.`date_trans` AS `date_trans` from (`tbl_trn_shipingmaterial` `a` left join `tbl_mst_customers` `b` on(`b`.`id` = `a`.`customer_id`)) where `a`.`types` = 'out' and `a`.`types_trans` = 'Order' order by `a`.`date_trans` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_tbl_sj`
--

/*!50001 DROP TABLE IF EXISTS `vw_tbl_sj`*/;
/*!50001 DROP VIEW IF EXISTS `vw_tbl_sj`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_tbl_sj` AS select `b`.`id` AS `headers_id`,`b`.`no_surat_jalan` AS `no_surat_jalan`,`a`.`name_material` AS `name_material`,`a`.`no_material` AS `no_material`,`a`.`qtyUnits` AS `qtyUnits`,`a`.`qtyPackaging` AS `qtyPackaging`,`a`.`units` AS `units`,`a`.`packaging` AS `packaging`,`a`.`details_unit` AS `details_unit` from (`tbl_trn_detailshipingmaterial` `a` left join `tbl_trn_shipingmaterial` `b` on(`b`.`id` = `a`.`headers_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-03  7:29:32
