# NAME: MOHAMED ALIF FATHI BIN ABDUL LATIF
# MATRIC NO: A23CS0112

# Task 1: Database Creation and Integrity Constraints

# DROP DATABASE IF EXISTS hostel_mgmt_alif;

CREATE DATABASE hostel_mgmt_alif;
USE hostel_mgmt_alif;

CREATE TABLE room_types (
    type_id INT AUTO_INCREMENT PRIMARY KEY,
    type_name ENUM('Single', 'Double', 'Premium', 'Family') NOT NULL,
    rent DECIMAL(8,2) NOT NULL,
    deposit DECIMAL(8,2) NOT NULL,
    capacity INT NOT NULL
);

CREATE TABLE rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    type_id INT NOT NULL,
    room_no VARCHAR(10) NOT NULL UNIQUE,
    floor_no INT NOT NULL,
    is_occupied BOOLEAN DEFAULT FALSE NOT NULL,
    FOREIGN KEY (type_id) REFERENCES room_types(type_id)
);

CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    status ENUM('ACTIVE', 'NON_ACTIVE') NOT NULL,
    checkin_date DATE NOT NULL,
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);

CREATE TABLE maintenance (
    maint_id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    issue_desc TEXT NOT NULL,
    severity ENUM('LOW','MEDIUM','HIGH') NOT NULL,
    status ENUM('OPEN','RESOLVED') NOT NULL,
    reported_on DATE NOT NULL,
    resolved_on DATE,
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);

CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    amount DECIMAL(8,2) NOT NULL,
    paid_on DATE NOT NULL,
    method ENUM('CASH','FPX','CARD','TNG') NOT NULL,
    note TEXT,
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);

# Alter table, create and delete test table
ALTER TABLE students ADD COLUMN email VARCHAR(50) UNIQUE;

CREATE TABLE test (
	id INT AUTO_INCREMENT PRIMARY KEY
);

DROP TABLE test;

# Task 2 Data Manipulation and Filtering

# Q1 Data Insertion (DML)

INSERT INTO room_types (type_name, rent, deposit, capacity) VALUES
('Single', 700.00, 300.00, 1),
('Single', 750.00, 300.00, 1),
('Single', 800.00, 300.00, 1),
('Double', 500.00, 200.00, 2),
('Double', 550.00, 200.00, 2),
('Double', 600.00, 200.00, 2),
('Premium', 700.00, 300.00, 2),
('Premium', 750.00, 300.00, 2),
('Premium', 800.00, 300.00, 2),
('Family', 1200.00, 500.00, 4),
('Family', 1250.00, 500.00, 4),
('Family', 1300.00, 500.00, 4);

INSERT INTO rooms (type_id, room_no, floor_no) VALUES
(4, 'A101', 1),
(4, 'A102', 1),
(5, 'A103', 1),
(5, 'A104', 1),
(6, 'A105', 1),
(1, 'A201', 2),
(1, 'A202', 2),
(2, 'A203', 2),
(2, 'A204', 2),
(3, 'A205', 2),
(7, 'A301', 3),
(8, 'A302', 3),
(9, 'A303', 3),
(10, 'A401', 4),
(11, 'A402', 4),
(12, 'A403', 4);

INSERT INTO students (room_id, fname, lname, status, checkin_date, email) VALUES
(1,'Alif','Fathi','ACTIVE','2025-09-26','alif@graduate.utm.my'),
(1,'Sabrina','Carpenter','ACTIVE','2025-10-08','sabrina@graduate.utm.my'),
(1,'Rie','Takahashi','NON_ACTIVE','2025-08-08','rie@graduate.utm.my'),
(2,'Iman','Abadi','ACTIVE','2025-09-10','iman@graduate.utm.my'),
(2,'Bella','Astillah','ACTIVE','2025-09-01','bella@graduate.utm.my'),
(3,'Adam','Ramli','ACTIVE','2025-10-01','adam@graduate.utm.my'),
(3,'Cindy','Liew','NON_ACTIVE','2025-08-15','cindy@graduate.utm.my'),
(4,'Siti','Farah','ACTIVE','2025-09-05','siti@graduate.utm.my'),
(4,'Naim','Daniel','NON_ACTIVE','2025-08-10','naim@graduate.utm.my'),
(5,'Emma','Watson','ACTIVE','2025-10-11','emma@graduate.utm.my'),
(5,'Elizabeth','Tan','ACTIVE','2025-10-15','elizabeth@graduate.utm.my'),
(6,'Ahmad','Afiq','NON_ACTIVE','2025-08-22','ahmad@graduate.utm.my'),
(7,'Farid','Hassan','ACTIVE','2025-10-20','farid@graduate.utm.my'),
(8,'Nadia','Zainal','ACTIVE','2025-09-25','nadia@graduate.utm.my'),
(9,'Hafiz','Ali','NON_ACTIVE','2025-08-30','hafiz@graduate.utm.my'),
(10,'Amirah','Osman','ACTIVE','2025-10-05','amirah@graduate.utm.my'),
(11,'Danish','Halim','ACTIVE','2025-09-12','danish@graduate.utm.my'),
(11,'Natsuki','Deguchi','ACTIVE','2025-09-28','natsuki@graduate.utm.my'),
(12,'Justin','Bieber','ACTIVE','2025-09-08','justin@graduate.utm.my'),
(12,'Iqmal','Hakim','NON_ACTIVE','2025-08-03','iqmal@graduate.utm.my'),
(13,'Damiya','Aina','NON_ACTIVE','2025-08-03','damiya@graduate.utm.my'),
(14,'Janna','Nick','ACTIVE','2025-10-02','janna@graduate.utm.my'),
(14,'Nur','Firzana','ACTIVE','2025-10-02','nur@graduate.utm.my'),
(14,'Nurul','Adriana','ACTIVE','2025-10-02','nurul@graduate.utm.my'),
(15,'Adib','Zikri','ACTIVE','2025-10-03','adib@graduate.utm.my'),
(16,'Furina','Focalors','NON_ACTIVE','2025-08-06','furina@graduate.utm.my');

