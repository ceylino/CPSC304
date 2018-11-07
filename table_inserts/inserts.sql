/*CUSTOMER TABLE - 10 entries*/
INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (1, "abby@gmail.com", "Abby", 123456);

INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (2, "bill@gmail.com", "Bill", 123456);

INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (3, "carl@gmail.com", "Carl", 123456);

INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (4, "dave@gmail.com", "Dave", 123456);

INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (5, "ed@gmail.com", "Edward", 123456);

INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (6, "Fran@gmail.com", "Francis", 123456);

INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (7, "gaby@gmail.com", "Gabriela", 123456);

INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (8, "harriet@gmail.com", "Harriet", 123456);

INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (9, "ivan@gmail.com", "Ivan", 123456);

INSERT INTO customer (customer_id, email, name, creditcard_number)
VALUES (10, "jannet@gmail.com", "Jannet", 123456);

/*MEMBER TABLE - 5 entries
Changes: Datetime instead is string for Join Datetime.
Notes: Should we change fee (float) to fee (boolean)??
*/
INSERT INTO member (customer_id, fee, points, join_date)
VALUES (6, 12.50, 120, "20121103");

INSERT INTO member (customer_id, fee, points, join_date)
VALUES (7, 12.50, 56, "2017930");

INSERT INTO member (customer_id, fee, points, join_date)
VALUES (8, 12.50, 778, "20021031");

INSERT INTO member (customer_id, fee, points, join_date)
VALUES (9, 12.50, 1001, "19931121");

INSERT INTO member (customer_id, fee, points, join_date)
VALUES (10, 12.50, 10, "20180809");

/*ROOM TABLE - 15 entries*/
INSERT INTO room (room_num, room_type, room_rate)
VALUES (1, "double", 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (2, "double", 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (3, "double", 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (4, "double", 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (5, "double", 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (6, "triple", 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (7, "triple", 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (8, "triple", 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (9, "triple", 250.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (10, "quad", 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (11, "quad", 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (12, "king", 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (13, "king", 150.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (14, "honeymoon", 450.00);

INSERT INTO room (room_num, room_type, room_rate)
VALUES (15, "president", 500.00);

/*ROOM RATE TABLE - 6 entries (1 for each of the 6 room types)*/
INSERT INTO RoomRate (room_type, room_rate)
VALUES ("double", 150.00);

INSERT INTO RoomRate (room_type, room_rate)
VALUES ("triple", 150.00);

INSERT INTO RoomRate (room_type, room_rate)
VALUES ("quad", 150.00);

INSERT INTO RoomRate (room_type, room_rate)
VALUES ("king", 150.00);

INSERT INTO RoomRate (room_type, room_rate)
VALUES ("honeymoon", 450.00);

INSERT INTO RoomRate (room_type, room_rate)
VALUES ("president", 500.00);

/*HOTEL STAFF TABLE - 5 entries*/
INSERT INTO hotelStaff (staff_id, name, phone)
VALUES (1, "Zayn", "6041234567");

INSERT INTO hotelStaff (staff_id, name, phone)
VALUES (2, "Yasmin", "6041250080");

INSERT INTO hotelStaff (staff_id, name, phone)
VALUES (3, "Xander", "6041230000");

INSERT INTO hotelStaff (staff_id, name, phone)
VALUES (4, "Walter", "6041298800");

INSERT INTO hotelStaff (staff_id, name, phone)
VALUES (5, "Violet", "6049019977");

/*SKI STAFF TABLE - 5 entries*/
INSERT INTO skiStaff (staff_id, name, phone)
VALUES (6, "Ursula", "6042224567");

INSERT INTO skiStaff (staff_id, name, phone)
VALUES (7, "Tom", "6043330080");

INSERT INTO skiStaff (staff_id, name, phone)
VALUES (8, "Sam", "6044440000");

INSERT INTO skiStaff (staff_id, name, phone)
VALUES (9, "Ron", "6045558800");

INSERT INTO skiStaff (staff_id, name, phone)
VALUES (0, "Quin", "6049066677");

/*RENTAL EQUIPMENT TABLE - 15 entries*/
INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (1, "skis", 15.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (2, "skis", 15.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (3, "skis", 15.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (4, "snowboard", 10.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (5, "snowboard", 10.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (6, "snowboard", 10.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (7, "boots", 10.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (8, "boots", 10.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (9, "boots", 10.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (10, "pole", 5.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (11, "pole", 5.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (12, "poles", 5.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (13, "helmet", 5.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (14, "helmet", 5.00);

INSERT INTO rentalEquip (equip_id, type, rental_rate)
VALUES (15, "helmet", 5.00);

/*RENTAL EQUIPMENT RATE TABLE - 5 entries (1 for each of the 5 equip. types)*/
INSERT INTO rentalEquipRate (type, rental_rate)
VALUES ("skis", 15.00);

INSERT INTO rentalEquipRate (type, rental_rate)
VALUES ("snowboard", 10.00);

INSERT INTO rentalEquipRate (type, rental_rate)
VALUES ("boots", 10.00);

INSERT INTO rentalEquipRate (type, rental_rate)
VALUES ("poles", 5.00);

INSERT INTO rentalEquipRate (type, rental_rate)
VALUES ("helmet", 5.00);
