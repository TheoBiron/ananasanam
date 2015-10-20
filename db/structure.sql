drop table if exists contact;

create table contact (
	contact_name varchar(50) not null,
	contact_email varchar(50) not null,
	contact_msg varchar(2000) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;
