-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------


-- Dumping structure for table ciblog.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `hobby` varchar(500) DEFAULT NULL,
  `bio` varchar(200) DEFAULT NULL,
  `type` enum('A','M','U') NOT NULL DEFAULT 'U',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping structure for table ciblog.blog_category
CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sort_index` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `FK_blog_category_blog_category` (`parent`),
  CONSTRAINT `FK_blog_category_blog_category` FOREIGN KEY (`parent`) REFERENCES `blog_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;


-- Dumping structure for table ciblog.blog_post
CREATE TABLE `blog_post` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(250) NOT NULL,
	`description` TEXT NOT NULL,
	`category` INT(11) NULL DEFAULT NULL,
	`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`sort_index` INT(11) NOT NULL DEFAULT '0',
	`created_by` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `name` (`name`),
	INDEX `FK_blog_post_blog_category` (`category`),
	INDEX `FK_blog_post_user` (`created_by`),
	CONSTRAINT `FK_blog_post_blog_category` FOREIGN KEY (`category`) REFERENCES `blog_category` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
	CONSTRAINT `FK_blog_post_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;


-- Dumping structure for table ciblog.blog_comment
CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(5000) NOT NULL,
  `post` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_blog_comment_blog_post` (`post`),
  KEY `FK_blog_comment_user` (`user`),
  CONSTRAINT `FK_blog_comment_blog_post` FOREIGN KEY (`post`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_blog_comment_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




--insert initial data
INSERT INTO `user` (`id`, `name`, `email`, `password`, `profession`, `hobby`, `bio`, `type`) VALUES (1, 'Administrator', 'admin@admin.com', 'admin', 'Student', 'Programming;cooking;playing;listaning song', 'I am a simple one', 'A');
