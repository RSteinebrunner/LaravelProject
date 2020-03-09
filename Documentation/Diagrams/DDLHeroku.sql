-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema heroku_99500d1c89b2e4b
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema heroku_99500d1c89b2e4b
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `heroku_99500d1c89b2e4b` DEFAULT CHARACTER SET latin1 ;
USE `heroku_99500d1c89b2e4b` ;

-- -----------------------------------------------------
-- Table `heroku_99500d1c89b2e4b`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_99500d1c89b2e4b`.`user` (
  `userId` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  `firstName` VARCHAR(45) NULL DEFAULT NULL,
  `lastName` VARCHAR(45) NULL DEFAULT NULL,
  `picture` VARCHAR(45) NULL DEFAULT NULL,
  `age` INT(11) NULL DEFAULT NULL,
  `gender` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(45) NULL DEFAULT NULL,
  `hometown` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(100) NULL DEFAULT NULL,
  `phoneNumber` VARCHAR(45) NULL DEFAULT NULL,
  `role` VARCHAR(45) NULL DEFAULT NULL,
  `isSuspended` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`userId`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `heroku_99500d1c89b2e4b`.`education`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_99500d1c89b2e4b`.`education` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `yearsAttended` INT(11) NOT NULL,
  `degree` VARCHAR(150) NOT NULL,
  `school` VARCHAR(100) NOT NULL,
  `userId` INT(11) NOT NULL,
  `gpa` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `userId` (`userId` ASC),
  CONSTRAINT `education_ibfk_1`
    FOREIGN KEY (`userId`)
    REFERENCES `heroku_99500d1c89b2e4b`.`user` (`userId`))
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `heroku_99500d1c89b2e4b`.`groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_99500d1c89b2e4b`.`groups` (
  `groupId` INT(11) NOT NULL AUTO_INCREMENT,
  `groupName` VARCHAR(45) NOT NULL,
  `description` VARCHAR(120) NOT NULL,
  `userId` INT(11) NOT NULL,
  PRIMARY KEY (`groupId`),
  INDEX `fk_groups_user1_idx` (`userId` ASC),
  CONSTRAINT `fk_groups_user1`
    FOREIGN KEY (`userId`)
    REFERENCES `heroku_99500d1c89b2e4b`.`user` (`userId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `heroku_99500d1c89b2e4b`.`jobhistory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_99500d1c89b2e4b`.`jobhistory` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `userId` INT(11) NOT NULL,
  `company` VARCHAR(100) NOT NULL,
  `position` VARCHAR(100) NOT NULL,
  `startDate` VARCHAR(100) NOT NULL,
  `endDate` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `userId` (`userId` ASC),
  CONSTRAINT `jobhistory_ibfk_1`
    FOREIGN KEY (`userId`)
    REFERENCES `heroku_99500d1c89b2e4b`.`user` (`userId`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `heroku_99500d1c89b2e4b`.`jobposting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_99500d1c89b2e4b`.`jobposting` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `company` VARCHAR(100) NOT NULL,
  `position` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `requirements` TEXT NOT NULL,
  `pay` VARCHAR(20) NOT NULL,
  `postingDate` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `heroku_99500d1c89b2e4b`.`skills`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_99500d1c89b2e4b`.`skills` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `userId` INT(11) NOT NULL,
  `skill` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `userId` (`userId` ASC),
  CONSTRAINT `skills_ibfk_1`
    FOREIGN KEY (`userId`)
    REFERENCES `heroku_99500d1c89b2e4b`.`user` (`userId`))
ENGINE = InnoDB
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `heroku_99500d1c89b2e4b`.`groupmembers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_99500d1c89b2e4b`.`groupmembers` (
  `userId` INT(11) NOT NULL,
  `groupId` INT(11) NOT NULL,
  INDEX `fk_user_has_groups_groups1_idx` (`groupId` ASC),
  INDEX `fk_user_has_groups_user1_idx` (`userId` ASC),
  CONSTRAINT `fk_user_has_groups_user1`
    FOREIGN KEY (`userId`)
    REFERENCES `heroku_99500d1c89b2e4b`.`user` (`userId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_has_groups_groups1`
    FOREIGN KEY (`groupId`)
    REFERENCES `heroku_99500d1c89b2e4b`.`groups` (`groupId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
user