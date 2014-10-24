CREATE TABLE IF NOT EXISTS `#__dolo_campaign` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`created_by` INT(11)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`start_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`end_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`brandid` INT NOT NULL ,
`campaigntype_id` INT NOT NULL ,
`campaignstatus_id` INT NOT NULL ,
`impressions` INT(10)  NOT NULL ,
`hero_images` TEXT NOT NULL ,
`keywords` TEXT NOT NULL ,
`collaborators` TEXT NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__dolo_brand` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`created_by` INT(11)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__dolo_campaigntype` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`created_by` INT(11)  NOT NULL ,
`type` VARCHAR(255)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__dolo_campaignstatus` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`created_by` INT(11)  NOT NULL ,
`status` VARCHAR(255)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__dolo_account` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`created_by` INT(11)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__dolo_account_brand_mapping` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`created_by` INT(11)  NOT NULL ,
`account_id` INT NOT NULL ,
`brand_id` INT NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__dolo_account_user_mapping` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`state` TINYINT(1)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`user_id` INT NOT NULL ,
`account_id` INT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__dolo_user_brand_mapping` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`state` TINYINT(1)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`user_id` INT NOT NULL ,
`brand_id` INT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

