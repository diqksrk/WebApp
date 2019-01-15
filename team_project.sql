ALTER TABLE `board_detail` DROP INDEX `contentsIndex`;
ALTER TABLE `board` DROP INDEX `titleIndex`;
ALTER TABLE `reviews` DROP INDEX `commentIndex`;

DROP TABLE IF EXISTS `info`;
DROP TABLE IF EXISTS `favorite`;
DROP TABLE IF EXISTS `log`;
DROP TABLE IF EXISTS `member`;
DROP TABLE IF EXISTS `reviews`;
DROP TABLE IF EXISTS `board`;
DROP TABLE IF EXISTS `board_detail`;
DROP TABLE IF EXISTS `reviews`;
-- DROP TABLE IF EXISTS `user_board`;


CREATE TABLE `member` (
  `id` VARCHAR(20) NOT NULL,
  `pass` VARCHAR(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `info` (
  `id` VARCHAR(20) NOT NULL,
  `email` VARCHAR(48) NOT NULL,
  `age` SMALLINT(3) NOT NULL,
  `gender` CHAR(1) NOT NULL DEFAULT 'A',
  `name` VARCHAR(32) NOT NULL,
  `cDate` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `favorite` (
  `id` VARCHAR(20) NOT NULL,
  `item_1` SMALLINT,
  `item_2` SMALLINT,
  `item_3` SMALLINT,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `log` (
  `id` VARCHAR(20) NOT NULL,
  `lDate` DATETIME NOT NULL DEFAULT NOW(),
  `num` SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `board` (
  `id` INT(10) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `date` VARCHAR(70) NOT NULL,
  `imagePath` VARCHAR(100),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `board_detail` (
  `id` INT(10) NOT NULL,
  `favorite` VARCHAR(4) NOT NULL,
  `contents` TEXT NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `reviews` (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `board_id` INT(10) NOT NULL,
  `user_id` VARCHAR(20) NOT NULL,
  `review` VARCHAR(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `board_detail` ADD FULLTEXT INDEX `contentsIndex` (`contents`);
ALTER TABLE `board` ADD FULLTEXT INDEX `titleIndex` (`title`);
ALTER TABLE `reviews` ADD FULLTEXT INDEX `commentIndex` (`review`);

INSERT INTO member VALUES ('Tester', '$2y$10$8K5BPVncH7h3kl7HWBoeZeNQPjIr2T0ao84XD7aDJvqp82vzwrDym');
INSERT INTO info(id,email,age,gender,name) VALUES('Tester','abc@google.com',24,'F','Rachel McAdams');
INSERT INTO favorite VALUES('Tester',3,5,7);
INSERT INTO log(id) VALUES ('Tester');