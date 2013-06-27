/**
* Database schema required by CDbAuthManager.
*/

drop table if exists authassignment;
drop table if exists authitemchild;
drop table if exists authitem;

create table authitem
(
   name varchar(64) not null,
   type integer not null,
   description text,
   bizrule text,
   data text,
   primary key (name)
) type=InnoDB, character set utf8;

create table authitemchild
(
   parent varchar(64) not null,
   child varchar(64) not null,
   primary key (parent,child),
   foreign key (parent) references AuthItem (name) on delete cascade on update cascade,
   foreign key (child) references AuthItem (name) on delete cascade on update cascade
) type=InnoDB, character set utf8;

create table authassignment
(
   itemname varchar(64) not null,
   userid varchar(64) not null,
   bizrule text,
   data text,
   primary key (itemname,userid),
   foreign key (itemname) references AuthItem (name) on delete cascade on update cascade
) type=InnoDB, character set utf8;

/**
* Schema required by Rights.
* Stores Rights specific data about authorization items.
* Replaces the old AuthItemWeight-table.
* @since 1.1.0
*/

create table rights
(
	itemname varchar(64) not null,
	type integer not null,
	weight integer not null,
	primary key (itemname),
	foreign key (itemname) references AuthItem (name) on delete cascade on update cascade
) type=InnoDB, character set utf8;

