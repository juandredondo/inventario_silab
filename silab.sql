CREATE DATABASE  IF NOT EXISTS `silab_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `silab_db`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: silab_db
-- ------------------------------------------------------
-- Server version	5.6.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `TBL_ACCESORIOS`
--

DROP TABLE IF EXISTS `TBL_ACCESORIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_ACCESORIOS` (
  `ACCE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ACCE_SERIAL` varchar(45) NOT NULL,
  `ACCE_MODELO` varchar(45) DEFAULT NULL,
  `ITNC_ID` int(11) NOT NULL,
  PRIMARY KEY (`ACCE_ID`),
  KEY `fk_accesorios_itemCualitativo_id_idx` (`ITNC_ID`),
  CONSTRAINT `fk_accesorios_itemCualitativo_id` FOREIGN KEY (`ITNC_ID`) REFERENCES `tbl_itemsnoconsumibles` (`ITNC_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_ACCESORIOS`
--

LOCK TABLES `TBL_ACCESORIOS` WRITE;
/*!40000 ALTER TABLE `TBL_ACCESORIOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_ACCESORIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_AUDITORIALOG`
--

DROP TABLE IF EXISTS `TBL_AUDITORIALOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_AUDITORIALOG` (
  `AULOG_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AULOG_TABLENAME` varchar(100) DEFAULT NULL,
  `AULOG_FECHA` timestamp NULL DEFAULT NULL,
  `USUA_ID` int(11) DEFAULT NULL,
  `LOTI_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`AULOG_ID`),
  KEY `FK_AUDITORIALOG_USUA_ID_idx` (`USUA_ID`),
  KEY `FK_AUDITORIALOG_LOTI_ID_idx` (`LOTI_ID`),
  CONSTRAINT `FK_AUDITORIALOG_USUA_ID` FOREIGN KEY (`USUA_ID`) REFERENCES `tbl_usuarios` (`USUA_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_AUDITORIALOG_LOTI_ID` FOREIGN KEY (`LOTI_ID`) REFERENCES `tbl_logtipo` (`LOTI_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_AUDITORIALOG`
--

LOCK TABLES `TBL_AUDITORIALOG` WRITE;
/*!40000 ALTER TABLE `TBL_AUDITORIALOG` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_AUDITORIALOG` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_CADUCIDADES`
--

DROP TABLE IF EXISTS `TBL_CADUCIDADES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_CADUCIDADES` (
  `CADU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CADU_NOMBRE` varchar(45) NOT NULL,
  `CADU_MIN` int(11) NOT NULL DEFAULT '0',
  `CADU_MAX` int(11) DEFAULT '0',
  PRIMARY KEY (`CADU_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_CADUCIDADES`
--

LOCK TABLES `TBL_CADUCIDADES` WRITE;
/*!40000 ALTER TABLE `TBL_CADUCIDADES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_CADUCIDADES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_COORDINADORES`
--

DROP TABLE IF EXISTS `TBL_COORDINADORES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_COORDINADORES` (
  `COOR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PERS_ID` int(11) NOT NULL,
  PRIMARY KEY (`COOR_ID`),
  KEY `fk_coordinadores_persona_id_idx` (`PERS_ID`),
  CONSTRAINT `fk_coordinadores_persona_id` FOREIGN KEY (`PERS_ID`) REFERENCES `tbl_personas` (`PERS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_COORDINADORES`
--

LOCK TABLES `TBL_COORDINADORES` WRITE;
/*!40000 ALTER TABLE `TBL_COORDINADORES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_COORDINADORES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_DETALLEPEDIDOS`
--

DROP TABLE IF EXISTS `TBL_DETALLEPEDIDOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_DETALLEPEDIDOS` (
  `DEPE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DEPE_CANTIDAD` double DEFAULT NULL,
  `PEDI_ID` int(11) NOT NULL,
  `ITEM_ID` int(11) NOT NULL,
  PRIMARY KEY (`DEPE_ID`),
  KEY `FK_DETALLEPEDIDO_ITEM_ID_idx` (`ITEM_ID`),
  KEY `FK_DETALLEPEDIDOS_PEDI_ID_idx` (`PEDI_ID`),
  CONSTRAINT `FK_DETALLEPEDIDOS_PEDI_ID` FOREIGN KEY (`PEDI_ID`) REFERENCES `tbl_pedidos` (`PEDI_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_DETALLEPEDIDO_ITEM_ID` FOREIGN KEY (`ITEM_ID`) REFERENCES `tbl_items` (`ITEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_DETALLEPEDIDOS`
--

LOCK TABLES `TBL_DETALLEPEDIDOS` WRITE;
/*!40000 ALTER TABLE `TBL_DETALLEPEDIDOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_DETALLEPEDIDOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_EDIFICIOS`
--

DROP TABLE IF EXISTS `TBL_EDIFICIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_EDIFICIOS` (
  `EDIF_ID` int(11) NOT NULL AUTO_INCREMENT,
  `EDIF_NOMBRE` varchar(100) NOT NULL,
  `EDIF_CODIGO` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`EDIF_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_EDIFICIOS`
--

LOCK TABLES `TBL_EDIFICIOS` WRITE;
/*!40000 ALTER TABLE `TBL_EDIFICIOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_EDIFICIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_EQUIPOS`
--

DROP TABLE IF EXISTS `TBL_EQUIPOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_EQUIPOS` (
  `EQUI_ID` int(11) NOT NULL AUTO_INCREMENT,
  `EQUI_SERIAL` varchar(100) NOT NULL,
  `ITNC_ID` int(11) NOT NULL,
  PRIMARY KEY (`EQUI_ID`),
  KEY `fk_equipos_itemCualitativo_id_idx` (`ITNC_ID`),
  CONSTRAINT `fk_equipos_itemCualitativo_id` FOREIGN KEY (`ITNC_ID`) REFERENCES `tbl_itemsnoconsumibles` (`ITNC_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_EQUIPOS`
--

LOCK TABLES `TBL_EQUIPOS` WRITE;
/*!40000 ALTER TABLE `TBL_EQUIPOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_EQUIPOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_ESTADOSCONSUMIBLE`
--

DROP TABLE IF EXISTS `TBL_ESTADOSCONSUMIBLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_ESTADOSCONSUMIBLE` (
  `ESCO_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ESCO_NOMBRE` varchar(45) NOT NULL,
  `ESCO_MIN` int(11) NOT NULL DEFAULT '0',
  `ESCO_MAX` int(11) DEFAULT '0',
  PRIMARY KEY (`ESCO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_ESTADOSCONSUMIBLE`
--

LOCK TABLES `TBL_ESTADOSCONSUMIBLE` WRITE;
/*!40000 ALTER TABLE `TBL_ESTADOSCONSUMIBLE` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_ESTADOSCONSUMIBLE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_ESTADOSNOCONSUMIBLE`
--

DROP TABLE IF EXISTS `TBL_ESTADOSNOCONSUMIBLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_ESTADOSNOCONSUMIBLE` (
  `ESNC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ESNC_NOMBRE` varchar(100) NOT NULL,
  `ESNC_CODIGO` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ESNC_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_ESTADOSNOCONSUMIBLE`
--

LOCK TABLES `TBL_ESTADOSNOCONSUMIBLE` WRITE;
/*!40000 ALTER TABLE `TBL_ESTADOSNOCONSUMIBLE` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_ESTADOSNOCONSUMIBLE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_FACTURAS`
--

DROP TABLE IF EXISTS `TBL_FACTURAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_FACTURAS` (
  `FACT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FACT_CODIGO` varchar(100) NOT NULL,
  `FACT_FECHA` datetime DEFAULT NULL,
  `FACT_IMAGEPATH` text,
  `PROV_ID` int(11) NOT NULL,
  `PEDI_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`FACT_ID`),
  KEY `fk_facturas_provedor_id_idx` (`PROV_ID`),
  KEY `FK_FACTURAS_PEDI_ID_idx` (`PEDI_ID`),
  CONSTRAINT `fk_facturas_provedor_id` FOREIGN KEY (`PROV_ID`) REFERENCES `tbl_provedores` (`PROV_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_FACTURAS_PEDI_ID` FOREIGN KEY (`PEDI_ID`) REFERENCES `tbl_pedidos` (`PEDI_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_FACTURAS`
--

LOCK TABLES `TBL_FACTURAS` WRITE;
/*!40000 ALTER TABLE `TBL_FACTURAS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_FACTURAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_FLUJOS`
--

DROP TABLE IF EXISTS `TBL_FLUJOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_FLUJOS` (
  `FLUJ_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FLUJ_CANTIDAD` double NOT NULL,
  `MOVI_ID` int(11) DEFAULT NULL,
  `STOC_ID` int(11) NOT NULL,
  `TIFU_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`FLUJ_ID`),
  KEY `FK_FLUJOS_STOC_ID_idx` (`STOC_ID`),
  KEY `FK_FLUJOS_TIFU_ID_idx` (`TIFU_ID`),
  KEY `FK_FLUJOS_PEDI_ID_idx` (`MOVI_ID`),
  CONSTRAINT `FK_FLUJOS_PEDI_ID` FOREIGN KEY (`MOVI_ID`) REFERENCES `tbl_movimientos` (`MOVI_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_FLUJOS_STOC_ID` FOREIGN KEY (`STOC_ID`) REFERENCES `tbl_stock` (`STOC_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_FLUJOS_TIFU_ID` FOREIGN KEY (`TIFU_ID`) REFERENCES `tbl_tipoflujo` (`TIFL_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_FLUJOS`
--

LOCK TABLES `TBL_FLUJOS` WRITE;
/*!40000 ALTER TABLE `TBL_FLUJOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_FLUJOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_FUNCIONALABORATORIO`
--

DROP TABLE IF EXISTS `TBL_FUNCIONALABORATORIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_FUNCIONALABORATORIO` (
  `FULA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FUNC_ID` int(11) DEFAULT NULL,
  `LABO_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`FULA_ID`),
  KEY `FK_FUNCIONALABORATORIO_FUNC_ID_idx` (`FUNC_ID`),
  KEY `FK_FUNCIONALABORATORIO_LABO__ID_idx` (`LABO_ID`),
  CONSTRAINT `FK_FUNCIONALABORATORIO_FUNC_ID` FOREIGN KEY (`FUNC_ID`) REFERENCES `tbl_funcionarios` (`FUNC_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_FUNCIONALABORATORIO_LABO__ID` FOREIGN KEY (`LABO_ID`) REFERENCES `tbl_laboratorios` (`LABO_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_FUNCIONALABORATORIO`
--

LOCK TABLES `TBL_FUNCIONALABORATORIO` WRITE;
/*!40000 ALTER TABLE `TBL_FUNCIONALABORATORIO` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_FUNCIONALABORATORIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_FUNCIONARIOS`
--

DROP TABLE IF EXISTS `TBL_FUNCIONARIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_FUNCIONARIOS` (
  `FUNC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PERS_ID` int(11) NOT NULL,
  PRIMARY KEY (`FUNC_ID`),
  KEY `fk_funcionarios_persona_id_idx` (`PERS_ID`),
  CONSTRAINT `fk_funcionarios_persona_id` FOREIGN KEY (`PERS_ID`) REFERENCES `tbl_personas` (`PERS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_FUNCIONARIOS`
--

LOCK TABLES `TBL_FUNCIONARIOS` WRITE;
/*!40000 ALTER TABLE `TBL_FUNCIONARIOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_FUNCIONARIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_GENEROS`
--

DROP TABLE IF EXISTS `TBL_GENEROS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_GENEROS` (
  `GENE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `GENE_NOMBRE` varchar(45) NOT NULL,
  PRIMARY KEY (`GENE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_GENEROS`
--

LOCK TABLES `TBL_GENEROS` WRITE;
/*!40000 ALTER TABLE `TBL_GENEROS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_GENEROS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_HERRAMIENTAS`
--

DROP TABLE IF EXISTS `TBL_HERRAMIENTAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_HERRAMIENTAS` (
  `HERR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `HERR_CANTIDAD` int(11) NOT NULL,
  `ITNC_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`HERR_ID`),
  KEY `fk_herramienta_itemCualitativo_id_idx` (`ITNC_ID`),
  CONSTRAINT `fk_herramienta_itemCualitativo_id` FOREIGN KEY (`ITNC_ID`) REFERENCES `tbl_itemsnoconsumibles` (`ITNC_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_HERRAMIENTAS`
--

LOCK TABLES `TBL_HERRAMIENTAS` WRITE;
/*!40000 ALTER TABLE `TBL_HERRAMIENTAS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_HERRAMIENTAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_INVENTARIOS`
--

DROP TABLE IF EXISTS `TBL_INVENTARIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_INVENTARIOS` (
  `INVE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABO_ID` int(11) NOT NULL,
  `INVE_CANTIDAD` float DEFAULT NULL,
  `PERI_ID` int(11) NOT NULL,
  PRIMARY KEY (`INVE_ID`),
  KEY `fk_inventarios_periodo_id_idx` (`PERI_ID`),
  KEY `fk_inventarios_laboratorio_id_idx` (`LABO_ID`),
  CONSTRAINT `fk_inventarios_periodo_id` FOREIGN KEY (`PERI_ID`) REFERENCES `tbl_periodos` (`PERI_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_inventarios_laboratorio_id` FOREIGN KEY (`LABO_ID`) REFERENCES `tbl_laboratorios` (`LABO_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_INVENTARIOS`
--

LOCK TABLES `TBL_INVENTARIOS` WRITE;
/*!40000 ALTER TABLE `TBL_INVENTARIOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_INVENTARIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_ITEMS`
--

DROP TABLE IF EXISTS `TBL_ITEMS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_ITEMS` (
  `ITEM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ITEM_NOMBRE` varchar(200) NOT NULL,
  `ITEM_OBSERVACION` text,
  `MARC_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ITEM_ID`),
  KEY `fk_items_marca_id_idx` (`MARC_ID`),
  CONSTRAINT `fk_items_marca_id` FOREIGN KEY (`MARC_ID`) REFERENCES `tbl_marcas` (`MARC_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_ITEMS`
--

LOCK TABLES `TBL_ITEMS` WRITE;
/*!40000 ALTER TABLE `TBL_ITEMS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_ITEMS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_ITEMSCONSUMIBLES`
--

DROP TABLE IF EXISTS `TBL_ITEMSCONSUMIBLES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_ITEMSCONSUMIBLES` (
  `ITCO_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Es un item, el cual, su estado es descrito de manera cualitatitva y no es relativa a un rango',
  `ITEM_ID` int(11) NOT NULL,
  `estadoConsumible_id` int(11) NOT NULL,
  PRIMARY KEY (`ITCO_ID`),
  KEY `fk_items_cualitativos_item_id_idx` (`ITEM_ID`),
  KEY `fk_items_cuantitativos_estadoCuantitativo_id_idx` (`estadoConsumible_id`),
  CONSTRAINT `fk_items_cuantitativos_item_id` FOREIGN KEY (`ITEM_ID`) REFERENCES `tbl_items` (`ITEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_items_cuantitativos_estadoCuantitativo_id` FOREIGN KEY (`estadoConsumible_id`) REFERENCES `tbl_estadosconsumible` (`ESCO_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_ITEMSCONSUMIBLES`
--

LOCK TABLES `TBL_ITEMSCONSUMIBLES` WRITE;
/*!40000 ALTER TABLE `TBL_ITEMSCONSUMIBLES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_ITEMSCONSUMIBLES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_ITEMSNOCONSUMIBLES`
--

DROP TABLE IF EXISTS `TBL_ITEMSNOCONSUMIBLES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_ITEMSNOCONSUMIBLES` (
  `ITNC_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Es un item, el cual, su estado es descrito de manera cualitatitva y no es relativa a un rango',
  `ITEM_ID` int(11) NOT NULL,
  `ESNC_ID` int(11) NOT NULL,
  `MODE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ITNC_ID`),
  KEY `fk_items_cualitativos_item_id_idx` (`ITEM_ID`),
  KEY `fk_items_cualitativos_estadoCualitativo_id_idx` (`ESNC_ID`),
  KEY `fk_items_cualitativos_modelo_id_idx` (`MODE_ID`),
  CONSTRAINT `fk_items_cualitativos_item_id` FOREIGN KEY (`ITEM_ID`) REFERENCES `tbl_items` (`ITEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_items_cualitativos_estadoCualitativo_id` FOREIGN KEY (`ESNC_ID`) REFERENCES `tbl_estadosnoconsumible` (`ESNC_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_items_cualitativos_modelo_id` FOREIGN KEY (`MODE_ID`) REFERENCES `tbl_modelo` (`MODE_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_ITEMSNOCONSUMIBLES`
--

LOCK TABLES `TBL_ITEMSNOCONSUMIBLES` WRITE;
/*!40000 ALTER TABLE `TBL_ITEMSNOCONSUMIBLES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_ITEMSNOCONSUMIBLES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_LABORATORIOS`
--

DROP TABLE IF EXISTS `TBL_LABORATORIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_LABORATORIOS` (
  `LABO_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABO_NOMBRE` varchar(100) NOT NULL,
  `LABO_NIVEL` int(11) DEFAULT NULL,
  `EDIF_ID` int(11) NOT NULL,
  `COOR_ID` int(11) NOT NULL,
  `TILA_ID` int(11) NOT NULL,
  PRIMARY KEY (`LABO_ID`),
  KEY `fk_laboratorios_coordinador_id_idx` (`COOR_ID`),
  KEY `fk_laboratorios_edificio_id_idx` (`EDIF_ID`),
  KEY `fk_LABoratorios_tila_id_idx` (`TILA_ID`),
  CONSTRAINT `fk_laboratorios_edificio_id` FOREIGN KEY (`EDIF_ID`) REFERENCES `tbl_edificios` (`EDIF_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_laboratorios_coordinador_id` FOREIGN KEY (`COOR_ID`) REFERENCES `tbl_coordinadores` (`COOR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_LABORATORIOS_TILA_ID` FOREIGN KEY (`TILA_ID`) REFERENCES `tbl_tipolaboratorios` (`TILA_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_LABORATORIOS`
--

LOCK TABLES `TBL_LABORATORIOS` WRITE;
/*!40000 ALTER TABLE `TBL_LABORATORIOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_LABORATORIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_LOGTIPO`
--

DROP TABLE IF EXISTS `TBL_LOGTIPO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_LOGTIPO` (
  `LOTI_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LOTI_DESCRIPCION` int(11) DEFAULT NULL,
  PRIMARY KEY (`LOTI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_LOGTIPO`
--

LOCK TABLES `TBL_LOGTIPO` WRITE;
/*!40000 ALTER TABLE `TBL_LOGTIPO` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_LOGTIPO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_MARCAS`
--

DROP TABLE IF EXISTS `TBL_MARCAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_MARCAS` (
  `MARC_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `MARC_NOMBRE` varchar(200) NOT NULL,
  PRIMARY KEY (`MARC_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_MARCAS`
--

LOCK TABLES `TBL_MARCAS` WRITE;
/*!40000 ALTER TABLE `TBL_MARCAS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_MARCAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_MATERIALES`
--

DROP TABLE IF EXISTS `TBL_MATERIALES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_MATERIALES` (
  `MATE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MATE_MEDIDA` varchar(45) DEFAULT NULL,
  `ITCO_ID` int(11) NOT NULL,
  PRIMARY KEY (`MATE_ID`),
  KEY `fk_materiales_itemCualitativo_id_idx` (`ITCO_ID`),
  CONSTRAINT `fk_materiales_itemCualitativo_id` FOREIGN KEY (`ITCO_ID`) REFERENCES `tbl_itemsconsumibles` (`ITCO_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_MATERIALES`
--

LOCK TABLES `TBL_MATERIALES` WRITE;
/*!40000 ALTER TABLE `TBL_MATERIALES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_MATERIALES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_MODELO`
--

DROP TABLE IF EXISTS `TBL_MODELO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_MODELO` (
  `MODE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MODE_CODIGO` varchar(200) NOT NULL,
  `MODE_EMPTY` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`MODE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_MODELO`
--

LOCK TABLES `TBL_MODELO` WRITE;
/*!40000 ALTER TABLE `TBL_MODELO` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_MODELO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_MOVIMIENTOS`
--

DROP TABLE IF EXISTS `TBL_MOVIMIENTOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_MOVIMIENTOS` (
  `MOVI_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MOVI_FECHA` datetime DEFAULT NULL,
  `MOVI_CODIGO` varchar(100) DEFAULT NULL,
  `TIMO_ID` int(11) DEFAULT NULL,
  `PERS_ID` int(11) DEFAULT NULL COMMENT 'Persona Solicitante',
  PRIMARY KEY (`MOVI_ID`),
  KEY `FK_MOVIMIENTOS_TIMO_ID_idx` (`TIMO_ID`),
  KEY `FK_MOVIMIENTOS_PERS_ID_idx` (`PERS_ID`),
  CONSTRAINT `FK_MOVIMIENTOS_TIMO_ID` FOREIGN KEY (`TIMO_ID`) REFERENCES `tbl_tipomovimientos` (`TIMO_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_MOVIMIENTOS_PERS_ID` FOREIGN KEY (`PERS_ID`) REFERENCES `tbl_personas` (`PERS_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_MOVIMIENTOS`
--

LOCK TABLES `TBL_MOVIMIENTOS` WRITE;
/*!40000 ALTER TABLE `TBL_MOVIMIENTOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_MOVIMIENTOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_PEDIDOS`
--

DROP TABLE IF EXISTS `TBL_PEDIDOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_PEDIDOS` (
  `PEDI_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PEDI_FECHA` datetime DEFAULT NULL,
  `PEDI_CODIGO` varchar(100) DEFAULT NULL,
  `MOVI_ID` int(11) NOT NULL,
  PRIMARY KEY (`PEDI_ID`),
  KEY `FK_PEDIDOS_MOVI_ID` (`MOVI_ID`),
  CONSTRAINT `FK_PEDIDOS_MOVI_ID` FOREIGN KEY (`MOVI_ID`) REFERENCES `tbl_movimientos` (`MOVI_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_PEDIDOS`
--

LOCK TABLES `TBL_PEDIDOS` WRITE;
/*!40000 ALTER TABLE `TBL_PEDIDOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_PEDIDOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_PERFILESROLES`
--

DROP TABLE IF EXISTS `TBL_PERFILESROLES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_PERFILESROLES` (
  `PERO_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ROL_ID` int(11) NOT NULL,
  `PERM_ID` int(11) NOT NULL,
  `PERO_PADRE` int(11) DEFAULT NULL,
  PRIMARY KEY (`PERO_ID`),
  UNIQUE KEY `UNIQUE_ROLES_PERMISOS` (`ROL_ID`,`PERM_ID`),
  KEY `FK_ROLES_ROL_ID_idx` (`ROL_ID`),
  KEY `FK_PERFILESROLES_PERM_ID_idx` (`PERM_ID`),
  KEY `FK_PERFILESROLES_PERO_PADRE_idx` (`PERO_PADRE`),
  CONSTRAINT `FK_PERFILROLES_ROL_ID` FOREIGN KEY (`ROL_ID`) REFERENCES `tbl_roles` (`ROL_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_PERFILESROLES_PERM_ID` FOREIGN KEY (`PERM_ID`) REFERENCES `tbl_permisos` (`PERM_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_PERFILESROLES_PERO_PADRE` FOREIGN KEY (`PERO_PADRE`) REFERENCES `tbl_perfilesroles` (`PERO_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_PERFILESROLES`
--

LOCK TABLES `TBL_PERFILESROLES` WRITE;
/*!40000 ALTER TABLE `TBL_PERFILESROLES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_PERFILESROLES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_PERIODOS`
--

DROP TABLE IF EXISTS `TBL_PERIODOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_PERIODOS` (
  `PERI_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PERI_SEMESTRE` int(11) NOT NULL,
  `PERI_FECHA` date DEFAULT NULL,
  PRIMARY KEY (`PERI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_PERIODOS`
--

LOCK TABLES `TBL_PERIODOS` WRITE;
/*!40000 ALTER TABLE `TBL_PERIODOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_PERIODOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_PERMISOS`
--

DROP TABLE IF EXISTS `TBL_PERMISOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_PERMISOS` (
  `PERM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PERM_ACCION` varchar(45) DEFAULT NULL,
  `PERM_CONTROLADOR` varchar(45) DEFAULT NULL,
  `PERM_MODULO` varchar(45) DEFAULT NULL,
  `PERM_PADRE` int(11) DEFAULT NULL,
  PRIMARY KEY (`PERM_ID`),
  KEY `FK_PERMISOS_PERM_PADRE_idx` (`PERM_PADRE`),
  CONSTRAINT `FK_PERMISOS_PERM_PADRE` FOREIGN KEY (`PERM_PADRE`) REFERENCES `tbl_permisos` (`PERM_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_PERMISOS`
--

LOCK TABLES `TBL_PERMISOS` WRITE;
/*!40000 ALTER TABLE `TBL_PERMISOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_PERMISOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_PERSONAS`
--

DROP TABLE IF EXISTS `TBL_PERSONAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_PERSONAS` (
  `PERS_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `PERS_NOMBRE` varchar(100) NOT NULL COMMENT 'Nombre',
  `PERS_IDENTIFICACION` bigint(20) NOT NULL COMMENT 'Documento de identidad',
  `GENE_ID` int(11) NOT NULL COMMENT 'Genero',
  `TIID_ID` int(11) NOT NULL COMMENT 'Tipo de documento',
  PRIMARY KEY (`PERS_ID`),
  KEY `fk_personas_tipoId_id_idx` (`TIID_ID`),
  KEY `fk_personas_genero_id_idx` (`GENE_ID`),
  CONSTRAINT `fk_personas_tipoId_id` FOREIGN KEY (`TIID_ID`) REFERENCES `tbl_tipoidentificaciones` (`TIID_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_personas_genero_id` FOREIGN KEY (`GENE_ID`) REFERENCES `tbl_generos` (`GENE_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_PERSONAS`
--

LOCK TABLES `TBL_PERSONAS` WRITE;
/*!40000 ALTER TABLE `TBL_PERSONAS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_PERSONAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_PROVEDORES`
--

DROP TABLE IF EXISTS `TBL_PROVEDORES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_PROVEDORES` (
  `PROV_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PROV_NOMBRE` varchar(100) NOT NULL,
  `PROV_NIT` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`PROV_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_PROVEDORES`
--

LOCK TABLES `TBL_PROVEDORES` WRITE;
/*!40000 ALTER TABLE `TBL_PROVEDORES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_PROVEDORES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_REACTIVOS`
--

DROP TABLE IF EXISTS `TBL_REACTIVOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_REACTIVOS` (
  `REAC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `REAC_CODIGO` varchar(100) NOT NULL,
  `REAC_UNIDAD` varchar(45) NOT NULL,
  `REAC_FECHA_VENCIMIENTO` date NOT NULL,
  `ITCO_ID` int(11) NOT NULL,
  `UBIC_ID` int(11) NOT NULL,
  `CADU_ID` int(11) NOT NULL,
  `SIMB_ID` int(11) NOT NULL,
  PRIMARY KEY (`REAC_ID`),
  KEY `fk_reactivos_caducidad_id_idx` (`CADU_ID`),
  KEY `fk_reactivos_ubicacion_id_idx` (`UBIC_ID`),
  KEY `fk_reactivos_simbolo_id_idx` (`SIMB_ID`),
  KEY `fk_reactivos_itemCuantitativo_id_idx` (`ITCO_ID`),
  CONSTRAINT `fk_reactivos_itemCuantitativo_id` FOREIGN KEY (`ITCO_ID`) REFERENCES `tbl_itemsconsumibles` (`ITCO_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_reactivos_caducidad_id` FOREIGN KEY (`CADU_ID`) REFERENCES `tbl_caducidades` (`CADU_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_reactivos_ubicacion_id` FOREIGN KEY (`UBIC_ID`) REFERENCES `tbl_ubicaciones` (`UBIC_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_reactivos_simbolo_id` FOREIGN KEY (`SIMB_ID`) REFERENCES `tbl_simbolos` (`SIMB_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_REACTIVOS`
--

LOCK TABLES `TBL_REACTIVOS` WRITE;
/*!40000 ALTER TABLE `TBL_REACTIVOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_REACTIVOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_ROLES`
--

DROP TABLE IF EXISTS `TBL_ROLES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_ROLES` (
  `ROL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ROL_NOMBRE` varchar(45) NOT NULL,
  `ROL_ORDEN` int(11) NOT NULL,
  PRIMARY KEY (`ROL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_ROLES`
--

LOCK TABLES `TBL_ROLES` WRITE;
/*!40000 ALTER TABLE `TBL_ROLES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_ROLES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_SIMBOLOS`
--

DROP TABLE IF EXISTS `TBL_SIMBOLOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_SIMBOLOS` (
  `SIMB_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SIMB_NOMBRE` varchar(100) NOT NULL,
  `SIMB_CODIGO` varchar(45) DEFAULT '',
  PRIMARY KEY (`SIMB_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_SIMBOLOS`
--

LOCK TABLES `TBL_SIMBOLOS` WRITE;
/*!40000 ALTER TABLE `TBL_SIMBOLOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_SIMBOLOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_STOCK`
--

DROP TABLE IF EXISTS `TBL_STOCK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_STOCK` (
  `STOC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ITEM_ID` int(11) NOT NULL,
  `INVE_ID` int(11) NOT NULL,
  `STOC_CANTIDAD` double DEFAULT NULL,
  PRIMARY KEY (`STOC_ID`),
  UNIQUE KEY `UNIQUE_ITEMSSTOCK_ITEM_INVE` (`INVE_ID`,`ITEM_ID`),
  KEY `FK_ITEMSSTOCK_ITEM_ID_idx` (`ITEM_ID`),
  KEY `FK_ITEMSSTOCK_INVE_ID_idx` (`INVE_ID`),
  CONSTRAINT `FK_ITEMSSTOCK_ITEM_ID` FOREIGN KEY (`ITEM_ID`) REFERENCES `tbl_items` (`ITEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ITEMSSTOCK_INVE_ID` FOREIGN KEY (`INVE_ID`) REFERENCES `tbl_inventarios` (`INVE_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_STOCK`
--

LOCK TABLES `TBL_STOCK` WRITE;
/*!40000 ALTER TABLE `TBL_STOCK` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_STOCK` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_TIPOFLUJO`
--

DROP TABLE IF EXISTS `TBL_TIPOFLUJO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_TIPOFLUJO` (
  `TIFL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIFL_NOMBRE` varchar(45) DEFAULT NULL,
  `TIFL_CONSTANTE` double DEFAULT NULL,
  PRIMARY KEY (`TIFL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_TIPOFLUJO`
--

LOCK TABLES `TBL_TIPOFLUJO` WRITE;
/*!40000 ALTER TABLE `TBL_TIPOFLUJO` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_TIPOFLUJO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_TIPOIDENTIFICACIONES`
--

DROP TABLE IF EXISTS `TBL_TIPOIDENTIFICACIONES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_TIPOIDENTIFICACIONES` (
  `TIID_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIID_NOMBRE` varchar(45) NOT NULL,
  PRIMARY KEY (`TIID_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_TIPOIDENTIFICACIONES`
--

LOCK TABLES `TBL_TIPOIDENTIFICACIONES` WRITE;
/*!40000 ALTER TABLE `TBL_TIPOIDENTIFICACIONES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_TIPOIDENTIFICACIONES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_TIPOLABORATORIOS`
--

DROP TABLE IF EXISTS `TBL_TIPOLABORATORIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_TIPOLABORATORIOS` (
  `TILA_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Tipo de Laboratorio',
  `TILA_NOMBRE` varchar(70) NOT NULL,
  PRIMARY KEY (`TILA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_TIPOLABORATORIOS`
--

LOCK TABLES `TBL_TIPOLABORATORIOS` WRITE;
/*!40000 ALTER TABLE `TBL_TIPOLABORATORIOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_TIPOLABORATORIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_TIPOMOVIMIENTOS`
--

DROP TABLE IF EXISTS `TBL_TIPOMOVIMIENTOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_TIPOMOVIMIENTOS` (
  `TIMO_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIMO_NOMBRE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`TIMO_ID`),
  UNIQUE KEY `TIMO_NOMBRE_UNIQUE` (`TIMO_NOMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_TIPOMOVIMIENTOS`
--

LOCK TABLES `TBL_TIPOMOVIMIENTOS` WRITE;
/*!40000 ALTER TABLE `TBL_TIPOMOVIMIENTOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_TIPOMOVIMIENTOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_UBICACIONES`
--

DROP TABLE IF EXISTS `TBL_UBICACIONES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_UBICACIONES` (
  `UBIC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `UBIC_ESTANTE` int(11) NOT NULL,
  `UBIC_NIVEL` int(11) NOT NULL,
  `UBIC_CODIGO` varchar(45) DEFAULT NULL COMMENT 'Codigo para agregar facilibilidad de memorizacion del estante y su nivel',
  PRIMARY KEY (`UBIC_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_UBICACIONES`
--

LOCK TABLES `TBL_UBICACIONES` WRITE;
/*!40000 ALTER TABLE `TBL_UBICACIONES` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_UBICACIONES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TBL_USUARIOS`
--

DROP TABLE IF EXISTS `TBL_USUARIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TBL_USUARIOS` (
  `USUA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USUA_USUARIO` varchar(45) NOT NULL,
  `USUA_PASSWORD` varchar(45) NOT NULL,
  `USUA_ES_ACTIVO` tinyint(1) DEFAULT '1',
  `PERS_ID` int(11) NOT NULL,
  `ROL_ID` int(11) NOT NULL,
  PRIMARY KEY (`USUA_ID`),
  KEY `FK_USUARIOS_PERS_ID_idx` (`PERS_ID`),
  KEY `FK_USUARIOS_ROL_ID_idx` (`ROL_ID`),
  CONSTRAINT `FK_USUARIOS_PERS_ID` FOREIGN KEY (`PERS_ID`) REFERENCES `tbl_personas` (`PERS_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIOS_ROL_ID` FOREIGN KEY (`ROL_ID`) REFERENCES `tbl_roles` (`ROL_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TBL_USUARIOS`
--

LOCK TABLES `TBL_USUARIOS` WRITE;
/*!40000 ALTER TABLE `TBL_USUARIOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TBL_USUARIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estado_solicitud`
--

DROP TABLE IF EXISTS `tb_estado_solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_estado_solicitud` (
  `estadoSolicitud_id` int(11) NOT NULL AUTO_INCREMENT,
  `estadoSolicitud_nombre` varchar(100) NOT NULL,
  `estadoSolicitud_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`estadoSolicitud_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estado_solicitud`
--

LOCK TABLES `tb_estado_solicitud` WRITE;
/*!40000 ALTER TABLE `tb_estado_solicitud` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_estado_solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_solicitud`
--

DROP TABLE IF EXISTS `tb_solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_solicitud` (
  `solicitud_id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_fecha` date DEFAULT NULL,
  `persona_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`solicitud_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_solicitud`
--

LOCK TABLES `tb_solicitud` WRITE;
/*!40000 ALTER TABLE `tb_solicitud` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'silab_db'
--

--
-- Dumping routines for database 'silab_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-15 10:55:15
