CREATE TABLE IF NOT EXISTS `#__image_upload` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`state` TINYINT(1)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`image` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

