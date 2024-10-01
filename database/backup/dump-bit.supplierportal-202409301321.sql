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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mst_part`
--

LOCK TABLES `tbl_mst_part` WRITE;
/*!40000 ALTER TABLE `tbl_mst_part` DISABLE KEYS */;
INSERT INTO `tbl_mst_part` VALUES (11,2,1,'560A','BT082','72405-X7V19','LINK SUB-ASSY, FR VERTICAL, RH',1,2,0,50,100,2,'Remark2',1,'2024-09-20 09:08:17','1','2024-09-25 13:15:45',NULL,NULL),(12,2,2,'660A/560A','CW4','71911-X7A01-A','STAY S/A, FR SEAT HEADREST',1,2,0,80,160,2,'Remark3',1,'2024-09-20 09:08:17','1','2024-09-30 10:48:21',90,NULL),(16,2,1,'D03B','EM8','232422-A3434B','STAY SUB-ASSY, RR SEAT HEADREST',1,2,25,45,90,2,'tester',1,'2024-09-30 11:27:52','1','2024-09-30 11:28:37',0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_stock`
--

LOCK TABLES `tbl_trn_stock` WRITE;
/*!40000 ALTER TABLE `tbl_trn_stock` DISABLE KEYS */;
INSERT INTO `tbl_trn_stock` VALUES (6,11,2,'2024-09-27 00:00:00',60,'2024-09-27 15:00:09','1','2024-09-30 11:31:39','1'),(7,12,2,'2024-09-27 00:00:00',150,'2024-09-27 15:00:09','1','2024-09-30 11:31:39','1'),(8,16,2,'2024-09-30 00:00:00',10,'2024-09-30 11:29:05','1','2024-09-30 11:31:39','1');
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trn_stockuploaddaily`
--

LOCK TABLES `tbl_trn_stockuploaddaily` WRITE;
/*!40000 ALTER TABLE `tbl_trn_stockuploaddaily` DISABLE KEYS */;
INSERT INTO `tbl_trn_stockuploaddaily` VALUES (36,11,2,90,'2024-09-27','2024-09-27 15:00:09','1',NULL,NULL),(37,12,2,200,'2024-09-27','2024-09-27 15:00:09','1',NULL,NULL),(38,11,2,60,'2024-09-30','2024-09-30 10:49:36','1','2024-09-30 11:31:39','1'),(39,12,2,150,'2024-09-30','2024-09-30 10:49:36','1','2024-09-30 11:31:39','1'),(40,16,2,10,'2024-09-30','2024-09-30 11:29:05','1','2024-09-30 11:31:39','1');
/*!40000 ALTER TABLE `tbl_trn_stockuploaddaily` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping routines for database 'bit.supplierportal'
--

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
/*!50001 VIEW `vw_monitorstock` AS select `b`.`supplier_name` AS `supplier_name`,`a`.`part_name` AS `part_name`,`a`.`part_number` AS `part_number`,`c`.`code_unit` AS `code_unit`,`a`.`qtySafety` AS `qtySafety`,`a`.`safetyForDays` AS `safetyForDays`,`a`.`qtySafety` / `a`.`safetyForDays` AS `volumePerDay`,ifnull(`x`.`stock`,'not update') AS `stockSupplier`,format(ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`),1) AS `stockUntilDay`,format(ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100,1) AS `statusPersentaseDay`,case when ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100 <= 40 then 'SHORTAGE' when ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100 > 40 and ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100 <= 80 then 'POTENTIAL' when ifnull(`x`.`stock`,0) / (`a`.`qtySafety` / `a`.`safetyForDays`) / `a`.`safetyForDays` * 100 > 80 then 'SAFETY' else 'Unknown' end AS `stockStatus`,`x`.`date_update` AS `last_update` from (((`bit.supplierportal`.`tbl_mst_part` `a` left join `bit.supplierportal`.`tbl_mst_supplier` `b` on(`b`.`id` = `a`.`supplier_id`)) left join `bit.supplierportal`.`tbl_mst_units` `c` on(`c`.`id` = `a`.`units_id`)) left join (select `bit.supplierportal`.`tbl_trn_stock`.`date_update` AS `date_update`,`bit.supplierportal`.`tbl_trn_stock`.`stock` AS `stock`,`bit.supplierportal`.`tbl_trn_stock`.`part_id` AS `part_id` from `bit.supplierportal`.`tbl_trn_stock`) `x` on(`x`.`part_id` = `a`.`id`)) */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-30 13:21:05
