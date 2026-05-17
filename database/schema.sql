-- Vcare Kids local database schema
-- Import: mysql -u root -p vannitamil_vanni < database/schema.sql

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'admin',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `donars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `donarfullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  `address` text,
  `photo` longblob,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `Details` text,
  `Casestatus` varchar(100) DEFAULT NULL,
  `file_number` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `whatsapp_number` varchar(50) DEFAULT NULL,
  `parent_phone_number` varchar(50) DEFAULT NULL,
  `parentname` varchar(255) DEFAULT NULL,
  `parentaddress` varchar(255) DEFAULT NULL,
  `permanentaddress` varchar(255) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `donar_id` bigint unsigned NOT NULL DEFAULT 0,
  `gender` varchar(20) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `schoolname` varchar(255) DEFAULT NULL,
  `familyincome` varchar(100) DEFAULT NULL,
  `parentjob` varchar(255) DEFAULT NULL,
  `bankname` varchar(255) DEFAULT NULL,
  `bankbranch` varchar(255) DEFAULT NULL,
  `accountnumber` varchar(100) DEFAULT NULL,
  `holdername` varchar(255) DEFAULT NULL,
  `image` longblob,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `students_donar_id` (`donar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `advertisement_image` longblob,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `cases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `activity_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `link` varchar(500) DEFAULT NULL,
  `image` longblob,
  `category_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `news_category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `donation` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `image` longblob,
  `status` varchar(20) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `student_donations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `studentid` bigint unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `path` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_donations_studentid` (`studentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `pdf_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `studentid` bigint unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `path` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pdf_documents_studentid` (`studentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;

-- Default admin (password: admin123) — change after first login
INSERT INTO `users` (`name`, `email`, `usertype`, `password`)
SELECT 'Administrator', 'admin@vcarekids.com', 'admin', MD5('admin123')
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `users` WHERE `email` = 'admin@vcarekids.com');
