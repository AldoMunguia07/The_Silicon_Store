

CREATE TABLE IF NOT EXISTS `nw202201`.`IntentosPagos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `cliente` VARCHAR(128) NOT NULL,
  `monto` DECIMAL(13,2) NULL,
  `fechaVencimiento` DATE NOT NULL,
   `estado` ENUM('ENV','PGD','CNL','ERR') NOT NULL,
  PRIMARY KEY (`id`)
  )


