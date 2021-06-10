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
  `id_usuario` varchar(64) NOT NULL,
  `id_materia` varchar(4) DEFAULT NULL,
  `tema` text NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `duracion_simple` tinyint(1) NOT NULL,
  `cupo` tinyint(4) NOT NULL,
  `medio_vir` tinyint(1) NOT NULL,
  `lugar` varchar(128) NOT NULL,
  `confirmada` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_asesoria`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_materia` (`id_materia`),
  CONSTRAINT `asesoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `asesoria_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
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
  `id_usuario` varchar(64) NOT NULL,
  `id_asesoria` int(11) NOT NULL,
  `es_solicitante` tinyint(1) NOT NULL DEFAULT 0,
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
  `dia` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_dia`),
  UNIQUE KEY `dia` (`dia`),
  UNIQUE KEY `dia_2` (`dia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dia`
--

LOCK TABLES `dia` WRITE;
/*!40000 ALTER TABLE `dia` DISABLE KEYS */;
INSERT INTO `dia` VALUES (4,'Jueves'),(1,'Lunes'),(2,'Martes'),(3,'Miércoles'),(5,'Viernes');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hora`
--

LOCK TABLES `hora` WRITE;
/*!40000 ALTER TABLE `hora` DISABLE KEYS */;
INSERT INTO `hora` VALUES (1,'07:50:00'),(2,'08:40:00'),(3,'09:30:00'),(4,'10:20:00'),(5,'11:10:00'),(6,'12:00:00'),(7,'12:50:00'),(8,'13:40:00'),(9,'14:30:00'),(10,'15:20:00'),(11,'16:10:00'),(12,'17:00:00'),(13,'17:50:00'),(14,'18:40:00'),(15,'19:30:00');
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
  `abreviacion` varchar(32) NOT NULL,
  `grado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES ('1400','MATEMATICAS IV','MATEM. IV',4),('1401','FISICA III','FIS. III',4),('1402','LENGUA ESPAÑOLA','L. ESPAÑ',4),('1403','HISTORIA UNIVERSAL III','H.UNI.III',4),('1404','LOGICA','LOGICA',4),('1405','GEOGRAFIA','GEOGRAFIA',4),('1406','DIBUJO II','DIBUJO II',4),('1407','LENGUA EXTRAN. INGLES IV','L.E.I. IV',4),('1408','LENGUA EXTRAN. FRANCES IV','L.E.F. IV',4),('1409','ED. ESTETICA-ARTISTICA IV','E.E.A. IV',4),('1410','EDUCACION FISICA IV','E.F. IV',4),('1411','ORIENTACION EDUCATIVA IV','O.EDU. IV',4),('1412','INFORMATICA','INFORMAT.',4),('1500','MATEMATICAS V','MATEM. V',5),('1501','QUIMICA III','QUIM. III',5),('1502','BIOLOGIA IV','BIOL. IV',5),('1503','EDUCACION PARA LA SALUD','E. SALUD',5),('1504','HISTORIA DE MEXICO II','H. MEXICO',5),('1505','ETIMOLOGIAS GRECOLATINAS','E. GREC.',5),('1506','L. EXTRANJERA INGLES V','L.E.I. V',5),('1507','L. EXTRANJERA FRANCES V','L.E.F. V',5),('1508','L. EXTRANJERA ITALIANO I','L.E.IT. I',5),('1509','L. EXTRANJERA ALEMAN I','L.E.A. I',5),('1510','L. EXTRANJERA INGLES I','L.E.I. I',5),('1511','L. EXTRANJERA FRANCES I','L.E.F. I',5),('1512','ETICA','ETICA',5),('1513','EDUCACION FISICA V','E.F. V',5),('1514','ED. ESTETICA-ARTISTICA V','E.E.A. V',5),('1515','ORIENTACION EDUCATIVA V','O.ED. V',5),('1516','LITERATURA UNIVERSAL','LIT. UNI.',5),('1600','MATEMATICAS VI AREA I Y II','MATEM. VI',6),('1601','DERECHO','DERECHO',6),('1602','LITERATURA MEX. E IB.','LIT. MEX.',6),('1603','INGLES VI','INGLES VI',6),('1604','FRANCES VI','FRANC. VI',6),('1605','ALEMAN II','ALEMAN II',6),('1606','ITALIANO II','ITAL. II',6),('1607','INGLES II','INGLES II',6),('1608','FRANCES II','FRANC. II',6),('1609','PSICOLOGIA','PSIC.',6),('1610','DIBUJO CONSTRUCTIVO II','D. C. II',6),('1611','FISICA IV AREA I','FISICA IV',6),('1612','QUIMICA IV AREA I','QUIM. IV',6),('1613','BIOLOGIA V','BIOL. V',6),('1614','GEOGRAFIA ECONOMICA','GEOG. ECO',6),('1615','INT. AL EST. C. S. Y ECO.','INT. EST.',6),('1616','PROBS. SOC. Y POL. Y ECO.','PROB. SOC',6),('1617','HISTORIA DE LA CULTURA','H. CULT.',6),('1618','HISTORIA DE LAS DOC. FIL.','H DOC FIL',6),('1619','MATEMATICAS VI AREA III','MATE VI',6),('1620','MATEMATICAS VI AREA IV','MATE VI',6),('1621','FISICA IV AREA II','FISICA IV',6),('1622','QUIMICA IV AREA II','QUIM. IV',6),('1700','HIGIENE MENTAL','HIG. MENT',6),('1703','REVOLUCION MEXICANA','REV. MEX.',6),('1704','CONT. Y GEST. ADMINISTRAT','CONT GEST',6),('1705','PENS. FILOSOFICO EN MEXIC','PENS FIL.',6),('1706','GEOLOGIA Y MINEROLOGIA','GEOLOGIA',6),('1707','GEOGRAFIA POLITICA','GEOG POL.',6),('1708','MODELADO II','MODEL II',6),('1709','FISICO-QUIMICA','FIS-QUIM.',6),('1710','TEMAS SELECTOS DE MATEM.','T S MATE.',6),('1711','TEMAS SELECTOS DE BIOLOG.','T S BIOL.',6),('1712','ESTADISTICA Y PROBABILID.','EST. PROB',6),('1713','LATIN','LATIN',6),('1714','GRIEGO','GRIEGO',6),('1715','COMUNICACION VISUAL','COM. VIS.',6),('1716','TEMAS SEL. MORFOL. Y FIS.','T S MORFO',6),('1717','ESTETICA','ESTETICA',6),('1718','HISTORIA DEL ARTE','H. ARTE',6),('1719','INFORMAT. APLI. C. E IND.','INF. APLI',6),('1720','SOCIOLOGIA','SOCIOLOG.',6),('1723','ASTRONOMIA','ASTRONOM.',6),('2101','O. T. COMPUTACION V','O.T.COMP1',5),('2122','O.T. CONTABILIDAD','O.T.CONTA',5),('2201','O. T. COMPUTACION VI','O.T.COMP2',5),('2225','O. T. ENSEÑANZA DE INGLES','O.T. ING',5),('2226','O.T. HISTOPATOLOGÍA','O.T. HIST',6),('E101','FOTOGRAFÍA','FOTO',4),('E102','PINTURA','PINTURA',4),('E103','ESCULTURA','ESCULTURA',4),('E104','GRABADO','GRABADO',4),('E105','CERÁMICA','CERÁMICA',4),('E106','DANZA CLÁSICA','D. CLÁSI',4),('E107','DANZA CONTEMPORÁNEA','D. CONTEM',4),('E108','DANZA ESPAÑOLA','D. ESPAÑ',4),('E109','DANZA REGIONAL','D. REGNAL',4),('E110','BANDA','BANDA',4),('E111','CORO','CORO',4),('E112','CLARINETE','CLARINETE',4),('E113','FLAUTA','FLAUTA',4),('E114','GUITARRA','GUITARRA',4),('E115','ESTUDIANTINA','ESTUDTINA',4),('E116','PIANO','PIANO',4),('E117','SAXOFÓN','SAXOFÓN',4),('E118','TROMPETA','TROMPETA',4),('E119','ORATORIA','ORATORIA',4),('E120','TEATRO','TEATRO',4),('E121','CINE','CINE',4);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `notificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacion` (
  `id_notificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(64) NOT NULL,
  `id_asesoria` int(11) NOT NULL,
  `id_tipo_notificacion` tinyint(4) NOT NULL,
  `visto` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_notificacion`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_asesoria` (`id_asesoria`),
  KEY `id_tipo_notificacion` (`id_tipo_notificacion`),
  CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `notificacion_ibfk_2` FOREIGN KEY (`id_asesoria`) REFERENCES `asesoria` (`id_asesoria`),
  CONSTRAINT `notificacion_ibfk_3` FOREIGN KEY (`id_tipo_notificacion`) REFERENCES `tipo_notificacion` (`id_tipo_notificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacion`
--

LOCK TABLES `notificacion` WRITE;
/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacion` ENABLE KEYS */;
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
  `id_usuario` varchar(64) NOT NULL,
  `id_asesoria` int(11) NOT NULL,
  PRIMARY KEY (`id_reporte`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_asesoria` (`id_asesoria`),
  CONSTRAINT `reporte_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `reporte_ibfk_2` FOREIGN KEY (`id_asesoria`) REFERENCES `asesoria` (`id_asesoria`)
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
-- Table structure for table `reporte_has_razon`
--

DROP TABLE IF EXISTS `reporte_has_razon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reporte_has_razon` (
  `id_rhr` int(11) NOT NULL AUTO_INCREMENT,
  `id_reporte` int(11) NOT NULL,
  `id_razon` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_rhr`),
  KEY `id_reporte` (`id_reporte`),
  KEY `id_razon` (`id_razon`),
  CONSTRAINT `reporte_has_razon_ibfk_1` FOREIGN KEY (`id_reporte`) REFERENCES `reporte` (`id_reporte`),
  CONSTRAINT `reporte_has_razon_ibfk_2` FOREIGN KEY (`id_razon`) REFERENCES `razon` (`id_razon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte_has_razon`
--

LOCK TABLES `reporte_has_razon` WRITE;
/*!40000 ALTER TABLE `reporte_has_razon` DISABLE KEYS */;
/*!40000 ALTER TABLE `reporte_has_razon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suspension`
--

DROP TABLE IF EXISTS `suspension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suspension` (
  `id_suspension` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(64) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_suspension`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `suspension_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suspension`
--

LOCK TABLES `suspension` WRITE;
/*!40000 ALTER TABLE `suspension` DISABLE KEYS */;
/*!40000 ALTER TABLE `suspension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_notificacion`
--

DROP TABLE IF EXISTS `tipo_notificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_notificacion` (
  `id_tipo_notificacion` tinyint(4) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(32) NOT NULL,
  PRIMARY KEY (`id_tipo_notificacion`),
  UNIQUE KEY `titulo` (`titulo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_notificacion`
--

LOCK TABLES `tipo_notificacion` WRITE;
/*!40000 ALTER TABLE `tipo_notificacion` DISABLE KEYS */;
INSERT INTO `tipo_notificacion` VALUES (7,'aviso_final'),(6,'aviso_inicio'),(8,'aviso_strike'),(4,'confirmar_asesoria'),(3,'pasar_asistencia'),(5,'recibir_confirmacion'),(2,'reportar'),(1,'valorar');
/*!40000 ALTER TABLE `tipo_notificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` varchar(64) NOT NULL,
  `contrasena` varchar(64) NOT NULL,
  `sal` varchar(23) NOT NULL,
  `num_cuenta` varchar(56) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `grado` enum('4','5','6') NOT NULL,
  `telefono` varchar(56) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `prim_ape` varchar(32) NOT NULL,
  `seg_ape` varchar(32) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `foto` text NOT NULL DEFAULT '../statics/perfiles/perfil.png',
  `num_faltas` tinyint(4) NOT NULL DEFAULT 0,
  `es_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `num_cuenta` (`num_cuenta`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `num_cuenta_2` (`num_cuenta`),
  UNIQUE KEY `telefono` (`telefono`),
  UNIQUE KEY `num_cuenta_3` (`num_cuenta`),
  UNIQUE KEY `telefono_2` (`telefono`),
  UNIQUE KEY `telefono_3` (`telefono`),
  UNIQUE KEY `num_cuenta_4` (`num_cuenta`),
  UNIQUE KEY `telefono_4` (`telefono`),
  UNIQUE KEY `num_cuenta_5` (`num_cuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('563ba8540f8e0ce61a6b3646a12db42ca55d8ccd69e3beaf11e26b0927e1e037','621fdf739618b97238de819ad88de880c92701d858a7faacb1f2eb6312ed1337','60c04f9a193299.19802246','a2dUaThjSkpXaVlUandtZzdXZVYvdz09Ojp75oK/G5tjsYcfhER82BCg','carlitos@alf.com','5','d1owZk9kdjQwbEg0eFNIdm9Scm1TQT09Ojr5JDiohkqtZOWbLI/94dbT','Papu','Gomez','Lel','2003-01-06','../statics/perfiles/perfil.png',0,0),('9ecea6b0b95158e3336fb8701242281706ec48692be23a8c2eb523798eaddf07','fa6dd9264d10d5517569e095b8f260282f6362471fefdfcdbd863bdf356b3626','60be67e7486561.88225675','YzJqV1BCclZvbGRWa1o1QlBjbmpEQT09OjpOgdQgcloKeHhKFRarV+cT','paqui10718@gmail.com','6','M2ZnR0p6OThhQnI5MnA1V0JnT0RXdz09OjrtI1ieVBNHnEps0fZDUiul','Francisco','Galindo','Mena','2004-09-01','../../statics/perfiles/foto-perfil.jpg',0,0);
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
  `id_usuario` varchar(64) NOT NULL,
  `id_hora` tinyint(4) NOT NULL,
  `id_dia` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_uhh`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_hora` (`id_hora`),
  KEY `id_dia` (`id_dia`),
  CONSTRAINT `usuario_has_horario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `usuario_has_horario_ibfk_2` FOREIGN KEY (`id_hora`) REFERENCES `hora` (`id_hora`),
  CONSTRAINT `usuario_has_horario_ibfk_3` FOREIGN KEY (`id_dia`) REFERENCES `dia` (`id_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_horario`
--

LOCK TABLES `usuario_has_horario` WRITE;
/*!40000 ALTER TABLE `usuario_has_horario` DISABLE KEYS */;
INSERT INTO `usuario_has_horario` VALUES (16,'9ecea6b0b95158e3336fb8701242281706ec48692be23a8c2eb523798eaddf07',2,1),(17,'9ecea6b0b95158e3336fb8701242281706ec48692be23a8c2eb523798eaddf07',1,3),(18,'9ecea6b0b95158e3336fb8701242281706ec48692be23a8c2eb523798eaddf07',3,3);
/*!40000 ALTER TABLE `usuario_has_horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_has_materia`
--

DROP TABLE IF EXISTS `usuario_has_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_has_materia` (
  `id_uhm` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(64) NOT NULL,
  `id_materia` varchar(4) NOT NULL,
  PRIMARY KEY (`id_uhm`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_materia` (`id_materia`),
  CONSTRAINT `usuario_has_materia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `usuario_has_materia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_materia`
--

LOCK TABLES `usuario_has_materia` WRITE;
/*!40000 ALTER TABLE `usuario_has_materia` DISABLE KEYS */;
INSERT INTO `usuario_has_materia` VALUES (15,'9ecea6b0b95158e3336fb8701242281706ec48692be23a8c2eb523798eaddf07','1400'),(16,'9ecea6b0b95158e3336fb8701242281706ec48692be23a8c2eb523798eaddf07','1412');
/*!40000 ALTER TABLE `usuario_has_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valoracion`
--

DROP TABLE IF EXISTS `valoracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valoracion` (
  `id_uhv` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(64) NOT NULL,
  `id_comentador` varchar(64) NOT NULL,
  `id_asesoria` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `calificacion` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_uhv`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_comentador` (`id_comentador`),
  KEY `id_asesoria` (`id_asesoria`),
  CONSTRAINT `valoracion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `valoracion_ibfk_2` FOREIGN KEY (`id_comentador`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `valoracion_ibfk_3` FOREIGN KEY (`id_asesoria`) REFERENCES `asesoria` (`id_asesoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valoracion`
--

LOCK TABLES `valoracion` WRITE;
/*!40000 ALTER TABLE `valoracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `valoracion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-09 22:32:59
