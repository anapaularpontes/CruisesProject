DROP DATABASE IF EXISTS CRUISES;
CREATE DATABASE CRUISES;
use CRUISES;

DROP TABLE IF EXISTS cities;
CREATE TABLE IF NOT EXISTS cities (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  active boolean not null default 1,
  PRIMARY KEY (id));

DROP TABLE IF EXISTS ships;
CREATE TABLE IF NOT EXISTS ships (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(45) NOT NULL,
  yearservice int(5) NOT NULL,
  active boolean not null default 1,
  PRIMARY KEY (id));

DROP TABLE IF EXISTS facilities;
CREATE TABLE IF NOT EXISTS facilities (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(45) NOT NULL,
    active boolean not null default 1,
    PRIMARY KEY (id));

DROP TABLE IF EXISTS tours;
CREATE TABLE IF NOT EXISTS tours (
  id int NOT NULL AUTO_INCREMENT,
  sailing_date date DEFAULT NULL,
  duration int NOT NULL,
  ship int NOT NULL,
  from_city int NOT NULL,
  to_city int NOT NULL,
  oneway int(1) not null,
  PRIMARY KEY (id),
  FOREIGN KEY (from_city) REFERENCES cities.id,
  FOREIGN KEY (to_city) REFERENCES cities.id,
  FOREIGN KEY (ship) REFERENCES ships(id));

DROP TABLE IF EXISTS attractions;
CREATE TABLE IF NOT EXISTS attractions (
  id int NOT NULL AUTO_INCREMENT,
  attraction varchar(30) NOT NULL,
  tour int NOT NULL,
  PRIMARY KEY (id),  
  FOREIGN KEY (tour) REFERENCES tours(id));

DROP TABLE IF EXISTS facilities_ship;
CREATE TABLE IF NOT EXISTS facilities_ship (
  id int NOT NULL AUTO_INCREMENT,
  facilities int NOT NULL,
  ship int NOT NULL,
  PRIMARY KEY (id),  
  FOREIGN KEY (facilities) REFERENCES facilities(id),
  FOREIGN KEY (ship) REFERENCES ships(id));

insert into cities(name) values 
  ('Alaska'),
  ('Bahamas'),
  ('Aruba'),
  ('Curacao'),
  ('Caribbean'),
  ('Vancouver'),
  ('Puerto Rico'),
  ('Jamaica'),
  ('US Virgin Islands');

insert into ships(name,yearservice) values 
  ('Polar Bear',2008),
  ('Grizzly Bear',2013),
  ('Black Bear',2009),
  ('Brown Bear',2015),
  ('Spirit Bear',2012);

insert into facilities(name) values 
  ('Olympic Swiming Pool'),
  ('Fitnes Center'),
  ('Cinema'),
  ('Spa'),
  ('Hot Tub'),
  ('Casino'),
  ('Tennis Courts'),
  ('Water Slide');

insert into tours (sailing_date,duration,ship,from_city,to_city,oneway) values 
  ('2019-06-15', 30, 1, 6, 1, 0),
  ('2019-07-20', 21, 1, 6, 7, 1),
  ('2019-08-12', 14, 1, 7, 8, 1),
  ('2019-08-31', 12, 1, 8, 6, 1),
  ('2019-04-27', 21, 2, 9, 3, 0),
  ('2019-05-25', 14, 2, 9, 4, 1),
  ('2019-06-15', 21, 2, 4, 8, 1),
  ('2019-07-12', 14, 2, 8, 6, 1),
  ('2019-07-26', 25, 2, 6, 5, 0),
  ('2019-07-27', 10, 2, 6, 7, 1),
  ('2019-12-14', 21, 2, 7, 2, 1),
  ('2019-08-11', 17, 2, 2, 9, 1),
  ('2019-05-25', 18, 3, 9, 2, 1),
  ('2019-06-15', 14, 3, 2, 5, 1),
  ('2019-06-30', 10, 3, 5, 9, 1),
  ('2019-07-12', 21, 3, 9, 3, 0),
  ('2019-05-11', 12, 4, 6, 3, 1),
  ('2019-06-01', 18, 4, 3, 7, 0),
  ('2019-06-22', 14, 4, 3, 5, 0),
  ('2019-07-13', 12, 4, 3, 7, 1),
  ('2019-08-22', 14, 4, 7, 6, 1),
  ('2019-05-18', 30, 5, 6, 1, 0),
  ('2019-06-21', 14, 5, 6, 4, 1),
  ('2019-07-07', 12, 5, 4, 2, 1),
  ('2019-07-21', 18, 5, 2, 8, 1),
  ('2019-08-10', 10, 5, 8, 6, 1);

insert into attractions (attraction, tour) values 
  ('Phil Collins Concert', 1),
  ('Bob Marley Concert', 3),
  ('Justin Timberlake Concert', 7),
  ('Cirque du Soleil', 9),
  ('David Copperfield Show', 10),
  ('Roberto Carlos Concert', 14),
  ('Paul McCartney Concert', 18),
  ('Elton John Concert', 20),
  ('Celine Dion Concert', 22),
  ('Ed Sheeran Concert', 23);

insert into facilities_ship (ship, facilities) values 
  (1,1),
  (2,1),
  (4,1),
  (5,1),
  (1,2),
  (2,2),
  (4,2),
  (1,3),
  (3,3),
  (2,4),
  (3,4),
  (4,4),
  (5,4),
  (1,5),
  (3,5),
  (4,5),
  (2,6),
  (4,6),
  (5,6),
  (2,7),
  (3,7),
  (4,7),
  (5,7),
  (1,8),
  (2,8),
  (4,8),
  (5,8);