/* Name: Bhavik Bhakta       */
/* This is a sample Database Test*/
/* Date: 3/32017 */
/* 

/**************************************************
 *              STEPS 1,2: CREATE TABLES
 ***************************************************
 */
/*
set echo on;
drop procedure prereg;
*/
/* ----------------------------------------------------------------
 *** Step 0: Clear existing tables and then create fresh tables ***
 *           
 * ----------------------------------------------------------------
*/

/* ------DESERT ROSE ------*/
/*Desert Rose (email, phone#)*/
DROP SCHEMA IF EXISTS desertrose;
CREATE SCHEMA desertrose;

USE desertrose;


/*DROP TABLE IF EXISTS drose cascade constraints
;
*/
DROP TABLE IF EXISTS drose;

create table if not exists drose(
    email   char(25) NOT NULL,
    phonenum VARCHAR(13) NOT NULL
)
;


/* ------Client------*/
/*Client(CID,Name, Address, Phone#, Email, License#)*/

DROP TABLE IF EXISTS client;

create table if not exists client(
    id int(6) NOT NULL,
    fname char(10) NOT NULL,
    mname char(7),
    lname char(7) NOT NULL,
    stname VARCHAR(25) NOT NULL,
    city VARCHAR(13) NOT NULL,
    state char(2) NOT NULL,
    zip int(5) NOT NULL,
    phonenum VARCHAR(13) NOT NULL,
    email char(25) NOT NULL,
    liencenum VARCHAR(10) NOT NULL,
    constraint client_pk PRIMARY KEY (id)
)
;


/* ------ClientContact------*/
/*Client_contacts(CID, cdate, conformation)*/
DROP TABLE IF EXISTS clientcontact;

create table if not exists clientcontact(
    cid int(6) NOT NULL,
    cdate DATETIME NOT NULL,
    conformation int(3) NOT NULL
)
;

/*Foreign key cid is reference to clinet id from client table*/
alter table clientcontact add constraint
    clientcontact_fk foreign key(cid) 
    references client(id)
;


/* ------Patient------*/
/*Patient(PID,CID,name,age,gender,phone#)*/
DROP TABLE IF EXISTS patient;

create table if not exists patient(
    id int(6) NOT NULL,
    cid int(6) NOT NULL,
    fname char(7) NOT NULL,
    mname char(7),
    lname char(7) NOT NULL,
    age int(2) NOT NULL,
    gender char(1) NOT NULL,
    phonenum VARCHAR(11) NOT NULL,
    constraint patient_pk PRIMARY KEY (id)
)
;

/*Foreign key cid is reference to clinet id from client table*/

alter table patient add constraint
    patient_fk foreign key(cid) 
    references client(id)
;


/* ------Placed order------*/
/*Placed_order(OID,CID,Order_date,Conformation,Due_date,Priority)*/
DROP TABLE IF EXISTS placeorder; 

create table if not exists placeorder(
    id int(6) NOT NULL,
    cid int(6) NOT NULL,
    odate DATETIME NOT NULL,
    conformation int(3) NOT NULL,
    ddate DATE NOT NULL,
    priority int(1) NOT NULL,
    constraint placeorder_pk PRIMARY KEY (id)
)
;

/*Foreign key cid is reference to clinet id from client table*/
alter table placeorder add constraint
    placeorder_fk1 foreign key(cid) 
    references client(id)
;

/* ------Digital order------*/
/*Digital(OID,PID,Removal,Biteinformation,surgicalm...)*/
DROP TABLE IF EXISTS digitalorder; 

create table if not exists digitalorder(
    oid int(6) NOT NULL,
    pid int(6) NOT NULL,
    removal VARCHAR(25) NOT NULL,
    biteinfo VARCHAR(25) NOT NULL,
    surgical VARCHAR(25) NOT NULL
)
;

/*Foreign key cid is reference to clinet id from client table*/
alter table digitalorder add constraint
    digitalorder_fk1 foreign key(oid) 
    references placeorder(id)
;

alter table digitalorder add constraint
    digitalorder_fk2 foreign key(pid) 
    references patient(id)
;


/* ------pvs order------*/
/*PVS(OID,PID,BiteInformation,indirect, shade, recommend,...)*/
DROP TABLE IF EXISTS pvsorder; 

