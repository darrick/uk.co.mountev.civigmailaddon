-- Table to store API request and response
CREATE TABLE IF NOT EXISTS `gmailaddon_log` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `datetime` DATETIME NOT NULL ,
  `entity` VARCHAR(50) NOT NULL ,
  `action` VARCHAR(50) NOT NULL ,
  `request_type` VARCHAR(50) NOT NULL ,
  `request` LONGTEXT NOT NULL ,
  `response` LONGTEXT NOT NULL ,
  `params` LONGTEXT NOT NULL ,
  PRIMARY KEY (`id`) );