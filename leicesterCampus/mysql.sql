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