INSERT INTO maintenance (room_id, issue_desc, severity, status, reported_on, resolved_on) VALUES
(1,'Bed slat broken','MEDIUM','OPEN','2025-10-26',NULL),
(1,'Lamp flickering','LOW','RESOLVED','2025-09-05','2025-09-08'),
(2,'Floor crack','HIGH','OPEN','2025-10-12',NULL),
(2,'Locker door loose','LOW','RESOLVED','2025-08-20','2025-08-25'),
(3,'Ceiling fan wobbling','MEDIUM','OPEN','2025-10-20',NULL),
(3,'Bulb blown','LOW','RESOLVED','2025-09-09','2025-09-10'),
(4,'Window latch broken','HIGH','OPEN','2025-10-22',NULL),
(4,'Door hinge loose','LOW','RESOLVED','2025-08-10','2025-08-14'),
(5,'Drawer jammed','LOW','OPEN','2025-10-25',NULL),
(5,'Chair leg broken','MEDIUM','OPEN','2025-10-27',NULL),
(6,'Window glass cracked','MEDIUM','OPEN','2025-10-24',NULL),
(6,'Power socket loose','HIGH','OPEN','2025-09-30',NULL),
(7,'Door handle loose','LOW','RESOLVED','2025-08-05','2025-08-14'),
(7,'Floor tile cracked','MEDIUM','RESOLVED','2025-08-06','2025-08-12'),
(8,'Shower pipe burst','HIGH','OPEN','2025-10-27',NULL),
(9,'Curtain rod bent','MEDIUM','RESOLVED','2025-08-10','2025-08-15'),
(9,'Lamp wiring exposed','HIGH','RESOLVED','2025-09-20','2025-09-22'),
(10,'Sink leaking','LOW','OPEN','2025-10-23',NULL),
(10,'Mirror cracked','HIGH','OPEN','2025-10-28',NULL),
(11,'Lamp switch loose','LOW','RESOLVED','2025-09-12','2025-09-13'),
(12,'Wall paint peeling','LOW','RESOLVED','2025-09-12','2025-09-20'),
(12,'Power socket intermittent','MEDIUM','OPEN','2025-10-10',NULL),
(13,'Bed frame wobbling','MEDIUM','OPEN','2025-10-27',NULL),
(13,'Power socket loose','MEDIUM','OPEN','2025-10-29',NULL),
(14,'Toilet flush faulty','HIGH','OPEN','2025-10-29',NULL),
(14,'Locker door dented','LOW','RESOLVED','2025-08-18','2025-08-22'),
(15,'Desk drawer stuck','LOW','RESOLVED','2025-08-22','2025-08-25'),
(16,'Bed frame unstable','MEDIUM','OPEN','2025-10-30',NULL);

