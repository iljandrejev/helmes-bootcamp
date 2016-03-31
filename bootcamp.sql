CREATE USER 'helmes'@'localhost'
  IDENTIFIED BY 'bootcamp';
CREATE DATABASE reservations;
GRANT ALL ON reservations.* TO 'helmes'@'localhost';
FLUSH PRIVILEGES;

USE reservations;
CREATE TABLE reservation (
  id      INT AUTO_INCREMENT NOT NULL,
  details VARCHAR(2000)      NOT NULL,
  PRIMARY KEY (id)
)
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_unicode_ci
  ENGINE = InnoDB;
