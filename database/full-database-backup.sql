	-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
	--
	-- Host: 127.0.0.1    Database: takexx
	-- ------------------------------------------------------
	-- Server version	8.4.0

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
	-- Table structure for table `categories`
	--

	DROP TABLE IF EXISTS `categories`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `categories` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `categories`
	--

	LOCK TABLES `categories` WRITE;
	/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
	INSERT INTO `categories` VALUES (1,'Đồ ăn',0,'2025-06-19 16:52:42','2025-06-19 16:52:42'),(2,'Nước uống',0,'2025-06-20 15:24:58','2025-06-20 15:24:58');
	/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `comments`
	--

	DROP TABLE IF EXISTS `comments`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `comments` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `post_id` int DEFAULT NULL,
	  `user_id` int DEFAULT NULL,
	  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
	  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  KEY `post_id` (`post_id`),
	  KEY `user_id` (`user_id`),
	  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
	  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `comments`
	--

	LOCK TABLES `comments` WRITE;
	/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
	/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `emailverifications`
	--

	DROP TABLE IF EXISTS `emailverifications`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `emailverifications` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `user_id` int DEFAULT NULL,
	  `otp_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `expires_at` datetime DEFAULT NULL,
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  KEY `user_id` (`user_id`),
	  CONSTRAINT `emailverifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `emailverifications`
	--

	LOCK TABLES `emailverifications` WRITE;
	/*!40000 ALTER TABLE `emailverifications` DISABLE KEYS */;
	/*!40000 ALTER TABLE `emailverifications` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `employees`
	--

	DROP TABLE IF EXISTS `employees`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `employees` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'admin',
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `email` (`email`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `employees`
	--

	LOCK TABLES `employees` WRITE;
	/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
	/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `notifications`
	--

	DROP TABLE IF EXISTS `notifications`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `notifications` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `content` text COLLATE utf8mb4_unicode_ci,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `notifications`
	--

	LOCK TABLES `notifications` WRITE;
	/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
	/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `orderdetails`
	--

	DROP TABLE IF EXISTS `orderdetails`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `orderdetails` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `order_id` int DEFAULT NULL,
	  `product_id` int DEFAULT NULL,
	  `size_id` int DEFAULT NULL,
	  `quantity` int NOT NULL,
	  `unit_price` decimal(12,2) NOT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  KEY `order_id` (`order_id`),
	  KEY `product_id` (`product_id`),
	  KEY `size_id` (`size_id`),
	  CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
	  CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
	  CONSTRAINT `orderdetails_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `orderdetails`
	--

	LOCK TABLES `orderdetails` WRITE;
	/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
	/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `orders`
	--

	DROP TABLE IF EXISTS `orders`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `orders` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `user_id` int DEFAULT NULL,
	  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
	  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
	  `total_amount` decimal(12,2) DEFAULT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  KEY `user_id` (`user_id`),
	  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `orders`
	--

	LOCK TABLES `orders` WRITE;
	/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
	/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `payments`
	--

	DROP TABLE IF EXISTS `payments`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `payments` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `order_id` int DEFAULT NULL,
	  `payment_date` datetime DEFAULT CURRENT_TIMESTAMP,
	  `amount` decimal(12,2) NOT NULL,
	  `method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'completed',
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  KEY `order_id` (`order_id`),
	  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `payments`
	--

	LOCK TABLES `payments` WRITE;
	/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
	/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `postcategories`
	--

	DROP TABLE IF EXISTS `postcategories`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `postcategories` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `postcategories`
	--

	LOCK TABLES `postcategories` WRITE;
	/*!40000 ALTER TABLE `postcategories` DISABLE KEYS */;
	/*!40000 ALTER TABLE `postcategories` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `posts`
	--

	DROP TABLE IF EXISTS `posts`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `posts` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
	  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `category_id` int DEFAULT NULL,
	  `employee_id` int DEFAULT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  KEY `category_id` (`category_id`),
	  KEY `employee_id` (`employee_id`),
	  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `postcategories` (`id`),
	  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `posts`
	--

	LOCK TABLES `posts` WRITE;
	/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
	/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `products`
	--

	DROP TABLE IF EXISTS `products`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `products` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `price` decimal(12,2) NOT NULL,
	  `description` text COLLATE utf8mb4_unicode_ci,
	  `category_id` int DEFAULT NULL,
	  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  `quantity` int NOT NULL DEFAULT '0',
	  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Còn hàng',
	  PRIMARY KEY (`id`),
	  KEY `category_id` (`category_id`),
	  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `products`
	--

	LOCK TABLES `products` WRITE;
	/*!40000 ALTER TABLE `products` DISABLE KEYS */;
	INSERT INTO `products` VALUES (1,'Mỳ Ý Sốt Bò Băm',85000.00,'Món mỳ Ý truyền thống với sốt bò băm đậm đà, thơm ngon.',1,'my-y-sot-bo.jpg',0,'2025-06-19 16:53:34','2025-06-19 17:09:55',5,'Còn hàng'),(2,'Bánh Mì Kẹp Thịt Nướng',50000.00,'Bánh mì giòn rụm kẹp thịt nướng tẩm ướp đặc biệt, rau tươi.',1,'banh-mi-thit-nuong.jpg',0,'2025-06-19 16:53:34','2025-06-19 17:09:55',4,'Còn hàng'),(3,'Trà Sữa Trân Châu Đường Đen',45000.00,'Trà sữa đậm vị, kết hợp trân châu đường đen dai ngon.',1,'tra-sua-tran-chau.jpg',0,'2025-06-19 16:53:34','2025-06-19 17:09:55',4,'Còn hàng'),(4,'Cơm Gà Xối Mỡ',70000.00,'Cơm gà xối mỡ giòn da, thịt mềm, ăn kèm dưa chuột và nước mắm gừng.',1,'com-ga-xoi-mo.jpg',0,'2025-06-19 16:53:34','2025-06-19 17:09:55',4,'Còn hàng'),(5,'Pizza Hải Sản Thập Cẩm',180000.00,'Pizza đế mỏng giòn, phủ đầy hải sản tươi ngon và phô mai kéo sợi.',1,'pizza-hai-san.jpg',0,'2025-06-19 16:53:34','2025-06-19 17:09:55',4,'Còn hàng'),(6,'Salad Rau Củ Quả Tươi',65000.00,'Salad thanh mát với các loại rau củ quả tươi theo mùa và sốt dầu giấm.',1,'salad-rau-cu.jpg',0,'2025-06-19 16:53:34','2025-06-19 17:09:55',4,'Còn hàng'),(7,'Súp Nấm Kem Tươi',40000.00,'Súp nấm sánh mịn với vị kem tươi béo ngậy, thơm lừng.',1,'sup-nam-kem.jpg',0,'2025-06-19 16:53:34','2025-06-19 17:09:55',4,'Còn hàng'),(8,'Kem Vị Vanilla Đậu',30000.00,'Kem mát lạnh, hương vị vanilla tự nhiên, ngọt ngào.',1,'kem-vanilla.jpg',0,'2025-06-19 16:53:34','2025-06-19 17:09:55',5,'Còn hàng'),(9,'Trà sửa ngon lắm',20.00,NULL,2,'uploads/products/68552b030934b.jpg',0,'2025-06-20 09:33:55','2025-06-20 09:33:55',3,'còn hàng'),(10,'Gà giòn cay',70.00,'<p>Sản phầm n&agrave;y tuyệt lắm</p>',1,'uploads/products/68552fb6685be.jpg',0,'2025-06-20 09:53:58','2025-06-20 09:53:58',5,'còn hàng');
	/*!40000 ALTER TABLE `products` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `productsizes`
	--

	DROP TABLE IF EXISTS `productsizes`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `productsizes` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `product_id` int DEFAULT NULL,
	  `size_id` int DEFAULT NULL,
	  `price` decimal(12,2) NOT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  KEY `product_id` (`product_id`),
	  KEY `size_id` (`size_id`),
	  CONSTRAINT `productsizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
	  CONSTRAINT `productsizes_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `productsizes`
	--

	LOCK TABLES `productsizes` WRITE;
	/*!40000 ALTER TABLE `productsizes` DISABLE KEYS */;
	/*!40000 ALTER TABLE `productsizes` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `reviews`
	--

	DROP TABLE IF EXISTS `reviews`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `reviews` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `user_id` int DEFAULT NULL,
	  `product_id` int DEFAULT NULL,
	  `content` text COLLATE utf8mb4_unicode_ci,
	  `rating` int DEFAULT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`),
	  KEY `user_id` (`user_id`),
	  KEY `product_id` (`product_id`),
	  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
	  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
	  CONSTRAINT `reviews_chk_1` CHECK ((`rating` between 1 and 5))
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `reviews`
	--

	LOCK TABLES `reviews` WRITE;
	/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
	/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `sizes`
	--

	DROP TABLE IF EXISTS `sizes`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `sizes` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `sizes`
	--

	LOCK TABLES `sizes` WRITE;
	/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
	/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `sliders`
	--

	DROP TABLE IF EXISTS `sliders`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `sliders` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `sliders`
	--

	LOCK TABLES `sliders` WRITE;
	/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
	/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
	UNLOCK TABLES;

	--
	-- Table structure for table `users`
	--

	DROP TABLE IF EXISTS `users`;
	/*!40101 SET @saved_cs_client     = @@character_set_client */;
	/*!50503 SET character_set_client = utf8mb4 */;
	CREATE TABLE `users` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `email_verified_at` datetime DEFAULT NULL,
	  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  `address` text COLLATE utf8mb4_unicode_ci,
	  `isDeleted` tinyint(1) DEFAULT '0',
	  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
	  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `email` (`email`)
	) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	/*!40101 SET character_set_client = @saved_cs_client */;

	--
	-- Dumping data for table `users`
	--

	LOCK TABLES `users` WRITE;
	/*!40000 ALTER TABLE `users` DISABLE KEYS */;
	INSERT INTO `users` VALUES (1,'MAI HỮU HUY','maihuy0089@gmail.com',NULL,'$2y$12$fyfq6/m7VW4UHRkv6qcv9.UbWxqykbjzsA3nB5SeougPCfCzRzZIS',NULL,NULL,0,'2025-06-17 10:30:09','2025-06-17 10:30:09',NULL);
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

	-- Dump completed on 2025-06-21 14:49:19
