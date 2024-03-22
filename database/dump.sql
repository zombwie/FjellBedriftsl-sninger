-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Fjeltickets
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Fjeltickets
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Fjeltickets` DEFAULT CHARACTER SET utf8 ;
USE `Fjeltickets` ;

-- -----------------------------------------------------
-- Table `Fjeltickets`.`Brukere`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fjeltickets`.`Brukere` (
  `idBrukere` INT NOT NULL AUTO_INCREMENT,
  `Username` VARCHAR(255) NOT NULL,
  `Pass` VARCHAR(255) NOT NULL,
  `Perms` INT NULL,
  PRIMARY KEY (`idBrukere`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Fjeltickets`.`Tickets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fjeltickets`.`Tickets` (
  `TicketID` INT NOT NULL AUTO_INCREMENT,
  `UserID` INT NOT NULL,
  `Title` VARCHAR(255) NOT NULL,
  `Inhold` LONGTEXT NOT NULL,
  `Status` INT NULL,
  PRIMARY KEY (`TicketID`),
  INDEX `fk_Tickets_Brukere_idx` (`UserID` ASC) VISIBLE,
  CONSTRAINT `fk_Tickets_Brukere`
    FOREIGN KEY (`UserID`)
    REFERENCES `Fjeltickets`.`Brukere` (`idBrukere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
