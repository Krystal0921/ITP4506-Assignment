-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: itp4506-ca
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
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `c_ID` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `c_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `c_Password` varchar(10) COLLATE utf8mb4_0900_as_cs NOT NULL,
  `c_Email_Address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `c_Phone_Number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `c_Address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`c_ID`,`c_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES ('c0000001','Kwong Ching Yee','0912','cherrie@pg95.com','92110080','Kwun Tong',1),('c0000002','Dom','d','wendy@pg95.com','92111587','no.37 Laguna Street',1),('c0000003','c','c','wendy@pg95.com','92114277','no.37 Laguna Street',1);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_personnel`
--

DROP TABLE IF EXISTS `delivery_personnel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_personnel` (
  `d_ID` varchar(8) NOT NULL,
  `d_Name` varchar(50) NOT NULL,
  `d_Password` varchar(10) NOT NULL,
  `d_Phone_Number` varchar(15) NOT NULL,
  `d_District` varchar(50) NOT NULL,
  `d_Transportation` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`d_ID`,`d_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_personnel`
--

LOCK TABLES `delivery_personnel` WRITE;
/*!40000 ALTER TABLE `delivery_personnel` DISABLE KEYS */;
INSERT INTO `delivery_personnel` VALUES ('d0000001','d','d','12345678','Kwun Tong ','Motorcycle',0),('d0000002','z','z','23456789','Lam Tin ','Walk',1),('d0000003','dd','123','23456789','Lam Tin ','Walk',1);
/*!40000 ALTER TABLE `delivery_personnel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `food` (
  `f_ID` varchar(8) NOT NULL,
  `f_Name` varchar(45) NOT NULL,
  `f_Image` varchar(255) DEFAULT NULL,
  `f_Type` varchar(45) NOT NULL,
  `f_Price` int NOT NULL,
  `f_descriptions` varchar(255) DEFAULT NULL,
  `r_ID` varchar(8) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`f_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` VALUES ('f0000001','Baguette','baguette.PNG','Bread',10,'Is a long, French bread with a crispy crust and a soft interior','r0000002',1),('f0000002','Croissant','croissant.PNG','Bread',8,'Is a French pastry characterized by its crescent shape. It has a flaky exterior and a soft, layered interior','r0000002',1),('f0000003','Pretzel ','pretzel.PNG','Bread',12,'Known for its twisted shape. It has a crunchy outer layer and a soft interior, often sprinkled with salt. ','r0000002',1),('f0000004','Chicken & Egg Burger','Chicken_and_Egg Burger.png','Main',18,'Is a burger that features grilled chicken and a fried egg as its main components.','r0000001',1),('f0000005','Americano','Americano.jpg','Beverages',23,'It has a rich coffee flavor but is lighter in body compared to espresso.','r0000001',1),('f0000006','Sundae','Sundae.jpg','Desserts',45,'It typically includes scoops of ice cream, chocolate sauce, fruit sauce, whipped cream, nuts, and may be garnished with a cherry or other decorations.','r0000001',1),('f0000007','Big Mac','Big_Mac.jpg','Main',20,'It consists of two beef patties, special sauce, pickles, cheese, onions, and is sandwiched between three layers of bread. ','r0000001',1),('f0000008','Coffee','coffee.PNG','Drink',11,'Coffee is a popular beverage made from roasted coffee beans.','r0000002',1),('f0000010','Chicken Leg','chicken.jpg','Chicken',13,'Yummy','r0000003',1),('f0000011','Bubble Tea','Bubble_Tea.PNG','Drink',25,'abc','r0000002',1);
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `id_number`
--

DROP TABLE IF EXISTS `id_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `id_number` (
  `Seq_Name` varchar(45) NOT NULL,
  `Seq_ID` int NOT NULL,
  `Seq_Header` varchar(1) NOT NULL,
  PRIMARY KEY (`Seq_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `id_number`
--

LOCK TABLES `id_number` WRITE;
/*!40000 ALTER TABLE `id_number` DISABLE KEYS */;
INSERT INTO `id_number` VALUES ('Customer',4,'c'),('Delivery_Personnel',3,'d'),('Food',11,'f'),('Restaurant',4,'r');
/*!40000 ALTER TABLE `id_number` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `m_ID` varchar(8) NOT NULL,
  `f_ID` varchar(8) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`m_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `o_ID` varchar(8) NOT NULL,
  `c_ID` varchar(8) NOT NULL,
  `r_ID` varchar(8) NOT NULL,
  `d_ID` varchar(8) DEFAULT NULL,
  `o_Time` datetime NOT NULL,
  `o_Delivery_Address` varchar(100) NOT NULL,
  `o_Payment_Method` int NOT NULL,
  `o_Status` varchar(50) NOT NULL,
  `o_Estimated_Time` datetime NOT NULL,
  `o_Delivery_Time` datetime NOT NULL,
  `o_Food_Rate` int DEFAULT NULL,
  `o_Service_Rate` int DEFAULT NULL,
  `o_Comment` varchar(100) DEFAULT NULL,
  `o_Total_Amount` float DEFAULT NULL,
  `o_Delivery_Fee` float DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`o_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES ('o0000001','c0000001','r0000001','d0000001','2023-10-25 23:13:25','Hong Kong',1,'Commit','2023-10-26 00:13:25','2023-10-26 00:13:25',0,0,'0',114.4,10.4,1),('o0000002','c0000001','r0000001','','2023-10-26 09:06:59','Hong Kong',1,'Pending to take away','2023-10-26 10:06:59','2023-10-26 10:06:59',0,0,'0',114.4,10.4,1),('o0000003','c0000001','r0000001','d0000001','2023-10-26 09:11:06','Hong Kong',2,'Pending to delivery','2023-10-26 10:11:06','2023-10-26 10:11:06',0,0,'0',114.4,10.4,1),('o0000004','c0000001','r0000001','','2023-10-26 10:07:06','Hong Kong',2,'Pending to take away','2023-10-26 11:07:06','2023-10-26 11:07:06',0,0,'0',50.6,4.6,1),('o0000005','c0000001','r0000001','','2023-10-26 10:18:26','Hong Kong',1,'Pending to take away','2023-10-26 11:18:26','2023-10-26 11:18:26',0,0,'0',50.6,4.6,1),('o0000006','c0000001','r0000001','','2023-10-26 10:19:27','Hong Kong',1,'Pending to take away','2023-10-26 11:19:27','2023-10-26 11:19:27',0,0,'0',50.6,4.6,1),('o0000007','c0000001','r0000001','','2023-10-26 15:24:08','Hong Kong',1,'Pending to take away','2023-10-26 16:24:08','2023-10-26 16:24:08',0,0,'0',67.1,6.1,1),('o0000008','c0000001','r0000001','','2023-10-26 16:58:16','Hong Kong',1,'Pending to take away','2023-10-26 17:58:16','2023-10-26 17:58:16',0,0,'0',19.8,1.8,1),('o0000009','c0000001','r0000001','','2023-10-26 22:14:28','Hong Kong',1,'Pending to take away','2023-10-26 23:14:28','2023-10-26 23:14:28',0,0,'0',138.6,12.6,1),('o0000010','c0000001','r0000001','','2023-10-26 22:17:05','Hong Kong',3,'Pending to cook','2023-10-26 23:17:05','2023-10-26 23:17:05',0,0,'0',41.8,3.8,1),('o0000011','c0000001','r0000001','','2023-10-26 22:21:05','Hong Kong',1,'Pending to cook','2023-10-26 23:21:05','2023-10-26 23:21:05',0,0,'0',39.6,3.6,1),('o0000012','c0000001','r0000001','','2023-10-27 10:32:46','Hong Kong',2,'Pending to cook','2023-10-27 11:32:46','2023-10-27 11:32:46',4,3,'0',45.1,4.1,1),('o0000013','c0000001','r0000001','','2023-10-27 10:34:58','Hong Kong',1,'Pending to cook','2023-10-27 11:34:58','2023-10-27 11:34:58',2,4,'0',49.5,4.5,1),('o0000014','c0000002','r0000001','','2023-10-28 10:02:56','Lam Tin',2,'Pending to cook','2023-10-28 11:02:56','2023-10-28 11:02:56',0,0,'0',19.8,1.8,1),('o0000015','c0000002','r0000002','','2023-10-28 12:36:03','Lam Tin',1,'Pending to take away','2023-10-28 13:36:03','2023-10-28 13:36:03',0,0,'0',19.8,1.8,1),('o0000016','c0000001','r0000001','','2023-10-28 15:23:21','Hong Kong',1,'Pending to cook','2023-10-28 16:23:21','2023-10-28 16:23:21',0,0,'0',64.9,5.9,1),('o0000017','c0000001','r0000001','','2023-10-28 15:35:29','Hong Kong',1,'Pending to cook','2023-10-28 16:35:29','2023-10-28 16:35:29',0,0,'0',41.8,3.8,1),('o0000018','c0000001','r0000001','','2023-10-28 20:22:15','Hong Kong',2,'Pending to cook','2023-10-28 21:22:15','2023-10-28 21:22:15',0,0,'0',71.5,6.5,1),('o0000019','c0000003','r0000002','','2023-10-28 22:13:00','Kwung Tong',2,'Pending to take away','2023-10-28 23:13:00','2023-10-28 23:13:00',0,0,'0',50.6,4.6,1),('o0000020','c0000003','r0000001','','2023-12-02 22:45:29','no.37 Laguna Street',1,'Pending to cook','2023-12-02 23:45:29','2023-12-02 23:45:29',0,0,'',41.8,3.8,1);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_content`
--

DROP TABLE IF EXISTS `order_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_content` (
  `o_ID` varchar(8) NOT NULL,
  `f_ID` varchar(8) NOT NULL,
  `o_Quantity` int NOT NULL,
  `o_Seq_ID` int NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`o_ID`,`o_Seq_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_content`
--

LOCK TABLES `order_content` WRITE;
/*!40000 ALTER TABLE `order_content` DISABLE KEYS */;
INSERT INTO `order_content` VALUES ('o0000001','f0000004',1,1,1),('o0000001','f0000005',1,2,1),('o0000001','f0000006',1,3,1),('o0000002','f0000004',2,1,1),('o0000002','f0000005',1,2,1),('o0000002','f0000006',1,3,1),('o0000003','f0000004',2,1,1),('o0000003','f0000005',1,2,1),('o0000003','f0000007',1,3,1),('o0000004','f0000005',2,1,1),('o0000005','f0000005',2,1,1),('o0000006','f0000005',2,1,1),('o0000007','f0000004',1,1,1),('o0000007','f0000005',1,2,1),('o0000007','f0000007',1,3,1),('o0000008','f0000004',1,1,1),('o0000009','f0000004',7,1,1),('o0000010','f0000004',1,1,1),('o0000010','f0000007',1,2,1),('o0000011','f0000004',2,1,1),('o0000012','f0000004',1,1,1),('o0000012','f0000005',1,2,1),('o0000013','f0000006',1,1,1),('o0000014','f0000004',1,1,1),('o0000015','f0000001',1,1,1),('o0000015','f0000002',1,2,1),('o0000016','f0000004',2,1,1),('o0000016','f0000005',1,2,1),('o0000017','f0000004',1,1,1),('o0000017','f0000007',1,2,1),('o0000018','f0000006',1,1,1),('o0000018','f0000007',1,2,1),('o0000019','f0000003',2,1,1),('o0000019','f0000008',1,2,1);
/*!40000 ALTER TABLE `order_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restaurant` (
  `r_ID` varchar(8) NOT NULL,
  `r_Name` varchar(50) NOT NULL,
  `r_Password` varchar(10) NOT NULL,
  `r_Address` varchar(100) NOT NULL,
  `r_Telephone_Number` varchar(15) NOT NULL,
  `r_Image` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`r_ID`,`r_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` VALUES ('r0000001','Mcdonalds','123','Shop No. 267, 2/F Shun Tak Centre, 200 Connaught Road, Central, Hong Kong','23547697','Mcdonalds.png',1),('r0000002','r','r','no.37 Laguna Street','92111587','baking.jpg',1),('r0000003','KFC','123','Shop A1 on G/F, 1/F& 2/F, East South Building, 475-481 Hennessy Road, Causeway Bay','36452876','KFC.png',1),('r0000004','Ichiran','123','Entrance Hall on G/F & Shop B on B/F, 8 Minden Avenue, Tsim Sha Tsui','28740009','Ichiran.png',1);
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_delivery_list`
--

DROP TABLE IF EXISTS `restaurant_delivery_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restaurant_delivery_list` (
  `r_d_List_Number` int NOT NULL,
  `d_ID` varchar(8) NOT NULL,
  `r_ID` varchar(8) NOT NULL,
  `d_Name` varchar(50) NOT NULL,
  `d_Phone_Number` varchar(15) NOT NULL,
  `d_District` varchar(50) NOT NULL,
  `d_Transportation` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`r_d_List_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_delivery_list`
--

LOCK TABLES `restaurant_delivery_list` WRITE;
/*!40000 ALTER TABLE `restaurant_delivery_list` DISABLE KEYS */;
INSERT INTO `restaurant_delivery_list` VALUES (1,'d0000003','r0000002','dd','23456789','Lam Tin ','Walk',1),(2,'d0000003','r0000001','dd','23456789','Lam Tin ','Walk',1),(3,'d0000001','r0000002','d','12345678','Kwun Tong ','Motorcycle',1),(4,'d0000002','r0000001','z','23456789','Lam Tin ','Walk',1),(5,'d0000001','r0000001','d','12345678','Kwun Tong ','Motorcycle',1),(6,'d0000002','r0000002','z','23456789','Lam Tin ','Walk',1);
/*!40000 ALTER TABLE `restaurant_delivery_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-02 23:35:06
