-- Adminer 4.8.1 MySQL 5.7.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'admin@email.com',	'$2y$10$hNEq4KMfBxoJwWC2badNN.dYhy6iCO6oRlXjFqzMbJW4s3WBeUIvC',	1,	'I5l2B65npIYICJnRxD1a2IpHQ3ZgSSt1sbe0aM9jESroQK1hczFKYCUl98Qw',	'2022-03-10 07:55:21',	'2022-03-15 01:50:27');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11,	'2014_10_12_000000_create_users_table',	1),
(12,	'2014_10_12_100000_create_password_resets_table',	1),
(13,	'2017_03_06_023521_create_admins_table',	1),
(16,	'2019_08_19_000000_create_failed_jobs_table',	1),
(20,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(21,	'2022_03_15_081619_create_notifications_table',	2);

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('primary','info','success','warning','danger') COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_admin_id_foreign` (`admin_id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `notifications` (`id`, `title`, `text`, `url`, `icon`, `type`, `to`, `admin_id`, `user_id`, `read_at`, `created_at`, `updated_at`) VALUES
(1,	'Welcome !',	'Welcome to our laravel app.\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters',	NULL,	'icon-heart',	'primary',	'admin',	1,	NULL,	'2022-03-16 06:03:13',	'2022-03-15 18:05:32',	'2022-03-16 06:03:13'),
(2,	'Test',	'This will specifically look for the admin guard and nothing else so guest means that the admin is not logged in and it doesn’t care if a user from web guard is logged in or not.',	'http://localhost/startup-laravel',	NULL,	'info',	'user',	NULL,	1,	NULL,	'2022-03-16 03:32:11',	'2022-03-16 03:32:11');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('user@email.com',	'$2y$10$ol3da27Xh.y.qRfA/8Uvaudy8M8mZ9qab7MeUYjt2w3WQLEOvuI8.',	'2022-03-10 04:48:11');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `block` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `block_notes` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `image`, `notes`, `block`, `block_notes`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'user',	'user@email.com',	'0552872008',	'$2y$10$zv3HLm8i/71n1VzrYqYG9.TYsm2RpWFrpyjE96i/7o74UG8aIrmTC',	'1647168575_1.jpg',	NULL,	0,	NULL,	'2022-03-10 07:55:44',	'aII5V3UNQDZJQhSnTMaJAMZJ8UKfhmJb6twaczEwF4dBimaSOELzOsINza7D',	'2022-03-10 07:55:44',	'2022-03-13 06:49:35'),
(2,	'test',	'test@email.com',	'0552872009',	'$2y$10$KYhjOINViohQgmcH5DcyYeKfsYS1RCVzTKoP/w330s6.PdapJW3/e',	'1647329719_8.jpg',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.',	1,	'Test account added by app admin!',	NULL,	NULL,	'2022-03-15 03:30:29',	'2022-03-15 03:35:19');

-- 2022-03-16 10:29:32