INSERT INTO payments (student_id, amount, paid_on, method, note) VALUES
(1,500.00,'2025-10-01','CASH','Rent (Oct 2025)'),
(2,500.00,'2025-11-01','FPX','Rent (Nov 2025)'),
(3,500.00,'2025-09-01','CARD','Rent (Sep 2025)'),
(4,500.00,'2025-10-01','TNG','Rent (Oct 2025)'),
(5,500.00,'2025-10-01','CASH','Rent (Oct 2025)'),
(6,550.00,'2025-11-01','FPX','Rent (Nov 2025)'),
(7,550.00,'2025-09-01','CARD','Rent (Sep 2025)'),
(8,550.00,'2025-10-01','TNG','Rent (Oct 2025)'),
(9,550.00,'2025-09-01','CASH','Rent (Sep 2025)'),
(10,600.00,'2025-11-01','FPX','Rent (Nov 2025)'),
(11,600.00,'2025-11-01','CARD','Rent (Nov 2025)'),
(12,700.00,'2025-09-01','TNG','Rent (Sep 2025)'),
(13,700.00,'2025-11-01','CASH','Rent (Nov 2025)'),
(14,750.00,'2025-10-01','FPX','Rent (Oct 2025)'),
(15,750.00,'2025-09-01','CARD','Rent (Sep 2025)'),
(16,800.00,'2025-11-01','TNG','Rent (Nov 2025)'),
(17,700.00,'2025-10-01','CASH','Rent (Oct 2025)'),
(18,700.00,'2025-10-01','FPX','Rent (Oct 2025)'),
(19,750.00,'2025-10-01','CARD','Rent (Oct 2025)'),
(20,750.00,'2025-09-01','TNG','Rent (Sep 2025)'),
(21,800.00,'2025-09-01','CASH','Rent (Sep 2025)'),
(22,1200.00,'2025-11-01','FPX','Rent (Nov 2025)'),
(23,1200.00,'2025-11-01','CARD','Rent (Nov 2025)'),
(24,1200.00,'2025-11-01','CASH','Rent (Nov 2025)'),
(25,1250.00,'2025-11-01','FPX','Rent (Nov 2025)'),
(26,1300.00,'2025-09-01','CARD','Rent (Sep 2025)');

# Q2 UPDATE and DELETE Operations

SET SQL_SAFE_UPDATES = 0;

UPDATE rooms
SET is_occupied = CASE
    WHEN room_id IN (SELECT room_id FROM students WHERE status = 'ACTIVE') THEN TRUE
    ELSE FALSE
END;

DELETE FROM maintenance
WHERE status='RESOLVED' AND DATEDIFF(CURDATE(), reported_on) > 60;

# Q3 Data Retrieval and Filtering Queries

SELECT * FROM room_types WHERE rent BETWEEN 400 AND 800;

SELECT * FROM students WHERE fname LIKE 'A%';

SELECT * FROM payments WHERE method IN ('FPX','CARD');

SELECT *
FROM students
WHERE (status = 'ACTIVE' OR status = 'NON_ACTIVE') AND NOT (email LIKE '%gmail.com');

# Q4 Functions and Expressions

# Aggregate Function
SELECT room_id, COUNT(student_id) AS total_students
FROM students
GROUP BY room_id;

# String Function
SELECT student_id, CONCAT(UPPER(fname), ' ', UPPER(lname)) AS full_name_upper
FROM students;

# Task 3 Reporting and Aggregation

# Q1

CREATE VIEW v_room_status AS
SELECT 
    r.room_no,
    rt.type_name,
    rt.rent,
    r.floor_no,
    rt.capacity,
    CASE WHEN s.n_occupants IS NULL THEN 0 ELSE s.n_occupants END AS n_occupants,
    CASE WHEN m.pending_issues IS NULL THEN 0 ELSE m.pending_issues END AS pending_issues,
    NOT r.is_occupied AS is_vacant
FROM rooms r
JOIN room_types rt ON r.type_id = rt.type_id
LEFT JOIN (
    SELECT room_id, SUM(status='ACTIVE') AS n_occupants
    FROM students
    GROUP BY room_id
) s ON r.room_id = s.room_id
LEFT JOIN (
    SELECT room_id, SUM(status='OPEN') AS pending_issues
    FROM maintenance
    GROUP BY room_id
) m ON r.room_id = m.room_id;

SELECT * FROM v_room_status;

# Q2

SELECT rt.type_name, COUNT(s.status) AS n_occupants
FROM rooms r
JOIN room_types rt ON rt.type_id = r.type_id
LEFT JOIN students s ON s.room_id = r.room_id
WHERE s.status = 'ACTIVE'
GROUP BY rt.type_name;

SELECT rt.type_name, ROUND(AVG(rt.rent),2) AS average_rent, ROUND(SUM(rt.deposit),2) AS sum_deposit
FROM rooms r
JOIN room_types rt ON rt.type_id = r.type_id
LEFT JOIN students s ON s.room_id = r.room_id
WHERE s.status = 'ACTIVE'
GROUP BY rt.type_name;

SELECT UPPER(MONTHNAME(paid_on)) AS month, YEAR(paid_on) AS year_paid_on, SUM(amount) AS sum_amount
FROM payments
GROUP BY paid_on;

SELECT r.floor_no, COUNT(m.status) AS total_issues
FROM maintenance m
JOIN rooms r ON r.room_id = m.room_id
WHERE status = 'OPEN'
GROUP BY floor_no
HAVING COUNT(m.status) > 2;

# Q3

SELECT
	CONCAT(UPPER(s.fname), ' ', UPPER(s.lname)) AS student_name,
    ROUND(rent, 2) AS rent,
    type_name AS room_type,
    CASE
        WHEN rent < 600 THEN 'LOW'
        WHEN rent BETWEEN 600 AND 900 THEN 'MEDIUM'
        ELSE 'HIGH'
    END AS rent_category
FROM room_types rt
JOIN rooms r ON r.type_id = rt.type_id
LEFT JOIN students s ON s.room_id = r.room_id;
