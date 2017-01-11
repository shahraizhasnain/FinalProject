/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : life_line_today_1

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-04-21 20:22:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cities
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(60) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(5) NOT NULL,
  `country_name` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for diseases
-- ----------------------------
DROP TABLE IF EXISTS `diseases`;
CREATE TABLE `diseases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` enum('INACTIVE','ACTIVE') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for images_thumbs
-- ----------------------------
DROP TABLE IF EXISTS `images_thumbs`;
CREATE TABLE `images_thumbs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_file_uploads_id` int(11) NOT NULL DEFAULT '0',
  `thumb_path` text,
  `thumb_width` int(11) DEFAULT NULL,
  `thumb_height` int(11) DEFAULT NULL,
  `size_type` enum('SMALL','MEDIUM','LARGE','XLARGE','SQUARE') DEFAULT NULL,
  `thumb_type` enum('IMAGETHUMB','VIDEOTHUMB') DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') DEFAULT 'INACTIVE',
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for patients
-- ----------------------------
DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) DEFAULT NULL,
  `gender` enum('FEMALE','MALE') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(55) DEFAULT NULL,
  `cell_number` varchar(55) DEFAULT NULL,
  `postal_address` varchar(255) DEFAULT NULL,
  `zip_code` varchar(55) DEFAULT NULL,
  `prefered_contact` enum('HOME','CELL') DEFAULT NULL COMMENT 'Means which Contact Number to be preferd phone_number or mobile_number',
  `relation_with_user` varchar(55) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `is_active` enum('INACTIVE','ACTIVE') DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for patients_diseases
-- ----------------------------
DROP TABLE IF EXISTS `patients_diseases`;
CREATE TABLE `patients_diseases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patients_id` int(11) NOT NULL,
  `diseases_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_diseases_id_1` (`diseases_id`),
  KEY `fk_patients_id_1` (`patients_id`),
  CONSTRAINT `fk_diseases_id_1` FOREIGN KEY (`diseases_id`) REFERENCES `diseases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_patients_id_1` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for patients_known_diseases
-- ----------------------------
DROP TABLE IF EXISTS `patients_known_diseases`;
CREATE TABLE `patients_known_diseases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patients_id` int(11) DEFAULT NULL,
  `patients_medical_history_id` int(11) DEFAULT NULL,
  `patients_known_disease` text,
  `patients_other_disease` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for patients_medical_history
-- ----------------------------
DROP TABLE IF EXISTS `patients_medical_history`;
CREATE TABLE `patients_medical_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patients_id` int(11) NOT NULL,
  `practioner_name` varchar(55) DEFAULT NULL COMMENT 'Means doctor',
  `practioner_contactnumber` varchar(55) DEFAULT NULL,
  `practioner_emailaddress` varchar(55) DEFAULT NULL,
  `practioner_clinicaddress` varchar(55) DEFAULT NULL,
  `practioner_type` enum('GENERAL','SPECIALIST') DEFAULT NULL COMMENT 'Means which type of Practioner',
  `patients_mobility` enum('NO ASSISTANCE','REQUIRES ASSISTANCE','WHEEL CHAIR BOUND','BED BOUND') DEFAULT NULL,
  `patients_known_allergies` text,
  PRIMARY KEY (`id`),
  KEY `fk_patients_id_4` (`patients_id`),
  CONSTRAINT `fk_patients_id_4` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for patients_practioners
