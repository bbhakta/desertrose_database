-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2017 at 06:34 PM
-- Server version: 5.5.55
-- PHP Version: 5.4.45-0+deb7u8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: 'desertrose'
--

-- --------------------------------------------------------

--
-- Table structure for table 'client'
--

CREATE TABLE IF NOT EXISTS `client` (
  id int(6) NOT NULL AUTO_INCREMENT,
  fname char(10) NOT NULL,
  mname char(7) DEFAULT NULL,
  lname char(7) NOT NULL,
  sname varchar(25) NOT NULL,
  city varchar(13) NOT NULL,
  state char(2) NOT NULL,
  zip int(5) NOT NULL,
  phonenum varchar(13) NOT NULL,
  email char(25) NOT NULL,
  liencenum varchar(10) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111357 ;

--
-- Dumping data for table 'client'
--

INSERT INTO client (id, fname, mname, lname, sname, city, state, zip, phonenum, email, liencenum) VALUES
(111111, 'Batman', '', 'DC', '1218 31st Ave.', 'Gotham', 'PI', 78251, '123-456-7820', 'thebats@op.com', '23456'),
(111222, 'Spiderman', '', 'Marvel', '2025 Broadway Ave.', 'New York', 'NY', 10009, '207-555-2034', 'spider@gmail.com', '13562'),
(111333, 'Daredevil', '', 'Netflix', '9825 Wall St.', 'New York', 'NY', 10008, '207-425-9825', 'dare@diablo.com', '12463'),
(111334, 'Aavatr', '', 'Aang', 'Southere Air Temple', 'South', 'Ai', 82235, '760-395-2320', 'aange@saveworld.com', '12456'),
(111343, 'Aavatr', '', 'Kora', 'Southern Water Tribe', 'South', 'So', 72823, '225-565-789', 'kora@tearbending.com', '127557'),
(111349, 'Sherlock', '', 'Homes', '1256 Baker St', 'London', 'En', 52563, '760-395-2320', 'sdeduction@homes.com', '562323'),
(111355, 'John', 'W', 'Wayne', '1246 E. 66th St.', 'New York', 'NY', 42565, '423-456-7893', 'wwayne@gmail.com', '4567824');

-- --------------------------------------------------------

--
-- Table structure for table 'clientcontact'
--

CREATE TABLE IF NOT EXISTS clientcontact (
  cid int(6) NOT NULL,
  cdate datetime NOT NULL,
  conformation int(3) NOT NULL,
  UNIQUE KEY cid (cid)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'clientcontact'
--

INSERT INTO clientcontact (cid, cdate, conformation) VALUES
(111111, '2017-03-03 05:17:00', 8930),
(111222, '2017-01-02 22:13:07', 8930),
(111333, '2017-03-03 13:20:22', 8930);

-- --------------------------------------------------------

--
-- Table structure for table 'completeorder'
--

CREATE TABLE IF NOT EXISTS completeorder (
  oid int(6) NOT NULL,
  cdate datetime NOT NULL,
  conformation int(3) NOT NULL,
  KEY completeorder_fk (oid)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'completeorder'
--

INSERT INTO completeorder (oid, cdate, conformation) VALUES
(111, '2017-03-03 08:20:00', 0),
(333, '0000-00-00 00:00:00', 0),
(555, '2017-03-03 14:22:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table 'deliverorder'
--

CREATE TABLE IF NOT EXISTS deliverorder (
  oid int(6) NOT NULL,
  cid int(6) NOT NULL,
  ddate datetime NOT NULL,
  conformation int(3) NOT NULL,
  KEY deliverorder_fk1 (oid),
  KEY deliverorder_fk2 (cid)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'deliverorder'
--

INSERT INTO deliverorder (oid, cid, ddate, conformation) VALUES
(111, 111111, '2017-03-03 08:50:00', 0),
(333, 111222, '0000-00-00 00:00:00', 0),
(555, 111333, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table 'digitalorder'
--

CREATE TABLE IF NOT EXISTS digitalorder (
  oid int(6) NOT NULL,
  pid int(6) NOT NULL,
  removal varchar(25) NOT NULL,
  biteinfo varchar(25) NOT NULL,
  surgical varchar(25) NOT NULL,
  KEY digitalorder_fk1 (oid),
  KEY digitalorder_fk2 (pid)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'digitalorder'
--

INSERT INTO digitalorder (oid, pid, removal, biteinfo, surgical) VALUES
(111, 222111, 'pivital', 'anterio', 'cbct'),
(333, 222333, 'night guard', 'posterior', 'lab fourm'),
(555, 222555, 'surgical guide', 'margins', 'impression');

-- --------------------------------------------------------

--
-- Table structure for table 'drose'
--

CREATE TABLE IF NOT EXISTS drose (
  email char(25) DEFAULT NULL,
  phonenum varchar(13) DEFAULT NULL,
  sname varchar(35) DEFAULT NULL,
  city varchar(13) DEFAULT NULL,
  state char(2) DEFAULT NULL,
  zip int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'drose'
--

INSERT INTO drose (email, phonenum, sname, city, state, zip) VALUES
('drose@gmail.com', '575-361-2073', '7520 Montgomery Blvd Building C Sui', 'Albuquerque', 'NM', 87109);

-- --------------------------------------------------------

--
-- Table structure for table 'patient'
--

CREATE TABLE IF NOT EXISTS patient (
  id int(6) NOT NULL AUTO_INCREMENT,
  cid int(6) NOT NULL,
  fname char(7) NOT NULL,
  mname char(7) DEFAULT NULL,
  lname char(7) NOT NULL,
  age int(2) NOT NULL,
  gender char(1) NOT NULL,
  phonenum varchar(11) NOT NULL,
  PRIMARY KEY (id),
  KEY patient_fk (cid)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=222685 ;

--
-- Dumping data for table 'patient'
--

INSERT INTO patient (id, cid, fname, mname, lname, age, gender, phonenum) VALUES
(222111, 111111, 'The', '', 'Joker', 36, 'M', '123-761-852'),
(222222, 111111, 'Killer', '', 'Croc', 29, 'M', '123-989-050'),
(222333, 111222, 'The', '', 'Venom', 25, 'M', '207-006-000'),
(222444, 111222, 'Mr.', '', 'Lizard', 42, 'M', '207-700-000'),
(222555, 111333, 'Bull', '', 'Eye', 25, 'M', '207-189-782'),
(222666, 111333, 'The', '', 'Kingpin', 39, 'M', '207-423-777'),
(222671, 111343, 'Mako', '', 'Fire', 25, 'M', '258-578-963'),
(222677, 111349, 'Ceaser', '', 'Salada', 35, 'M', '245-236-276'),
(222683, 111355, '', '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table 'placeorder'
--

CREATE TABLE IF NOT EXISTS placeorder (
  id int(6) NOT NULL AUTO_INCREMENT,
  cid int(6) NOT NULL,
  odate datetime NOT NULL,
  ddate date NOT NULL,
  priority int(1) NOT NULL,
  PRIMARY KEY (id),
  KEY placeorder_fk1 (cid)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=679 ;

--
-- Dumping data for table 'placeorder'
--

INSERT INTO placeorder (id, cid, odate, ddate, priority) VALUES
(111, 111111, '2017-03-03 06:18:00', '2017-03-03', 0),
(222, 111111, '2017-03-03 07:18:00', '2017-03-03', 0),
(333, 111222, '2017-03-02 23:18:00', '2017-03-03', 0),
(444, 111222, '2017-03-02 23:42:00', '2017-03-04', 0),
(555, 111333, '2017-03-03 13:22:00', '2017-03-03', 0),
(666, 111333, '2017-03-04 06:18:00', '2017-03-06', 0),
(677, 111355, '2017-05-17 09:42:41', '2017-05-17', 0),
(678, 111355, '2017-05-20 17:43:05', '2017-05-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table 'pvsorder'
--

CREATE TABLE IF NOT EXISTS pvsorder (
  oid int(6) NOT NULL,
  pid int(6) NOT NULL,
  removables varchar(125) DEFAULT NULL,
  biteinfo varchar(125) DEFAULT NULL,
  surgical_guide varchar(125) DEFAULT NULL,
  additional_info varchar(125) DEFAULT NULL,
  KEY pvsorder_fk1 (oid),
  KEY pvsorder_fk2 (pid)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'pvsorder'
--

INSERT INTO pvsorder (oid, pid, removables, biteinfo, surgical_guide, additional_info) VALUES
(222, 222222, 'crown', 'light', 'monolithic', NULL),
(444, 222444, 'abutment', 'heavy', 'shading', NULL),
(677, 222683, ' , , , , .', ', , , , .', ', , , .', ', , , , , , , , .');

-- --------------------------------------------------------

--
-- Table structure for table 'receivedorder'
--

CREATE TABLE IF NOT EXISTS receivedorder (
  oid int(6) NOT NULL,
  rdate datetime NOT NULL,
  KEY receivedorder_fk (oid)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'receivedorder'
--

INSERT INTO receivedorder (oid, rdate) VALUES
(111, '2017-03-03 06:20:00'),
(222, '2017-03-03 07:24:00'),
(333, '2017-03-02 23:20:00'),
(444, '2017-03-02 23:45:00'),
(555, '2017-03-03 13:24:00'),
(666, '2017-03-04 06:20:00'),
(677, '2017-05-17 09:42:41'),
(677, '2017-05-20 17:43:05');

-- --------------------------------------------------------

--
-- Table structure for table 'users'
--

CREATE TABLE IF NOT EXISTS users (
  ID int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table 'users'
--

INSERT INTO users (ID, `user`, `password`) VALUES
(1, 'user', 'pass1'),
(2, 'test', 'bmoney'),
(3, 'admin', 'drose');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientcontact`
--
ALTER TABLE `clientcontact`
  ADD CONSTRAINT clientcontact_fk FOREIGN KEY (cid) REFERENCES client (id);

--
-- Constraints for table `completeorder`
--
ALTER TABLE `completeorder`
  ADD CONSTRAINT completeorder_fk FOREIGN KEY (oid) REFERENCES placeorder (id);

--
-- Constraints for table `deliverorder`
--
ALTER TABLE `deliverorder`
  ADD CONSTRAINT deliverorder_fk1 FOREIGN KEY (oid) REFERENCES placeorder (id),
  ADD CONSTRAINT deliverorder_fk2 FOREIGN KEY (cid) REFERENCES client (id);

--
-- Constraints for table `digitalorder`
--
ALTER TABLE `digitalorder`
  ADD CONSTRAINT digitalorder_fk1 FOREIGN KEY (oid) REFERENCES placeorder (id),
  ADD CONSTRAINT digitalorder_fk2 FOREIGN KEY (pid) REFERENCES patient (id);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT patient_fk FOREIGN KEY (cid) REFERENCES client (id);

--
-- Constraints for table `placeorder`
--
ALTER TABLE `placeorder`
  ADD CONSTRAINT placeorder_fk1 FOREIGN KEY (cid) REFERENCES client (id);

--
-- Constraints for table `pvsorder`
--
ALTER TABLE `pvsorder`
  ADD CONSTRAINT pvsorder_fk1 FOREIGN KEY (oid) REFERENCES placeorder (id),
  ADD CONSTRAINT pvsorder_fk2 FOREIGN KEY (pid) REFERENCES patient (id);

--
-- Constraints for table `receivedorder`
--
ALTER TABLE `receivedorder`
  ADD CONSTRAINT receivedorder_fk FOREIGN KEY (oid) REFERENCES placeorder (id);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
