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
INSERT INTO `tbl_mst_category` VALUES (1,'Welding','tes',1,'2024-09-19 13:00:00','1',NULL,NULL),(2,'Stamping','Dssss',1,'2024-09-19 08:42:40',NULL,'2024-09-30 15:10:35',NULL);
/*!40000 ALTER TABLE `tbl_mst_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mst_part`
--

DROP TABLE IF EXISTS `tbl_mst_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mst_part` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `uniq` varchar(100) DEFAULT NULL,
  `part_number` varchar(100) DEFAULT NULL,
  `part_name` varchar(100) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `units_id` int(11) DEFAULT NULL,
  `qtyPerUnit` double DEFAULT NULL,
  `volumePerDays` double DEFAULT NULL,
  `qtySafety` double DEFAULT NULL,
  `safetyForDays` double DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status_part` int(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `forecast` double DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_part_unique` (`uniq`),
  UNIQUE KEY `tbl_mst_part_unique_1` (`part_number`),
  KEY `tbl_mst_part_tbl_mst_supplier_FK` (`supplier_id`),
  KEY `tbl_mst_part_tbl_mst_units_FK` (`unit_id`),
  KEY `tbl_mst_part_tbl_mst_units_FK_1` (`units_id`),
  KEY `tbl_mst_part_tbl_mst_category_FK` (`category_id`),
  CONSTRAINT `tbl_mst_part_tbl_mst_category_FK` FOREIGN KEY (`category_id`) REFERENCES `tbl_mst_category` (`id`),
  CONSTRAINT `tbl_mst_part_tbl_mst_supplier_FK` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_mst_supplier` (`id`),
  CONSTRAINT `tbl_mst_part_tbl_mst_units_FK` FOREIGN KEY (`unit_id`) REFERENCES `tbl_mst_units` (`id`),
  CONSTRAINT `tbl_mst_part_tbl_mst_units_FK_1` FOREIGN KEY (`units_id`) REFERENCES `tbl_mst_units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_part`
--

LOCK TABLES `tbl_mst_part` WRITE;
/*!40000 ALTER TABLE `tbl_mst_part` DISABLE KEYS */;
INSERT INTO `tbl_mst_part` VALUES (11,2,1,'560A','BT082','72405-X7V19','LINK SUB-ASSY, FR VERTICAL, RH',1,2,0,50,100,2,'Remark2',1,'2024-09-20 09:08:17','1','2024-09-25 13:15:45',NULL,NULL),(12,2,2,'660A/560A','CW4','71911-X7A01-A','STAY S/A, FR SEAT HEADREST',1,2,0,80,160,2,'Remark3',1,'2024-09-20 09:08:17','1','2024-09-30 10:48:21',90,NULL),(16,2,1,'D03B','EM8','232422-A3434B','STAY SUB-ASSY, RR SEAT HEADREST',1,2,25,45,90,2,'tester',1,'2024-09-30 11:27:52','1','2024-09-30 11:28:37',0,NULL),(47,1,1,'560A','BT082A','72405-X7V19A','LINK SUB-ASSY, FR VERTICAL, RH A',1,2,0,321,642.3,2,'Remark2',1,'2024-09-30 13:52:20','1',NULL,6423,NULL);
/*!40000 ALTER TABLE `tbl_mst_part` ENABLE KEYS */;
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
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status_role` int(1) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_mst_role_unique` (`code_role`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_role`
--

LOCK TABLES `tbl_mst_role` WRITE;
/*!40000 ALTER TABLE `tbl_mst_role` DISABLE KEYS */;
INSERT INTO `tbl_mst_role` VALUES (19,'PCD','pcd','2024-10-01 07:34:02','2024-10-02 07:26:25',1,NULL,'1'),(26,'supplier','sup','2024-10-01 10:39:18','2024-10-02 07:26:17',1,'1','1'),(31,'developer','dev','2024-10-01 13:01:26','2024-10-02 07:26:13',1,'1','1');
/*!40000 ALTER TABLE `tbl_mst_role` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_supplier`
--

LOCK TABLES `tbl_mst_supplier` WRITE;
/*!40000 ALTER TABLE `tbl_mst_supplier` DISABLE KEYS */;
INSERT INTO `tbl_mst_supplier` VALUES (1,'BTI','Bonecom Tricom','123456','bonecom@mail.com','Jl Selayar',1,'2024-10-10 13:00:00',NULL,NULL,NULL),(2,'RIM','Ravalia Inti Mandiri','6276767','rim@mail.com','Jl Jawa Karang Timur',1,'2024-10-10 13:00:00',NULL,NULL,NULL),(4,'BIT','Bonecom Inti Technology','8737346374','email@pass','Jl Raya Mangga Dua',1,'2024-09-18 14:23:47',NULL,'2024-09-18 14:26:28',NULL),(10,'ADM','Astra Daihatsu Motor','67263726','bonecom@mail.com','Jl Raya Selayar',1,'2024-09-30 13:10:00',NULL,'2024-09-30 13:10:00',NULL);
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
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `lock_user` int(1) DEFAULT 0,
  `profile` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(3) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_mst_users_tbl_mst_role_FK` (`role_id`),
  CONSTRAINT `tbl_mst_users_tbl_mst_role_FK` FOREIGN KEY (`role_id`) REFERENCES `tbl_mst_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_users`
--

LOCK TABLES `tbl_mst_users` WRITE;
/*!40000 ALTER TABLE `tbl_mst_users` DISABLE KEYS */;
INSERT INTO `tbl_mst_users` VALUES (6,'dev','123','dev@mail.com','665665',0,NULL,'*',31,'2024-09-12 14:00:00','1','2024-10-02 15:35:26','1'),(9,'pcd','123','12@mail.com','654',0,NULL,'*',19,'2024-10-02 14:40:00','1','2024-10-02 14:40:00',NULL),(11,'supplier','123','supplier@mail.com','726676',0,NULL,'2',26,'2024-10-03 09:57:03','1','2024-10-03 09:57:03',NULL);
/*!40000 ALTER TABLE `tbl_mst_users` ENABLE KEYS */;
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
  `LevelNumber` varchar(100) DEFAULT NULL,
  `ParentMenu` varchar(100) DEFAULT NULL,
  `MenuName` varchar(100) DEFAULT NULL,
  `MenuIcon` varchar(100) DEFAULT NULL,
  `MenuUrl` varchar(100) DEFAULT NULL,
  `StatusMenu` int(1) DEFAULT 0,
  PRIMARY KEY (`Menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_menu`
--

LOCK TABLES `tbl_sys_menu` WRITE;
/*!40000 ALTER TABLE `tbl_sys_menu` DISABLE KEYS */;
INSERT INTO `tbl_sys_menu` VALUES ('MN-1','0','0','*','Dashboard','fa fa-home','dashboard',1),('MN-2','1','1','*','Master Data','fas fa-cubes','base',1),('MN-2A','2','2','MN-2','Supplier','-','supplier',1),('MN-2B','2','2','MN-2','Units','-','units',1),('MN-2C','2','2','MN-2','Category','-','category',1),('MN-2D','2','2','MN-2','Part Material','-','part',1),('MN-3','1','1','*','Stock','fas fa-layer-group','proc',1),('MN-3A','2','2','MN-3','Upload Safe Stock','-','entrystock',1),('MN-3B','2','2','MN-3','Monitor Stock','-','monitorStock',1),('MN-4','1','1','*','Tools','fas fa-cog','tools',1),('MN-4A','2','2','MN-4','Roles','-','roles',1),('MN-4B','2','2','MN-4','Users','-','users',1);
/*!40000 ALTER TABLE `tbl_sys_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_menuusers`
--

DROP TABLE IF EXISTS `tbl_sys_menuusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_menuusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accessmenu_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `add` int(1) DEFAULT NULL,
  `edit` int(1) DEFAULT NULL,
  `delete` int(1) DEFAULT NULL,
  `showAll` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_sys_menuUsers_unique` (`accessmenu_id`,`user_id`),
  KEY `tbl_sys_menuUsers_tbl_mst_users_FK` (`user_id`),
  CONSTRAINT `tbl_sys_menuUsers_tbl_mst_users_FK` FOREIGN KEY (`user_id`) REFERENCES `tbl_mst_users` (`id`),
  CONSTRAINT `tbl_sys_menuUsers_tbl_sys_roleaccessmenu_FK` FOREIGN KEY (`accessmenu_id`) REFERENCES `tbl_sys_roleaccessmenu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1071 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_menuusers`
--

LOCK TABLES `tbl_sys_menuusers` WRITE;
/*!40000 ALTER TABLE `tbl_sys_menuusers` DISABLE KEYS */;
INSERT INTO `tbl_sys_menuusers` VALUES (724,189,9,0,0,0,0,'2024-10-02 14:40:00','1'),(725,208,9,1,1,0,0,'2024-10-02 14:40:00','1'),(726,241,9,0,0,0,1,'2024-10-02 14:40:00','1'),(1055,228,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1056,229,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1057,230,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1058,231,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1059,232,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1060,233,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1061,234,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1062,235,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1063,236,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1064,237,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1065,238,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1066,239,6,1,1,1,1,'2024-10-03 08:25:14','1'),(1067,193,11,1,1,1,1,'2024-10-03 09:57:03','1'),(1068,196,11,1,1,1,1,'2024-10-03 09:57:03','1'),(1069,197,11,1,1,1,1,'2024-10-03 09:57:03','1'),(1070,198,11,1,1,1,1,'2024-10-03 09:57:03','1');
/*!40000 ALTER TABLE `tbl_sys_menuusers` ENABLE KEYS */;
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
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_sys_roleaccessmenu_unique` (`role_id`,`menu_id`),
  KEY `tbl_sys_roleaccessmenu_tbl_sys_menu_FK` (`menu_id`),
  CONSTRAINT `tbl_sys_roleaccessmenu_tbl_mst_role_FK` FOREIGN KEY (`role_id`) REFERENCES `tbl_mst_role` (`id`),
  CONSTRAINT `tbl_sys_roleaccessmenu_tbl_sys_menu_FK` FOREIGN KEY (`menu_id`) REFERENCES `tbl_sys_menu` (`Menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_roleaccessmenu`
--

LOCK TABLES `tbl_sys_roleaccessmenu` WRITE;
/*!40000 ALTER TABLE `tbl_sys_roleaccessmenu` DISABLE KEYS */;
INSERT INTO `tbl_sys_roleaccessmenu` VALUES (189,19,'MN-1',1,'2024-10-01 08:05:47','1','2024-10-02 07:32:10','1'),(193,26,'MN-1',1,'2024-10-01 10:39:18','1','2024-10-02 07:26:17','1'),(196,26,'MN-3',1,'2024-10-01 10:50:53','1','2024-10-02 07:26:17','1'),(197,26,'MN-3A',1,'2024-10-01 10:50:53','1','2024-10-02 07:26:17','1'),(198,26,'MN-3B',1,'2024-10-01 10:50:53','1','2024-10-02 07:26:17','1'),(208,19,'MN-2',1,'2024-10-01 11:55:02','1','2024-10-02 07:32:10','1'),(228,31,'MN-1',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(229,31,'MN-2',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(230,31,'MN-2A',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(231,31,'MN-2B',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(232,31,'MN-2C',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(233,31,'MN-2D',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(234,31,'MN-3',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(235,31,'MN-3A',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(236,31,'MN-3B',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(237,31,'MN-4',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(238,31,'MN-4A',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(239,31,'MN-4B',1,'2024-10-02 07:22:29','1','2024-10-02 07:26:13','1'),(241,19,'MN-2A',1,'2024-10-02 07:32:10','1',NULL,NULL);
/*!40000 ALTER TABLE `tbl_sys_roleaccessmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_stock`
--

DROP TABLE IF EXISTS `tbl_trn_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `stock` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_trn_stock_unique` (`part_id`),
  KEY `tbl_trn_stock_tbl_mst_supplier_FK` (`supplier_id`),
  CONSTRAINT `tbl_trn_stock_tbl_mst_part_FK` FOREIGN KEY (`part_id`) REFERENCES `tbl_mst_part` (`id`),
  CONSTRAINT `tbl_trn_stock_tbl_mst_supplier_FK` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_mst_supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_stock`
--

LOCK TABLES `tbl_trn_stock` WRITE;
/*!40000 ALTER TABLE `tbl_trn_stock` DISABLE KEYS */;
INSERT INTO `tbl_trn_stock` VALUES (9,11,2,'2024-09-30 14:04:38',60,'2024-09-30 14:00:15','1','2024-09-30 14:04:38','1'),(10,12,2,'2024-09-30 14:04:38',150,'2024-09-30 14:00:15','1','2024-09-30 14:04:38','1'),(11,16,2,'2024-09-30 14:04:38',10,'2024-09-30 14:00:15','1','2024-09-30 14:04:38','1');
/*!40000 ALTER TABLE `tbl_trn_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trn_stockuploaddaily`
--

DROP TABLE IF EXISTS `tbl_trn_stockuploaddaily`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trn_stockuploaddaily` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty_safetyStock` double DEFAULT NULL,
  `date_upload` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_trn_stockdaily_tbl_mst_supplier_FK` (`supplier_id`),
  KEY `tbl_trn_stockdaily_tbl_mst_part_FK` (`part_id`),
  CONSTRAINT `tbl_trn_stockdaily_tbl_mst_part_FK` FOREIGN KEY (`part_id`) REFERENCES `tbl_mst_part` (`id`),
  CONSTRAINT `tbl_trn_stockdaily_tbl_mst_supplier_FK` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_mst_supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_stockuploaddaily`
--

LOCK TABLES `tbl_trn_stockuploaddaily` WRITE;
/*!40000 ALTER TABLE `tbl_trn_stockuploaddaily` DISABLE KEYS */;
INSERT INTO `tbl_trn_stockuploaddaily` VALUES (41,11,2,60,'2024-09-30','2024-09-30 14:00:15','1','2024-09-30 14:04:38','1'),(42,12,2,150,'2024-09-30','2024-09-30 14:00:15','1','2024-09-30 14:04:38','1'),(43,16,2,10,'2024-09-30','2024-09-30 14:00:15','1','2024-09-30 14:04:38','1');
/*!40000 ALTER TABLE `tbl_trn_stockuploaddaily` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `vw_listmenuroles`
--

DROP TABLE IF EXISTS `vw_listmenuroles`;
/*!50001 DROP VIEW IF EXISTS `vw_listmenuroles`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_listmenuroles` (
  `role_id` tinyint NOT NULL,
  `Menu_id` tinyint NOT NULL,
  `ParentMenu` tinyint NOT NULL,
  `MenuName` tinyint NOT NULL,
  `MenuLevel` tinyint NOT NULL,
  `MenuIcon` tinyint NOT NULL,
  `LevelNumber` tinyint NOT NULL,
  `enable_menu` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_menu`
--

DROP TABLE IF EXISTS `vw_menu`;
/*!50001 DROP VIEW IF EXISTS `vw_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_menu` (
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
  `delete` tinyint NOT NULL,
  `view` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_monitorstock`
--

DROP TABLE IF EXISTS `vw_monitorstock`;
/*!50001 DROP VIEW IF EXISTS `vw_monitorstock`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_monitorstock` (
  `supplier_name` tinyint NOT NULL,
  `part_name` tinyint NOT NULL,
  `supplier_id` tinyint NOT NULL,
  `part_number` tinyint NOT NULL,
  `code_unit` tinyint NOT NULL,
  `qtySafety` tinyint NOT NULL,
  `safetyForDays` tinyint NOT NULL,
  `volumePerDay` tinyint NOT NULL,
  `stockSupplier` tinyint NOT NULL,
  `stockUntilDay` tinyint NOT NULL,
  `statusPersentaseDay` tinyint NOT NULL,
  `stockStatus` tinyint NOT NULL,
  `last_update` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_part`
--

DROP TABLE IF EXISTS `vw_part`;
/*!50001 DROP VIEW IF EXISTS `vw_part`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_part` (
  `supplier_name` tinyint NOT NULL,
  `unit` tinyint NOT NULL,
  `code_unit` tinyint NOT NULL,
  `units` tinyint NOT NULL,
  `code_units` tinyint NOT NULL,
  `name_category` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `supplier_id` tinyint NOT NULL,
  `category_id` tinyint NOT NULL,
  `model` tinyint NOT NULL,
  `uniq` tinyint NOT NULL,
  `part_number` tinyint NOT NULL,
  `part_name` tinyint NOT NULL,
  `unit_id` tinyint NOT NULL,
  `units_id` tinyint NOT NULL,
  `qtyPerUnit` tinyint NOT NULL,
  `volumePerDays` tinyint NOT NULL,
  `qtySafety` tinyint NOT NULL,
  `safetyForDays` tinyint NOT NULL,
  `status_part` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `forecast` tinyint NOT NULL,
  `remarks` tinyint NOT NULL,
  `updated_by` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `vw_roles`
--

DROP TABLE IF EXISTS `vw_roles`;
/*!50001 DROP VIEW IF EXISTS `vw_roles`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_roles` (
  `id` tinyint NOT NULL,
  `roleName` tinyint NOT NULL,
  `code_role` tinyint NOT NULL,
  `status_role` tinyint NOT NULL,
  `created_at` tinyint NOT NULL,
  `created_by` tinyint NOT NULL,
  `updated_by` tinyint NOT NULL,
  `updated_at` tinyint NOT NULL,
  `Accessed` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'bit.supplierportal'
--

--
-- Final view structure for view `vw_listmenuroles`
--

/*!50001 DROP TABLE IF EXISTS `vw_listmenuroles`*/;
/*!50001 DROP VIEW IF EXISTS `vw_listmenuroles`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_listmenuroles` AS select `x`.`role_id` AS `role_id`,`a`.`Menu_id` AS `Menu_id`,`a`.`ParentMenu` AS `ParentMenu`,`a`.`MenuName` AS `MenuName`,`a`.`MenuLevel` AS `MenuLevel`,`a`.`MenuIcon` AS `MenuIcon`,`a`.`LevelNumber` AS `LevelNumber`,`x`.`enable_menu` AS `enable_menu` from (`bit.supplierportal`.`tbl_sys_menu` `a` left join (select `tsr`.`enable_menu` AS `enable_menu`,`tsr`.`menu_id` AS `menu_id`,`tsr`.`role_id` AS `role_id` from `bit.supplierportal`.`tbl_sys_roleaccessmenu` `tsr` group by `tsr`.`menu_id`,`tsr`.`enable_menu`,`tsr`.`role_id`) `x` on(`x`.`menu_id` = `a`.`Menu_id`)) where `a`.`StatusMenu` = 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_menu`
--

/*!50001 DROP TABLE IF EXISTS `vw_menu`*/;
/*!50001 DROP VIEW IF EXISTS `vw_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_menu` AS select `a`.`user_id` AS `user_id`,`b`.`enable_menu` AS `enable_menu`,`b`.`menu_id` AS `menu_id`,`b`.`role_id` AS `role_id`,`c`.`MenuName` AS `MenuName`,`c`.`MenuLevel` AS `MenuLevel`,`c`.`MenuIcon` AS `MenuIcon`,`c`.`LevelNumber` AS `LevelNumber`,`c`.`ParentMenu` AS `ParentMenu`,`c`.`MenuUrl` AS `MenuUrl`,`a`.`add` AS `add`,`a`.`edit` AS `edit`,`a`.`delete` AS `delete`,`a`.`showAll` AS `view` from ((`tbl_sys_menuusers` `a` join `tbl_sys_roleaccessmenu` `b` on(`b`.`id` = `a`.`accessmenu_id`)) join `tbl_sys_menu` `c` on(`c`.`Menu_id` = `b`.`menu_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_monitorstock`
--

/*!50001 DROP TABLE IF EXISTS `vw_monitorstock`*/;
/*!50001 DROP VIEW IF EXISTS `vw_monitorstock`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_monitorstock` AS select `b`.`supplier_name` AS `supplier_name`,`a`.`part_name` AS `part_name`,`a`.`supplier_id` AS `supplier_id`,`a`.`part_number` AS `part_number`,`c`.`code_unit` AS `code_unit`,`a`.`qtySafety` AS `qtySafety`,`a`.`safetyForDays` AS `safetyForDays`,`a`.`qtySafety` / `a`.`safetyForDays` AS `volumePerDay`,ifnull(`x`.`stock`,'not update') AS `stockSupplier`,format(ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`),1) AS `stockUntilDay`,format(ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100,1) AS `statusPersentaseDay`,case when ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100 <= 40 then 'SHORTAGE' when ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100 > 40 and ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100 <= 80 then 'POTENTIAL' when ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100 > 80 then 'SAFETY' else 'Unknown' end AS `stockStatus`,`x`.`date_update` AS `last_update` from (((`bit.supplierportal`.`tbl_mst_part` `a` left join `bit.supplierportal`.`tbl_mst_supplier` `b` on(`b`.`id` = `a`.`supplier_id`)) left join `bit.supplierportal`.`tbl_mst_units` `c` on(`c`.`id` = `a`.`units_id`)) left join (select `bit.supplierportal`.`tbl_trn_stock`.`date_update` AS `date_update`,`bit.supplierportal`.`tbl_trn_stock`.`stock` AS `stock`,`bit.supplierportal`.`tbl_trn_stock`.`part_id` AS `part_id` from `bit.supplierportal`.`tbl_trn_stock`) `x` on(`x`.`part_id` = `a`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_part`
--

/*!50001 DROP TABLE IF EXISTS `vw_part`*/;
/*!50001 DROP VIEW IF EXISTS `vw_part`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_part` AS select `b`.`supplier_name` AS `supplier_name`,`c`.`name_unit` AS `unit`,`c`.`code_unit` AS `code_unit`,`d`.`name_unit` AS `units`,`d`.`code_unit` AS `code_units`,`e`.`name_category` AS `name_category`,`a`.`id` AS `id`,`a`.`supplier_id` AS `supplier_id`,`a`.`category_id` AS `category_id`,`a`.`model` AS `model`,`a`.`uniq` AS `uniq`,`a`.`part_number` AS `part_number`,`a`.`part_name` AS `part_name`,`a`.`unit_id` AS `unit_id`,`a`.`units_id` AS `units_id`,`a`.`qtyPerUnit` AS `qtyPerUnit`,`a`.`volumePerDays` AS `volumePerDays`,`a`.`qtySafety` AS `qtySafety`,`a`.`safetyForDays` AS `safetyForDays`,`a`.`status_part` AS `status_part`,`a`.`created_at` AS `created_at`,`a`.`created_by` AS `created_by`,`a`.`updated_at` AS `updated_at`,`a`.`forecast` AS `forecast`,`a`.`remarks` AS `remarks`,`a`.`updated_by` AS `updated_by` from ((((`tbl_mst_part` `a` left join `tbl_mst_supplier` `b` on(`b`.`id` = `a`.`supplier_id`)) left join `tbl_mst_units` `c` on(`c`.`id` = `a`.`unit_id`)) left join `tbl_mst_units` `d` on(`d`.`id` = `a`.`units_id`)) left join `tbl_mst_category` `e` on(`e`.`id` = `a`.`category_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_roles`
--

/*!50001 DROP TABLE IF EXISTS `vw_roles`*/;
/*!50001 DROP VIEW IF EXISTS `vw_roles`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_roles` AS select `a`.`id` AS `id`,`a`.`roleName` AS `roleName`,`a`.`code_role` AS `code_role`,`a`.`status_role` AS `status_role`,`a`.`created_at` AS `created_at`,`a`.`created_by` AS `created_by`,`a`.`updated_by` AS `updated_by`,`a`.`updated_at` AS `updated_at`,group_concat(concat('[',`x`.`MenuName`,']') order by substr(`x`.`Menu_id`,4,3) ASC separator ' ') AS `Accessed` from (`bit.supplierportal`.`tbl_mst_role` `a` left join (select `tsm`.`MenuName` AS `MenuName`,`tsr`.`role_id` AS `role_id`,`tsm`.`Menu_id` AS `Menu_id` from (`bit.supplierportal`.`tbl_sys_roleaccessmenu` `tsr` left join `bit.supplierportal`.`tbl_sys_menu` `tsm` on(`tsm`.`Menu_id` = `tsr`.`menu_id`)) where `tsr`.`enable_menu` = 1 group by `tsm`.`MenuName`,`tsr`.`role_id`,`tsm`.`Menu_id` order by cast(substr(`tsm`.`Menu_id`,4,3) as signed)) `x` on(`a`.`id` = `x`.`role_id`)) group by `a`.`id`,`a`.`roleName`,`a`.`code_role`,`a`.`status_role`,`a`.`created_at`,`a`.`created_by`,`a`.`updated_by`,`a`.`updated_at` */;
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

-- Dump completed on 2024-10-03 11:22:47
