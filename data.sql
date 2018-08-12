CREATE TABLE `blog_category` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(200) NOT NULL,
	`parent` INT(11) NULL DEFAULT NULL,
	`description` VARCHAR(500) NULL DEFAULT NULL,
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`sort_order` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `FK_blog_category_blog_category` (`parent`),
	CONSTRAINT `FK_blog_category_blog_category` FOREIGN KEY (`parent`) REFERENCES `blog_category` (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;
