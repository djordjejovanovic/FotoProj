CREATE DATABASE fotoProj;
USE fotoProj;

CREATE TABLE items (
  item_id int(255) NOT NULL AUTO_INCREMENT,
  item_name varchar(255) NOT NULL,
  item_price int(255) NOT NULL,
  item_text varchar(255),
  item_image varchar(255),
  PRIMARY KEY (item_id)
);

CREATE TABLE users (
  user_id int(11) NOT NULL AUTO_INCREMENT,
  user_email varchar(256) NOT NULL,
  user_name varchar(256) NOT NULL,
  user_password varchar(256) NOT NULL,
  user_type int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (user_id)
);