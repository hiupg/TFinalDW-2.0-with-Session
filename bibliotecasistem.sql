-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bibliotecasistem
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bibliotecasistem
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bibliotecasistem` DEFAULT CHARACTER SET latin1 ;
USE `bibliotecasistem` ;

-- -----------------------------------------------------
-- Table `bibliotecasistem`.`biblioteca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliotecasistem`.`biblioteca` (
  `cnpj` VARCHAR(30) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `endereco` VARCHAR(45) NULL,
  `telefone` INT(9) NULL,
  PRIMARY KEY (`cnpj`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bibliotecasistem`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliotecasistem`.`cliente` (
  `cpf` INT(11) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `sobrenome` VARCHAR(45) NULL DEFAULT NULL,
  `sexo` VARCHAR(7) NULL DEFAULT NULL,
  `endereco` VARCHAR(45) NULL DEFAULT NULL,
  `telefone` INT(12) NULL DEFAULT NULL,
  `email` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`cpf`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bibliotecasistem`.`fornecedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliotecasistem`.`fornecedor` (
  `cnpj` VARCHAR(50) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `endereco` VARCHAR(45) NULL DEFAULT NULL,
  `cep` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `telefone` INT(12) NULL DEFAULT NULL,
  PRIMARY KEY (`cnpj`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bibliotecasistem`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliotecasistem`.`funcionario` (
  `cpf` INT(11) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `telefone` INT(11) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `sexo` VARCHAR(7) NULL DEFAULT NULL,
  `cargo` VARCHAR(45) NULL DEFAULT NULL,
  `endereco` VARCHAR(45) NULL,
  `biblioteca_cnpj` VARCHAR(30) NULL,
  PRIMARY KEY (`cpf`),
  INDEX `fk_funcionario_biblioteca1_idx` (`biblioteca_cnpj` ASC),
  CONSTRAINT `fk_funcionario_biblioteca1`
    FOREIGN KEY (`biblioteca_cnpj`)
    REFERENCES `bibliotecasistem`.`biblioteca` (`cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bibliotecasistem`.`livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliotecasistem`.`livro` (
  `id` INT(11) NOT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `genero` VARCHAR(45) NULL DEFAULT NULL,
  `faixaEtaria` VARCHAR(3) NULL DEFAULT NULL,
  `editora` VARCHAR(45) NULL DEFAULT NULL,
  `autor` VARCHAR(45) NULL DEFAULT NULL,
  `nDePaginas` INT(5) NULL DEFAULT NULL,
  `dataLanç` DATE NULL DEFAULT NULL,
  `cliente_cpf` INT(11) NULL,
  `biblioteca_cnpj` VARCHAR(30) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_livro_cliente1_idx` (`cliente_cpf` ASC),
  INDEX `fk_livro_biblioteca1_idx` (`biblioteca_cnpj` ASC),
  CONSTRAINT `fk_livro_cliente1`
    FOREIGN KEY (`cliente_cpf`)
    REFERENCES `bibliotecasistem`.`cliente` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro_biblioteca1`
    FOREIGN KEY (`biblioteca_cnpj`)
    REFERENCES `bibliotecasistem`.`biblioteca` (`cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `bibliotecasistem`.`fornecedor_fornece_livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bibliotecasistem`.`fornecedor_fornece_livro` (
  `fornecedor_cnpj` VARCHAR(50) NOT NULL,
  `livro_id` INT(11) NOT NULL,
  PRIMARY KEY (`fornecedor_cnpj`, `livro_id`),
  INDEX `fk_fornecedor_has_livro_livro1_idx` (`livro_id` ASC),
  INDEX `fk_fornecedor_has_livro_fornecedor1_idx` (`fornecedor_cnpj` ASC),
  CONSTRAINT `fk_fornecedor_has_livro_fornecedor1`
    FOREIGN KEY (`fornecedor_cnpj`)
    REFERENCES `bibliotecasistem`.`fornecedor` (`cnpj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fornecedor_has_livro_livro1`
    FOREIGN KEY (`livro_id`)
    REFERENCES `bibliotecasistem`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
