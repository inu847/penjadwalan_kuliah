-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: penjadwalan_kuliah
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `tb_dosen`
--

DROP TABLE IF EXISTS `tb_dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_dosen` (
  `kode_dosen` int NOT NULL AUTO_INCREMENT,
  `nidn` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_dosen` text COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_dosen`
--

LOCK TABLES `tb_dosen` WRITE;
/*!40000 ALTER TABLE `tb_dosen` DISABLE KEYS */;
INSERT INTO `tb_dosen` VALUES (17,'0724098501','Sri Lestanti, S.Kom., M.T',NULL,NULL),(18,'0807067301','Indyah Hartami Santi, M.Kom',NULL,NULL),(19,'0706028602','Filda Febrinita, M.Pd',NULL,NULL),(20,'0710028805','Saiful Nur Budiman, S.Kom., M.Kom',NULL,NULL),(21,'0000000001','Mohammad Faried Rahmat, S.S.T., M.Tr.T',NULL,NULL),(22,'0000000002','Udkhiati Mawadah, S.Kom., M.Kom',NULL,NULL),(23,'0703079004','Sabitul Kirom, M.Pd',NULL,NULL),(24,'0723038903','Wahyu Dwi Puspitasari, M.Pd',NULL,NULL),(25,'0708068601','Zunita Wulansari, M.T',NULL,NULL),(26,'0710058506','Abdi Pandu Kusuma, S.Kom., M.T',NULL,NULL),(27,'0728078602','Haris Yuana, M.T',NULL,NULL),(28,'0708088802','Yusniarsi Primasari, M.Pd',NULL,NULL),(29,'0000000003','Rizki Dwi Romadhona, S.S.T., M.Tr.T',NULL,NULL),(30,'0731088601','M. Taofik Chulkamdi, S.Kom.,MT',NULL,NULL);
/*!40000 ALTER TABLE `tb_dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_hari`
--

DROP TABLE IF EXISTS `tb_hari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_hari` (
  `kode_hari` int NOT NULL AUTO_INCREMENT,
  `nama_hari` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`kode_hari`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_hari`
--

LOCK TABLES `tb_hari` WRITE;
/*!40000 ALTER TABLE `tb_hari` DISABLE KEYS */;
INSERT INTO `tb_hari` VALUES (4,'Senin'),(5,'Selasa'),(6,'Rabu');
/*!40000 ALTER TABLE `tb_hari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jam`
--

DROP TABLE IF EXISTS `tb_jam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_jam` (
  `kode_jam` int NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_jam`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jam`
--

LOCK TABLES `tb_jam` WRITE;
/*!40000 ALTER TABLE `tb_jam` DISABLE KEYS */;
INSERT INTO `tb_jam` VALUES (4,'12:22:00','16:22:00','2023-07-04 01:12:09','2023-07-04 01:09:17');
/*!40000 ALTER TABLE `tb_jam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kelas`
--

DROP TABLE IF EXISTS `tb_kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_kelas` (
  `kode_kelas` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` text COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_mahasiswa` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kelas`
--

LOCK TABLES `tb_kelas` WRITE;
/*!40000 ALTER TABLE `tb_kelas` DISABLE KEYS */;
INSERT INTO `tb_kelas` VALUES (8,'2A',28,NULL,NULL),(9,'2B',27,NULL,NULL),(10,'4A',30,NULL,NULL),(11,'4B',28,NULL,NULL),(12,'6A',26,NULL,NULL),(13,'6B',26,NULL,NULL),(14,'8A',24,NULL,NULL),(15,'8B',20,NULL,NULL),(17,'100',123123123,'2023-07-04 00:46:46','2023-07-04 00:46:46');
/*!40000 ALTER TABLE `tb_kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_matkul`
--

DROP TABLE IF EXISTS `tb_matkul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_matkul` (
  `kode_matkul` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_matkul` text COLLATE utf8mb4_general_ci NOT NULL,
  `sks` int NOT NULL,
  `semester` int NOT NULL,
  `jenis` text COLLATE utf8mb4_general_ci NOT NULL,
  `kurikulum` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_matkul`
--

LOCK TABLES `tb_matkul` WRITE;
/*!40000 ALTER TABLE `tb_matkul` DISABLE KEYS */;
INSERT INTO `tb_matkul` VALUES ('PKKU1101',6,'Bahasa Indonesia',2,1,'Teori',2017,NULL,NULL);
/*!40000 ALTER TABLE `tb_matkul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pengampu`
--

DROP TABLE IF EXISTS `tb_pengampu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_pengampu` (
  `kode_pengampu` int NOT NULL AUTO_INCREMENT,
  `tahun_akademik` text COLLATE utf8mb4_general_ci NOT NULL,
  `matkul_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dosen_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelas_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_pengampu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pengampu`
--

LOCK TABLES `tb_pengampu` WRITE;
/*!40000 ALTER TABLE `tb_pengampu` DISABLE KEYS */;
INSERT INTO `tb_pengampu` VALUES (4,'2022 - 2023','6','17','10','2023-07-04 01:02:27',NULL);
/*!40000 ALTER TABLE `tb_pengampu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_penjadwalan`
--

DROP TABLE IF EXISTS `tb_penjadwalan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_penjadwalan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_time` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `matkul_id` int NOT NULL,
  `kelas_id` int NOT NULL,
  `end_time` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dosen_id` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `ruang_id` int NOT NULL,
  `day` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_penjadwalan`
--

LOCK TABLES `tb_penjadwalan` WRITE;
/*!40000 ALTER TABLE `tb_penjadwalan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_penjadwalan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_ruang`
--

DROP TABLE IF EXISTS `tb_ruang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_ruang` (
  `kode_ruang` int NOT NULL AUTO_INCREMENT,
  `nama_ruang` text COLLATE utf8mb4_general_ci NOT NULL,
  `kapasitas` int NOT NULL,
  `jenis` text COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_ruang`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ruang`
--

LOCK TABLES `tb_ruang` WRITE;
/*!40000 ALTER TABLE `tb_ruang` DISABLE KEYS */;
INSERT INTO `tb_ruang` VALUES (3,'A2006',30,'Teori',NULL,NULL),(4,'A2007',30,'Teori',NULL,NULL),(7,'A2008',30,'Teori',NULL,NULL),(8,'Lab Komputer',30,'Praktikum',NULL,NULL);
/*!40000 ALTER TABLE `tb_ruang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_waktukhusus`
--

DROP TABLE IF EXISTS `tb_waktukhusus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_waktukhusus` (
  `kode_waktukhusus` int NOT NULL AUTO_INCREMENT,
  `day` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` text COLLATE utf8mb4_general_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_waktukhusus`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_waktukhusus`
--

LOCK TABLES `tb_waktukhusus` WRITE;
/*!40000 ALTER TABLE `tb_waktukhusus` DISABLE KEYS */;
INSERT INTO `tb_waktukhusus` VALUES (2,'Rabu','1','05:55:00','22:22:00','2023-07-04 01:31:10','2023-07-04 01:31:10'),(3,'Senin','8','07:00:00','08:00:00','2023-07-04 01:39:10','2023-07-04 01:39:10');
/*!40000 ALTER TABLE `tb_waktukhusus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@gmail.com',NULL,'$2y$10$YKTcJliuji6e/HRx34cTbO3axLW5gCpT8cLx6NUkOwH4Krx2hwV0.',NULL,'2023-07-03 23:56:37','2023-07-03 23:56:37','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'penjadwalan_kuliah'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-04 15:59:41
