/*CUSTOMER TABLE - 10 entries*/
INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (1, 'Abby', 'abby@gmail.com', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (2, 'Bill', 'bill@gmail.com', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (3, 'Carl', 'carl@gmail.com', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (4, 'Dave', 'dave@gmail.com', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (5, 'Edward', 'ed@gmail.com', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (6, 'Francis', 'fran@gmail.com', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (7, 'Gabriela', 'gaby@gmail.com', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (8, 'Harriet', 'harriet@gmail.com', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (9, 'Ivan', 'ivan@gmail.com', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (10, 'Jannet', 'jannet@gmail.com', 123456);

commit;

/*---------------------------------------------------------------------------------*/
/*MEMBER TABLE - 5 entries */
/* Changes: Datetime instead is string for Join Datetime. */

INSERT INTO member (c_id, fee, points, join_date)
VALUES (6, 12.50, 120, '20121103');

INSERT INTO member (c_id, fee, points, join_date)
VALUES (7, 12.50, 56, '20170930');

INSERT INTO member (c_id, fee, points, join_date)
VALUES (8, 12.50, 778, '20021031');

INSERT INTO member (c_id, fee, points, join_date)
VALUES (9, 12.50, 1001, '19931121');

INSERT INTO member (c_id, fee, points, join_date)
VALUES (10, 12.50, 10, '20180809');

commit;

/*---------------------------------------------------------------------------------*/
/*ROOM RATE TABLE - 6 entries (1 for each of the 6 room types)*/
INSERT INTO roomRate (room_type, room_rate)
VALUES ('double', 150.00);

INSERT INTO roomRate (room_type, room_rate)
VALUES ('triple', 200.00);

INSERT INTO roomRate (room_type, room_rate)
VALUES ('quad', 250.00);

INSERT INTO roomRate (room_type, room_rate)
VALUES ('king', 350.00);

INSERT INTO roomRate (room_type, room_rate)
VALUES ('honeymoon', 450.00);

INSERT INTO roomRate (room_type, room_rate)
VALUES ('president', 500.00);

commit;

/*---------------------------------------------------------------------------------*/
/*ROOM TABLE - 15 entries*/
INSERT INTO room (room_num, room_type, room_rate)
VALUES (1, 'double', 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (2, 'double', 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (3, 'double', 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (4, 'double', 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (5, 'double', 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (6, 'triple', 200.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (7, 'triple', 200.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (8, 'triple', 200.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (9, 'triple', 200.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (10, 'quad', 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (11, 'quad', 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (12, 'king', 350.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (13, 'king', 350.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (14, 'honeymoon', 450.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (15, 'president', 500.00);

commit;

/*---------------------------------------------------------------------------------*/
/*ROOMRESERVATION TABLE - 7 entries*/
INSERT INTO roomReservation (room_num, c_id, start_date, end_date)
VALUES (1, 4, '20180101', '20180103');

INSERT INTO roomReservation (room_num, c_id, start_date, end_date)
VALUES (8, 4, '20180202', '20180207');

INSERT INTO roomReservation (room_num, c_id, start_date, end_date)
VALUES (10, 2, '20180202', '20180204');

INSERT INTO roomReservation (room_num, c_id, start_date, end_date)
VALUES (11, 10, '20180102', '20180107');

INSERT INTO roomReservation (room_num, c_id, start_date, end_date)
VALUES (13, 8, '20180101', '20180115');

INSERT INTO roomReservation (room_num, c_id, start_date, end_date)
VALUES (14, 6, '20180210', '20180220');

INSERT INTO roomReservation (room_num, c_id, start_date, end_date)
VALUES (15, 5, '20181015', '20180217');

commit;


/*---------------------------------------------------------------------------------*/
/*HOTEL STAFF TABLE - 5 entries*/
INSERT INTO hotelStaff (staff_id, s_name, phone)
VALUES (1, 'Zayn', '6041234567');

INSERT INTO hotelStaff (staff_id, s_name, phone)
VALUES (2, 'Yasmin', '6041250080');

INSERT INTO hotelStaff (staff_id, s_name, phone)
VALUES (3, 'Xander', '6041230000');

INSERT INTO hotelStaff (staff_id, s_name, phone)
VALUES (4, 'Walter', '6041298800');

INSERT INTO hotelStaff (staff_id, s_name, phone)
VALUES (5, 'Violet', '6049019977');

commit;

/*---------------------------------------------------------------------------------*/
/*SKI STAFF TABLE - 5 entries*/
INSERT INTO skiStaff (staff_id, s_name, phone)
VALUES (6, 'Ursula', '6042224567');

INSERT INTO skiStaff (staff_id, s_name, phone)
VALUES (7, 'Tom', '6043330080');

INSERT INTO skiStaff (staff_id, s_name, phone)
VALUES (8, 'Sam', '6044440000');

INSERT INTO skiStaff (staff_id, s_name, phone)
VALUES (9, 'Ron', '6045558800');

INSERT INTO skiStaff (staff_id, s_name, phone)
VALUES (0, 'Quin', '6049066677');

commit;

/*---------------------------------------------------------------------------------*/
/*RENTAL EQUIPMENT RATE TABLE - 5 entries (1 for each of the 5 equip. types)*/
INSERT INTO rentalEquipRate (equip_type, rental_rate)
VALUES ('skis', 15.00);

INSERT INTO rentalEquipRate (equip_type, rental_rate)
VALUES ('snowboard', 10.00);

INSERT INTO rentalEquipRate (equip_type, rental_rate)
VALUES ('boots', 10.00);

INSERT INTO rentalEquipRate (equip_type, rental_rate)
VALUES ('poles', 5.00);

INSERT INTO rentalEquipRate (equip_type, rental_rate)
VALUES ('helmet', 5.00);

commit;

/*---------------------------------------------------------------------------------*/
/*RENTAL EQUIPMENT TABLE - 15 entries*/
INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (1, 'skis', 15.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (2, 'skis', 15.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (3, 'skis', 15.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (4, 'snowboard', 10.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (5, 'snowboard', 10.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (6, 'snowboard', 10.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (7, 'boots', 10.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (8, 'boots', 10.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (9, 'boots', 10.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (10, 'poles', 5.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (11, 'poles', 5.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (12, 'poles', 5.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (13, 'helmet', 5.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (14, 'helmet', 5.00);

INSERT INTO rentalEquip (equip_id, equip_type, rental_rate)
VALUES (15, 'helmet', 5.00);

commit;

/*---------------------------------------------------------------------------------*/

/*EQUIPRESERVATION TABLE - 7 entries*/
INSERT INTO equipReservation (equip_id, c_id, start_date, end_date)
VALUES (1, 1, '20180101', '20180115');

INSERT INTO equipReservation (equip_id, c_id, start_date, end_date)
VALUES (9, 2, '20180202', '20180204');

INSERT INTO equipReservation (equip_id, c_id, start_date, end_date)
VALUES (10, 3, '20180111', '20180115');

INSERT INTO equipReservation (equip_id, c_id, start_date, end_date)
VALUES (14, 4, '20180201', '20180215');

INSERT INTO equipReservation (equip_id, c_id, start_date, end_date)
VALUES (3, 10, '20180210', '20180215')

INSERT INTO equipReservation (equip_id, c_id, start_date, end_date)
VALUES (5, 7, '20180211', '20180216')

INSERT INTO equipReservation (equip_id, c_id, start_date, end_date)
VALUES (12, 8, '20180209', '20180216')

commit;

/*---------------------------------------------------------------------------------*/
/*ROOMMANAGEMENT TABLE - 15 entries (a hotel staff member is assigned to a room at all times)*/
INSERT INTO roomManagement (room_num, staff_id)
VALUES (1, 4);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (2, 1);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (3, 5);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (4, 2);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (5, 1);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (6, 1);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (7, 3);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (8, 2);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (9, 2);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (10, 4);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (11, 3);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (12, 3);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (13, 3);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (14, 3);

INSERT INTO roomManagement (room_num, staff_id)
VALUES (15, 3);

commit;

/*---------------------------------------------------------------------------------*/
/*EQUIPMANAGEMENT TABLE - 15 entries (each equipment is assigned a ski staff member)*/
INSERT INTO equipManagement (equip_id, staff_id)
VALUES (1, 6);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (2, 6);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (3, 6);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (4, 6);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (5, 7);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (6, 7);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (7, 7);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (8, 8);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (9, 8);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (10, 9);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (11, 9);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (12, 0);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (13, 0);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (14, 0);

INSERT INTO equipManagement (equip_id, staff_id)
VALUES (15, 0);

commit;

/*---------------------------------------------------------------------------------*/
/*PURCHASEDLIFTPASS TABLE - 6 entries*/
INSERT INTO purchasedLiftPass (c_id, pass_id, purchase_date, pass_price)
VALUES (1, 1, '20180809', 50.00);

INSERT INTO purchasedLiftPass (c_id, pass_id, purchase_date, pass_price)
VALUES (4, 2, '20181205', 50.00);

INSERT INTO purchasedLiftPass (c_id, pass_id, purchase_date, pass_price)
VALUES (9, 3, '20181012', 50.00);

INSERT INTO purchasedLiftPass (c_id, pass_id, purchase_date, pass_price)
VALUES (7, 4, '20180901', 50.00);

INSERT INTO purchasedLiftPass (c_id, pass_id, purchase_date, pass_price)
VALUES (10, 5, '20171019', 50.00);

INSERT INTO purchasedLiftPass (c_id, pass_id, purchase_date, pass_price)
VALUES (8, 6, '20150105', 50.00);

commit;

/*---------------------------------------------------------------------------------*/
/*LESSONTIME TABLE - 9 entries: The type of lesson must be unique*/
INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('beginnersSki', '201808091130');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('intermediateSki', '201808091430');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('advancedSki', '201812051300');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('beginnersSnowboard', '201809031415');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('intermediateSnowboard', '201809041515');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('advancedSnowboard', '201710191245');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('crosscountrySki', '201510030900');

commit;

/*---------------------------------------------------------------------------------*/
/*LESSON TABLE - 9 entries*/
INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (8, '201808091130', 'beginnersSki');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (8, '201808091430', 'intermediateSki');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (8, '201812051300', 'advancedSki');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (9, '201510030900', 'crosscountrySki');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (6, '201809031415', 'beginnersSnowboard');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (0, '201809041515', 'intermediateSnowboard');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (6, '201710191245', 'advancedSnowboard');

commit;

/*---------------------------------------------------------------------------------*/
/*BOOKEDLESSONS TABLE - 5 entries*/
INSERT INTO bookedLessons (c_id, lesson_datetime, lesson_type)
VALUES (1, '201808091130', 'beginnersSki');

INSERT INTO bookedLessons (c_id, lesson_datetime, lesson_type)
VALUES (6, '201809031415', 'beginnersSnowboard');

INSERT INTO bookedLessons (c_id, lesson_datetime, lesson_type)
VALUES (4, '201809041515', 'intermediateSnowboard');

INSERT INTO bookedLessons (c_id, lesson_datetime, lesson_type)
VALUES (10, '201808091130', 'beginnersSki');

INSERT INTO bookedLessons (c_id, lesson_datetime, lesson_type)
VALUES (7, '201510030900', 'crosscountrySki');

commit;

/*---------------------------------------------------------------------------------*/