create table if not exists pvsorder(
    oid int(6) NOT NULL,
    pid int(6) NOT NULL,
    indirect VARCHAR(25) NOT NULL,
    biteinfo VARCHAR(25) NOT NULL,
    shade VARCHAR(25) NOT NULL
)
;

/*Foreign key cid is reference to clinet id from client table*/
alter table pvsorder add constraint
    pvsorder_fk1 foreign key(oid) 
    references placeorder(id)
;

alter table pvsorder add constraint
    pvsorder_fk2 foreign key(pid) 
    references patient(id)
;



/* ------Received ordered------*/
/*Received_order(OID,rdate,Conformation)*/
DROP TABLE IF EXISTS receivedorder;

create table if not exists receivedorder(
    oid int(6) NOT NULL,
    rdate DATETIME NOT NULL,
    conformation int(3) NOT NULL
)
;

/*Foreign key cid is reference to clinet id from client table*/
alter table receivedorder add constraint
    receivedorder_fk foreign key(oid) 
    references placeorder(id)
;



/* ------Completed ordered------*/
/*Complete_order(OID,cdate,Conformation)*/
DROP TABLE IF EXISTS completeorder;

create table if not exists completeorder(
    oid int(6) NOT NULL,
    cdate DATETIME NOT NULL,
    conformation int(3) NOT NULL
)
;

/*Foreign key cid is reference to clinet id from client table*/
alter table completeorder add constraint
    completeorder_fk foreign key(oid) 
    references placeorder(id)
;



/* ------Delievered ordered------*/
/*Delivered_order(OID,CID,ddate,Conformation)*/
DROP TABLE IF EXISTS deliverorder;

create table if not exists deliverorder(
    oid int(6) NOT NULL,
    cid int(6) NOT NULL,
    ddate DATETIME NOT NULL,
    conformation int(3) NOT NULL
)
;

/*Foreign key cid is reference to clinet id from client table*/
alter table deliverorder add constraint
    deliverorder_fk1 foreign key(oid) 
    references placeorder(id)
;

/*Foreign key cid is reference to clinet id from client table*/
alter table deliverorder add constraint
    deliverorder_fk2 foreign key(cid) 
    references client(id)
;



/*------FINAL STATUS i.e desribes the tables -------*/
describe drose;
describe client;
describe clientcontact;
describe patient;
describe placeorder;
describe digitalorder;
describe pvsorder;
describe receivedorder;
describe completeorder;
describe deliverorder;

/* ----------------------------------------------------------------
 *** Step 1: Populate the tables ***
 * ----------------------------------------------------------------
*/

/*drose table */
insert into drose values ('drose@gmail.com', '575-361-2073');

/*client table*/
insert into client values (111111, 'Batman', '', 'DC', '1218 31st Ave.', 'Gotham', 'PI', 78251, '123-456-7820', 'thebats@op.com', 023456);
insert into client values (111222, 'Spiderman', '', 'Marvel', '2025 Broadway Ave.', 'New York', 'NY', 10009, '207-555-2034', 'spider@gmail.com', 013562);
insert into client values (111333, 'Daredevil', '', 'Netflix', '9825 Wall St.', 'New York', 'NY', 10008, '207-425-9825', 'dare@diablo.com', 012463);

/*client contact table*/
insert into clientcontact values (111111, '2017-03-03 05:17:00', 8930);
insert into clientcontact values (111222, '2017-01-02 22:13:07', 8930);
insert into clientcontact values (111333, '2017-03-03 13:20:22', 8930);

/*patient table*/
insert into patient values (222111, 111111, 'The', '', 'Joker', 36, 'M', '123-761-8520');
insert into patient values (222222, 111111, 'Killer', '', 'Croc', 29, 'M', '123-989-0500');
insert into patient values (222333, 111222, 'The', '', 'Venom', 25, 'M', '207-006-0008');
insert into patient values (222444, 111222, 'Mr.', '', 'Lizard', 42, 'M', '207-700-0007');
insert into patient values (222555, 111333, 'Bull', '', 'Eye', 25, 'M', '207-189-7823');
insert into patient values (222666, 111333, 'The', '', 'Kingpin', 39, 'M', '207-423-77789');

