drop database if exists transportmanager;

create database transportManager;
use transportManager;

create table roles(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(30) NOT NULL
);

insert into roles(role_name) values('Admin');
insert into roles(role_name) values('Client');
insert into roles(role_name) values('Employee');

create table countries(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    country_name VARCHAR(30) NOT NULL
);

insert into countries(country_name) values('Morocco');
insert into countries(country_name) values('USA');

-- create table containers_states(
--     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--     container_state_name VARCHAR(30) NOT NULL
-- );

-- insert into containers_states(container_state_name) values('On Shipping');
-- insert into containers_states(container_state_name) values('Shipped');
-- insert into containers_states(container_state_name) values('Shipped and back');

create table cities(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    city_name VARCHAR(30) NOT NULL,
    country_id int(6) UNSIGNED,
    foreign key (country_id) references countries(id)
);


insert into cities(city_name,country_id) values('Rabat',1);
insert into cities(city_name,country_id) values('Tanger',1);
insert into cities(city_name,country_id) values('Casablanca',1);
insert into cities(city_name,country_id) values('Fes',1);
insert into cities(city_name,country_id) values('New york',2);
insert into cities(city_name,country_id) values('Chicago',2);

create table users(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(50) ,
    password VARCHAR(50),
    role_id  int(6) UNSIGNED,
    unique(email),
    foreign key (role_id) references users(id)
);

insert into users(first_name,last_name,email,password,role_id) values ('admin','account','admin@mail.com','password',1);
insert into users(first_name,last_name,email,password,role_id) values ('Reda','Sahmi','reda@mail.com','password',2);
insert into users(first_name,last_name,email,password,role_id) values ('Khalid','Benjelloun','khalid@mail.com','password',3);

create table containers(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(30) NOT NULL,
    max_volume int not null,
    free boolean
    
);

insert into containers(label,max_volume,free) values ('Cargo-A1',200,true);
insert into containers(label,max_volume,free) values ('Cargo-A2',300,true);
insert into containers(label,max_volume,free) values ('Cargo-A3',400,false);

create table travels(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    from_city_id int(6) UNSIGNED,
    to_city_id int(6) UNSIGNED,
    container_id int(6) UNSIGNED,
    client_id int(6) UNSIGNED,
    unit_price double ,
    departure_date date,
    arrival_date date ,
    foreign key (from_city_id) references cities(id),
    foreign key (to_city_id) references cities(id),
    foreign key (container_id) references containers(id),
    foreign key (client_id) references users(id)
);

insert into travels(from_city_id,to_city_id,container_id,client_id,unit_price,departure_date,arrival_date) values (1,2,1,2,12500,'2022/07/14','2022/12/25');
insert into travels(from_city_id,to_city_id,container_id,client_id,unit_price,departure_date,arrival_date) values (3,1,2,3,43500,'2022/09/25',null);