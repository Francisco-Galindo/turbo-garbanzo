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
  `id_usuario` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesoria`
--

LOCK TABLES `asesoria` WRITE;
/*!40000 ALTER TABLE `asesoria` DISABLE KEYS */;
INSERT INTO `asesoria` VALUES (15,320054336,'1400','Hola','2021-07-11 00:30:00',1,3,1,'XD',1);
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
  `id_usuario` int(11) NOT NULL,
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
  `id_usuario` int(11) NOT NULL,
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
  `id_usuario` int(11) NOT NULL,
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
  `id_usuario` int(11) NOT NULL,
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
  `id_usuario` int(11) NOT NULL,
  `contrasena` varchar(64) NOT NULL,
  `sal` varchar(23) NOT NULL,
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
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `telefono` (`telefono`),
  UNIQUE KEY `telefono_2` (`telefono`),
  UNIQUE KEY `telefono_3` (`telefono`),
  UNIQUE KEY `telefono_4` (`telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (320000001,'d07fc2722e5f9c64d823a109487e5d23c485a2a430cbcdd46bd6936d163b2fa3','60c2e12de283a0.35612206','sergio.dam@gmail.com','6','RVp4WEZiL0VmTkI3L0U4QWs5dmx6dz09OjqY0UIAu94Ldw6S2J3F6wgO','Sergio','Navarro','Juárez','2004-09-02','../statics/perfiles/perfil.png',0,1),(320000002,'76a0ec6e9ce2b5ae9d7fa809ec01742ade91798cb1ab4c1efea8aee2dc3f5819','60c2e5ae4f6380.94595083','vic.hola@gmail.com','6','SnpER0ZnSEhKaGZiOXkyZXI0RmUyZz09OjoCja/g0ZzmVIUx5NXOlCpX','Víctor','Fernández','Martínez','2004-06-15','../statics/perfiles/perfil.png',0,0),(320000003,'ad1ac4352da74710a51d61b1df1fb142c65cf73167a1e108a8f898e2d35b6511','60c2e6e2cc0f18.70122847','jaz_ram@hotmail.com','4','M0plekozZmtwWGZmcVFyZ1QvRi8xQT09Ojr+EwMjdLCqSPkju7VmSF6Q','Karla','Ramírez','Domínguez','2004-06-01','../statics/perfiles/perfil.png',0,0),(320000004,'4a45f96ddf6dbe746f3942c4e290e361bf318288951663864d7bab79cf044c2d','60c2ecbabee2f1.05267285','radon@gmail.com','6','bW42cDhUZjNoZ2xUUVlpbGo1bk4yUT09OjqHIcNMjFNjHxpox6E9e5dY','Carlos','García','García','2003-06-09','../statics/perfiles/perfil.png',0,0),(320000005,'7a68d32ad6af514479f5cb54c704ee1636d506b14236582a074ed44a0855953f','60c2ed089f1dc8.23545095','juanito@comunidad.unam.mx','5','QUtRMDVpeFgxcGVORlp1OEdqTlI2dz09OjqEZXB+QEdJXzFNC36zZFfT','Juan','Pérez','Pérez','2005-05-10','../statics/perfiles/perfil.png',0,0),(320000006,'141bcb2730421688caaa10ae67706864717ec298b785ce69f0491e716440ffcd','60c2ed90ecec55.47356810','peter_mar@outlook.com','4','Z3lRL1NGWElMRFJhRFg1cWRyMUt5dz09Ojq3jXDI+eRHajZG4kpOML15','Pedro','Martínez','Martínez','2006-06-05','../statics/perfiles/perfil.png',0,0),(320000007,'24cdf340769b19e00b99a7aa6bc77c8ce05ac4368b65eadd18961debb4a2c90c','60c2ee13d89c05.20274973','eri_san@gmail.com','5','aUJIOXJPcXE1QVJ4Q0dxMjMrTEdpZz09OjqmS84Z/bwupgS8a7/UMql2','Erick','Nava','Nava','2004-05-03','../statics/perfiles/perfil.png',0,0),(320000008,'838d54139ccb106a34fc6a8c998e771e45384c033f8d75bcc625e02f70be89bd','60c2ee98230d38.93439845','rolo_perez@hotmail.com','5','WjNyTE9yazN1RzRDMk9ONW50KzVEUT09OjrDxKqL3gs1bNZQ2HRBarbe','Rodrigo','López','López','2004-05-11','../statics/perfiles/perfil.png',0,0),(320000009,'929dec814e276d056bc85af6a24e8cdfb155acf32c02a8eacee29ba3d5a2b282','60c2eefa5e7e71.95803197','leo_mart@gmail.com','6','YmQ1c3Y3TU1GL09QblU4NmpoU2VVdz09Ojrkq1MTJL3BsXFZuGLYfhwL','Leonardo','Martínez','Martínez','2004-09-14','../statics/perfiles/perfil.png',0,0),(320054336,'fc377ef73234191b4f1ccb97b40a3b934ea4bdbd9b01f0081cea17abbfec469d','60c230c449fb54.34214459','paqui10718@gmail.com','4','NlJFV3RmZi84U3dtczMrcWdkcjdMQT09OjoUZIWTj1tgQO3wDEL0IWcH','Francisco','Galindo','Mena','2004-09-01','../../statics/img/perfiles/320054336.png',0,0);
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
  `id_usuario` int(11) NOT NULL,
  `id_hora` tinyint(4) NOT NULL,
  `id_dia` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_uhh`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_hora` (`id_hora`),
  KEY `id_dia` (`id_dia`),
  CONSTRAINT `usuario_has_horario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `usuario_has_horario_ibfk_2` FOREIGN KEY (`id_hora`) REFERENCES `hora` (`id_hora`),
  CONSTRAINT `usuario_has_horario_ibfk_3` FOREIGN KEY (`id_dia`) REFERENCES `dia` (`id_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_horario`
--

LOCK TABLES `usuario_has_horario` WRITE;
/*!40000 ALTER TABLE `usuario_has_horario` DISABLE KEYS */;
INSERT INTO `usuario_has_horario` VALUES (57,320054336,1,1),(58,320054336,2,1),(59,320000001,14,5),(60,320000001,15,5),(63,320000003,1,1),(64,320000003,7,3),(65,320000004,1,1),(66,320000004,13,2),(67,320000005,1,2),(68,320000005,2,2),(69,320000006,9,1),(70,320000006,10,1),(71,320000007,14,1),(72,320000007,15,1),(73,320000008,3,1),(74,320000008,7,1),(75,320000009,1,1),(76,320000009,6,3);
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
  `id_usuario` int(11) NOT NULL,
  `id_materia` varchar(4) NOT NULL,
  PRIMARY KEY (`id_uhm`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_materia` (`id_materia`),
  CONSTRAINT `usuario_has_materia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `usuario_has_materia_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_has_materia`
--

LOCK TABLES `usuario_has_materia` WRITE;
/*!40000 ALTER TABLE `usuario_has_materia` DISABLE KEYS */;
INSERT INTO `usuario_has_materia` VALUES (30,320054336,'1400'),(31,320054336,'1401'),(32,320000001,'1412'),(33,320000001,'1502'),(34,320000003,'1400'),(35,320000003,'1401'),(36,320000004,'1400'),(37,320000004,'1401'),(38,320000005,'1400'),(39,320000005,'1401'),(40,320000006,'1401'),(41,320000006,'1406'),(42,320000007,'1400'),(43,320000007,'1401'),(44,320000008,'1400'),(45,320000008,'1401'),(46,320000009,'1502'),(47,320000009,'1505');
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
  `id_usuario` int(11) NOT NULL,
  `id_comentador` int(11) NOT NULL,
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

-- Dump completed on 2021-06-11  0:12:17
