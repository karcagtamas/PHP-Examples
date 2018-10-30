CREATE DATABASE Forum
  CHARACTER SET utf8
  COLLATE utf8_hungarian_ci;

USE Forum;

CREATE TABLE users(
  id int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  username varchar(100) NOT NULL,
  password varchar(255) NOT NULL
  );

CREATE TABLE topics(
  id int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name varchar(100) NOT NULL,
  creation_time datetime DEFAULT NOW(),
  creater int(11) NOT NULL,
  CONSTRAINT fk_creater_id_users FOREIGN KEY (creater)
  REFERENCES users (id)
);

CREATE TABLE posts(
  content longtext,
  writer int(11) NOT NULL,
  write_time datetime DEFAULT NOW(),
  topic int(11) NOT NULL,
  PRIMARY KEY (writer, write_time),
  CONSTRAINT fk_writer_id_users FOREIGN KEY (writer)
  REFERENCES users(id),
  CONSTRAINT fk_topic_id_topics FOREIGN KEY (topic)
  REFERENCES topics (id)
);