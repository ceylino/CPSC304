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
	join_date char(8) null,
	primary key (c_id),
	foreign key (c_id) references customer(c_id) ON DELETE CASCADE);

grant select on member to public;

create table roomRate
  (room_type char(10) not null,
 room_rate float null,
 primary key (room_type));

 grant select on roomRate to public;

create table room
    (room_num int not null,
	room_type char(10) not null,
	room_rate float null,
	primary key (room_num),
  foreign key (room_type) references roomRate(room_type) ON DELETE CASCADE);

 grant select on room to public;

create table roomReservation
    (room_num int not null,
	c_id int not null,
  start_date char(8) not null,
  end_date char(8) not null,
	primary key (room_num, start_date, end_date),
  foreign key (room_num) references room(room_num) ON DELETE CASCADE,
	foreign key (c_id) references customer(c_id) ON DELETE CASCADE);

grant select on roomReservation to public;

create table hotelStaff
    (staff_id int not null,
	s_name varchar(20) not null,
	phone char(10) not null,
	primary key (staff_id));

grant select on hotelStaff to public;

create table skiStaff
    (staff_id int not null,
	s_name varchar(20) not null,
	phone char(10) not null,
	primary key (staff_id));

grant select on skiStaff to public;

create table rentalEquipRate
    (equip_type varchar(20) not null,
	rental_rate	float not null,
	primary key (equip_type));

grant select on rentalEquipRate to public;

create table rentalEquip
    (equip_id int not null,
	equip_type varchar(20) not null,
	rental_rate float not null,
	primary key (equip_id),
  foreign key (equip_type) references rentalEquipRate(equip_type) ON DELETE CASCADE);

  grant select on rentalEquip to public;

create table equipReservation
    (equip_id int not null,
	c_id int not null,
  start_date char(8) not null,
  end_date char(8) not null,
	primary key (equip_id, start_date, end_date),
	foreign key (c_id) references customer(c_id) ON DELETE CASCADE,
  foreign key (equip_id) references rentalEquip(equip_id) ON DELETE CASCADE);

grant select on equipReservation to public;

create table roomManagement
    (room_num int not null,
	 staff_id int not null,
	primary key (room_num, staff_id),
	foreign key (room_num) references room(room_num) ON DELETE CASCADE,
	foreign key (staff_id) references hotelStaff(staff_id) ON DELETE CASCADE);

grant select on roomManagement to public;

create table equipManagement
    (equip_id int not null,
	 staff_id int not null,
	primary key (equip_id, staff_id),
	foreign key (equip_id) references rentalEquip(equip_id) ON DELETE CASCADE,
	foreign key (staff_id) references skiStaff(staff_id) ON DELETE CASCADE);

grant select on equipManagement to public;

create table purchasedLiftPass
    (c_id int not null,
	 pass_id int not null,
	purchase_date char(8) not null,
	pass_price float not null,
	primary key (c_id, pass_id),
	foreign key (c_id) references customer(c_id) ON DELETE CASCADE);

grant select on purchasedLiftPass to public;

 create table lessonTime
        (lesson_type varchar(30) not null,
  	lesson_datetime char(12) not null,
  	primary key (lesson_type, lesson_datetime));

  grant select on lessonTime to public;

  create table lesson
      (lesson_id int not null,
    staff_id int not null,
  	lesson_datetime char(12) not null,
  	lesson_type varchar(30) not null,
  	primary key (lesson_id),
    foreign key (lesson_type, lesson_datetime) references lessonTime(lesson_type, lesson_datetime) ON DELETE CASCADE,
  	foreign key (staff_id) references skiStaff(staff_id) ON DELETE CASCADE);

  grant select on lesson to public;

create table bookedLessons
    (c_id int not null,
  lesson_datetime char(12) not null,
  lesson_id int not null,
	lesson_type varchar(30) not null,
	primary key (c_id, lesson_id),
	foreign key (c_id) references customer(c_id) ON DELETE CASCADE,
  foreign key (lesson_id) references lesson(lesson_id) ON DELETE CASCADE,
	foreign key (lesson_type, lesson_datetime) references lessonTime(lesson_type, lesson_datetime) ON DELETE CASCADE);

grant select on bookedLessons to public;

commit;

create view staff as
select staff_id, s_name
from hotelStaff
union
select staff_id, s_name
from skiStaff;

commit;
