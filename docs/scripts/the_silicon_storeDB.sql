-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema The_Silicon_Store
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema The_Silicon_Store
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `The_Silicon_Store` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema the_silicon_store
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema the_silicon_store
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `the_silicon_store` DEFAULT CHARACTER SET utf8 ;
USE `The_Silicon_Store` ;

-- -----------------------------------------------------
-- Table `The_Silicon_Store`.`marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `The_Silicon_Store`.`marca` (
  `idMarca` BIGINT(13) NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(75) NOT NULL,
  `estado` CHAR(3) NOT NULL  DEFAULT 'ACT',
  PRIMARY KEY (`idMarca`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `The_Silicon_Store`.`celular`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `The_Silicon_Store`.`celular` (
  `invPrdId` BIGINT(13) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(1000) NOT NULL,
  `precio` DECIMAL(13,2) NOT NULL NULL DEFAULT 0,
  `estado` CHAR(3) NOT NULL  DEFAULT 'ACT',
  `idMarca` BIGINT(13) NOT NULL,
  PRIMARY KEY (`invPrdId`),
  INDEX `idMarca_idx` (`idMarca` ASC) VISIBLE,
  CONSTRAINT `idMarca`
    FOREIGN KEY (`idMarca`)
    REFERENCES `The_Silicon_Store`.`marca` (`idMarca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `The_Silicon_Store`.`inventario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `The_Silicon_Store`.`inventario` (
 `idInventario` BIGINT(13) NOT NULL AUTO_INCREMENT,
  `invPrdId` BIGINT(13) NOT NULL,
  `cantidad` INT NOT NULL,
  PRIMARY KEY (`idInventario`, `invPrdId`),
  INDEX `fk_invPrdId_inventario` (`invPrdId` ASC) VISIBLE,
  CONSTRAINT `idCelular`
    FOREIGN KEY (`invPrdId`)
    REFERENCES `The_Silicon_Store`.`celular` (`invPrdId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `the_silicon_store`.`carretilla_anon`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `the_silicon_store`.`carretilla_anon` (
  `anoncartid` BIGINT(18) NOT NULL,
  `invPrdId` BIGINT NOT NULL,
  `cartCtd` INT NULL DEFAULT NULL,
  `cartPrc` DECIMAL(13,2) NULL DEFAULT NULL,
  `cartIat` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`anoncartid`, `invPrdId`),
  INDEX `fk_carretilla_anon_celulares_idx` (`invPrdId` ASC) VISIBLE,
  CONSTRAINT `fk_carretilla_anon_celulares`
    FOREIGN KEY (`invPrdId`)
    REFERENCES `the_silicon_store`.`celular` (`invPrdId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `the_silicon_store`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `the_silicon_store`.`usuario` (
  `usercod` BIGINT NOT NULL AUTO_INCREMENT,
  `useremail` VARCHAR(80) NULL DEFAULT NULL,
  `username` VARCHAR(80) NULL DEFAULT NULL,
  `userpswd` VARCHAR(128) NULL DEFAULT NULL,
  `userfching` DATETIME NULL DEFAULT NULL,
  `userpswdest` CHAR(3) NULL DEFAULT NULL,
  `userpswdexp` DATETIME NULL DEFAULT NULL,
  `userest` CHAR(3) NULL DEFAULT NULL,
  `useractcod` VARCHAR(128) NULL DEFAULT NULL,
  `userpswdchg` VARCHAR(128) NULL DEFAULT NULL,
  `usertipo` CHAR(3) NULL DEFAULT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente',
  PRIMARY KEY (`usercod`),
  UNIQUE INDEX `useremail_UNIQUE` (`useremail` ASC) VISIBLE,
  INDEX `usertipo` (`usertipo` ASC, `useremail` ASC, `usercod` ASC, `userest` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `The_Silicon_Store`.`bitacora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `The_Silicon_Store`.`bitacora` (
  `idBitacora` BIGINT(13) NOT NULL,
  `usercod` BIGINT NOT NULL,
  `accion` VARCHAR(255) NOT NULL,
  `fecha` DATETIME NOT NULL,
  PRIMARY KEY (`idBitacora`),
   CONSTRAINT `fk_bitacora_usuarios_idx`
    FOREIGN KEY (`usercod`)
    REFERENCES `the_silicon_store`.`usuario` (`usercod`))
ENGINE = InnoDB;

USE `the_silicon_store` ;


-- -----------------------------------------------------
-- Table `the_silicon_store`.`carretilla_auth`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `the_silicon_store`.`carretilla_auth` (
  `usercod` BIGINT NOT NULL,
  `invPrdId` BIGINT NOT NULL,
  `cartCtd` INT NULL DEFAULT NULL,
  `cartPrc` DECIMAL(13,2) NULL DEFAULT NULL,
  `cartIat` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`usercod`, `invPrdId`),
  INDEX `fk_carretilla_auth_productos_idx` (`invPrdId` ASC) VISIBLE,
  CONSTRAINT `fk_carretilla_auth_celulares`
    FOREIGN KEY (`invPrdId`)
    REFERENCES `the_silicon_store`.`celular` (`invPrdId`),
  CONSTRAINT `fk_carretilla_auth_usuarios_idx`
    FOREIGN KEY (`usercod`)
    REFERENCES `the_silicon_store`.`usuario` (`usercod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `the_silicon_store`.`documento_fiscal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `the_silicon_store`.`documento_fiscal` (
  `doccod` BIGINT NOT NULL AUTO_INCREMENT,
  `docfch` DATETIME NULL DEFAULT NULL,
  `usercod` BIGINT NULL DEFAULT NULL,
  `docobs` VARCHAR(256) NULL DEFAULT NULL,
  `docshipping` MEDIUMTEXT NULL DEFAULT NULL,
  `docest` CHAR(3) NULL DEFAULT NULL,
  `docmeta` MEDIUMTEXT NULL DEFAULT NULL,
  `docfchdlv` DATETIME NULL DEFAULT NULL,
  `docestdlv` CHAR(3) NULL DEFAULT NULL,
  `docFrmPgo` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`doccod`),
  INDEX `fk_documento_fiscal_usuario_idx` (`usercod` ASC) VISIBLE,
  CONSTRAINT `fk_documento_fiscal_usuario`
    FOREIGN KEY (`usercod`)
    REFERENCES `the_silicon_store`.`usuario` (`usercod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `the_silicon_store`.`documento_fiscal_lineas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `the_silicon_store`.`documento_fiscal_lineas` (
  `doccod` BIGINT NOT NULL,
  `invPrdId` BIGINT NOT NULL,
  `docCtd` INT NULL DEFAULT NULL,
  `docPrc` DECIMAL(13,2) NULL DEFAULT NULL,
  `docIva` DECIMAL(6,2) NULL DEFAULT NULL,
  `docLObs` VARCHAR(256) NULL DEFAULT NULL,
  `docDsc` DECIMAL(6,2) NULL DEFAULT NULL,
  PRIMARY KEY (`doccod`, `invPrdId`),
  INDEX `fk_linea_documento_fiscal_celular_idx_idx` (`invPrdId` ASC) VISIBLE,
  CONSTRAINT `fk_linea_documento_fiscal_celular_idx`
    FOREIGN KEY (`invPrdId`)
    REFERENCES `the_silicon_store`.`celular` (`invPrdId`),
  CONSTRAINT `fk_linea_documento_fiscal_idx`
    FOREIGN KEY (`doccod`)
    REFERENCES `the_silicon_store`.`documento_fiscal` (`doccod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `the_silicon_store`.`funciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `the_silicon_store`.`funciones` (
  `fncod` VARCHAR(255) NOT NULL,
  `fndsc` VARCHAR(255) NULL DEFAULT NULL,
  `fnest` CHAR(3) NULL DEFAULT NULL,
  `fntyp` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`fncod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `the_silicon_store`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `the_silicon_store`.`roles` (
  `rolescod` VARCHAR(15) NOT NULL,
  `rolesdsc` VARCHAR(45) NULL DEFAULT NULL,
  `rolesest` CHAR(3) NULL DEFAULT NULL,
  PRIMARY KEY (`rolescod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `the_silicon_store`.`funciones_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `the_silicon_store`.`funciones_roles` (
  `rolescod` VARCHAR(15) NOT NULL,
  `fncod` VARCHAR(255) NOT NULL,
  `fnrolest` CHAR(3) NULL DEFAULT NULL,
  `fnexp` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`rolescod`, `fncod`),
  INDEX `rol_funcion_key_idx` (`fncod` ASC) VISIBLE,
  CONSTRAINT `funcion_rol_key`
    FOREIGN KEY (`rolescod`)
    REFERENCES `the_silicon_store`.`roles` (`rolescod`),
  CONSTRAINT `rol_funcion_key`
    FOREIGN KEY (`fncod`)
    REFERENCES `the_silicon_store`.`funciones` (`fncod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `the_silicon_store`.`roles_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `the_silicon_store`.`roles_usuarios` (
  `usercod` BIGINT NOT NULL,
  `rolescod` VARCHAR(15) NOT NULL,
  `roleuserest` CHAR(3) NULL DEFAULT NULL,
  `roleuserfch` DATETIME NULL DEFAULT NULL,
  `roleuserexp` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`usercod`, `rolescod`),
  INDEX `rol_usuario_key_idx` (`rolescod` ASC) VISIBLE,
  CONSTRAINT `rol_usuario_key`
    FOREIGN KEY (`rolescod`)
    REFERENCES `the_silicon_store`.`roles` (`rolescod`),
  CONSTRAINT `usuario_rol_key`
    FOREIGN KEY (`usercod`)
    REFERENCES `the_silicon_store`.`usuario` (`usercod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

DELIMITER $$
CREATE TRIGGER ReducirStock after INSERT on documento_fiscal_lineas
for each row
BEGIN
	UPDATE inventario SET cantidad = cantidad - (new.docCtd) where invPrdId = (new.invPrdId);
    
END$$
DELIMITER ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
