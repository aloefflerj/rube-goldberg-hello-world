CREATE DATABASE IF NOT EXISTS `goldberg`;

USE `goldberg`;

SET GLOBAL tmp_table_size = 208003028;

CREATE TABLE
    IF NOT EXISTS `users` (
        `id` CHAR(36) NOT NULL,
        `username` varchar(40) NOT NULL,
        `mail` varchar(70) NOT NULL,
        `passwd` char(255) NOT NULL,
        `user_type` ENUM('app', 'adm', 'dba') NOT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    IF NOT EXISTS `particles` (
        `id` CHAR(36) NOT NULL,
        `charge` ENUM('negative', 'positive') NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;