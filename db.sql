-- noinspection SqlNoDataSourceInspectionForFile

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------



CREATE TABLE `user` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(200) NOT NULL,
	`email` VARCHAR(200) NOT NULL,
	`password` VARCHAR(200) NOT NULL,
	`profession` VARCHAR(100) NULL DEFAULT NULL,
	`hobby` VARCHAR(500) NULL DEFAULT NULL,
	`bio` VARCHAR(200) NULL DEFAULT NULL,
	`role` ENUM('A','M','U') NOT NULL DEFAULT 'U',
	`is_active` ENUM('Y','N') NOT NULL DEFAULT 'N',
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `email` (`email`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;





CREATE TABLE `blog_category` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(200) NOT NULL,
	`parent` INT(11) NULL DEFAULT NULL,
	`description` VARCHAR(500) NULL DEFAULT NULL,
	`meta` VARCHAR(500) NULL DEFAULT NULL,
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`sort_index` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `name` (`name`),
	INDEX `FK_blog_category_blog_category` (`parent`),
	CONSTRAINT `FK_blog_category_blog_category` FOREIGN KEY (`parent`) REFERENCES `blog_category` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;





CREATE TABLE `blog_post` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(250) NOT NULL,
	`summary` VARCHAR(1000) NOT NULL,
	`description` TEXT NOT NULL,
  `meta` VARCHAR(500) NULL DEFAULT NULL,
	`category` INT(11) NULL DEFAULT NULL,
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`sort_index` INT(11) NULL DEFAULT '0',
	`created_by` INT(11) NULL DEFAULT NULL,
	`is_active` ENUM('Y','N') NOT NULL DEFAULT 'N',
	`is_featured` ENUM('Y','N') NULL DEFAULT 'N',
	`views` INT(11) NULL DEFAULT '0',
	`image` VARCHAR(250) NULL DEFAULT NULL,
	`thumb` VARCHAR(250) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `name` (`name`),
	INDEX `FK_blog_post_blog_category` (`category`),
	INDEX `FK_blog_post_user` (`created_by`),
	CONSTRAINT `FK_blog_post_blog_category` FOREIGN KEY (`category`) REFERENCES `blog_category` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
	CONSTRAINT `FK_blog_post_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;





CREATE TABLE `blog_comment` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(5000) NOT NULL,
	`post` INT(11) NOT NULL,
	`created_by` INT(11) NULL DEFAULT NULL,
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`is_active` ENUM('Y','N') NOT NULL DEFAULT 'N',
	PRIMARY KEY (`id`),
	INDEX `FK_blog_comment_blog_post` (`post`),
	INDEX `FK_blog_comment_user` (`created_by`),
	CONSTRAINT `FK_blog_comment_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;


CREATE TABLE `page` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(150) NOT NULL,
	`heading` VARCHAR(250) NULL DEFAULT NULL,
	`uri` VARCHAR(250) NOT NULL DEFAULT '0',
	`post` INT(11) NULL DEFAULT NULL,
	`content` TEXT NULL,
  `meta` VARCHAR(500) NULL DEFAULT NULL,
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`is_active` ENUM('Y','N') NOT NULL DEFAULT 'N',
	`created_by` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `uri` (`uri`),
	INDEX `FK_page_blog_post` (`post`),
	INDEX `FK_page_user` (`created_by`),
	CONSTRAINT `FK_page_blog_post` FOREIGN KEY (`post`) REFERENCES `blog_post` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
	CONSTRAINT `FK_page_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;



CREATE TABLE `navigation` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL,
	`type` ENUM('PAGE','POST') NULL DEFAULT NULL,
	`uri` VARCHAR(300) NULL DEFAULT NULL,
	`parent` INT(11) NULL DEFAULT NULL,
	`is_active` ENUM('Y','N') NOT NULL DEFAULT 'N',
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`created_by` INT(11) NULL DEFAULT NULL,
	`sort_index` INT(11) NULL DEFAULT '0',
	`target` ENUM('_SELF','_TOP', '_BLANK', '_PARENT') NULL DEFAULT '_SELF',
	PRIMARY KEY (`id`),
	INDEX `FK_navigation_navigation` (`parent`),
	INDEX `FK_navigation_user` (`created_by`),
	CONSTRAINT `FK_navigation_navigation` FOREIGN KEY (`parent`) REFERENCES `navigation` (`id`) ON UPDATE CASCADE,
	CONSTRAINT `FK_navigation_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;



-- initial data
INSERT INTO `user` (`id`, `name`, `email`, `password`, `profession`, `hobby`, `bio`, `role`, `is_active`) VALUES
	(1, 'Administrator', 'admin@ciblog.com', '21232f297a57a5a743894a0e4a801fc3', 'Student', 'Programming;cooking;playing;listaning song', 'I am a simple one', 'A', 'Y'),
	(2, 'User', 'user@ciblog.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'Student', 'Programming;cooking;playing;listaning song', 'I am a simple one', 'U', 'Y');


INSERT INTO `navigation` (`id`, `name`, `type`, `uri`, `parent`, `is_active`, `created`, `updated`, `created_by`, `sort_index`) VALUES
	(1, 'Home', NULL, NULL, NULL, 'Y', '2018-10-22 15:51:10', '2018-10-22 15:58:21', 1, 0),
	(2, 'Featured', NULL, 'category/featured', NULL, 'Y', '2018-10-22 15:53:43', '2018-10-22 16:00:01', 1, 1),
	(3, 'Latest', NULL, 'category/latest', NULL, 'Y', '2018-10-22 15:54:20', '2018-10-22 16:00:04', 1, 2),
	(4, 'Most Popular', NULL, 'category/popular', NULL, 'Y', '2018-10-22 15:55:18', '2018-10-22 16:00:06', 1, 3);
