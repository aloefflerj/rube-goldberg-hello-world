CREATE DATABASE IF NOT EXISTS `goldberg`;

USE `goldberg`;

SET GLOBAL tmp_table_size = 208003028;

CREATE USER 'web' @'localhost' IDENTIFIED BY 'web';

GRANT ALL PRIVILEGES ON goldberg.* TO 'web' @'%';

CREATE TABLE IF NOT EXISTS `users` (
    `id` CHAR(36) NOT NULL,
    `username` varchar(40) NOT NULL,
    `mail` varchar(70) NOT NULL,
    `passwd` char(255) NOT NULL,
    `user_type` ENUM('app', 'adm', 'dba') NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- ------------------------

CREATE TABLE IF NOT EXISTS `particles` (
    `id` CHAR(36) NOT NULL,
    `charge` ENUM('negative', 'positive') NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `particles`
VALUES (
        '1fb5fcd9-f4f0-45c2-873e-a407ac305e93',
        'positive'
    ),
    (
        '304766b2-6e34-4be5-a636-2f22f36ef299',
        'positive'
    ),
    (
        '3f97dbe9-4d58-4f15-88ea-bc0efb8cabea',
        'negative'
    ),
    (
        '4ab7bbfc-04c6-4599-8c9b-a8c4f7dc8e78',
        'positive'
    ),
    (
        '64387c38-c372-4b77-834a-c1b75983d280',
        'negative'
    ),
    (
        '752dd640-dac0-43b5-bed8-49a04ec4d25f',
        'negative'
    ),
    (
        '7788f8d9-c44c-4dbe-9fc3-e4b65243c143',
        'positive'
    ),
    (
        '957e77ca-19b5-4cf9-9841-74d1b38080a6',
        'negative'
    ),
    (
        '9db165bb-9ffb-4240-8418-2b2af8915098',
        'positive'
    ),
    (
        'a46d86f8-d722-4300-a35c-cdc58650d27f',
        'negative'
    ),
    (
        'ba80ffc2-fb62-4872-9e3b-27bdce20dc1b',
        'negative'
    ),
    (
        'ba95aba6-05aa-4640-9341-95488e402e8c',
        'positive'
    ),
    (
        'be1a0a8d-9ad5-44ad-a22c-8a6dfaac393e',
        'positive'
    );

-- ------------------------
CREATE TABLE IF NOT EXISTS `steps` (
    `id` CHAR(36) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `order` INT(255) NOT NULL,
    `status` ENUM(
        'waiting',
        'ongoing',
        'finished'
    ) DEFAULT 'waiting',
    PRIMARY KEY (`id`),
    CONSTRAINT `unique_order` UNIQUE (`order`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `steps`
VALUES (
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        'prologue',
        1,
        'ongoing'
    ),
    (
        '2ca9be39-cf6c-429e-afb0-d754fa0fb8c6',
        'big-bang',
        2,
        'waiting'
    );

-- ------------------------
CREATE TABLE IF NOT EXISTS `speeches` (
    `id` CHAR(36) NOT NULL,
    `step_id` CHAR(36) NOT NULL,
    `order` INT(255) NOT NULL,
    `content` VARCHAR(255) NOT NULL,
    `speed` ENUM(
        'pause',
        'slow',
        'normal',
        'fast'
    ) DEFAULT 'normal',
    `highlight` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`step_id`) REFERENCES `steps` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `speeches`
VALUES (
        '492e39aa-a363-4555-a980-48f395d509b6',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        'Hi! Welcome to the',
        'normal',
        0
    ),
    (
        '3bba95ec-c7f7-4493-97a8-31a76376aa65',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        2,
        'Rube Goldberg Hello World.',
        'slow',
        1
    ),
    (
        '646489f9-2a0a-4879-923e-5343b62236be',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        3,
        'The idea of this project is to create a',
        'normal',
        0
    ),
    (
        '2375a2af-2ce3-40a1-ad47-3ec87d3aae3e',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        4,
        '"Hello World"',
        'normal',
        1
    ),
    (
        'db95064f-e22a-432a-848a-8b7eb7e58305',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        5,
        'in the most complicated way.',
        'normal',
        0
    ),
    (
        '98b6776b-4f29-4339-b016-7bd320605333',
        '2ca9be39-cf6c-429e-afb0-d754fa0fb8c6',
        1,
        'As the famous Carl Sagan once said,',
        'normal',
        0
    ),
    (
        '7f1b6831-f235-4a4a-8ea8-3d05f1538caf',
        '2ca9be39-cf6c-429e-afb0-d754fa0fb8c6',
        2,
        '"If you wish to make an apple pie from scratch, you must first invent the universe."',
        'normal',
        1
    );