/*  placeorder table */
insert into placeorder values (000111, 111111, '2017-03-03 06:18:00', 8930, '2017-03-03', 0);
insert into placeorder values (000222, 111111, '2017-03-03 07:18:00', 8930, '2017-03-03', 0);
insert into placeorder values (000333, 111222, '2017-03-02 23:18:00', 8930, '2017-03-03', 0);
insert into placeorder values (000444, 111222, '2017-03-02 23:42:00', 8930, '2017-03-04', 0);
insert into placeorder values (000555, 111333, '2017-03-03 13:22:00', 8930, '2017-03-03', 0);
insert into placeorder values (000666, 111333, '2017-03-04 06:18:00', 8930, '2017-03-06', 0);

/* digitalorder table */

insert into digitalorder values (000111, 222111, 'pivital', 'anterio', 'cbct');
insert into digitalorder values (000333, 222333, 'night guard', 'posterior', 'lab fourm');
insert into digitalorder values (000555, 222555, 'surgical guide', 'margins', 'impression');

/* pvsorder table */

insert into pvsorder values (000222, 222222, 'crown', 'light', 'monolithic');
insert into pvsorder values (000444, 222444, 'abutment', 'heavy', 'shading');
insert into pvsorder values (000666, 222666, 'crown', 'light', 'shading');

/*receivedorder table*/
insert into receivedorder values (000111, '2017-03-03 06:20:00', 8930);
insert into receivedorder values (000222, '2017-03-03 07:24:00', 8930);
insert into receivedorder values (000333, '2017-03-02 23:20:00', 8930);
insert into receivedorder values (000444, '2017-03-02 23:45:00', 8930);
insert into receivedorder values (000555, '2017-03-03 13:24:00', 8930);
insert into receivedorder values (000666, '2017-03-04 06:20:00', 8930);

/*completeorder table*/
insert into completeorder values (000111, '2017-03-03 08:20:00', 0);
insert into completeorder values (000333, '2017-03-02 24:20:00', 0);
insert into completeorder values (000555, '2017-03-03 14:22:00', 0);

/*deliverorder table*/
insert into deliverorder values (000111, 111111, '2017-03-03 08:50:00', 0);
insert into deliverorder values (000333, 111222,  '2017-03-02 24:20:00', 0);
insert into deliverorder values (000555, 111333,  '', 1);

/* ----------------------------------------------------------------
  * *** Step 2:Display contents of all the tables ***
  * ----------------------------------------------------------------
 */

select * 
    from drose;

select * 
    from client;

select * 
    from clientcontact;

select * 
    from patient;

select * 
    from placeorder;

select * 
    from digitalorder;

select * 
    from pvsorder;

select * 
    from receivedorder;

select * 
    from completeorder;

select * 
    from deliverorder;


/* ----------------------------------------------------------------
 *  Step 3: The Queries
 * ----------------------------------------------------------------
 */

/*select order that are due today*/
select p.id, p.cid, p.odate, p.ddate
    from placeorder p, receivedorder r
    where p.id = r.oid
    and p.ddate = '2017-03-03'
;

/*select digital order order that are due today*/
select d.oid, d.pid, d.removal, d.biteinfo, d.surgical
    from placeorder p, receivedorder r, digitalorder d
    where p.id = r.oid
    and p.ddate = '2017-03-03'
    and r.oid = d.oid
;

/*select pvsorder order order that are due today*/
select q.oid, q.pid, q.indirect, q.biteinfo, q.shade
    from placeorder p, receivedorder r, pvsorder q
    where p.id = r.oid
    and p.ddate = '2017-03-03'
    and r.oid = q.oid
;



/*select order that are not completed*/
select p.id, p.cid, p.odate, p.ddate
    from placeorder p, receivedorder r
    where p.id = r.oid
    and p.id not in
        (select c.oid 
            from completeorder c)
    ;

/*select order that are due today but not completed*/
select p.id, p.cid, p.odate, p.ddate
    from placeorder p, receivedorder r
    where p.id = r.oid
    and p.ddate = '2017-03-03'
    and p.id not in
        (select c.oid 
            from completeorder c)
    ;

/*select name phone of patient whos order are completed */
select p.id, p.cid, p.fname, p.lname, p.gender, p.phonenum
    from patient p, placeorder r, completeorder c
    where r.id = c.oid
    and p.cid = r.cid
;

/*select order that are completed but not delievered*/
select d.oid, d.cid, c.cdate
    from deliverorder d, completeorder c
    where d.oid = c.oid
    and d.conformation = 1
;

/* ---------------------------------------------------------------- */
/*   CLEANUP  */
/* ---------------------------------------------------------------- */

/*
set echo off;
spool off;
*/
