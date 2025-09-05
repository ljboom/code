-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: wukong_ceshi59
-- ------------------------------------------------------
-- Server version	5.7.44-log

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
-- Table structure for table `admin_ledgers`
--

DROP TABLE IF EXISTS `admin_ledgers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_ledgers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) unsigned NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perticulation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `debit` double NOT NULL DEFAULT '0',
  `credit` double NOT NULL DEFAULT '0',
  `status` enum('pending','approved','rejected','default') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_ledgers`
--

LOCK TABLES `admin_ledgers` WRITE;
/*!40000 ALTER TABLE `admin_ledgers` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_ledgers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `balance` double(20,2) NOT NULL DEFAULT '0.00',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,0.00,'优选源码网 yxymk.com','/public/admin/assets/images/profile/17542518144Vp.jpg','yxymk@gmail.com','2023-11-29 18:37:08','$2y$10$102Y0GVRzAhwsu0T6O/c8uTE/1snCMLIpiipuyvwMV99ZiJqtatSm','2025-08-04','admin','2222222222','Pakistan From Lahore','ed64SrtGvjEOJjs4N7v65wL8a1cSr6XRvCPXvNLYPkLZ3UkVgrJX9PIrHUL9','2023-11-28 11:11:57','2025-08-03 18:18:28');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonus_ledgers`
--

DROP TABLE IF EXISTS `bonus_ledgers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonus_ledgers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `bonus_id` bigint(20) unsigned NOT NULL,
  `amount` double(20,2) NOT NULL DEFAULT '0.00',
  `bonus_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonus_ledgers`
--

LOCK TABLES `bonus_ledgers` WRITE;
/*!40000 ALTER TABLE `bonus_ledgers` DISABLE KEYS */;
INSERT INTO `bonus_ledgers` VALUES (2,21,1,3.00,'123456','2024-02-19 23:07:23','2024-02-19 23:07:23'),(3,36,1,2.00,'123456','2024-04-28 11:31:17','2024-04-28 11:31:17');
/*!40000 ALTER TABLE `bonus_ledgers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonuses`
--

DROP TABLE IF EXISTS `bonuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bonus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter` int(11) DEFAULT '0' COMMENT 'user get service count',
  `set_service_counter` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `winner` int(11) DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonuses`
--

LOCK TABLES `bonuses` WRITE;
/*!40000 ALTER TABLE `bonuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checkins`
--

DROP TABLE IF EXISTS `checkins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checkins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(20,2) NOT NULL DEFAULT '0.00',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checkins_user_id_foreign` (`user_id`),
  CONSTRAINT `checkins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkins`
--

LOCK TABLES `checkins` WRITE;
/*!40000 ALTER TABLE `checkins` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commissions`
--

DROP TABLE IF EXISTS `commissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `amount` double(20,2) NOT NULL DEFAULT '0.00',
  `date` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `token` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commissions`
--

LOCK TABLES `commissions` WRITE;
/*!40000 ALTER TABLE `commissions` DISABLE KEYS */;
INSERT INTO `commissions` VALUES (1,16,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 10:12:54','2023-12-29 10:12:54'),(2,16,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 10:12:59','2023-12-29 10:12:59'),(3,16,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 10:13:00','2023-12-29 10:13:00'),(4,16,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 10:13:04','2023-12-29 10:13:04'),(5,16,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 10:13:08','2023-12-29 10:13:08'),(6,16,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 10:13:13','2023-12-29 10:13:13'),(7,16,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 10:13:16','2023-12-29 10:13:16'),(8,16,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 10:13:19','2023-12-29 10:13:19'),(9,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:29','2023-12-29 12:12:29'),(10,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:33','2023-12-29 12:12:33'),(11,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:36','2023-12-29 12:12:36'),(12,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:39','2023-12-29 12:12:39'),(13,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:43','2023-12-29 12:12:43'),(14,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:46','2023-12-29 12:12:46'),(15,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:48','2023-12-29 12:12:48'),(16,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:52','2023-12-29 12:12:52'),(17,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:54','2023-12-29 12:12:54'),(18,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:57','2023-12-29 12:12:57'),(19,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:12:59','2023-12-29 12:12:59'),(20,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:13:02','2023-12-29 12:13:02'),(21,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:13:04','2023-12-29 12:13:04'),(22,19,1,21.00,'2023-12-29','active','2023-12-16','2023-12-29 12:13:07','2023-12-29 12:13:07'),(23,16,1,21.00,'2023-12-30','active','2023-12-30','2023-12-30 07:35:16','2023-12-30 07:35:16'),(24,19,1,21.00,'2023-12-30','active','2023-12-30','2023-12-30 11:30:52','2023-12-30 11:30:52'),(25,19,1,21.00,'2023-12-30','active','2023-12-30','2023-12-30 11:30:56','2023-12-30 11:30:56'),(26,19,1,21.00,'2023-12-30','active','2023-12-30','2023-12-30 11:30:59','2023-12-30 11:30:59'),(27,16,1,21.00,'2023-12-30','active','2023-12-30','2023-12-30 12:01:44','2023-12-30 12:01:44');
/*!40000 ALTER TABLE `commissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `method_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'User Number',
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'User Deposit Amount',
  `charge_amount` double(20,2) NOT NULL DEFAULT '0.00',
  `final_amount` double(20,2) NOT NULL DEFAULT '0.00',
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','rejected','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposits`
--

LOCK TABLES `deposits` WRITE;
/*!40000 ALTER TABLE `deposits` DISABLE KEYS */;
INSERT INTO `deposits` VALUES (15,65,'TRC 20','66083','Testshsheh','/public/upload/payment/1735920356mMr.png',NULL,'300',0.00,300.00,'03-01-2025 22:05:57','approved by admin','approved','2025-01-04 03:05:57','2025-01-04 03:07:40'),(16,65,'Jazz Cash(JC)','65475','R500','/public/upload/payment/1735920546uml.png',NULL,'500',0.00,500.00,'03-01-2025 22:09:06','approved by admin','approved','2025-01-04 03:09:06','2025-01-04 03:09:19'),(17,96,'USDT-TRC20','31514','优选源码网 yxymk.com yxymk.net yxymk.net TG：@yxymk','/public/upload/payment/1754244396arT.png',NULL,'100000',0.00,100000.00,'04-08-2025 00:06:36','approved by admin','approved','2025-08-03 16:06:36','2025-08-03 16:16:16');
/*!40000 ALTER TABLE `deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lucky_ledgers`
--

DROP TABLE IF EXISTS `lucky_ledgers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lucky_ledgers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `draw_id` bigint(20) DEFAULT NULL,
  `amount` double(20,2) NOT NULL DEFAULT '0.00',
  `current_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lucky_ledgers_user_id_foreign` (`user_id`),
  CONSTRAINT `lucky_ledgers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lucky_ledgers`
--

LOCK TABLES `lucky_ledgers` WRITE;
/*!40000 ALTER TABLE `lucky_ledgers` DISABLE KEYS */;
/*!40000 ALTER TABLE `lucky_ledgers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_03_16_074227_create_admins_table',1),(6,'2023_03_17_123007_create_packages_table',2),(8,'2023_03_27_103153_create_payment_methods_table',3),(10,'2023_03_28_074201_create_deposits_table',4),(11,'2023_03_28_142734_create_user_ledgers_table',5),(12,'2023_03_28_142802_create_admin_ledgers_table',6),(13,'2023_03_30_071745_create_vip_sliders_table',7),(14,'2023_03_30_150139_create_settings_table',8),(15,'2023_04_01_185541_create_bonuses_table',9),(16,'2023_04_01_205009_create_bonus_ledgers_table',10),(17,'2023_04_05_203304_create_purchases_table',11),(18,'2023_04_09_200835_create_minings_table',12),(19,'2023_05_05_092841_create_drows_table',13),(20,'2023_05_05_111428_create_lucky_ledgers_table',14),(21,'2023_05_05_161904_create_icons_table',15),(22,'2023_05_09_214610_create_hiru_notices_table',16),(23,'2023_06_06_210226_create_funds_table',17),(24,'2023_06_06_222047_create_fund_invests_table',18),(25,'2023_06_11_113547_create_checkins_table',19),(26,'2023_06_23_193458_create_improvments_table',20),(27,'2023_06_24_083626_create_commissions_table',21),(28,'2023_12_14_221116_create_tasks_table',22),(29,'2024_01_31_034808_create_rebates_table',23);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `tab` enum('vip','fixed','event') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vip',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `validity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'count days',
  `commission_with_avg_amount` double NOT NULL DEFAULT '0' COMMENT 'user get average amount after validity',
  `ref1` double(20,2) NOT NULL DEFAULT '0.00',
  `ref2` double(20,2) NOT NULL DEFAULT '0.00',
  `ref3` double(20,2) NOT NULL DEFAULT '0.00',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `is_default` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (47,NULL,'vip','1','The transformers yxymk','/public/upload/package/1735346963pJ2.jpg',500,'30',15000,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 11:49:24','2025-08-03 16:25:50'),(48,NULL,'vip','2','Insurcient','/public/upload/package/1735347160fbq.jpg',5000,'45',60000,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 11:52:40','2024-12-28 11:52:40'),(49,NULL,'vip','3','Thor Ragnaror','/public/upload/package/1735347317QXh.jpg',15000,'60',100000,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 11:55:17','2024-12-28 11:55:17'),(50,NULL,'vip','4','The Scorch Trials','/public/upload/package/1735347395KmT.jpg',30000,'65',150000,5.00,3.00,1.00,'active','0',NULL,'2024-12-28 11:56:35','2024-12-28 11:56:35'),(51,NULL,'vip','5','11th April','/public/upload/package/1735347455kxV.jpg',50000,'75',175000,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 11:57:35','2024-12-28 11:57:35'),(52,NULL,'vip','6','The Fighter','/public/upload/package/17353475111E3.jpg',100000,'80',200000,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 11:58:31','2024-12-28 11:58:31'),(53,NULL,'vip','7','Maze Runner','/public/upload/package/1735347584RzS.jpg',125000,'85',300000,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 11:59:45','2024-12-28 11:59:45'),(54,NULL,'vip','8','Divercient','/public/upload/package/1735347669u3u.jpg',250000,'100',500000,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 12:01:09','2024-12-28 12:01:09'),(55,NULL,'vip','9','Under paris','/public/upload/package/1735347753J58.jpeg',500000,'120',800000,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 12:02:33','2024-12-28 12:02:33'),(56,NULL,'vip','10','Damsel','/public/upload/package/1735347812qYV.jpg',800000,'130',1500000,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 12:03:32','2024-12-28 12:03:32'),(57,NULL,'fixed','1','Vip 1','/public/upload/package/1735379761364.jpg',120,'15',300,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 20:56:02','2024-12-28 20:56:02'),(58,NULL,'fixed','2','Vip 2','/public/upload/package/1735379908Wy0.jpg',300,'30',600,6.00,3.00,1.00,'active','0',NULL,'2024-12-28 20:58:28','2024-12-28 20:58:28'),(59,NULL,'fixed','3','Vip 3','/public/upload/package/17353799677Cx.jpg',1000,'60',6000,4.00,2.00,1.00,'active','0',NULL,'2024-12-28 20:59:27','2024-12-28 21:00:23'),(60,NULL,'event','Ev 1','Flickri Evi 1','/public/upload/package/17353831533wm.jpg',100,'1',300,6.00,2.00,1.00,'active','0',NULL,'2024-12-28 21:52:34','2024-12-28 21:52:34'),(61,NULL,'event','2','Flickri Evi 2','/public/upload/package/1735383289JWN.jpg',300,'2',600,5.00,2.00,1.00,'active','0',NULL,'2024-12-28 21:54:49','2024-12-28 21:54:49');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` VALUES (32,'Jazz Cash(JC)','/public/upload/setting/1714242234PPN.png','Demo KT Dev','inactive','2023-07-05 07:44:20','2025-08-03 16:04:20'),(33,'USDT-TRC20','/public/upload/setting/17142422425b1.png','TBrZnhFEgQiTBdELghWL3Shefi2twuKong','active','2023-07-05 20:17:41','2025-08-03 16:05:10');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tab` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `package_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `daily_income` double(20,2) NOT NULL DEFAULT '0.00',
  `hourly` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `return_total` double(20,2) NOT NULL DEFAULT '0.00',
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `validity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchases_user_id_foreign` (`user_id`),
  KEY `purchases_package_id_foreign` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (13,'vip',54,35,600,35.00,1.4583,3150.00,'2024-10-21 02:14:23',NULL,'active','2025-01-18 02:14:23','2024-10-20 01:14:23','2024-10-20 01:14:23'),(14,'vip',54,35,600,35.00,1.4583,3150.00,'2024-10-21 03:12:01',NULL,'active','2025-01-18 03:12:01','2024-10-20 02:12:01','2024-10-20 02:12:01'),(15,'vip',54,36,1200,70.00,2.9167,6300.00,'2024-10-21 03:22:56',NULL,'active','2025-01-18 03:22:56','2024-10-20 02:22:56','2024-10-20 02:22:56'),(16,'vip',54,36,1200,70.00,2.9167,6300.00,'2024-10-21 03:23:07',NULL,'active','2025-01-18 03:23:07','2024-10-20 02:23:07','2024-10-20 02:23:07'),(17,'vip',55,35,600,35.00,1.4583,3150.00,'2024-10-21 08:09:40',NULL,'active','2025-01-18 08:09:40','2024-10-20 07:09:40','2024-10-20 07:09:40'),(18,'vip',55,36,1200,70.00,2.9167,6300.00,'2024-10-21 08:30:03',NULL,'active','2025-01-18 08:30:03','2024-10-20 07:30:03','2024-10-20 07:30:03'),(19,'vip',55,37,3000,176.00,7.3333,15840.00,'2024-10-21 08:32:34',NULL,'active','2025-01-18 08:32:34','2024-10-20 07:32:34','2024-10-20 07:32:34'),(20,'vip',54,37,3000,176.00,7.3333,15840.00,'2024-11-04 05:03:44',NULL,'active','2025-02-01 05:03:44','2024-11-03 05:03:44','2024-11-03 05:03:44'),(21,'vip',54,38,5000,294.00,12.2500,26460.00,'2024-12-29 01:54:33',NULL,'active','2025-03-28 01:54:33','2024-12-28 06:54:33','2024-12-28 06:54:33'),(22,'vip',54,38,5000,294.00,12.2500,26460.00,'2024-12-29 01:54:34',NULL,'active','2025-03-28 01:54:34','2024-12-28 06:54:34','2024-12-28 06:54:34'),(23,'vip',54,38,5000,294.00,12.2500,26460.00,'2024-12-29 01:54:34',NULL,'active','2025-03-28 01:54:34','2024-12-28 06:54:34','2024-12-28 06:54:34'),(24,'vip',54,49,15000,1666.67,69.4444,100000.00,'2024-12-29 14:13:08',NULL,'active','2025-02-26 14:13:08','2024-12-28 19:13:08','2024-12-28 19:13:08'),(25,'vip',65,47,500,500.00,20.8333,15000.00,'2025-01-04 22:09:58',NULL,'inactive','2025-02-02 22:09:58','2025-01-04 03:09:58','2025-08-03 18:18:28'),(26,'vip',96,47,500,500.00,20.8333,15000.00,'2025-08-05 00:29:22',NULL,'active','2025-09-03 00:29:22','2025-08-03 16:29:22','2025-08-03 16:29:22');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rebates`
--

DROP TABLE IF EXISTS `rebates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rebates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `interest_commission1` double NOT NULL,
  `interest_commission2` double NOT NULL,
  `interest_commission3` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rebates`
--

LOCK TABLES `rebates` WRITE;
/*!40000 ALTER TABLE `rebates` DISABLE KEYS */;
INSERT INTO `rebates` VALUES (1,6,3,1,NULL,'2024-02-06 03:33:26');
/*!40000 ALTER TABLE `rebates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `withdraw_charge` int(11) NOT NULL DEFAULT '0' COMMENT 'percent',
  `minimum_withdraw` double(20,2) NOT NULL DEFAULT '0.00',
  `maximum_withdraw` double(20,2) NOT NULL DEFAULT '0.00',
  `w_time_status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `checkin` double(20,2) NOT NULL DEFAULT '0.00',
  `registration_bonus` double(20,2) NOT NULL DEFAULT '0.00',
  `total_member_register_reword` int(11) NOT NULL DEFAULT '0',
  `total_member_register_reword_amount` double(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,2,250.00,50000.00,'active',0.00,50.00,0,0.00,'2022-01-18 11:03:22','2025-08-03 15:55:57','https://t.me/yxymk');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_ledgers`
--

DROP TABLE IF EXISTS `user_ledgers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_ledgers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `get_balance_from_user_id` bigint(20) DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perticulation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `debit` double NOT NULL DEFAULT '0',
  `credit` double NOT NULL DEFAULT '0',
  `status` enum('pending','approved','rejected','default') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_ledgers`
--

LOCK TABLES `user_ledgers` WRITE;
/*!40000 ALTER TABLE `user_ledgers` DISABLE KEYS */;
INSERT INTO `user_ledgers` VALUES (1,21,NULL,'withdraw_request','withdraw request status is pending',500,475,0,'pending','28-04-2024 01:09',NULL,'2024-04-28 00:09:52','2024-04-28 00:09:52'),(2,21,NULL,'payment_approved','Your payment already approved. thanks for invest in our BITLA',6000,6000,0,'approved','28-04-2024 01:23',NULL,'2024-04-28 00:23:31','2024-04-28 00:23:31'),(3,21,NULL,'payment_approved','Your payment already approved. thanks for invest in our BITLA',6000,6000,0,'approved','28-04-2024 01:24',NULL,'2024-04-28 00:24:53','2024-04-28 00:24:53'),(4,36,NULL,'Claim','Congratulations User85 you are successfully get your bonus.',2,2,0,'approved','28-04-2024 12:31',NULL,'2024-04-28 11:31:17','2024-04-28 11:31:17'),(5,36,NULL,'payment_approved','Your payment already approved. thanks for invest in our Hello Coder',25000,25000,0,'approved','28-04-2024 12:35',NULL,'2024-04-28 11:35:57','2024-04-28 11:35:57'),(6,39,NULL,'payment_approved','Your payment already approved. thanks for invest in our Hello Coder',2800,2800,0,'approved','16-10-2024 03:23',NULL,'2024-10-16 02:23:03','2024-10-16 02:23:03'),(7,36,NULL,'daily_income','Daily Income Added',35,0,35,'approved','2024-10-16 03:32:01',NULL,'2024-10-16 02:32:01','2024-10-16 02:32:01'),(8,39,NULL,'daily_income','Daily Income Added',4.5,0,4.5,'approved','2024-10-16 03:32:01',NULL,'2024-10-16 02:32:01','2024-10-16 02:32:01'),(9,39,NULL,'withdraw_request','withdraw request status is pending',4,3.8,0,'pending','16-10-2024 03:45',NULL,'2024-10-16 02:45:16','2024-10-16 02:45:16'),(10,39,NULL,'withdraw_approved','Your withdraw already approved. thanks for withdraw in our Hello Coder',4,3.8,0,'approved','16-10-2024 03:46',NULL,'2024-10-16 02:46:11','2024-10-16 02:46:11'),(11,40,NULL,'payment_approved','Your payment already approved. thanks for invest in our Hello Coder',33000,33000,0,'approved','16-10-2024 03:49',NULL,'2024-10-16 02:49:03','2024-10-16 02:49:03'),(12,39,40,'commission','First Level Commission Received',45,45,0,'approved','16-10-2024 03:49','first','2024-10-16 02:49:40','2024-10-16 02:49:40'),(13,39,NULL,'withdraw_request','withdraw request status is pending',4,3.8,0,'pending','17-10-2024 02:05',NULL,'2024-10-17 01:05:05','2024-10-17 01:05:05'),(14,44,NULL,'payment_approved','Your payment already approved. thanks for invest in our Nexus Core',5000,5000,0,'approved','17-10-2024 03:17',NULL,'2024-10-17 07:17:24','2024-10-17 07:17:24'),(15,43,NULL,'payment_approved','Your payment already approved. thanks for invest in our Nexus Core',50000,50000,0,'approved','17-10-2024 03:19',NULL,'2024-10-17 07:19:26','2024-10-17 07:19:26'),(16,44,NULL,'daily_income','Daily Income Added',100,0,100,'approved','2024-10-17 03:25:52',NULL,'2024-10-17 07:25:52','2024-10-17 07:25:52'),(17,44,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-17 03:25:52',NULL,'2024-10-17 07:25:52','2024-10-17 07:25:52'),(18,43,NULL,'daily_income','Daily Income Added',100,0,100,'approved','2024-10-17 03:25:52',NULL,'2024-10-17 07:25:52','2024-10-17 07:25:52'),(19,43,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-17 03:25:52',NULL,'2024-10-17 07:25:52','2024-10-17 07:25:52'),(20,45,NULL,'payment_approved','Your payment already approved. thanks for invest in our Nexus Core',1000,1000,0,'approved','17-10-2024 08:44',NULL,'2024-10-17 12:44:12','2024-10-17 12:44:12'),(21,44,45,'commission','First Level Commission Received',60,60,0,'approved','17-10-2024 08:44','first','2024-10-17 12:44:24','2024-10-17 12:44:24'),(22,46,NULL,'payment_approved','Your payment already approved. thanks for invest in our Nexus Core',1000,1000,0,'approved','17-10-2024 08:45',NULL,'2024-10-17 12:45:53','2024-10-17 12:45:53'),(23,45,46,'commission','First Level Commission Received',60,60,0,'approved','17-10-2024 08:46','first','2024-10-17 12:46:18','2024-10-17 12:46:18'),(24,44,46,'commission','Second Level Commission Received',30,30,0,'approved','17-10-2024 08:46','second','2024-10-17 12:46:18','2024-10-17 12:46:18'),(25,47,NULL,'payment_approved','Your payment already approved. thanks for invest in our Nexus Core',1000,1000,0,'approved','17-10-2024 08:47',NULL,'2024-10-17 12:47:59','2024-10-17 12:47:59'),(26,46,47,'commission','First Level Commission Received',60,60,0,'approved','17-10-2024 08:48','first','2024-10-17 12:48:08','2024-10-17 12:48:08'),(27,45,47,'commission','Second Level Commission Received',30,30,0,'approved','17-10-2024 08:48','second','2024-10-17 12:48:08','2024-10-17 12:48:08'),(28,44,47,'commission','Third Level Commission Received',10,10,0,'approved','17-10-2024 08:48','third','2024-10-17 12:48:08','2024-10-17 12:48:08'),(29,44,NULL,'withdraw_request','withdraw request status is pending',300,294,0,'pending','17-10-2024 10:32',NULL,'2024-10-17 14:32:14','2024-10-17 14:32:14'),(30,44,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-18 00:16:13',NULL,'2024-10-18 04:16:13','2024-10-18 04:16:13'),(31,43,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-18 00:16:13',NULL,'2024-10-18 04:16:13','2024-10-18 04:16:13'),(32,45,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-18 00:16:13',NULL,'2024-10-18 04:16:13','2024-10-18 04:16:13'),(33,46,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-18 00:16:13',NULL,'2024-10-18 04:16:13','2024-10-18 04:16:13'),(34,47,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-18 00:16:13',NULL,'2024-10-18 04:16:13','2024-10-18 04:16:13'),(35,44,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-19 16:56:41',NULL,'2024-10-19 20:56:41','2024-10-19 20:56:41'),(36,43,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-19 16:56:41',NULL,'2024-10-19 20:56:41','2024-10-19 20:56:41'),(37,45,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-19 16:56:41',NULL,'2024-10-19 20:56:41','2024-10-19 20:56:41'),(38,46,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-19 16:56:41',NULL,'2024-10-19 20:56:41','2024-10-19 20:56:41'),(39,47,NULL,'daily_income','Daily Income Added',250,0,250,'approved','2024-10-19 16:56:41',NULL,'2024-10-19 20:56:41','2024-10-19 20:56:41'),(40,54,NULL,'payment_approved','Your payment already approved. thanks for invest in our Hello Coder',55066,55066,0,'approved','20-10-2024 02:13',NULL,'2024-10-20 01:13:02','2024-10-20 01:13:02'),(41,55,NULL,'payment_approved','Your payment already approved. thanks for invest in our Hello Coder',5500,5500,0,'approved','20-10-2024 08:08',NULL,'2024-10-20 07:08:47','2024-10-20 07:08:47'),(42,54,NULL,'daily_income','Daily Income Added',35,0,35,'approved','2024-10-20 08:10:21',NULL,'2024-10-20 07:10:21','2024-10-20 07:10:21'),(43,54,NULL,'daily_income','Daily Income Added',35,0,35,'approved','2024-10-20 08:10:21',NULL,'2024-10-20 07:10:21','2024-10-20 07:10:21'),(44,54,NULL,'daily_income','Daily Income Added',70,0,70,'approved','2024-10-20 08:10:21',NULL,'2024-10-20 07:10:21','2024-10-20 07:10:21'),(45,54,NULL,'daily_income','Daily Income Added',70,0,70,'approved','2024-10-20 08:10:21',NULL,'2024-10-20 07:10:21','2024-10-20 07:10:21'),(46,55,NULL,'daily_income','Daily Income Added',35,0,35,'approved','2024-10-20 08:10:21',NULL,'2024-10-20 07:10:21','2024-10-20 07:10:21'),(47,54,NULL,'daily_income','Daily Income Added',1666.67,0,1666.67,'approved','2024-12-28 17:33:50',NULL,'2024-12-28 22:33:50','2024-12-28 22:33:50'),(48,54,NULL,'withdraw_request','withdraw request status is pending',300,294,0,'pending','28-12-2024 19:03',NULL,'2024-12-29 00:03:37','2024-12-29 00:03:37'),(49,65,NULL,'payment_approved','Your payment already approved. thanks for invest in our Tuffnells Pro',300,300,0,'approved','03-01-2025 22:07',NULL,'2025-01-04 03:07:40','2025-01-04 03:07:40'),(50,65,NULL,'payment_approved','Your payment already approved. thanks for invest in our Tuffnells Pro',500,500,0,'approved','03-01-2025 22:09',NULL,'2025-01-04 03:09:18','2025-01-04 03:09:18'),(51,96,NULL,'payment_approved','Your payment already approved. thanks for invest in our Kt dev',100000,100000,0,'approved','04-08-2025 00:16',NULL,'2025-08-03 16:16:16','2025-08-03 16:16:16'),(52,65,NULL,'daily_income','Daily Income Added',500,0,500,'approved','2025-08-04 02:18:27',NULL,'2025-08-03 18:18:28','2025-08-03 18:18:28'),(53,96,NULL,'daily_income','Daily Income Added',500,0,500,'approved','2025-08-04 02:18:28',NULL,'2025-08-03 18:18:28','2025-08-03 18:18:28');
/*!40000 ALTER TABLE `user_ledgers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `realname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_tab` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` double(20,2) NOT NULL DEFAULT '0.00',
  `deposit_balance` double(20,2) NOT NULL DEFAULT '0.00',
  `receive_able_amount` double(20,2) NOT NULL DEFAULT '0.00',
  `checkin` double(20,2) NOT NULL DEFAULT '0.00',
  `reword_balance` double(20,2) NOT NULL DEFAULT '0.00',
  `invest_cumulative_balance_received` double(20,2) NOT NULL DEFAULT '0.00',
  `invest_cumulative_balance` double(20,2) NOT NULL DEFAULT '0.00',
  `interest_cumulative_balance_received` double(20,2) NOT NULL DEFAULT '0.00',
  `interest_cumulative_balance` double(20,2) NOT NULL DEFAULT '0.00',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `ban_unban` enum('ban','unban') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unban',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (65,'4405121502','921uu6552h','',NULL,'+880','22222222222','103.126.151.44','uname22222222222','vip','user773191735461835@gmail.com',NULL,'$2y$10$sflEIYj1BV6XGdpAsp9xM.c12d8weZpJqAD.wiSju3zEq0bop/JUa',NULL,50000.00,300.00,500.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-29 19:43:55','2025-08-03 18:18:27'),(66,'93692288','885jt968uf','',NULL,'+880','01999673637','103.141.175.41','uname01999673637',NULL,'user743471735463753@gmail.com',NULL,'$2y$10$17YnUipZjdaOafArjX/jQu7yKBa8CEditEtrfSxxw1NRi2m7B0oSi',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-29 20:15:53','2024-12-29 20:15:53'),(67,'301141695','2877fv8303','',NULL,'+880','648716944','41.13.254.224','uname648716944',NULL,'user692491735464302@gmail.com',NULL,'$2y$10$y9lfppEQLre4xpzv0iUAaOMti7lqqnLZX8n/Nej.aR10xIl4T5Sm2',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-29 20:25:02','2024-12-29 20:25:02'),(68,'8864119633','fp7139k879','',NULL,'+880','81382303159','114.79.3.26','uname81382303159',NULL,'user446691735465490@gmail.com',NULL,'$2y$10$zMCw0fnbA5J7IX2fwqCwaewyvcDdD6kCnqeUiShwP6Ak/vs34IZU6',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-29 20:44:50','2024-12-29 20:44:50'),(69,'820745867','bg179n6106','',NULL,'+880','1234567890','102.135.174.107','uname1234567890',NULL,'user741131735465711@gmail.com',NULL,'$2y$10$JtRvNYO16s0sXfFRVjBanu3LJMyxnatGwv7vXJG3Zf/8upeV4ur2S',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-29 20:48:31','2024-12-29 20:48:31'),(70,'400068482','ey1714e365','',NULL,'+880','01300000000','2400:c600:3387:77df:90d7:c7ff:feff:de3d','uname01300000000',NULL,'user662841735465920@gmail.com',NULL,'$2y$10$blJOi/DZ4tFq3P6untZ32.3nzeO3lqt63RNz0gFCvzNuWjmAtvxDS',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-29 20:52:00','2024-12-29 20:52:00'),(71,'85812415','747cmxe916','',NULL,'+880','88888888','182.2.53.248','uname88888888',NULL,'user504271735467453@gmail.com',NULL,'$2y$10$CgLd4FzUF9OmpmlyRXwHoOZ68mt4m4dKBku6c9UP7iv.trRnvP3Uq',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-29 21:17:33','2024-12-29 21:17:33'),(72,'4076116557','105j7197sn','',NULL,'+880','9015501668','105.112.176.172','uname9015501668',NULL,'user830121735469916@gmail.com',NULL,'$2y$10$CQj0HQppxaI/2phcTfhx2eXsKjL53ETaikorgQwYegkPfqzrwAYEy',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-29 21:58:37','2024-12-29 21:58:37'),(73,'6127121004','770tnrt166','',NULL,'+880','9123123985','175.176.29.255','uname9123123985',NULL,'user841001735474258@gmail.com',NULL,'$2y$10$H7RRFLz3SpaP9K6lw2aN4OMSIYmzlxhuE2HVRGZj3twOyXW2m6Y3S',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-29 23:10:58','2024-12-29 23:10:58'),(74,'945569113','215ok6k712','',NULL,'+880','12345678','103.178.191.66','uname12345678',NULL,'user935091735483632@gmail.com',NULL,'$2y$10$JdVahKWIVq1pT2479MI4qOnBY3kd62xYtTzubD3ml4PlYeh.buR9u',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-30 01:47:12','2024-12-30 01:47:12'),(75,'775428721','235yi882jo','',NULL,'+880','582307187','2a00:5400:f020:f809:d8f6:9dff:fe94:975e','uname582307187',NULL,'user734091735489511@gmail.com',NULL,'$2y$10$essvF0cF1CSh9n1TJOUAVeoFdaXyooJuh/DMzuSg7smYubSX4/tA2',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-30 03:25:11','2024-12-30 03:25:11'),(76,'6308108955','9166k8224u','',NULL,'+880','0323203232','2c0f:2a80:12a8:8510:7449:3708:d219:8ebc','uname0323203232',NULL,'user391811735499848@gmail.com',NULL,'$2y$10$dra1Up7wev8BfdmWZn8QC.YbwAGu/31xNkciYy0EF..bJtGHyYxE.',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-30 06:17:28','2024-12-30 06:17:28'),(77,'576815537','lk533nt198','',NULL,'+880','89529186710','114.10.28.238','uname89529186710',NULL,'user469171735504516@gmail.com',NULL,'$2y$10$pR9FhUtqEbRWcBJoQxRQNeePISKkm63LnWWONgTVAQwrU666E6rz2',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-30 07:35:16','2024-12-30 07:35:16'),(78,'674163136','cy665il5','',NULL,'+880','7979797979','119.252.195.224','uname7979797979',NULL,'user858931735513698@gmail.com',NULL,'$2y$10$hkVFUgcBfBM5DV9X5gquSenXjcOuuoR0uL6elKcoqRJ8A.qUAsNGK',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-30 10:08:18','2024-12-30 10:08:18'),(79,'8886666','633vw4022q','',NULL,'+880','87476396174','37.99.18.85','uname87476396174',NULL,'user389831735592321@gmail.com',NULL,'$2y$10$ef/8AZR1twoA3tVtm62gzOd57JIzQ8wDJxthbIMeRLP.D8s3h8dga',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-31 07:58:41','2024-12-31 07:58:41'),(80,'914383062','558lb7218j','',NULL,'+880','7476396174','37.99.26.153','uname7476396174',NULL,'user669181735601386@gmail.com',NULL,'$2y$10$BwF4cGtzRFj9O3OhUzIUSuKKSJf9VeAc/fIN7UbUMYbaC/gkaVG7u',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-31 10:29:46','2024-12-31 10:29:46'),(81,'910163715','200pxk1997','',NULL,'+880','01721206118','103.160.16.145','uname01721206118',NULL,'user246841735628128@gmail.com',NULL,'$2y$10$/GIWgP6hRFzh8wO2TH1P8u.cHW1uFW8CPAPzycHh7/OvLnuNEooAm',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-31 17:55:28','2024-12-31 17:55:28'),(82,'904760869','hx6954899g','',NULL,'+880','0546222045','154.161.112.47','uname0546222045',NULL,'user373361735643119@gmail.com',NULL,'$2y$10$RGGZeH.lJOeJENWSmO8zPueH0d6Gn2WYddT7guGVJk6p1W6ZuKOoi',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-31 22:05:19','2024-12-31 22:05:19'),(83,'964636296','50dr222br','',NULL,'+880','0535751148','154.161.191.147','uname0535751148',NULL,'user886251735643834@gmail.com',NULL,'$2y$10$mUB7ShIAp0pXxd3OECQVKOnYqMkPDga6oCMrka0MKqcHeVeNXCMzu',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-31 22:17:14','2024-12-31 22:17:14'),(84,'290278661','866v4ur150','',NULL,'+880','0599859466','154.160.11.167','uname0599859466',NULL,'user812651735644596@gmail.com',NULL,'$2y$10$MLyuZvhWPN77t3Vvic6ZHeV1NXkmALvEP6RWm1heh/jDr.Whoj7I6',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2024-12-31 22:29:56','2024-12-31 22:29:56'),(85,'685948821','py422132fb','magod',NULL,'+880','01882442453','27.147.200.128','uname01882442453',NULL,'user511011735663161@gmail.com',NULL,'$2y$10$g6ELKsKhWgn0jAlgOhLOZO3NGjs.2pRwTUUXbni9u.V1ITRZkkWNu',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,'Choose now','019413900833',NULL,'active','unban','2025-01-01 03:39:21','2025-01-01 03:43:59'),(86,'489514249','6095uwu540','',NULL,'+880','542389322','154.161.144.4','uname542389322',NULL,'user837161735669113@gmail.com',NULL,'$2y$10$uq1FVBpRqFfi.z49s7pU5OCcO260Yp4pTjXtfHZO0YORVLTWN6kJm',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-01 05:18:34','2025-01-01 05:18:34'),(87,'386713689','yn132925k3','',NULL,'+880','206541067','154.161.156.27','uname206541067',NULL,'user430371735669162@gmail.com',NULL,'$2y$10$O6//SOsuAK/lnzTpQ3TEPu0D82TyrzIlyc75HrPF0jJHouUWXpgnO',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-01 05:19:22','2025-01-01 05:19:22'),(88,'86141443','9s150484je','',NULL,'+880','085646718415','120.188.78.182','uname085646718415',NULL,'user424241735703499@gmail.com',NULL,'$2y$10$JeV2.iFV0eU97vKeAhuKm.eCesLB2hqxqaqpU.ki1mXzCQqlOqjEi',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-01 14:51:39','2025-01-01 14:51:39'),(89,'385114237','243zj849hw','',NULL,'+880','0245712023','154.161.120.190','uname0245712023',NULL,'user717061735716086@gmail.com',NULL,'$2y$10$cr61JhaJl4wP5KM7bTKpxu75gP9U4GBL/VSKThPshumycX874jzja',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-01 18:21:26','2025-01-01 18:21:26'),(90,'707661595','ib750192rr','',NULL,'+880','7476395235','37.99.97.57','uname7476395235',NULL,'user333561735724232@gmail.com',NULL,'$2y$10$p4kPKf3tjtu458nfK0qqP.gudXVgp4pDbjF5avAS6VrEr49vYTWuS',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-01 20:37:12','2025-01-01 20:37:12'),(91,'925962334','jy767w8820','',NULL,'+880','1647147298','122.152.50.94','uname1647147298',NULL,'user962521735753705@gmail.com',NULL,'$2y$10$ALP0M1bScSkL/RSQCTZOuObLo9tmq320GFksw0b6nnTJiMQ3xcFY.',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-02 04:48:25','2025-01-02 04:48:25'),(92,'693520461','wi200963qq','',NULL,'+880','51367801','102.158.95.82','uname51367801',NULL,'user157221735816729@gmail.com',NULL,'$2y$10$a6O6eIi4Ez1IXWHnMv17yeLfL59hgotxBlU4od368E5PSCXsvhK8K',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-02 22:18:50','2025-01-02 22:18:50'),(93,'933143516','172qize333','',NULL,'+880','811111111','36.74.52.106','uname811111111',NULL,'user732831735832381@gmail.com',NULL,'$2y$10$7twATmXBeUkQuOqRKC7mJey424fewa8nZAHIyxekyrgID09G3knZK',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-03 02:39:41','2025-01-03 02:39:41'),(94,'79511627','114v4155p8','',NULL,'+880','07503784822','185.136.148.249','uname07503784822',NULL,'user754941735844069@gmail.com',NULL,'$2y$10$cUOx.boDUBPqYc.rbABF7.sEfJlqfQn4Oj1uLgTpMkmDBWqOCW252',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-03 05:54:29','2025-01-03 05:54:29'),(95,'223492358','512lx1406z','',NULL,'+880','21990229212','200.189.28.2','uname21990229212',NULL,'user434141735914798@gmail.com',NULL,'$2y$10$hT4Qxgm7ayI7kdARhZVkQeoooP6rKQoqYv/8JybeGWN.bDvd1sz4e',NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-04 01:33:18','2025-01-04 01:33:18'),(96,'41119947','fq471605os','',NULL,'+880','5188888888','152.67.33.44','优选源码网 yxymk.com','vip','user690911735914960@gmail.com',NULL,'$2y$10$XHTcHRsA58kXrt5kuaW7POcFOhDUm0saeuvP/rNqKULaOFsVRyVim',NULL,0.00,99500.00,500.00,0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL,NULL,NULL,'active','unban','2025-01-04 01:36:00','2025-08-03 18:18:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vip_sliders`
--

DROP TABLE IF EXISTS `vip_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vip_sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `page_type` enum('home_page','vip_page') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home_page',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vip_sliders`
--

LOCK TABLES `vip_sliders` WRITE;
/*!40000 ALTER TABLE `vip_sliders` DISABLE KEYS */;
INSERT INTO `vip_sliders` VALUES (11,'/public/upload/slider/1688711605xsK.jpg','active','home_page','2023-07-05 01:06:16','2023-07-07 04:33:25'),(12,'/public/upload/slider/1688711639ObA.jpg','active','home_page','2023-07-05 01:06:35','2023-07-07 04:33:59');
/*!40000 ALTER TABLE `vip_sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdrawals`
--

DROP TABLE IF EXISTS `withdrawals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `withdrawals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `method_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(20,2) NOT NULL DEFAULT '0.00',
  `charge` decimal(20,2) NOT NULL DEFAULT '0.00',
  `trx` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `after_charge` decimal(20,2) NOT NULL DEFAULT '0.00',
  `withdraw_information` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending' COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdrawals`
--

LOCK TABLES `withdrawals` WRITE;
/*!40000 ALTER TABLE `withdrawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdrawals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'wukong_ceshi59'
--

--
-- Dumping routines for database 'wukong_ceshi59'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-04  5:29:40
