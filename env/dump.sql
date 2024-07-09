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

INSERT INTO `particles`
VALUES (
        '1fb5fcd9-f4f0-45c2-873e-a407ac305e93',
        'positive'
    ), (
        '304766b2-6e34-4be5-a636-2f22f36ef299',
        'positive'
    ), (
        '3f97dbe9-4d58-4f15-88ea-bc0efb8cabea',
        'negative'
    ), (
        '4ab7bbfc-04c6-4599-8c9b-a8c4f7dc8e78',
        'positive'
    ), (
        '64387c38-c372-4b77-834a-c1b75983d280',
        'negative'
    ), (
        '752dd640-dac0-43b5-bed8-49a04ec4d25f',
        'negative'
    ), (
        '7788f8d9-c44c-4dbe-9fc3-e4b65243c143',
        'positive'
    ), (
        '957e77ca-19b5-4cf9-9841-74d1b38080a6',
        'negative'
    ), (
        '9db165bb-9ffb-4240-8418-2b2af8915098',
        'positive'
    ), (
        'a46d86f8-d722-4300-a35c-cdc58650d27f',
        'negative'
    ), (
        'ba80ffc2-fb62-4872-9e3b-27bdce20dc1b',
        'negative'
    ), (
        'ba95aba6-05aa-4640-9341-95488e402e8c',
        'positive'
    ), (
        'be1a0a8d-9ad5-44ad-a22c-8a6dfaac393e',
        'positive'
    );

CREATE USER 'web'@'localhost' IDENTIFIED BY 'web';

GRANT ALL PRIVILEGES ON goldberg.* TO 'web'@'%';