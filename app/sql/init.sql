CREATE SCHEMA phpdb;
USE phpdb;

CREATE TABLE user
(
  id VARCHAR(30) NOT NULL,
  email VARCHAR(70) NOT NULL,
  password CHAR(64) NOT NULL,
  PRIMARY KEY (id)
);

CREATE USER 'php_db_admin' IDENTIFIED BY 'php_db_admin';
GRANT ALL ON phpdb.* TO 'php_db_admin';