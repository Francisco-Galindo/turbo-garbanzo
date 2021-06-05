-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: asesorias_p6
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

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
-- Table structure for table `asesoria`
--

DROP TABLE IF EXISTS `asesoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asesoria` (
  `id_asesoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_materia` varchar(4) DEFAULT NULL,
  `tema` text NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `duracion_simple` tinyint(1) NOT NULL,
  `cupo` bit(1) NOT NULL,
  `medio_vir` tinyint(1) NOT NULL,
  `lugar` varchar(128) NOT NULL,
  PRIMARY KEY (`id_asesoria`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_materia` (`id_materia`),
  CONSTRAINT `asesoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `asesoria_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesoria`
--

LOCK TABLES `asesoria` WRITE;
/*!40000 ALTER TABLE `asesoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `asesoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asesoria_has_usuario`
--

DROP TABLE IF EXISTS `asesoria_has_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asesoria_has_usuario` (
  `id_ahu` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_asesoria` int(11) NOT NULL,
  PRIMARY KEY (`id_ahu`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_asesoria` (`id_asesoria`),
  CONSTRAINT `asesoria_has_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `asesoria_has_usuario_ibfk_2` FOREIGN KEY (`id_asesoria`) REFERENCES `asesoria` (`id_asesoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesoria_has_usuario`
--

LOCK TABLES `asesoria_has_usuario` WRITE;
/*!40000 ALTER TABLE `asesoria_has_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `asesoria_has_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dia`
--

DROP TABLE IF EXISTS `dia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dia` (
  `id_dia` tinyint(4) NOT NULL AUTO_INCREMENT,
  `dia` varchar(5) NOT NULL,
  PRIMARY KEY (`id_dia`),
  UNIQUE KEY `dia` (`dia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dia`
--

LOCK TABLES `dia` WRITE;
/*!40000 ALTER TABLE `dia` DISABLE KEYS */;
/*!40000 ALTER TABLE `dia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hora`
--

DROP TABLE IF EXISTS `hora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hora` (
  `id_hora` tinyint(4) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_hora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hora`
--

LOCK TABLES `hora` WRITE;
/*!40000 ALTER TABLE `hora` DISABLE KEYS */;
/*!40000 ALTER TABLE `hora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `id_materia` varchar(4) NOT NULL,
  `materia` varchar(32) NOT NULL,
  `colegio` int(11) DEFAULT NULL,
  `abrev` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `razon`
--

DROP TABLE IF EXISTS `razon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `razon` (
  `id_razon` tinyint(4) NOT NULL AUTO_INCREMENT,
  `razon` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_razon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `razon`
--

LOCK TABLES `razon` WRITE;
/*!40000 ALTER TABLE `razon` DISABLE KEYS */;
/*!40000 ALTER TABLE `razon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporte`
--

DROP TABLE IF EXISTS `reporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reporte` (
  `id_reporte` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_asesoria` int(11) NOT NULL,
  `id_razon` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_reporte`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_asesoria` (`id_asesoria`),
  KEY `id_razon` (`id_razon`),
  CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `reporte_ibfk_2` FOREIGN KEY (`id_asesoria`) REFERENCES `asesoria` (`id_asesoria`),
  CONSTRAINT `reporte_ibfk_3` FOREIGN KEY (`id_razon`) REFERENCES `razon` (`id_razon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte`
--

LOCK TABLES `reporte` WRITE;
/*!40000 ALTER TABLE `reporte` DISABLE KEYS */;
/*!40000 ALTER TABLE `reporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` bigint(20) NOT NULL,
  `contrasena` varchar(64) NOT NULL,
  `sal` varchar(16) NOT NULL,
  `telefono` varchar(64) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `prim_ape` varchar(32) NOT NULL,
  `seg_ape` varchar(32) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `num_faltas` bit(1) NOT NULL,
  `es_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_has_horario`
--

DROP TABLE IF EXISTS `usuario_has_horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_horario` (
  `id_uhh` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_hora` tinyint(4) NOT NULL,
  `id_dia` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_uhh`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_hora` (`id_hora`),
  KEY `id_dia` (`id_dia`),
  CONSTRAINT `usuario_has_horario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `usuario_has_horario_ibfk_2` FOREIGN KEY (`id_hora`) REFERENCES `hora` (`id_hora`),
  CONSTRAINT `usuario_has_horario_ibfk_3` FOREIGN KEY (`id_dia`) REFERENCES `dia` (`id_dia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_horario`
--

LOCK TABLES `usuario_has_horario` WRITE;
/*!40000 ALTER TABLE `usuario_has_horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_has_horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_has_valoracion`
--

DROP TABLE IF EXISTS `usuario_has_valoracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_valoracion` (
  `id_uhv` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_comentador` bigint(20) NOT NULL,
  `id_asesoria` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `calificacion` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_uhv`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_comentador` (`id_comentador`),
  KEY `id_asesoria` (`id_asesoria`),
  CONSTRAINT `usuario_has_valoracion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `usuario_has_valoracion_ibfk_2` FOREIGN KEY (`id_comentador`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `usuario_has_valoracion_ibfk_3` FOREIGN KEY (`id_asesoria`) REFERENCES `asesoria` (`id_asesoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_valoracion`
--

LOCK TABLES `usuario_has_valoracion` WRITE;
/*!40000 ALTER TABLE `usuario_has_valoracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_has_valoracion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-04 21:12:48
