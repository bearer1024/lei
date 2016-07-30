create database leicesterCampusDB

use leicesterCampusDB

create table users(
    user_id int(11) primary key AUTO_INCREMENT,
    user_name varchar(50) not null,
    user_email varchar(100) not null unique,
    user_password varchar(80) not null,
    salt varchar(10) not null,
    _tc timestamp
    );

CREATE TABLE news(
      newsId INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(100) NOT NULL,
      writer VARCHAR(50) NOT NULL,
      pubDate DATETIME,
      content TEXT NOT NULL,
      extLink VARCHAR(200),
      PRIMARY KEY(newsId),
      FOREIGN KEY(writer) REFERENCES users(user_name)
)
