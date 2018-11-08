-- updated the size of notes in titles relation// Hazra

drop table bookedlessons;
drop table lessontime;
drop table lesson;
drop table purchasedLiftPass;
drop table bookedlessons;
drop table equipManagement;
drop table roomManagement;
drop table equipreservation;
drop table rentalEquipRate;
drop table rentalequip;
drop table skistaff;
drop table hotelstaff;
drop table roomreservation;
drop table roomrate;
drop table room;
drop table member;
drop table customer;


commit;


create table customer
    (c_id int not null,
	c_name varchar(20) not null,
	e_mail varchar(40) not null,
	creditcard_num char(16) null,
	primary key (c_id));
 
grant select on customer to public;

create table member
    (c_id int not null,
	fee float null,
	points int null,
	join_date varchar(20) null,
	primary key (c_id),
	foreign key (c_id) references customer ON DELETE CASCADE);
 
grant select on member to public;
 

create table room
    (room_num int not null,
	room_type char(10) not null,
	room_rate float      null,
	primary key (room_num));

 grant select on room to public;
	

 create table roomrate
	(room_type char(10) not null,
	room_rate float null,
	primary key (room_type),
	foreign key (room_type) references room ON DELETE CASCADE); 

grant select on roomrate to public;
 

create table roomreservation
    (confirm_num int not null,
	room_num int not null,
	c_id int not null,
	primary key (confirm_num),
	foreign key (room_num) references room ON DELETE CASCADE,
	foreign key (c_id) references customer ON DELETE CASCADE);
 
grant select on roomreservation to public;
 
create table hotelstaff
    (staff_id int not null,
	s_name varchar(20) not null,
	phone char(10) null,	
	primary key (staff_id));
 
grant select on hotelstaff to public;

create table skistaff
    (staff_id int not null,
	s_name varchar(20) null,
	phone char(10) null,	
	primary key (staff_id));
 
grant select on skistaff to public;

create table rentalequip
    (equip_id int not null,
	 equip_type varchar(20) not null,
	rental_rate float not null,	
	primary key (equip_id));
 
grant select on rentalequip to public;

create table rentalEquipRate
    (equip_type varchar(20) not null,
	rental_rate	float not null,
	primary key (equip_type),
	foreign key (equip_type) references rentalequip  ON DELETE CASCADE);
 
grant select on rentalEquipRate to public;

create table equipreservation
    (confirm_num int not null,
	equip_id int not null,
	c_id int not null,
	primary key (confirm_num),
	foreign key (equip_id) references rentalequip ON DELETE CASCADE,
	foreign key (c_id) references customer ON DELETE CASCADE);
 
grant select on equipreservation to public;

create table roomManagement  
    (room_num int not null,
	 staff_id int not null,
	primary key (room_num, staff_id),
	foreign key (room_num) references room ON DELETE CASCADE,
	foreign key (staff_id) references hotelstaff ON DELETE CASCADE);
 
grant select on roomManagement to public;

create table equipManagement 
    (equip_id int not null,
	 staff_id int not null,
	primary key (equip_id, staff_id),
	foreign key (equip_id) references rentalequip ON DELETE CASCADE,
	foreign key (staff_id) references skistaff ON DELETE CASCADE);
 
grant select on equipManagement to public;

create table purchasedLiftPass
    (c_id int not null,
	 pass_id int not null,
	purchase_date datetime not null,
	pass_price float not null,	
	primary key (c_id, pass_id),
	foreign key (c_id) references customer ON DELETE CASCADE);
 
grant select on purchasedLiftPass to public;

create table lesson
    (staff_id int not null,
	lesson_datetime datetime not null,
	lesson_type varchar(20) not null,	
	primary key (lesson_type, staff_id),
	foreign key (staff_id) references skistaff ON DELETE CASCADE);
 
grant select on lesson to public;

create table lessontime
    (lesson_type varchar(20) not null,
	lesson_datetime datetime not nul,
	primary key (lesson_type),
	foreign key (lesson_type) references lesson ON DELETE CASCADE,
	foreign key (lesson_datetime) references lesson ON DELETE CASCADE);
 
grant select on lessontime to public;

create table bookedlessons 
    (c_id int not null,
	lesson_type varchar(20) not null,
	staff_id int not null,
	primary key (c_id, lesson_type, staff_id),
	foreign key (c_id) references customer ON DELETE CASCADE,
	foreign key (staff_id) references skistaff ON DELETE CASCADE,
	foreign key (lesson_type) references lesson ON DELETE CASCADE);
 
grant select on bookedlessons to public;



commit;