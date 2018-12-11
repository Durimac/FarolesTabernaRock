create database FarolesTabernaRock;

use FarolesTabernaRock;

create table food
(
	id_product int unsigned not null auto_increment primary key,
	product_name char(30) not null,
	description text not null,
	calories char (5),
	price float(4,2),
	kind char (20),
	image char(50)
);

create table orders
(
	id_order int unsigned not null auto_increment primary key,
	client_name char(50) not null,
	client_surname char(60) not null,
	phone char(15) not null,
	email char(60),
	full_cost float(6,2),
	order_time datetime not null,
	pickup_time datetime not null,
	order_state char(15),
	comments char(251)
);


create table order_food
(
	id_order int unsigned not null,
	id_product char(5) not null,
	quantity tinyint unsigned,
	
	primary key (id_order, id_product)
);

create table penista
(
	id_penista int unsigned not null auto_increment primary key,
	clothes char(1) not null,
	clothes_size char(1),
	penista_name char (30) not null,
	penista_surname char (60) not null,
	penista_email char (50),
	penista_phone char (11),
	penista_age char(11),
	payed char(1)
);