drop table if exists user1;
create table user1
(
username varchar(20),
password varchar(20)
);
cc


drop table if exists statedetails;
create table statedetails
(
    stateid int(20) primary key auto_increment,
    states varchar(30)
)auto_increment=1001;


insert into statedetails values
(NULL,'Karnataka'),
(NULL,'West Bengal'),
(NULL,'Maharastra'),
(NULL,'Delhi'),
(NULL,'Uttarakhand');


drop table if exists citydetails;
create table citydetails(
    cityid int(20) primary key auto_increment,
    cities varchar(30),
    stateid int(20)
)auto_increment=101;


insert into citydetails values
(NULL,'Kodagu',1001),
(NULL,'Bangalore',1001),
(NULL,'Mysore',1001),
(NULL,'Mangalore',1001);

insert into citydetails values
(NULL,'Kolkata',1002),
(NULL,'Haldia',1002),
(NULL,'Durgapur',1002),
(NULL,'Howrah',1002);

insert into citydetails values
(NULL,'Mumbai',1003),
(NULL,'Pune',1003),
(NULL,'Navi Mumbai',1003),
(NULL,'Nashik',1003);

insert into citydetails values
(NULL,'Paschim Vihar',1004),
(NULL,'Ghaziabad',1004),
(NULL,'Noida',1004),
(NULL,'Gurugram',1004);

insert into citydetails values
(NULL,'Deheradun',1005),
(NULL,'Musoorie',1005),
(NULL,'Kulu',1005),
(NULL,'Manali',1005);