-- ----------------------------
DROP TABLE IF EXISTS `patients_practioners`;
CREATE TABLE `patients_practioners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patients_id` int(11) NOT NULL,
  `practitioners_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_patients_id_2` (`patients_id`),
  KEY `fk_practitioners_id_1` (`practitioners_id`),
  CONSTRAINT `fk_patients_id_2` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_practitioners_id_1` FOREIGN KEY (`practitioners_id`) REFERENCES `practitioner` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for practitioner
-- ----------------------------
DROP TABLE IF EXISTS `practitioner`;
CREATE TABLE `practitioner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) DEFAULT NULL,
  `gender` enum('FEMALE','MALE') DEFAULT NULL,
  `email_address` varchar(55) DEFAULT NULL,
  `phone_number` varchar(55) DEFAULT NULL,
  `cell_number` varchar(55) DEFAULT NULL,
  `clinic_address` varchar(255) DEFAULT NULL,
  `country_name` varchar(55) DEFAULT NULL,
  `city_name` varchar(55) DEFAULT NULL,
  `zip_code` varchar(55) DEFAULT NULL,
  `prefered_contact` enum('HOME','CELL') DEFAULT NULL COMMENT 'Means which Contact Number to be preferd phone_number or mobile_number',
  `practitioner_type` enum('GENERAL','SPECIALIST') DEFAULT NULL COMMENT 'Means which type of Practioner',
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `is_active` enum('INACTIVE','ACTIVE') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for session
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `user_agent` varchar(100) DEFAULT NULL,
  `client_id` text,
  `session_token` text,
  `os` varchar(15) DEFAULT NULL,
  `os_version` float(4,0) DEFAULT NULL,
  `browser_name` varchar(15) DEFAULT NULL,
  `browser_major_version` varchar(15) DEFAULT NULL,
  `browser_full_version` varchar(25) DEFAULT NULL,
  `is_mobile` tinyint(1) DEFAULT NULL,
  `is_retina` tinyint(1) DEFAULT NULL,
  `is_high_density` tinyint(1) DEFAULT NULL,
  `flash_version` int(15) DEFAULT NULL,
  `is_cookie` tinyint(1) DEFAULT NULL,
  `screen_size` varchar(25) DEFAULT NULL,
  `full_user_agent` varchar(55) DEFAULT NULL,
  `expirte_time` int(11) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for states
-- ----------------------------
DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state_name` varchar(70) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(55) NOT NULL COMMENT 'Means user_name will be valid email ',
  `user_password` varchar(55) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) DEFAULT NULL,
  `gender` enum('FEMALE','MALE') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone_number` varchar(55) DEFAULT NULL,
  `cell_number` varchar(55) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `zip_code` varchar(55) DEFAULT NULL,
  `prefered_contact` enum('HOME','CELL') DEFAULT NULL COMMENT 'Means which Contact Number to be preferd phone_number or mobile_number',
  `visit_type` enum('REFERED','SELF') DEFAULT NULL COMMENT 'Means user come from where by sellf or by refered by other',
  `profile_image_id` int(11) DEFAULT NULL,
  `cover_image_id` int(11) DEFAULT NULL,
  `last_login_datetime` datetime DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `is_active` enum('INACTIVE','ACTIVE') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for users_cart
-- ----------------------------
DROP TABLE IF EXISTS `users_cart`;
CREATE TABLE `users_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `plan_decided` text,
  `amount_to_pay` decimal(10,3) DEFAULT NULL,
  `total_count` int(11) NOT NULL DEFAULT '0',
  `is_active` enum('INACTIVE','ACTIVE') DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `is_order_finished` enum('CANCELED','OPEN','FINISHED') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for users_patients
-- ----------------------------
DROP TABLE IF EXISTS `users_patients`;
CREATE TABLE `users_patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `patients_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_patients_id_3` (`patients_id`),
  KEY `fk_users_id_1` (`users_id`),
  CONSTRAINT `fk_patients_id_3` FOREIGN KEY (`patients_id`) REFERENCES `patients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_id_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for user_file_uploads
-- ----------------------------
DROP TABLE IF EXISTS `user_file_uploads`;
CREATE TABLE `user_file_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `parent_type` enum('USERPROFILE','USERCOVER','PATIENTPROFILE','PATIENTCOVER','DEFAULTPROFILE') DEFAULT NULL,
  `file_type` enum('AUDIO','VIDEO','IMAGE') DEFAULT NULL,
  `file_name` text,
  `extension` varchar(55) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `path` text,
  `status` enum('ACTIVE','INACTIVE','USERDEACTIVATED') DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;
