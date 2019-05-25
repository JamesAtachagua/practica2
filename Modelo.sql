-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Pinateca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Pinateca` (
  `idPinateca` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `ciudad` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `metrosCuadrados` INT NULL,
  `cantidadCuadros` INT NULL,
  PRIMARY KEY (`idPinateca`),
  UNIQUE INDEX `ciudad_UNIQUE` (`ciudad` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`MaestrosPintor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`MaestrosPintor` (
  `idMaestrosPintor` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `pais` VARCHAR(45) NULL,
  `ciudad` VARCHAR(45) NULL,
  `fechaNacimiento` VARCHAR(45) NULL,
  `fechaFallecimiento` VARCHAR(45) NULL,
  `idPintor` INT NOT NULL,
  PRIMARY KEY (`idMaestrosPintor`),
  INDEX `fk_MaestrosPintor_Pintor1_idx` (`idPintor` ASC) VISIBLE,
  CONSTRAINT `fk_MaestrosPintor_Pintor1`
    FOREIGN KEY (`idPintor`)
    REFERENCES `mydb`.`Pintor` (`idPintor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Escuela`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Escuela` (
  `idEscuela` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `pais` VARCHAR(45) NULL,
  `fechaCreacion` DATE NULL,
  PRIMARY KEY (`idEscuela`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Mecenas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Mecenas` (
  `idMecenas` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `pais` VARCHAR(45) NULL,
  `ciudadNacimiento` VARCHAR(45) NULL,
  `fechaFallecimiento` DATE NULL,
  `fechaInicio` DATE NULL,
  `fechaFin` DATE NULL,
  `idPintor` INT NOT NULL,
  PRIMARY KEY (`idMecenas`),
  INDEX `fk_Mecenas_Pintor1_idx` (`idPintor` ASC) VISIBLE,
  CONSTRAINT `fk_Mecenas_Pintor1`
    FOREIGN KEY (`idPintor`)
    REFERENCES `mydb`.`Pintor` (`idPintor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Pintor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Pintor` (
  `idPintor` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `pais` VARCHAR(45) NULL,
  `ciudad` VARCHAR(45) NULL,
  `fechaNacimiento` DATE NULL,
  `fechaFallecimiento` DATE NULL,
  `idMaestrosPintor` INT NOT NULL,
  `idEscuela` INT NOT NULL,
  `idMecenas` INT NOT NULL,
  `foto` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idPintor`),
  INDEX `fk_Pintor_MaestrosPintor1_idx` (`idMaestrosPintor` ASC) VISIBLE,
  INDEX `fk_Pintor_Escuela1_idx` (`idEscuela` ASC) VISIBLE,
  INDEX `fk_Pintor_Mecenas1_idx` (`idMecenas` ASC) VISIBLE,
  CONSTRAINT `fk_Pintor_MaestrosPintor1`
    FOREIGN KEY (`idMaestrosPintor`)
    REFERENCES `mydb`.`MaestrosPintor` (`idMaestrosPintor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pintor_Escuela1`
    FOREIGN KEY (`idEscuela`)
    REFERENCES `mydb`.`Escuela` (`idEscuela`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pintor_Mecenas1`
    FOREIGN KEY (`idMecenas`)
    REFERENCES `mydb`.`Mecenas` (`idMecenas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Cuadros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cuadros` (
  `idCuadros` INT NOT NULL,
  `codigo` VARCHAR(45) NULL,
  `nombre` VARCHAR(45) NULL,
  `medidas` VARCHAR(45) NULL,
  `fechaPintado` DATE NULL,
  `tecnicaPintado` VARCHAR(45) NULL,
  `idPinateca` INT NOT NULL,
  `idPintor` INT NOT NULL,
  PRIMARY KEY (`idCuadros`, `idPinateca`, `idPintor`),
  INDEX `fk_Cuadros_Pinateca1_idx` (`idPinateca` ASC) VISIBLE,
  INDEX `fk_Cuadros_Pintor1_idx` (`idPintor` ASC) VISIBLE,
  CONSTRAINT `fk_Cuadros_Pinateca1`
    FOREIGN KEY (`idPinateca`)
    REFERENCES `mydb`.`Pinateca` (`idPinateca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cuadros_Pintor1`
    FOREIGN KEY (`idPintor`)
    REFERENCES `mydb`.`Pintor` (`idPintor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
