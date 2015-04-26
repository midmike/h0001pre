create database if not exists resmanag;
use resmanag;
create table if not exists  tbuser ( id int auto_increment primary key , name nvarchar(50), status int, address nvarchar(200), phone varchar(12), username varchar(50), password varchar(100),createdate date, modifydate date, editedby int, cache bit);
create table if not exists  tbtable( id int auto_increment primary key, status int, seat int,createdate date, modifydate date, editedby int, cache bit) ;
create table  if not exists tborder( id int auto_increment primary key, date date, refuser int, foreign key fk_user(id) references tbuser(id)  ON UPDATE CASCADE  ON DELETE RESTRICT,tatalamount float,  reftable int, foreign key fkt_id(id) references tbtable(id)  ON UPDATE CASCADE ON DELETE RESTRICT ,createdate date, modifydate date, editedby int, cache bit);
create table if not exists  tbfoodtype( id int auto_increment primary key, code nvarchar(50), description nvarchar(100), createdate date, modifydate date, editedby int, cache bit);
create table if not exists  tbfood( id int auto_increment primary key, name nvarchar(50), price float, status int, image nvarchar(100), thumbnail nvarchar(100), reffoodtype int, createdate date, modifydate date, editedby int, cache bit, foreign key fk_food_foodtype(reffoodtype) references tbfoodtype(id) ON UPDATE CASCADE  ON DELETE RESTRICT);
create table if not exists  tbsellfoodCount ( id int auto_increment primary key, date date, count int, reffood int, foreign key fk_id(id) references tbfood(id) ON UPDATE CASCADE ON DELETE RESTRICT,createdate date, modifydate date, editedby int, cache bit);
create table if not exists  tborderdetail(orderid int references tborder(id), orderfood int references tbfood(id), primary key (orderid, orderfood), Date date, qty int,createdate date, modifydate date, editedby int, cache bit);
create table if not exists tbreturnorder(orderid int references tborder(id), orderfood int references tbfood(id) , primary key (orderid, orderfood), Date date, qty int,createdate date, modifydate date, editedby int, cache bit);
create table if not exists  tbuseronline(id int auto_increment primary key ,session char(100) NOT NULL default '', time int(11) NOT NULL default '0', refuser int, foreign key fk_online_user_id(refuser) references tbuser(id) ON UPDATE CASCADE ON DELETE RESTRICT,createdate date, modifydate date, editedby int, cache bit);
create table if not exists  tbSite(id int auto_increment primary key , language char(2), refuser int, foreign key fk_site_user_id(refuser) references tbuser(id) ON UPDATE CASCADE ON DELETE RESTRICT,createdate date, modifydate date, editedby int, cache bit);

/* fake recode here */
INSERT IGNORE INTO `tbuser` (`id`,`name`, `status`, `address`, `phone`, `username`, `password`, `createdate`, `modifydate`, `editedby`, `cache`) VALUES
(1,'Admin', 1, 'phnom Pehn', '012 345 678', 'admin', '$2y$12$JnPsdYsUq/5sWjqEUnIV0uPDz2v6rJA/rla09./5xdwtpkvhVKJty', NULL, NULL, NULL, NULL);
INSERT IGNORE INTO `tbuser` (`id`,`name`, `status`, `address`, `phone`, `username`, `password`, `createdate`, `modifydate`, `editedby`, `cache`) VALUES
(2,'User', 2, 'phnom Pehn', '012 345 678', 'user', '$2y$12$JnPsdYsUq/5sWjqEUnIV0uPDz2v6rJA/rla09./5xdwtpkvhVKJty', NULL, NULL, NULL, NULL);