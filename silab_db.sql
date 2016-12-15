-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema silab_db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `silab_db` ;

-- -----------------------------------------------------
-- Schema silab_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `silab_db` DEFAULT CHARACTER SET utf8 ;
USE `silab_db` ;

-- -----------------------------------------------------
-- Table `silab_db`.`TBL_TIPOIDENTIFICACIONES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_TIPOIDENTIFICACIONES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_TIPOIDENTIFICACIONES` (
  `TIID_ID` INT NOT NULL AUTO_INCREMENT,
  `TIID_NOMBRE` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`TIID_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_GENEROS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_GENEROS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_GENEROS` (
  `GENE_ID` INT NOT NULL AUTO_INCREMENT,
  `GENE_NOMBRE` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`GENE_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_PERSONAS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_PERSONAS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_PERSONAS` (
  `PERS_ID` INT NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `PERS_NOMBRE` VARCHAR(100) NOT NULL COMMENT 'Nombre',
  `PERS_IDENTIFICACION` BIGINT NOT NULL COMMENT 'Documento de identidad',
  `GENE_ID` INT NOT NULL COMMENT 'Genero',
  `TIID_ID` INT NOT NULL COMMENT 'Tipo de documento',
  PRIMARY KEY (`PERS_ID`),
  INDEX `fk_personas_tipoId_id_idx` (`TIID_ID` ASC),
  INDEX `fk_personas_genero_id_idx` (`GENE_ID` ASC),
  CONSTRAINT `fk_personas_tipoId_id`
    FOREIGN KEY (`TIID_ID`)
    REFERENCES `silab_db`.`TBL_TIPOIDENTIFICACIONES` (`TIID_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_personas_genero_id`
    FOREIGN KEY (`GENE_ID`)
    REFERENCES `silab_db`.`TBL_GENEROS` (`GENE_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_COORDINADORES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_COORDINADORES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_COORDINADORES` (
  `COOR_ID` INT NOT NULL AUTO_INCREMENT,
  `PERS_ID` INT NOT NULL,
  PRIMARY KEY (`COOR_ID`),
  INDEX `fk_coordinadores_persona_id_idx` (`PERS_ID` ASC),
  CONSTRAINT `fk_coordinadores_persona_id`
    FOREIGN KEY (`PERS_ID`)
    REFERENCES `silab_db`.`TBL_PERSONAS` (`PERS_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_FUNCIONARIOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_FUNCIONARIOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_FUNCIONARIOS` (
  `FUNC_ID` INT NOT NULL AUTO_INCREMENT,
  `PERS_ID` INT NOT NULL,
  PRIMARY KEY (`FUNC_ID`),
  INDEX `fk_funcionarios_persona_id_idx` (`PERS_ID` ASC),
  CONSTRAINT `fk_funcionarios_persona_id`
    FOREIGN KEY (`PERS_ID`)
    REFERENCES `silab_db`.`TBL_PERSONAS` (`PERS_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_MARCAS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_MARCAS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_MARCAS` (
  `MARC_ID` INT NOT NULL AUTO_INCREMENT COMMENT 'id',
  `MARC_NOMBRE` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`MARC_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_TIPOSITEMS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_TIPOSITEMS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_TIPOSITEMS` (
  `TIIT_ID` INT NOT NULL AUTO_INCREMENT,
  `TIIT_NOMBRE` VARCHAR(45) NOT NULL,
  `TIIT_PADRE` INT NULL,
  PRIMARY KEY (`TIIT_ID`),
  INDEX `REF_TIPOSITEMS_TIIT_PADRE_ID_idx` (`TIIT_PADRE` ASC),
  CONSTRAINT `REF_TIPOSITEMS_TIIT_PADRE_ID`
    FOREIGN KEY (`TIIT_PADRE`)
    REFERENCES `silab_db`.`TBL_TIPOSITEMS` (`TIIT_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_ITEMS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_ITEMS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_ITEMS` (
  `ITEM_ID` INT NOT NULL AUTO_INCREMENT,
  `ITEM_NOMBRE` VARCHAR(200) NOT NULL,
  `ITEM_OBSERVACION` TEXT NULL,
  `MARC_ID` INT NOT NULL,
  `TIIT_ID` INT NOT NULL,
  PRIMARY KEY (`ITEM_ID`),
  INDEX `fk_items_marca_id_idx` (`MARC_ID` ASC),
  INDEX `FK_ITEMS_TIIT_ID_idx` (`TIIT_ID` ASC),
  CONSTRAINT `fk_items_marca_id`
    FOREIGN KEY (`MARC_ID`)
    REFERENCES `silab_db`.`TBL_MARCAS` (`MARC_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_ITEMS_TIIT_ID`
    FOREIGN KEY (`TIIT_ID`)
    REFERENCES `silab_db`.`TBL_TIPOSITEMS` (`TIIT_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_MODELO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_MODELO` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_MODELO` (
  `MODE_ID` INT NOT NULL AUTO_INCREMENT,
  `MODE_CODIGO` VARCHAR(200) NOT NULL,
  `MODE_EMPTY` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`MODE_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_ESTADOSNOCONSUMIBLE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_ESTADOSNOCONSUMIBLE` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_ESTADOSNOCONSUMIBLE` (
  `ESNC_ID` INT NOT NULL AUTO_INCREMENT,
  `ESNC_NOMBRE` VARCHAR(100) NOT NULL,
  `ESNC_CODIGO` VARCHAR(45) NULL,
  PRIMARY KEY (`ESNC_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_ITEMSNOCONSUMIBLES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_ITEMSNOCONSUMIBLES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_ITEMSNOCONSUMIBLES` (
  `ITNC_ID` INT NOT NULL AUTO_INCREMENT COMMENT 'Es un item, el cual, su estado es descrito de manera cualitatitva y no es relativa a un rango',
  `ITEM_ID` INT NOT NULL,
  `ESNC_ID` INT NOT NULL,
  `MODE_ID` INT NOT NULL,
  PRIMARY KEY (`ITNC_ID`),
  INDEX `fk_items_cualitativos_item_id_idx` (`ITEM_ID` ASC),
  INDEX `fk_items_cualitativos_estadoCualitativo_id_idx` (`ESNC_ID` ASC),
  INDEX `fk_items_cualitativos_modelo_id_idx` (`MODE_ID` ASC),
  CONSTRAINT `fk_items_cualitativos_item_id`
    FOREIGN KEY (`ITEM_ID`)
    REFERENCES `silab_db`.`TBL_ITEMS` (`ITEM_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_items_cualitativos_estadoCualitativo_id`
    FOREIGN KEY (`ESNC_ID`)
    REFERENCES `silab_db`.`TBL_ESTADOSNOCONSUMIBLE` (`ESNC_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_items_cualitativos_modelo_id`
    FOREIGN KEY (`MODE_ID`)
    REFERENCES `silab_db`.`TBL_MODELO` (`MODE_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_EQUIPOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_EQUIPOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_EQUIPOS` (
  `EQUI_ID` INT NOT NULL AUTO_INCREMENT,
  `EQUI_SERIAL` VARCHAR(100) NOT NULL,
  `ITNC_ID` INT NOT NULL,
  PRIMARY KEY (`EQUI_ID`),
  INDEX `fk_equipos_itemCualitativo_id_idx` (`ITNC_ID` ASC),
  CONSTRAINT `fk_equipos_itemCualitativo_id`
    FOREIGN KEY (`ITNC_ID`)
    REFERENCES `silab_db`.`TBL_ITEMSNOCONSUMIBLES` (`ITNC_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_ESTADOSCONSUMIBLE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_ESTADOSCONSUMIBLE` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_ESTADOSCONSUMIBLE` (
  `ESCO_ID` INT NOT NULL AUTO_INCREMENT,
  `ESCO_NOMBRE` VARCHAR(45) NOT NULL,
  `ESCO_MIN` INT NOT NULL DEFAULT 0,
  `ESCO_MAX` INT NULL DEFAULT 0,
  PRIMARY KEY (`ESCO_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_ITEMSCONSUMIBLES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_ITEMSCONSUMIBLES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_ITEMSCONSUMIBLES` (
  `ITCO_ID` INT NOT NULL AUTO_INCREMENT COMMENT 'Es un item, el cual, su estado es descrito de manera cualitatitva y no es relativa a un rango',
  `ITEM_ID` INT NOT NULL,
  `ESCO_ID` INT NOT NULL,
  PRIMARY KEY (`ITCO_ID`),
  INDEX `fk_items_cualitativos_item_id_idx` (`ITEM_ID` ASC),
  INDEX `fk_items_cuantitativos_estadoCuantitativo_id_idx` (`ESCO_ID` ASC),
  CONSTRAINT `fk_items_cuantitativos_item_id`
    FOREIGN KEY (`ITEM_ID`)
    REFERENCES `silab_db`.`TBL_ITEMS` (`ITEM_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_items_cuantitativos_estadoCuantitativo_id`
    FOREIGN KEY (`ESCO_ID`)
    REFERENCES `silab_db`.`TBL_ESTADOSCONSUMIBLE` (`ESCO_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_MATERIALES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_MATERIALES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_MATERIALES` (
  `MATE_ID` INT NOT NULL AUTO_INCREMENT,
  `MATE_MEDIDA` VARCHAR(45) NULL,
  `ITCO_ID` INT NOT NULL,
  PRIMARY KEY (`MATE_ID`),
  INDEX `fk_materiales_itemCualitativo_id_idx` (`ITCO_ID` ASC),
  CONSTRAINT `fk_materiales_itemCualitativo_id`
    FOREIGN KEY (`ITCO_ID`)
    REFERENCES `silab_db`.`TBL_ITEMSCONSUMIBLES` (`ITCO_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_HERRAMIENTAS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_HERRAMIENTAS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_HERRAMIENTAS` (
  `HERR_ID` INT NOT NULL AUTO_INCREMENT,
  `HERR_CANTIDAD` INT NOT NULL,
  `ITNC_ID` INT NULL,
  PRIMARY KEY (`HERR_ID`),
  INDEX `fk_herramienta_itemCualitativo_id_idx` (`ITNC_ID` ASC),
  CONSTRAINT `fk_herramienta_itemCualitativo_id`
    FOREIGN KEY (`ITNC_ID`)
    REFERENCES `silab_db`.`TBL_ITEMSNOCONSUMIBLES` (`ITNC_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_ACCESORIOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_ACCESORIOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_ACCESORIOS` (
  `ACCE_ID` INT NOT NULL AUTO_INCREMENT,
  `ACCE_SERIAL` VARCHAR(45) NOT NULL,
  `ACCE_MODELO` VARCHAR(45) NULL,
  `ITNC_ID` INT NOT NULL,
  PRIMARY KEY (`ACCE_ID`),
  INDEX `fk_accesorios_itemCualitativo_id_idx` (`ITNC_ID` ASC),
  CONSTRAINT `fk_accesorios_itemCualitativo_id`
    FOREIGN KEY (`ITNC_ID`)
    REFERENCES `silab_db`.`TBL_ITEMSNOCONSUMIBLES` (`ITNC_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_CADUCIDADES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_CADUCIDADES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_CADUCIDADES` (
  `CADU_ID` INT NOT NULL AUTO_INCREMENT,
  `CADU_NOMBRE` VARCHAR(45) NOT NULL,
  `CADU_MIN` INT NOT NULL DEFAULT 0,
  `CADU_MAX` INT NULL DEFAULT 0,
  PRIMARY KEY (`CADU_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_UBICACIONES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_UBICACIONES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_UBICACIONES` (
  `UBIC_ID` INT NOT NULL AUTO_INCREMENT,
  `UBIC_ESTANTE` INT NOT NULL,
  `UBIC_NIVEL` INT NOT NULL,
  `UBIC_CODIGO` VARCHAR(45) NULL COMMENT 'Codigo para agregar facilibilidad de memorizacion del estante y su nivel',
  PRIMARY KEY (`UBIC_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_SIMBOLOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_SIMBOLOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_SIMBOLOS` (
  `SIMB_ID` INT NOT NULL AUTO_INCREMENT,
  `SIMB_NOMBRE` VARCHAR(100) NOT NULL,
  `SIMB_CODIGO` VARCHAR(45) NULL DEFAULT '',
  PRIMARY KEY (`SIMB_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_REACTIVOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_REACTIVOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_REACTIVOS` (
  `REAC_ID` INT NOT NULL AUTO_INCREMENT,
  `REAC_CODIGO` VARCHAR(100) NOT NULL,
  `REAC_UNIDAD` VARCHAR(45) NOT NULL,
  `REAC_FECHA_VENCIMIENTO` DATE NOT NULL,
  `ITCO_ID` INT NOT NULL,
  `UBIC_ID` INT NOT NULL,
  `CADU_ID` INT NOT NULL,
  `SIMB_ID` INT NOT NULL,
  PRIMARY KEY (`REAC_ID`),
  INDEX `fk_reactivos_caducidad_id_idx` (`CADU_ID` ASC),
  INDEX `fk_reactivos_ubicacion_id_idx` (`UBIC_ID` ASC),
  INDEX `fk_reactivos_simbolo_id_idx` (`SIMB_ID` ASC),
  INDEX `fk_reactivos_itemCuantitativo_id_idx` (`ITCO_ID` ASC),
  CONSTRAINT `fk_reactivos_itemCuantitativo_id`
    FOREIGN KEY (`ITCO_ID`)
    REFERENCES `silab_db`.`TBL_ITEMSCONSUMIBLES` (`ITCO_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reactivos_caducidad_id`
    FOREIGN KEY (`CADU_ID`)
    REFERENCES `silab_db`.`TBL_CADUCIDADES` (`CADU_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reactivos_ubicacion_id`
    FOREIGN KEY (`UBIC_ID`)
    REFERENCES `silab_db`.`TBL_UBICACIONES` (`UBIC_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reactivos_simbolo_id`
    FOREIGN KEY (`SIMB_ID`)
    REFERENCES `silab_db`.`TBL_SIMBOLOS` (`SIMB_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_EDIFICIOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_EDIFICIOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_EDIFICIOS` (
  `EDIF_ID` INT NOT NULL AUTO_INCREMENT,
  `EDIF_NOMBRE` VARCHAR(100) NOT NULL,
  `EDIF_CODIGO` VARCHAR(45) NULL,
  PRIMARY KEY (`EDIF_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_TIPOLABORATORIOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_TIPOLABORATORIOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_TIPOLABORATORIOS` (
  `TILA_ID` INT NOT NULL AUTO_INCREMENT COMMENT 'ID Tipo de Laboratorio',
  `TILA_NOMBRE` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`TILA_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_LABORATORIOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_LABORATORIOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_LABORATORIOS` (
  `LABO_ID` INT NOT NULL AUTO_INCREMENT,
  `LABO_NOMBRE` VARCHAR(100) NOT NULL,
  `LABO_NIVEL` INT GENERATED ALWAYS AS (0) VIRTUAL,
  `EDIF_ID` INT NOT NULL,
  `COOR_ID` INT NOT NULL,
  `TILA_ID` INT NOT NULL,
  PRIMARY KEY (`LABO_ID`),
  INDEX `fk_laboratorios_coordinador_id_idx` (`COOR_ID` ASC),
  INDEX `fk_laboratorios_edificio_id_idx` (`EDIF_ID` ASC),
  INDEX `fk_LABoratorios_tila_id_idx` (`TILA_ID` ASC),
  CONSTRAINT `fk_laboratorios_edificio_id`
    FOREIGN KEY (`EDIF_ID`)
    REFERENCES `silab_db`.`TBL_EDIFICIOS` (`EDIF_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_laboratorios_coordinador_id`
    FOREIGN KEY (`COOR_ID`)
    REFERENCES `silab_db`.`TBL_COORDINADORES` (`COOR_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_LABORATORIOS_TILA_ID`
    FOREIGN KEY (`TILA_ID`)
    REFERENCES `silab_db`.`TBL_TIPOLABORATORIOS` (`TILA_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_PERIODOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_PERIODOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_PERIODOS` (
  `PERI_ID` INT NOT NULL AUTO_INCREMENT,
  `PERI_SEMESTRE` INT NOT NULL,
  `PERI_FECHA` DATE NULL,
  PRIMARY KEY (`PERI_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_INVENTARIOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_INVENTARIOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_INVENTARIOS` (
  `INVE_ID` INT NOT NULL AUTO_INCREMENT,
  `INVE_NOMBRE` VARCHAR(200) NULL,
  `LABO_ID` INT NOT NULL,
  `INVE_CANTIDAD` FLOAT NULL,
  `PERI_ID` INT NOT NULL,
  PRIMARY KEY (`INVE_ID`),
  INDEX `fk_inventarios_periodo_id_idx` (`PERI_ID` ASC),
  INDEX `fk_inventarios_laboratorio_id_idx` (`LABO_ID` ASC),
  CONSTRAINT `fk_inventarios_periodo_id`
    FOREIGN KEY (`PERI_ID`)
    REFERENCES `silab_db`.`TBL_PERIODOS` (`PERI_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_inventarios_laboratorio_id`
    FOREIGN KEY (`LABO_ID`)
    REFERENCES `silab_db`.`TBL_LABORATORIOS` (`LABO_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`tb_solicitud`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`tb_solicitud` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`tb_solicitud` (
  `solicitud_id` INT NOT NULL AUTO_INCREMENT,
  `solicitud_fecha` DATE NULL,
  `persona_id` VARCHAR(45) NULL,
  PRIMARY KEY (`solicitud_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`tb_estado_solicitud`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`tb_estado_solicitud` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`tb_estado_solicitud` (
  `estadoSolicitud_id` INT NOT NULL AUTO_INCREMENT,
  `estadoSolicitud_nombre` VARCHAR(100) NOT NULL,
  `estadoSolicitud_orden` INT NULL,
  PRIMARY KEY (`estadoSolicitud_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_PROVEDORES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_PROVEDORES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_PROVEDORES` (
  `PROV_ID` INT NOT NULL AUTO_INCREMENT,
  `PROV_NOMBRE` VARCHAR(100) NOT NULL,
  `PROV_NIT` VARCHAR(45) NULL,
  PRIMARY KEY (`PROV_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_TIPOMOVIMIENTOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_TIPOMOVIMIENTOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_TIPOMOVIMIENTOS` (
  `TIMO_ID` INT NOT NULL AUTO_INCREMENT,
  `TIMO_NOMBRE` VARCHAR(100) NULL,
  PRIMARY KEY (`TIMO_ID`),
  UNIQUE INDEX `TIMO_NOMBRE_UNIQUE` (`TIMO_NOMBRE` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_MOVIMIENTOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_MOVIMIENTOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_MOVIMIENTOS` (
  `MOVI_ID` INT NOT NULL AUTO_INCREMENT,
  `MOVI_FECHA` DATETIME NULL,
  `MOVI_CODIGO` VARCHAR(100) NULL,
  `TIMO_ID` INT NULL,
  `PERS_ID` INT NULL COMMENT 'Persona Solicitante',
  PRIMARY KEY (`MOVI_ID`),
  INDEX `FK_MOVIMIENTOS_TIMO_ID_idx` (`TIMO_ID` ASC),
  INDEX `FK_MOVIMIENTOS_PERS_ID_idx` (`PERS_ID` ASC),
  CONSTRAINT `FK_MOVIMIENTOS_TIMO_ID`
    FOREIGN KEY (`TIMO_ID`)
    REFERENCES `silab_db`.`TBL_TIPOMOVIMIENTOS` (`TIMO_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_MOVIMIENTOS_PERS_ID`
    FOREIGN KEY (`PERS_ID`)
    REFERENCES `silab_db`.`TBL_PERSONAS` (`PERS_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_PEDIDOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_PEDIDOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_PEDIDOS` (
  `PEDI_ID` INT NOT NULL AUTO_INCREMENT,
  `PEDI_FECHA` DATETIME NULL,
  `PEDI_CODIGO` VARCHAR(100) NULL,
  `MOVI_ID` INT NOT NULL,
  PRIMARY KEY (`PEDI_ID`),
  CONSTRAINT `FK_PEDIDOS_MOVI_ID`
    FOREIGN KEY (`MOVI_ID`)
    REFERENCES `silab_db`.`TBL_MOVIMIENTOS` (`MOVI_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_FACTURAS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_FACTURAS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_FACTURAS` (
  `FACT_ID` INT NOT NULL AUTO_INCREMENT,
  `FACT_CODIGO` VARCHAR(100) NOT NULL,
  `FACT_FECHA` DATETIME NULL,
  `FACT_IMAGEPATH` TEXT NULL,
  `PROV_ID` INT NOT NULL,
  `PEDI_ID` INT NULL,
  PRIMARY KEY (`FACT_ID`),
  INDEX `fk_facturas_provedor_id_idx` (`PROV_ID` ASC),
  INDEX `FK_FACTURAS_PEDI_ID_idx` (`PEDI_ID` ASC),
  CONSTRAINT `fk_facturas_provedor_id`
    FOREIGN KEY (`PROV_ID`)
    REFERENCES `silab_db`.`TBL_PROVEDORES` (`PROV_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_FACTURAS_PEDI_ID`
    FOREIGN KEY (`PEDI_ID`)
    REFERENCES `silab_db`.`TBL_PEDIDOS` (`PEDI_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_STOCK`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_STOCK` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_STOCK` (
  `STOC_ID` INT NOT NULL AUTO_INCREMENT,
  `ITEM_ID` INT NOT NULL,
  `INVE_ID` INT NOT NULL,
  `STOC_CANTIDAD` DOUBLE NULL,
  PRIMARY KEY (`STOC_ID`),
  INDEX `FK_ITEMSSTOCK_ITEM_ID_idx` (`ITEM_ID` ASC),
  INDEX `FK_ITEMSSTOCK_INVE_ID_idx` (`INVE_ID` ASC),
  UNIQUE INDEX `UNIQUE_ITEMSSTOCK_ITEM_INVE` (`INVE_ID` ASC, `ITEM_ID` ASC),
  CONSTRAINT `FK_ITEMSSTOCK_ITEM_ID`
    FOREIGN KEY (`ITEM_ID`)
    REFERENCES `silab_db`.`TBL_ITEMS` (`ITEM_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_ITEMSSTOCK_INVE_ID`
    FOREIGN KEY (`INVE_ID`)
    REFERENCES `silab_db`.`TBL_INVENTARIOS` (`INVE_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_TIPOFLUJO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_TIPOFLUJO` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_TIPOFLUJO` (
  `TIFL_ID` INT NOT NULL AUTO_INCREMENT,
  `TIFL_NOMBRE` VARCHAR(45) NULL,
  `TIFL_CONSTANTE` DOUBLE NULL,
  PRIMARY KEY (`TIFL_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_FLUJOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_FLUJOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_FLUJOS` (
  `FLUJ_ID` INT NOT NULL AUTO_INCREMENT,
  `FLUJ_CANTIDAD` DOUBLE NOT NULL,
  `MOVI_ID` INT NULL,
  `STOC_ID` INT NOT NULL,
  `TIFU_ID` INT NULL,
  PRIMARY KEY (`FLUJ_ID`),
  INDEX `FK_FLUJOS_STOC_ID_idx` (`STOC_ID` ASC),
  INDEX `FK_FLUJOS_TIFU_ID_idx` (`TIFU_ID` ASC),
  INDEX `FK_FLUJOS_PEDI_ID_idx` (`MOVI_ID` ASC),
  CONSTRAINT `FK_FLUJOS_PEDI_ID`
    FOREIGN KEY (`MOVI_ID`)
    REFERENCES `silab_db`.`TBL_MOVIMIENTOS` (`MOVI_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_FLUJOS_STOC_ID`
    FOREIGN KEY (`STOC_ID`)
    REFERENCES `silab_db`.`TBL_STOCK` (`STOC_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_FLUJOS_TIFU_ID`
    FOREIGN KEY (`TIFU_ID`)
    REFERENCES `silab_db`.`TBL_TIPOFLUJO` (`TIFL_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_ROLES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_ROLES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_ROLES` (
  `ROL_ID` INT NOT NULL AUTO_INCREMENT,
  `ROL_NOMBRE` VARCHAR(45) NOT NULL,
  `ROL_ORDEN` INT NOT NULL,
  PRIMARY KEY (`ROL_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_USUARIOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_USUARIOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_USUARIOS` (
  `USUA_ID` INT NOT NULL AUTO_INCREMENT,
  `USUA_USUARIO` VARCHAR(45) NOT NULL,
  `USUA_PASSWORD` VARCHAR(45) NOT NULL,
  `USUA_ES_ACTIVO` TINYINT(1) NULL DEFAULT 1,
  `USUA_TOKEN` VARCHAR(250) NULL,
  `PERS_ID` INT NOT NULL,
  `ROL_ID` INT NOT NULL,
  PRIMARY KEY (`USUA_ID`),
  INDEX `FK_USUARIOS_PERS_ID_idx` (`PERS_ID` ASC),
  INDEX `FK_USUARIOS_ROL_ID_idx` (`ROL_ID` ASC),
  CONSTRAINT `FK_USUARIOS_PERS_ID`
    FOREIGN KEY (`PERS_ID`)
    REFERENCES `silab_db`.`TBL_PERSONAS` (`PERS_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_USUARIOS_ROL_ID`
    FOREIGN KEY (`ROL_ID`)
    REFERENCES `silab_db`.`TBL_ROLES` (`ROL_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_LOGTIPO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_LOGTIPO` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_LOGTIPO` (
  `LOTI_ID` INT NOT NULL AUTO_INCREMENT,
  `LOTI_DESCRIPCION` INT NULL,
  PRIMARY KEY (`LOTI_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_AUDITORIALOG`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_AUDITORIALOG` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_AUDITORIALOG` (
  `AULOG_ID` INT NOT NULL AUTO_INCREMENT,
  `AULOG_TABLENAME` VARCHAR(100) NULL,
  `AULOG_FECHA` TIMESTAMP NULL,
  `USUA_ID` INT NULL,
  `LOTI_ID` INT NULL,
  PRIMARY KEY (`AULOG_ID`),
  INDEX `FK_AUDITORIALOG_USUA_ID_idx` (`USUA_ID` ASC),
  INDEX `FK_AUDITORIALOG_LOTI_ID_idx` (`LOTI_ID` ASC),
  CONSTRAINT `FK_AUDITORIALOG_USUA_ID`
    FOREIGN KEY (`USUA_ID`)
    REFERENCES `silab_db`.`TBL_USUARIOS` (`USUA_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_AUDITORIALOG_LOTI_ID`
    FOREIGN KEY (`LOTI_ID`)
    REFERENCES `silab_db`.`TBL_LOGTIPO` (`LOTI_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_FUNCIONALABORATORIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_FUNCIONALABORATORIO` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_FUNCIONALABORATORIO` (
  `FULA_ID` INT NOT NULL AUTO_INCREMENT,
  `FUNC_ID` INT NULL,
  `LABO_ID` INT NULL,
  PRIMARY KEY (`FULA_ID`),
  INDEX `FK_FUNCIONALABORATORIO_FUNC_ID_idx` (`FUNC_ID` ASC),
  INDEX `FK_FUNCIONALABORATORIO_LABO__ID_idx` (`LABO_ID` ASC),
  CONSTRAINT `FK_FUNCIONALABORATORIO_FUNC_ID`
    FOREIGN KEY (`FUNC_ID`)
    REFERENCES `silab_db`.`TBL_FUNCIONARIOS` (`FUNC_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_FUNCIONALABORATORIO_LABO__ID`
    FOREIGN KEY (`LABO_ID`)
    REFERENCES `silab_db`.`TBL_LABORATORIOS` (`LABO_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_PERMISOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_PERMISOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_PERMISOS` (
  `PERM_ID` INT NOT NULL AUTO_INCREMENT,
  `PERM_ACCION` VARCHAR(45) NULL,
  `PERM_CONTROLADOR` VARCHAR(45) NULL,
  `PERM_MODULO` VARCHAR(45) NULL,
  `PERM_PADRE` INT NULL,
  PRIMARY KEY (`PERM_ID`),
  INDEX `FK_PERMISOS_PERM_PADRE_idx` (`PERM_PADRE` ASC),
  CONSTRAINT `REF_PERMISOS_PERM_PADRE`
    FOREIGN KEY (`PERM_PADRE`)
    REFERENCES `silab_db`.`TBL_PERMISOS` (`PERM_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_DETALLEPEDIDOS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_DETALLEPEDIDOS` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_DETALLEPEDIDOS` (
  `DEPE_ID` INT NOT NULL AUTO_INCREMENT,
  `DEPE_CANTIDAD` DOUBLE NULL,
  `PEDI_ID` INT NOT NULL,
  `ITEM_ID` INT NOT NULL,
  PRIMARY KEY (`DEPE_ID`),
  INDEX `FK_DETALLEPEDIDO_ITEM_ID_idx` (`ITEM_ID` ASC),
  INDEX `FK_DETALLEPEDIDOS_PEDI_ID_idx` (`PEDI_ID` ASC),
  CONSTRAINT `FK_DETALLEPEDIDOS_PEDI_ID`
    FOREIGN KEY (`PEDI_ID`)
    REFERENCES `silab_db`.`TBL_PEDIDOS` (`PEDI_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_DETALLEPEDIDO_ITEM_ID`
    FOREIGN KEY (`ITEM_ID`)
    REFERENCES `silab_db`.`TBL_ITEMS` (`ITEM_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `silab_db`.`TBL_PERFILESROLES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `silab_db`.`TBL_PERFILESROLES` ;

CREATE TABLE IF NOT EXISTS `silab_db`.`TBL_PERFILESROLES` (
  `PERO_ID` INT NOT NULL AUTO_INCREMENT,
  `ROL_ID` INT NOT NULL,
  `PERM_ID` INT NOT NULL,
  `PERO_PADRE` INT NULL,
  PRIMARY KEY (`PERO_ID`),
  INDEX `FK_ROLES_ROL_ID_idx` (`ROL_ID` ASC),
  INDEX `FK_PERFILESROLES_PERM_ID_idx` (`PERM_ID` ASC),
  INDEX `FK_PERFILESROLES_PERO_PADRE_idx` (`PERO_PADRE` ASC),
  UNIQUE INDEX `UNIQUE_ROLES_PERMISOS` (`ROL_ID` ASC, `PERM_ID` ASC),
  CONSTRAINT `FK_PERFILROLES_ROL_ID`
    FOREIGN KEY (`ROL_ID`)
    REFERENCES `silab_db`.`TBL_ROLES` (`ROL_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_PERFILESROLES_PERM_ID`
    FOREIGN KEY (`PERM_ID`)
    REFERENCES `silab_db`.`TBL_PERMISOS` (`PERM_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `REF_PERFILESROLES_PERO_PADRE`
    FOREIGN KEY (`PERO_PADRE`)
    REFERENCES `silab_db`.`TBL_PERFILESROLES` (`PERO_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
