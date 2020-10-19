CREATE SCHEMA  `vaDF`;
USE `vaDF` ;




-- -----------------------------------------------------
-- Table `vaDF`.`tbl_jogador`
-- -----------------------------------------------------
CREATE TABLE `tbl_jogador` (
  `id_jogador` INT NOT NULL AUTO_INCREMENT,
  `nome_jogador` VARCHAR(200) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `token` VARCHAR(100) NULL,
  `dtultconexao` DATETIME,
  `coordenadas` VARCHAR(100) NOT NULL,
  `experiencia` INT NOT NULL,
  `titulo` VARCHAR(45) NOT NULL,
  `email_confirmado` INT DEFAULT 0,
  `ativo` VARCHAR(45) INT DEFAULT 1,
  PRIMARY KEY (`id_jogador`));


-- -----------------------------------------------------
-- Table `vaDF`.`tbl_funcionarios`
-- -----------------------------------------------------
CREATE TABLE `tbl_funcionarios` (
  `matricula` INT NOT NULL AUTO_INCREMENT,
  `nome_funcionario` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `token` VARCHAR(100) NULL,
  `dtultconexao` DATETIME,
  `ativo` VARCHAR(45) INT DEFAULT 1
  PRIMARY KEY (`matricula`));


-- -----------------------------------------------------
-- Table `vaDF`.`tbl_badges`
-- -----------------------------------------------------
CREATE TABLE `tbl_badges` (
  `id_badge` INT NOT NULL AUTO_INCREMENT,
  `nome_badge` VARCHAR(100) NOT NULL,
  `requisito` VARCHAR(100) NOT NULL,
  `url_imagem` VARCHAR(300) NOT NULL,
  `experiencia` INT NOT NULL,
  `matricula_cadastro` INT NOT NULL,
  PRIMARY KEY (`id_badge`),
  INDEX `fk_tbl_badges_tbl_funcionarios1_idx` (`matricula_cadastro` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_badges_tbl_funcionarios1`
    FOREIGN KEY (`matricula_cadastro`)
    REFERENCES `vaDF`.`tbl_funcionarios` (`matricula`));


-- -----------------------------------------------------
-- Table `vaDF`.`tbl_circuitos`
-- -----------------------------------------------------
CREATE TABLE `tbl_circuitos` (
  `id_circuito` INT NOT NULL AUTO_INCREMENT,
  `nome_circuito` VARCHAR(100) NOT NULL,
  `experiencia` INT NOT NULL,
  `matricula_cadastro` INT NOT NULL,
  `id_badge` INT NOT NULL,
  PRIMARY KEY (`id_circuito`),
  INDEX `fk_tbl_circuitos_tbl_funcionarios1_idx` (`matricula_cadastro` ASC) VISIBLE,
  INDEX `fk_tbl_circuitos_tbl_badges1_idx` (`id_badge` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_circuitos_tbl_funcionarios1`
    FOREIGN KEY (`matricula_cadastro`)
    REFERENCES `vaDF`.`tbl_funcionarios` (`matricula`),
  CONSTRAINT `fk_tbl_circuitos_tbl_badges1`
    FOREIGN KEY (`id_badge`)
    REFERENCES `vaDF`.`tbl_badges` (`id_badge`));


-- -----------------------------------------------------
-- Table `vaDF`.`tbl_pontos_turisticos`
-- -----------------------------------------------------
CREATE TABLE `tbl_pontos_turisticos` (
  `id_ponto_turistico` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `experiencia` INT NOT NULL DEFAULT 0,
  `url_imagem` VARCHAR(300) NOT NULL,
  `descricao` VARCHAR(1000) NOT NULL,
  `matricula_cadastro` INT NOT NULL,
  `id_badge` INT NOT NULL,
  PRIMARY KEY (`id_ponto_turistico`),
  INDEX `fk_tbl_pontos_turisticos_tbl_funcionarios1_idx` (`matricula_cadastro` ASC) VISIBLE,
  INDEX `fk_tbl_pontos_turisticos_tbl_badges1_idx` (`id_badge` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_pontos_turisticos_tbl_funcionarios1`
    FOREIGN KEY (`matricula_cadastro`)
    REFERENCES `vaDF`.`tbl_funcionarios` (`matricula`),
  CONSTRAINT `fk_tbl_pontos_turisticos_tbl_badges1`
    FOREIGN KEY (`id_badge`)
    REFERENCES `vaDF`.`tbl_badges` (`id_badge`));


-- -----------------------------------------------------
-- Table `vaDF`.`tbl_circuitos_pontos_turisticos`
-- -----------------------------------------------------
CREATE TABLE `tbl_circuitos_pontos_turisticos` (
  `id_circuito` INT NOT NULL,
  `id_ponto_turistico` INT NOT NULL,
  INDEX `fk_tbl_circuitos_has_tbl_pontos_turisticos_tbl_pontos_turis_idx` (`id_ponto_turistico` ASC) VISIBLE,
  INDEX `fk_tbl_circuitos_has_tbl_pontos_turisticos_tbl_circuitos_idx` (`id_circuito` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_circuitos_has_tbl_pontos_turisticos_tbl_circuitos`
    FOREIGN KEY (`id_circuito`)
    REFERENCES `vaDF`.`tbl_circuitos` (`id_circuito`),
  CONSTRAINT `fk_tbl_circuitos_has_tbl_pontos_turisticos_tbl_pontos_turisti1`
    FOREIGN KEY (`id_ponto_turistico`)
    REFERENCES `vaDF`.`tbl_pontos_turisticos` (`id_ponto_turistico`));


-- -----------------------------------------------------
-- Table `vaDF`.`tbl_jogador_badge`
-- -----------------------------------------------------
CREATE TABLE `tbl_jogador_badge` (
  `id_jogador` INT NOT NULL,
  `id_badge` INT NOT NULL,
  INDEX `fk_tbl_jogador_has_tbl_badges_tbl_badges1_idx` (`id_badge` ASC) VISIBLE,
  INDEX `fk_tbl_jogador_has_tbl_badges_tbl_jogador1_idx` (`id_jogador` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_jogador_has_tbl_badges_tbl_jogador1`
    FOREIGN KEY (`id_jogador`)
    REFERENCES `vaDF`.`tbl_jogador` (`id_jogador`),
  CONSTRAINT `fk_tbl_jogador_has_tbl_badges_tbl_badges1`
    FOREIGN KEY (`id_badge`)
    REFERENCES `vaDF`.`tbl_badges` (`id_badge`));


-- -----------------------------------------------------
-- Table `vaDF`.`tbl_jogador_pontos_turisticos`
-- -----------------------------------------------------
CREATE TABLE `tbl_jogador_pontos_turisticos` (
  `id_jogador` INT NOT NULL,
  `id_ponto_turistico` INT NOT NULL,
  INDEX `fk_tbl_jogador_has_tbl_pontos_turisticos_tbl_pontos_turisti_idx` (`id_ponto_turistico` ASC) VISIBLE,
  INDEX `fk_tbl_jogador_has_tbl_pontos_turisticos_tbl_jogador1_idx` (`id_jogador` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_jogador_has_tbl_pontos_turisticos_tbl_jogador1`
    FOREIGN KEY (`id_jogador`)
    REFERENCES `vaDF`.`tbl_jogador` (`id_jogador`),
  CONSTRAINT `fk_tbl_jogador_has_tbl_pontos_turisticos_tbl_pontos_turisticos1`
    FOREIGN KEY (`id_ponto_turistico`)
    REFERENCES `vaDF`.`tbl_pontos_turisticos` (`id_ponto_turistico`));


-- -----------------------------------------------------
-- Table `vaDF`.`tbl_jogador_circuito`
-- -----------------------------------------------------
CREATE TABLE `tbl_jogador_circuito` (
  `id_jogador` INT NOT NULL,
  `id_circuito` INT NOT NULL,
  INDEX `fk_tbl_jogador_has_tbl_circuitos_tbl_circuitos1_idx` (`id_circuito` ASC) VISIBLE,
  INDEX `fk_tbl_jogador_has_tbl_circuitos_tbl_jogador1_idx` (`id_jogador` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_jogador_has_tbl_circuitos_tbl_jogador1`
    FOREIGN KEY (`id_jogador`)
    REFERENCES `vaDF`.`tbl_jogador` (`id_jogador`),
  CONSTRAINT `fk_tbl_jogador_has_tbl_circuitos_tbl_circuitos1`
    FOREIGN KEY (`id_circuito`)
    REFERENCES `vaDF`.`tbl_circuitos` (`id_circuito`));