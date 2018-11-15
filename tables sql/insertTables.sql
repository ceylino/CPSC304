/*CUSTOMER TABLE - 10 entries*/
INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (1, 'abby@gmail.com', 'Abby', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (2, 'bill@gmail.com', 'Bill', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (3, 'carl@gmail.com', 'Carl', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (4, 'dave@gmail.com', 'Dave', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (5, 'ed@gmail.com', 'Edward', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (6, 'Fran@gmail.com', 'Francis', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (7, 'gaby@gmail.com', 'Gabriela', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (8, 'harriet@gmail.com', 'Harriet', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (9, 'ivan@gmail.com', 'Ivan', 123456);

INSERT INTO customer (c_id, c_name, e_mail, creditcard_num)
VALUES (10, 'jannet@gmail.com', 'Jannet', 123456);

commit;

/*---------------------------------------------------------------------------------*/
/*MEMBER TABLE - 5 entries */
/* Changes: Datetime instead is string for Join Datetime. */

INSERT INTO member (c_id, fee, points, join_date)
VALUES (6, 12.50, 120, '20121103');

INSERT INTO member (c_id, fee, points, join_date)
VALUES (7, 12.50, 56, '2017930');

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
VALUES ('triple', 150.00);

INSERT INTO roomRate (room_type, room_rate)
VALUES ('quad', 150.00);

INSERT INTO roomRate (room_type, room_rate)
VALUES ('king', 150.00);

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
VALUES (6, 'triple', 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (7, 'triple', 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (8, 'triple', 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (9, 'triple', 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (10, 'quad', 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (11, 'quad', 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (12, 'king', 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (13, 'king', 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (14, 'honeymoon', 450.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (15, 'president', 500.00);

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
INSERT INTO equipReservation (confirm_num, equip_id, c_id)
VALUES (1, 1, 1);

INSERT INTO equipReservation (confirm_num, equip_id, c_id)
VALUES (2, 9, 2);

INSERT INTO equipReservation (confirm_num, equip_id, c_id)
VALUES (3, 10, 3);

INSERT INTO equipReservation (confirm_num, equip_id, c_id)
VALUES (4, 14, 4);

INSERT INTO equipReservation (confirm_num, equip_id, c_id)
VALUES (5, 3, 10)

INSERT INTO equipReservation (confirm_num, equip_id, c_id)
VALUES (6, 5, 7)

INSERT INTO equipReservation (confirm_num, equip_id, c_id)
VALUES (7, 12, 8)

commit;

/*---------------------------------------------------------------------------------*/
/*ROOMRESERVATION TABLE - 7 entries*/
INSERT INTO roomReservation (confirm_num, room_num, c_id)
VALUES (1, 1, 4);

INSERT INTO roomReservation (confirm_num, room_num, c_id)
VALUES (2, 8, 4);

INSERT INTO roomReservation (confirm_num, room_num, c_id)
VALUES (3, 10, 2);

INSERT INTO roomReservation (confirm_num, room_num, c_id)
VALUES (4, 11, 10);

INSERT INTO roomReservation (confirm_num, room_num, c_id)
VALUES (5, 13, 8);

INSERT INTO roomReservation (confirm_num, room_num, c_id)
VALUES (6, 14, 6);

INSERT INTO roomReservation (confirm_num, room_num, c_id)
VALUES (7, 15, 5);

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
/*LESSON TABLE - 9 entries*/
INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (6, '201808091130', 'ski');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (6, '201808091430', 'ski');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (8, '201812051300', 'ski');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (8, '201812061300', 'ski');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (0, '201809031515', 'snowboard');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (0, '201809041515', 'snowboard');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (7, '201710191245', 'snowboard');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (7, '201710191545', 'snowboard');

INSERT INTO lesson (staff_id, lesson_datetime, lesson_type)
VALUES (9, '201510030900', 'crosscountry');

commit;

/*---------------------------------------------------------------------------------*/
/*LESSONTIME TABLE - 9 entries*/
INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('ski', '201808091130');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('ski', '201808091430');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('ski', '201812051300');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('ski', '201812061300');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('snowboard', '201809031515');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('snowboard', '201809041515');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('snowboard', '201710191245');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('snowboard', '201710191545');

INSERT INTO lessonTime (lesson_type, lesson_datetime)
VALUES ('crosscountry', '201510030900');

commit;

/*---------------------------------------------------------------------------------*/
/*BOOKEDLESSONS TABLE - 5 entries*/
INSERT INTO bookedLessons (c_id, lesson_type, staff_id)
VALUES (1, 'ski', 6);

INSERT INTO bookedLessons (c_id, lesson_type, staff_id)
VALUES (6, 'snowboard', 0);

INSERT INTO bookedLessons (c_id, lesson_type, staff_id)
VALUES (4, 'snowboard', 0);

INSERT INTO bookedLessons (c_id, lesson_type, staff_id)
VALUES (10, 'ski', 8);

INSERT INTO bookedLessons (c_id, lesson_type, staff_id)
VALUES (7, 'crosscountry', 9);

commit;

/*---------------------------------------------------------------------------------*/
