-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: ReseauxSocio
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.24.04.2

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
-- Table structure for table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idPublication` int DEFAULT NULL,
  `idCompte` int DEFAULT NULL,
  `contenue` text NOT NULL,
  `nbrJaimeC` int DEFAULT '0',
  `nbrNonJaimeC` int DEFAULT '0',
  `nbrHahahaC` int DEFAULT '0',
  `nbrJadoreC` int DEFAULT '0',
  `dateHeureCom` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idPublication` (`idPublication`),
  KEY `idCompte` (`idCompte`),
  CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`idPublication`) REFERENCES `publications` (`id`),
  CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`idCompte`) REFERENCES `compte` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaires`
--

LOCK TABLES `commentaires` WRITE;
/*!40000 ALTER TABLE `commentaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `commentaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compte`
--

DROP TABLE IF EXISTS `compte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenoms` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compte`
--

LOCK TABLES `compte` WRITE;
/*!40000 ALTER TABLE `compte` DISABLE KEYS */;
INSERT INTO `compte` VALUES (1,'freddy','nomena','akama@gmail.com','$2y$10$jPM3OZkJ6xjG.aSJljziV.mjXM5U4Y66rv0971pwJou3lurYGeN9e'),(2,'freddy','freddy','fre@gmail.com','$2y$10$NTPmn7nV.YK4k9qEh.7J7eSCBkYOEIRwHLdAFZ.G2GmSBI5vCqgUe'),(3,'MAHERY NOMENA','freddy','123@123.123','$2y$10$cOuN3PWxRYwhc71fNIuIsOouu/TA8eJ7B20usuRStpeN6stvhqQNS');
/*!40000 ALTER TABLE `compte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCompte` int DEFAULT NULL,
  `contenue` text NOT NULL,
  `nbrJaimeP` int DEFAULT '0',
  `nbrNonJaimeP` int DEFAULT '0',
  `nbrHahahaP` int DEFAULT '0',
  `nbrJadoreP` int DEFAULT '0',
  `dateHeurePub` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idCompte` (`idCompte`),
  CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`idCompte`) REFERENCES `compte` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (69,1,'kozy',1,0,0,0,'2024-10-02 19:40:14'),(72,1,'sdsw',0,0,1,0,'2024-10-02 20:05:19'),(73,1,'fdghjkl',0,0,0,0,'2024-10-02 20:29:14'),(74,1,'asdfghjk',0,0,0,0,'2024-10-02 21:13:37'),(75,3,'sfsd',0,0,0,0,'2024-10-02 21:37:23'),(76,1,'asdfghj',0,0,0,0,'2024-10-02 22:39:56');
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reactionCommentaire`
--

DROP TABLE IF EXISTS `reactionCommentaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reactionCommentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCommentaire` int DEFAULT NULL,
  `idPublication` int DEFAULT NULL,
  `idCompte` int DEFAULT NULL,
  `Reaction` enum('aime','nonAime','hahaha','adore') NOT NULL,
  `dateHeureCommentaire` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idCompte` (`idCompte`,`idPublication`,`idCommentaire`),
  KEY `idCommentaire` (`idCommentaire`),
  KEY `idPublication` (`idPublication`),
  CONSTRAINT `reactionCommentaire_ibfk_1` FOREIGN KEY (`idCommentaire`) REFERENCES `commentaires` (`id`),
  CONSTRAINT `reactionCommentaire_ibfk_2` FOREIGN KEY (`idPublication`) REFERENCES `publications` (`id`),
  CONSTRAINT `reactionCommentaire_ibfk_3` FOREIGN KEY (`idCompte`) REFERENCES `compte` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reactionCommentaire`
--

LOCK TABLES `reactionCommentaire` WRITE;
/*!40000 ALTER TABLE `reactionCommentaire` DISABLE KEYS */;
/*!40000 ALTER TABLE `reactionCommentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reactionPublications`
--

DROP TABLE IF EXISTS `reactionPublications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reactionPublications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCompte` int DEFAULT NULL,
  `idPublication` int DEFAULT NULL,
  `Reaction` enum('aime','nonAime','hahaha','adore') NOT NULL,
  `dateHeureReaction` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idCompte` (`idCompte`,`idPublication`),
  KEY `idPublication` (`idPublication`),
  CONSTRAINT `reactionPublications_ibfk_1` FOREIGN KEY (`idCompte`) REFERENCES `compte` (`id`),
  CONSTRAINT `reactionPublications_ibfk_2` FOREIGN KEY (`idPublication`) REFERENCES `publications` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reactionPublications`
--

LOCK TABLES `reactionPublications` WRITE;
/*!40000 ALTER TABLE `reactionPublications` DISABLE KEYS */;
INSERT INTO `reactionPublications` VALUES (1,1,69,'aime','2024-10-02 20:30:50'),(47,3,75,'adore','2024-10-02 21:37:29'),(49,3,72,'aime','2024-10-02 21:37:41'),(54,3,69,'aime','2024-10-02 21:38:20'),(58,3,74,'adore','2024-10-02 21:38:27'),(59,1,75,'nonAime','2024-10-02 22:35:47'),(60,1,74,'aime','2024-10-02 22:35:49'),(62,1,72,'hahaha','2024-10-02 22:35:54'),(63,1,73,'nonAime','2024-10-02 22:35:56'),(65,1,76,'aime','2024-10-03 00:46:24');
/*!40000 ALTER TABLE `reactionPublications` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-03  3:51:25
