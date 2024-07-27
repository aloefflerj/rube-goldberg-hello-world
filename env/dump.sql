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
        'beggining',
        2,
        'waiting'
    ),
    (
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        'the-universe',
        3,
        'waiting'
    ),
    (
        'ae824e15-2bcd-4520-a37c-95633d6ea3d0',
        'inflation',
        4,
        'waiting'
    ),
    (
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        'big-bang',
        5,
        'waiting'
    ),
    (
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        'nucleosynthesis',
        6,
        'waiting'
    ),
    (
        '54ff870a-fc37-43dd-b114-1c02e26a4f38',
        'recombination',
        7,
        'waiting'
    ),
    (
        'c78b9ee5-5827-4b04-8622-877981048b16',
        'firts-stars',
        8,
        'waiting'
    ),
    (
        'ee18fb01-649e-4f4d-8b9d-02e7c062591b',
        'our-sun',
        9,
        'waiting'
    ),
    (
        'bb02d575-812d-4d55-aeed-d1f2133492bc',
        'our-planet',
        10,
        'waiting'
    );

-- ------------------------
CREATE TABLE IF NOT EXISTS `speeches` (
    `id` CHAR(36) NOT NULL,
    `step_id` CHAR(36) NOT NULL,
    `order` INT(255) NOT NULL,
    `group` INT(255) NOT NULL,
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

delete from speeches;

INSERT INTO
    `speeches`
VALUES (
        '492e39aa-a363-4555-a980-48f395d509b6',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        1,
        'Hi! Welcome to the',
        'normal',
        0
    ),
    (
        '3bba95ec-c7f7-4493-97a8-31a76376aa65',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        2,
        1,
        'Rube Goldberg Hello World.',
        'slow',
        1
    ),
    (
        '646489f9-2a0a-4879-923e-5343b62236be',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        3,
        1,
        'The goal of this project is to create a',
        'normal',
        0
    ),
    (
        '2375a2af-2ce3-40a1-ad47-3ec87d3aae3e',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        4,
        1,
        '"Hello World"',
        'normal',
        1
    ),
    (
        'db95064f-e22a-432a-848a-8b7eb7e58305',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        5,
        1,
        'in the most complicated way possible.',
        'normal',
        0
    ),
    (
        'c91597e6-d7cc-43d6-a1c7-cb70a8566add',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        2,
        'Here is how it works...',
        'normal',
        0
    ),
    (
        'c75c544e-a581-4883-887c-4e51346dd773',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        3,
        'At the top left you have the',
        'normal',
        0
    ),
    (
        '0e11bef1-9136-46c7-9667-c7f42f954d7a',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        2,
        3,
        'input area.',
        'slow',
        1
    ),
    (
        'b35d4966-7284-48ab-b2e6-887c47d21bb2',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        3,
        3,
        'Click there to navigate through each step of the project, which will ultimately print',
        'normal',
        0
    ),
    (
        'c3ac1958-f656-4b46-8eff-a08d7a1c34a9',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        4,
        3,
        '"Hello World"',
        'normal',
        1
    ),
    (
        '93a58e3e-bffb-4d90-8ba6-ca652ec3216e',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        4,
        'You can also control the debug options there.',
        'normal',
        0
    ),
    (
        'a98c1281-3711-44d3-aa06-e19053deeb6c',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        5,
        'At the top right, we have the',
        'normal',
        0
    ),
    (
        '66fb0c1c-2697-402e-8735-6edba30d596a',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        2,
        5,
        'debug area.',
        'slow',
        1
    ),
    (
        '5f55f991-e430-4e78-8ca4-f0efad180b6d',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        3,
        5,
        'Enable it in the input area.',
        'normal',
        0
    ),
    (
        '318fa2a6-2a7a-4021-8591-b41b484ce9a5',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        6,
        'It currently debugs the backend clean architecture, tracing each step of the execution stack.',
        'normal',
        0
    ),
    (
        '4c0d4390-5fa7-423b-8351-c767bac686f6',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        7,
        'At the bottom left, we have the',
        'normal',
        0
    ),
    (
        'ca60adb8-4e99-4c64-b11b-ad10d00d9050',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        2,
        7,
        'view area,',
        'slow',
        1
    ),
    (
        '0e0b9044-9c8a-4352-8950-3cd9618e1441',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        3,
        7,
        'a visual representation of each step on the path to',
        'normal',
        0
    ),
    (
        '3072dce7-ba94-495a-8f71-d5a16bcc9f37',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        4,
        7,
        '"Hello World"',
        'normal',
        1
    ),
    (
        '947b98cd-fb2c-4e3b-8a4f-db87e0ce7372',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        8,
        'At the bottom right, you\'ll find me, explaining things as you go through each step.',
        'normal',
        0
    ),
    (
        'bcbaf3b2-6357-486f-856c-0eaf123893da',
        '3a73ddac-4d02-4e4a-8f12-1d918c37d9a4',
        1,
        9,
        'Now, let\'s begin…',
        'normal',
        0
    ),
    (
        '98b6776b-4f29-4339-b016-7bd320605333',
        '2ca9be39-cf6c-429e-afb0-d754fa0fb8c6',
        1,
        1,
        'As the famous Carl Sagan once said,',
        'normal',
        0
    ),
    (
        '7f1b6831-f235-4a4a-8ea8-3d05f1538caf',
        '2ca9be39-cf6c-429e-afb0-d754fa0fb8c6',
        2,
        1,
        '"If you wish to make an apple pie from scratch, you must first invent the universe."',
        'normal',
        1
    ),
    (
        'ccef40a5-52dc-451a-8834-9f4eec1587b6',
        '2ca9be39-cf6c-429e-afb0-d754fa0fb8c6',
        1,
        2,
        'So, if we wish to make a',
        'normal',
        0
    ),
    (
        '1e0aef56-4260-48c8-9b5f-a43529c9a7c7',
        '2ca9be39-cf6c-429e-afb0-d754fa0fb8c6',
        2,
        2,
        '“Hello World”',
        'normal',
        1
    ),
    (
        '71854e10-023c-405b-99da-64cb6ced13f8',
        '2ca9be39-cf6c-429e-afb0-d754fa0fb8c6',
        3,
        2,
        'from scratch, let\'s start with the',
        'normal',
        0
    ),
    (
        '8c872dcb-d1aa-4206-bd28-f2b8a51915c3',
        '2ca9be39-cf6c-429e-afb0-d754fa0fb8c6',
        4,
        2,
        'big bang.',
        'slow',
        1
    ),
    (
        '148ec5ef-d219-446f-af66-d5457d189fe5',
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        1,
        1,
        'Congrats! We have something.',
        'normal',
        0
    ),
    (
        '0e89edac-9e1f-4c74-9ce4-34333e6e3b4a',
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        1,
        2,
        'But what',
        'normal',
        0
    ),
    (
        '333ead79-8b2f-4269-896b-6c7a6131afcc',
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        2,
        2,
        'is',
        'slow',
        1
    ),
    (
        '99b93c8f-f223-4338-b45c-59795459d126',
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        3,
        2,
        'this something?',
        'normal',
        0
    ),
    (
        '817c7880-8ec3-4181-b485-66e1f857d8fb',
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        1,
        3,
        'When',
        'slow',
        1
    ),
    (
        '59474050-6202-427e-9a0f-0232b9fed608',
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        2,
        3,
        'it is?',
        'normal',
        0
    ),
    (
        '51622f5b-15dd-477a-ae31-b90afc028c23',
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        1,
        4,
        'How',
        'slow',
        1
    ),
    (
        'd21bc323-badc-46ed-8f63-6704935e5eab',
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        2,
        4,
        'it is?',
        'normal',
        0
    ),
    (
        'c2de022c-eb86-4fce-b147-46079f621f1c',
        'eef5cf9f-fc3a-4233-af6c-d1b38a9962ca',
        1,
        5,
        'We better move forward in time so our monkey brains can comprehend something.',
        'normal',
        0
    ),
    (
        '8b6f83a9-b3f0-45f8-a826-893053242f7b',
        'ae824e15-2bcd-4520-a37c-95633d6ea3d0',
        1,
        1,
        'We are now in the',
        'normal',
        0
    ),
    (
        'e2bdc8ca-fc0e-43d4-866b-45a2c6224b66',
        'ae824e15-2bcd-4520-a37c-95633d6ea3d0',
        2,
        1,
        'cosmic inflation',
        'slow',
        1
    ),
    (
        'fb2662e6-2958-4b8c-856b-003bf5961f2e',
        'ae824e15-2bcd-4520-a37c-95633d6ea3d0',
        3,
        1,
        'period, when the universe expanded faster than the speed of light for a fraction of a second.',
        'normal',
        0
    ),
    (
        'b1822ae5-c1d7-4e57-9169-68c6660d1718',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        1,
        1,
        'Look!',
        'normal',
        0
    ),
    (
        '37ab296d-c85f-4ca0-bacb-f6ba8f16347c',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        1,
        2,
        'The inflation stopped. The energy driving it has transformed into matter and light.',
        'normal',
        0
    ),
    (
        'd58dfc1f-3907-4375-a6ac-94dc372f4329',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        1,
        3,
        'The',
        'normal',
        0
    ),
    (
        '6de40060-5483-4cf9-87bc-d9fa1c859905',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        2,
        3,
        'big bang!',
        'slow',
        1
    ),
    (
        'a4e90021-6ced-4e3f-9826-591f7c4b440a',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        1,
        4,
        'It is incredibly hot right now.',
        'normal',
        0
    ),
    (
        '11128dda-3559-4588-ba76-e0ef4108bab8',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        1,
        5,
        'And look closely... Because of that, subatomic primordial particles are contained in a',
        'normal',
        0
    ),
    (
        '32226808-d0a2-40de-8992-195e6534a68f',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        2,
        5,
        'quark soup.',
        'slow',
        1
    ),
    (
        'c3f74994-de7d-4904-9ba4-e7b86f7dc065',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        1,
        6,
        'When we add so much energy to an atom, it falls apart, overcoming the strong forces holding its nuclei together.',
        'normal',
        0
    ),
    (
        '10e7daaa-8cbe-4bf2-9dfe-81465b15c8d3',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        1,
        7,
        'That\'s why in this high temperature environment only subatomic particles exist, like',
        'normal',
        0
    ),
    (
        '2a11b32e-1f2b-472f-9819-4798c319b4b0',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        2,
        7,
        'electrons',
        'normal',
        1
    ),
    (
        '2221c5e0-d7b5-4094-851c-42012595d5b2',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        3,
        7,
        'and',
        'normal',
        0
    ),
    (
        'd5372798-1b6f-42cf-b43f-753e4fe0c759',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        4,
        7,
        'quarks.',
        'normal',
        1
    ),
    (
        '10d7534d-9a80-435c-bba0-29b0e357c1b7',
        '140b4bde-61e6-49b4-b6d4-244e37edf25b',
        1,
        8,
        'To advance, we need to make the universe less dense and cooler.',
        'normal',
        0
    ),
    (
        '3fc10f39-c695-44c1-900d-82baecf8ce47',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        1,
        1,
        'All right, now see what happenned?',
        'normal',
        0
    ),
    (
        '44133ac2-ed1a-4744-9dc1-c09b54b1ce84',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        1,
        2,
        'Subatomic particles are starting to stick together.',
        'normal',
        0
    ),
    (
        '6478b43f-63da-47f1-aabd-963ffe335dd9',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        1,
        3,
        'Can you see what\'s forming?',
        'normal',
        0
    ),
    (
        'ab33fd35-1b91-4c98-a1e7-48d20021c671',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        1,
        4,
        'Atoms!',
        'slow',
        1
    ),
    (
        '5faae492-fe48-405b-aa57-e6c970c88edd',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        1,
        5,
        'It\'s still very hot, but at this temperature, nuclear fusion can occur.',
        'normal',
        0
    ),
    (
        'bf511f71-4607-4d95-803a-f23618eec626',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        1,
        6,
        'Protons',
        'normal',
        1
    ),
    (
        '878f1537-17e1-4766-9417-e440b2246698',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        2,
        6,
        'and',
        'normal',
        0
    ),
    (
        '4df469ca-05da-4def-b039-8c5a37936745',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        3,
        6,
        'neutrons',
        'normal',
        1
    ),
    (
        '287eb8d5-65e6-4738-af2c-a83c68bba4a6',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        4,
        6,
        'are colliding, forming',
        'normal',
        0
    ),
    (
        '322a1888-c0e0-49af-98a2-b951f377a151',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        5,
        6,
        'hydrogen, helium,',
        'normal',
        1
    ),
    (
        'eaf0df2b-7835-4559-a8a3-0382cc15acbf',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        7,
        6,
        'and a bit of',
        'normal',
        0
    ),
    (
        '2c127e73-aa9f-4734-b1f8-5d923c864ee4',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        8,
        6,
        'lithium',
        'normal',
        1
    ),
    (
        'a09fdc2b-538f-4f3c-9c15-be9e20eb6e70',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        9,
        6,
        'and',
        'normal',
        0
    ),
    (
        'ad8c5a79-66a6-4094-9a67-029f013a6c74',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        10,
        6,
        'beryllium.',
        'normal',
        1
    ),
    (
        '407fab2a-693b-4c38-96b6-37d03fd3a72d',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        1,
        7,
        'However, the cosmos is opaque because a vast number of',
        'normal',
        0
    ),
    (
        'f02b5bd9-5bcd-4236-bf99-8ded161659f8',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        2,
        7,
        'electrons',
        'normal',
        1
    ),
    (
        '0c3db935-53a9-4855-92b7-218aa1004f26',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        3,
        7,
        'created a',
        'normal',
        0
    ),
    (
        '301f332a-581f-4306-b719-b19364a9bd56',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        4,
        7,
        'fog',
        'normal',
        1
    ),
    (
        'd4636bc5-3aba-4157-95fd-65af3a4d8fa1',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        5,
        7,
        'scattered light.',
        'normal',
        0
    ),
    (
        '75eb7776-7d76-4655-bdea-09a0392fa7ec',
        'e915f09c-ef20-440b-9466-86cd84c89ce5',
        1,
        8,
        'Let\'s clear things up a bit.',
        'normal',
        0
    ),
    (
        '2ec97879-b51c-440b-85cb-362b6a40bbc9',
        '54ff870a-fc37-43dd-b114-1c02e26a4f38',
        1,
        1,
        'It\'s cooling down.',
        'normal',
        0
    ),
    (
        'af5d29ce-5eab-4edb-8c5a-ba48028b221c',
        '54ff870a-fc37-43dd-b114-1c02e26a4f38',
        1,
        2,
        'Now, atomic nuclei can capture electrons.',
        'normal',
        0
    ),
    (
        '83c6cdce-1802-423e-9863-6aac076ba768',
        '54ff870a-fc37-43dd-b114-1c02e26a4f38',
        1,
        3,
        'With most electrons bound to nuclei, there aren\'t enough to scatter light.',
        'normal',
        0
    ),
    (
        '1c34ec8e-86bb-4706-aac5-7ac7443beb13',
        '54ff870a-fc37-43dd-b114-1c02e26a4f38',
        1,
        4,
        'The cosmic fog has cleared; we can see things now!',
        'normal',
        0
    ),
    (
        '6a5e179b-2003-452a-b676-6b5622ea663a',
        'c78b9ee5-5827-4b04-8622-877981048b16',
        1,
        1,
        'The universe continues to expand and cool.',
        'normal',
        0
    ),
    (
        'a13a12ee-56bd-4959-a20b-65c0be2df895',
        'c78b9ee5-5827-4b04-8622-877981048b16',
        1,
        2,
        'Gas is not uniform throughout space.',
        'normal',
        0
    ),
    (
        '4ccd3525-d7e1-47b9-af3e-104445a6ed97',
        'c78b9ee5-5827-4b04-8622-877981048b16',
        1,
        3,
        'In denser regions, we see the formation of the',
        'normal',
        0
    ),
    (
        '376d5545-ab75-4dfd-a697-6eefed7b11ed',
        'c78b9ee5-5827-4b04-8622-877981048b16',
        2,
        3,
        'first stars',
        'normal',
        1
    ),
    (
        '8031f357-50b0-4e7e-a758-51159535d89a',
        'c78b9ee5-5827-4b04-8622-877981048b16',
        3,
        3,
        'and, later on,',
        'normal',
        0
    ),
    (
        '0cc1ad81-ee7e-4ebe-a9f5-aafd2a5bed87',
        'c78b9ee5-5827-4b04-8622-877981048b16',
        4,
        3,
        'galaxies.',
        'normal',
        1
    ),
    (
        'a90aae71-3732-4ec8-8eec-43a137734a27',
        'ee18fb01-649e-4f4d-8b9d-02e7c062591b',
        1,
        1,
        'Our sun formed from a giant, spinning cloud of gas and dust.',
        'normal',
        0
    ),
    (
        'fbdc74e9-ac72-45c0-94d6-eefb264a81fe',
        'ee18fb01-649e-4f4d-8b9d-02e7c062591b',
        1,
        2,
        'It collapsed under its own gravity, pulling in most of the nebula material.',
        'normal',
        0
    ),
    (
        'c4988d14-ce9f-43db-887e-d2bedfa2bff1',
        'bb02d575-812d-4d55-aeed-d1f2133492bc',
        1,
        1,
        'Much of the remaining nebula material formed the planets of our solar system.',
        'normal',
        0
    ),
    (
        '84d7825f-9258-4dd4-9acd-709d8ff4c0e8',
        'bb02d575-812d-4d55-aeed-d1f2133492bc',
        1,
        2,
        'Including our planet.',
        'normal',
        0
    ),
    (
        '3a4313bc-e2f9-4fa2-9fba-f972afdf70c4',
        'bb02d575-812d-4d55-aeed-d1f2133492bc',
        1,
        3,
        'Oh.',
        'normal',
        0
    ),
    (
        'f246b641-c7da-43e2-b180-829774cdc1e7',
        'bb02d575-812d-4d55-aeed-d1f2133492bc',
        1,
        4,
        'Wait...',
        'slow',
        0
    ),
    (
        'c2db2205-385f-4b68-a463-f775247847df',
        'bb02d575-812d-4d55-aeed-d1f2133492bc',
        1,
        5,
        'Hello World.',
        'slow',
        1
    );