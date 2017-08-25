-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2017 at 03:31 PM
-- Server version: 5.5.57-0+deb8u1
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `desertrose`
--
CREATE DATABASE IF NOT EXISTS `desertrose` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `desertrose`;

-- --------------------------------------------------------

--
-- Table structure for table `aligner_order`
--

CREATE TABLE IF NOT EXISTS `aligner_order` (
  `Order_Type` varchar(5) NOT NULL,
  `oid` int(6) NOT NULL,
  `Upper` char(3) DEFAULT NULL,
  `Lower` char(3) DEFAULT NULL,
  `Replacement` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aligner_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
`id` int(6) NOT NULL,
  `fname` char(10) NOT NULL,
  `mname` char(7) DEFAULT NULL,
  `lname` char(15) NOT NULL,
  `sname` varchar(25) NOT NULL,
  `city` varchar(13) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` int(5) NOT NULL,
  `phonenum` varchar(13) NOT NULL,
  `email` char(25) NOT NULL,
  `liencenum` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=100005 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--


-- --------------------------------------------------------

--
-- Table structure for table `clientcontact`
--

CREATE TABLE IF NOT EXISTS `clientcontact` (
  `cid` int(6) NOT NULL,
  `cdate` datetime NOT NULL,
  `confirmation` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `completeorder`
--

CREATE TABLE IF NOT EXISTS `completeorder` (
  `oid` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `cdate` datetime NOT NULL,
  `confirmation` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crown_order`
--

CREATE TABLE IF NOT EXISTS `crown_order` (
  `Order_Type` varchar(5) NOT NULL,
  `oid` int(6) NOT NULL,
  `Diagnostic` char(3) DEFAULT NULL,
  `Zirconia` char(3) DEFAULT NULL,
  `Emax` char(3) DEFAULT NULL,
  `Gold` char(3) DEFAULT NULL,
  `Shad` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crown_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `deliverorder`
--

CREATE TABLE IF NOT EXISTS `deliverorder` (
  `oid` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `ddate` datetime NOT NULL,
  `confirmation` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `denture_order`
--

CREATE TABLE IF NOT EXISTS `denture_order` (
  `Order_Type` varchar(5) NOT NULL,
  `oid` int(6) NOT NULL,
  `Upper` char(3) DEFAULT NULL,
  `Lower` char(3) DEFAULT NULL,
  `Shade` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `denture_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `digitalorder`
--

CREATE TABLE IF NOT EXISTS `digitalorder` (
  `oid` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `pid` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drose`
--

CREATE TABLE IF NOT EXISTS `drose` (
  `email` char(25) DEFAULT NULL,
  `phonenum` varchar(13) DEFAULT NULL,
  `sname` varchar(35) DEFAULT NULL,
  `city` varchar(13) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drose`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `file` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--


-- --------------------------------------------------------

--
-- Table structure for table `night_guard`
--

CREATE TABLE IF NOT EXISTS `night_guard` (
  `Order_Type` varchar(5) NOT NULL,
  `oid` int(6) NOT NULL,
  `Upper` char(3) DEFAULT NULL,
  `Lower` char(3) DEFAULT NULL,
  `Soft` char(3) DEFAULT NULL,
  `Hard` char(3) DEFAULT NULL,
  `May_Appliance` char(3) DEFAULT NULL,
  `Ocllual` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `night_guard`
--



-- --------------------------------------------------------

--
-- Table structure for table `partial_order`
--

CREATE TABLE IF NOT EXISTS `partial_order` (
  `Order_Type` varchar(5) NOT NULL,
  `oid` int(6) NOT NULL,
  `Upper` char(3) DEFAULT NULL,
  `Lower` char(3) DEFAULT NULL,
  `Missing_Teeth` varchar(15) DEFAULT NULL,
  `Shade` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
`id` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `fname` char(7) NOT NULL,
  `mname` char(7) DEFAULT NULL,
  `lname` char(7) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` char(1) NOT NULL,
  `phonenum` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=555560 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--


-- --------------------------------------------------------

--
-- Table structure for table `placeorder`
--

CREATE TABLE IF NOT EXISTS `placeorder` (
`id` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `odate` datetime NOT NULL,
  `ddate` date NOT NULL,
  `priority` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placeorder`
--


-- --------------------------------------------------------

--
-- Table structure for table `pvsorder`
--

CREATE TABLE IF NOT EXISTS `pvsorder` (
  `oid` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `pid` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pvsorder`
--


-- --------------------------------------------------------

--
-- Table structure for table `receivedorder`
--

CREATE TABLE IF NOT EXISTS `receivedorder` (
  `oid` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `rdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receivedorder`
--


-- --------------------------------------------------------

--
-- Table structure for table `surgical_order`
--

CREATE TABLE IF NOT EXISTS `surgical_order` (
  `Order_Type` varchar(5) NOT NULL,
  `oid` int(6) NOT NULL,
  `Implant_System` char(3) DEFAULT NULL,
  `Tooth_Num` char(3) DEFAULT NULL,
  `Sleeve` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surgical_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) NOT NULL,
  `user` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `aligner_order`
--
ALTER TABLE `aligner_order`
 ADD KEY `aligner_fk` (`oid`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientcontact`
--
ALTER TABLE `clientcontact`
 ADD KEY `clientcontact_fk` (`cid`);

--
-- Indexes for table `completeorder`
--
ALTER TABLE `completeorder`
 ADD KEY `completeorder_fk` (`oid`), ADD KEY `completeorder_fk2` (`cid`);

--
-- Indexes for table `crown_order`
--
ALTER TABLE `crown_order`
 ADD KEY `crown_fk` (`oid`);

--
-- Indexes for table `deliverorder`
--
ALTER TABLE `deliverorder`
 ADD KEY `deliverorder_fk1` (`oid`), ADD KEY `deliverorder_fk2` (`cid`);

--
-- Indexes for table `denture_order`
--
ALTER TABLE `denture_order`
 ADD KEY `denture_fk` (`oid`);

--
-- Indexes for table `digitalorder`
--
ALTER TABLE `digitalorder`
 ADD KEY `digitalorder_fk1` (`oid`), ADD KEY `digitalorder_fk2` (`cid`), ADD KEY `digitalorder_fk3` (`pid`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
 ADD KEY `invoice_fk` (`id`), ADD KEY `invoice_fk1` (`cid`);

--
-- Indexes for table `night_guard`
--
ALTER TABLE `night_guard`
 ADD KEY `night_fk` (`oid`);

--
-- Indexes for table `partial_order`
--
ALTER TABLE `partial_order`
 ADD KEY `partial_fk` (`oid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
 ADD PRIMARY KEY (`id`), ADD KEY `patient_fk` (`cid`);

--
-- Indexes for table `placeorder`
--
ALTER TABLE `placeorder`
 ADD PRIMARY KEY (`id`), ADD KEY `placeorder_fk1` (`cid`);

--
-- Indexes for table `pvsorder`
--
ALTER TABLE `pvsorder`
 ADD KEY `pvsorder_fk1` (`oid`), ADD KEY `pvsorder_fk2` (`cid`), ADD KEY `pvsorder_fk3` (`pid`);

--
-- Indexes for table `receivedorder`
--
ALTER TABLE `receivedorder`
 ADD KEY `receivedorder_fk` (`oid`), ADD KEY `receivedorder_fk2` (`cid`);

--
-- Indexes for table `surgical_order`
--
ALTER TABLE `surgical_order`
 ADD KEY `surgical_fk` (`oid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100005;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=555560;
--
-- AUTO_INCREMENT for table `placeorder`
--
ALTER TABLE `placeorder`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aligner_order`
--
ALTER TABLE `aligner_order`
ADD CONSTRAINT `aligner_fk` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`);

--
-- Constraints for table `clientcontact`
--
ALTER TABLE `clientcontact`
ADD CONSTRAINT `clientcontact_fk` FOREIGN KEY (`cid`) REFERENCES `client` (`id`);

--
-- Constraints for table `completeorder`
--
ALTER TABLE `completeorder`
ADD CONSTRAINT `completeorder_fk` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`),
ADD CONSTRAINT `completeorder_fk2` FOREIGN KEY (`cid`) REFERENCES `client` (`id`);

--
-- Constraints for table `crown_order`
--
ALTER TABLE `crown_order`
ADD CONSTRAINT `crown_fk` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`);

--
-- Constraints for table `deliverorder`
--
ALTER TABLE `deliverorder`
ADD CONSTRAINT `deliverorder_fk1` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`),
ADD CONSTRAINT `deliverorder_fk2` FOREIGN KEY (`cid`) REFERENCES `client` (`id`);

--
-- Constraints for table `denture_order`
--
ALTER TABLE `denture_order`
ADD CONSTRAINT `denture_fk` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`);

--
-- Constraints for table `digitalorder`
--
ALTER TABLE `digitalorder`
ADD CONSTRAINT `digitalorder_fk1` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`),
ADD CONSTRAINT `digitalorder_fk2` FOREIGN KEY (`cid`) REFERENCES `client` (`id`),
ADD CONSTRAINT `digitalorder_fk3` FOREIGN KEY (`pid`) REFERENCES `patient` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
ADD CONSTRAINT `invoice_fk` FOREIGN KEY (`id`) REFERENCES `placeorder` (`id`),
ADD CONSTRAINT `invoice_fk1` FOREIGN KEY (`cid`) REFERENCES `client` (`id`);

--
-- Constraints for table `night_guard`
--
ALTER TABLE `night_guard`
ADD CONSTRAINT `night_fk` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`);

--
-- Constraints for table `partial_order`
--
ALTER TABLE `partial_order`
ADD CONSTRAINT `partial_fk` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
ADD CONSTRAINT `patient_fk` FOREIGN KEY (`cid`) REFERENCES `client` (`id`);

--
-- Constraints for table `placeorder`
--
ALTER TABLE `placeorder`
ADD CONSTRAINT `placeorder_fk1` FOREIGN KEY (`cid`) REFERENCES `client` (`id`);

--
-- Constraints for table `pvsorder`
--
ALTER TABLE `pvsorder`
ADD CONSTRAINT `pvsorder_fk1` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`),
ADD CONSTRAINT `pvsorder_fk2` FOREIGN KEY (`cid`) REFERENCES `client` (`id`),
ADD CONSTRAINT `pvsorder_fk3` FOREIGN KEY (`pid`) REFERENCES `patient` (`id`);

--
-- Constraints for table `receivedorder`
--
ALTER TABLE `receivedorder`
ADD CONSTRAINT `receivedorder_fk` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`),
ADD CONSTRAINT `receivedorder_fk2` FOREIGN KEY (`cid`) REFERENCES `client` (`id`);

--
-- Constraints for table `surgical_order`
--
ALTER TABLE `surgical_order`
ADD CONSTRAINT `surgical_fk` FOREIGN KEY (`oid`) REFERENCES `placeorder` (`id`);

--
-- Dumping data for table `clientcontact`
--

INSERT INTO `aligner_order` (`Order_Type`, `oid`, `Upper`, `Lower`, `Replacement`) VALUES
('pvs', 3, '', '', 'rep'),
('pvs', 4, 'upp', '', '');

INSERT INTO `client` (`id`, `fname`, `mname`, `lname`, `sname`, `city`, `state`, `zip`, `phonenum`, `email`, `liencenum`) VALUES
(100000, 'Will', '', 'Ro', '1256 Quail Rd', 'Albuquerque', 'NM', 87112, '505-232-5624', 'dapatron@rossboss.com', '123456'),
(100001, 'Chris', '', 'White', '1235 Brake Ankle', 'Albuquerque', 'NM', 78214, '505-232-5888', 'christkool@gmail.com', '87595'),
(100002, 'Chris', '', 'White', '1235 Brake Ankle', 'Albuquerque', 'NM', 78214, '505-232-5888', 'christkool@gmail.com', '87595'),
(100003, 'Sagey', '', 'Poos', '69 doggo street', 'Georgia', 'Ge', 87122, '505-420-6969', 'sageypoos@DOD.mil', 'Spartan 11'),
(100004, 'Spong', '', 'Bob', '1234 Bakini bootmms', 'Bikini Bottom', 'Oc', 85225, '725-683-456', 'spong@karaaby.com', '85235');

INSERT INTO `clientcontact` (`cid`, `cdate`, `confirmation`) VALUES
(100000, '2017-07-25 16:14:23', 8930),
(100001, '2017-07-30 17:44:47', 8930),
(100001, '2017-07-30 17:56:20', 8930),
(100003, '2017-08-08 20:44:03', 8930),
(100004, '2017-08-09 15:17:01', 8930);

INSERT INTO `crown_order` (`Order_Type`, `oid`, `Diagnostic`, `Zirconia`, `Emax`, `Gold`, `Shad`) VALUES
('pvs', 1, 'dia', '', '', 'gol', '2.33'),
('pvs', 1, 'dia', '', '', 'gol', '2.33'),
('pvs', 4, 'dia', '', '', '', '');


INSERT INTO `denture_order` (`Order_Type`, `oid`, `Upper`, `Lower`, `Shade`) VALUES
('pvs', 1, '', 'low', ''),
('pvs', 1, '', 'low', '');

INSERT INTO `drose` (`email`, `phonenum`, `sname`, `city`, `state`, `zip`) VALUES
('desertrose@gmail.com', '575-361-2073', '7520 Montgomery Blvd Building C Sui', 'Albuquerque', 'NM', 87109);


INSERT INTO `invoice` (`id`, `cid`, `file`) VALUES
(1, 100001, 0x2f7661722f7777772f68746d6c2f696e766f696365312e706466),
(1, 100001, 0x2f7661722f7777772f68746d6c2f696e766f696365312e706466),
(3, 100003, 0x2f7661722f7777772f68746d6c2f696e766f696365332e706466),
(4, 100004, 0x2f7661722f7777772f68746d6c2f696e766f696365342e706466);

INSERT INTO `night_guard` (`Order_Type`, `oid`, `Upper`, `Lower`, `Soft`, `Hard`, `May_Appliance`, `Ocllual`) VALUES
('pvs', 1, 'upp', '', '', '', 'may', ''),
('pvs', 1, 'upp', '', '', '', 'may', ''),
('pvs', 4, '', 'low', 'sof', '', '', '');

INSERT INTO `patient` (`id`, `cid`, `fname`, `mname`, `lname`, `age`, `gender`, `phonenum`) VALUES
(555555, 100000, 'Marble', '', 'Woof', 2, 'F', '505-756-893'),
(555556, 100001, 'Leo', '', 'Dick', 25, 'M', '505-756-893'),
(555557, 100001, 'Leo', '', 'Dick', 25, 'M', '505-756-893'),
(555558, 100003, 'B', '', 'Money', 25, 'M', '1234567890'),
(555559, 100004, 'Patrik', '', 'Star', 21, 'M', '505-756-893');
INSERT INTO `placeorder` (`id`, `cid`, `odate`, `ddate`, `priority`) VALUES
(1, 100001, '2017-07-30 17:44:47', '2017-07-31', 1),
(2, 100001, '2017-07-30 17:56:20', '2017-07-31', 1),
(3, 100003, '2017-08-08 20:44:03', '2017-08-07', 1),
(4, 100004, '2017-08-09 15:17:01', '2017-08-10', 1);

INSERT INTO `pvsorder` (`oid`, `cid`, `pid`) VALUES
(1, 100001, 555556),
(1, 100001, 555556),
(3, 100003, 555558),
(4, 100004, 555559);

INSERT INTO `receivedorder` (`oid`, `cid`, `rdate`) VALUES
(1, 100001, '2017-07-30 17:44:47'),
(1, 100001, '2017-07-30 17:56:20'),
(3, 100003, '2017-08-08 20:44:03'),
(4, 100004, '2017-08-09 15:17:01');


INSERT INTO `surgical_order` (`Order_Type`, `oid`, `Implant_System`, `Tooth_Num`, `Sleeve`) VALUES
('pvs', 1, 'imp', '2.3', ''),
('pvs', 1, 'imp', '2.3', '');


INSERT INTO `users` (`id`, `user`, `password`) VALUES
(1, 'user', 'pass1'),
(2, 'test', 'bmoney'),
(3, 'admin', 'drose');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
