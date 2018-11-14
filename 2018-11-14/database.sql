CREATE DATABASE newsportal
  CHARACTER SET utf8
  COLLATE utf8_hungarian_ci;

USE newsportal;

CREATE TABLE users(
  id int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  username varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  registration_time datetime NOT NULL DEFAULT NOW()
  );

CREATE TABLE news(
  id int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  title varchar(100) NOT NULL,
  creation_time datetime DEFAULT NOW(),
  end_time datetime NOT NULL,
  last_modify datetime,
  creater int(11) NOT NULL,
  content longtext NOT NULL,
  CONSTRAINT fk_creater_id_users FOREIGN KEY (creater)
  REFERENCES users (id)
);