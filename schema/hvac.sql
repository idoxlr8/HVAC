-- phpMyAdmin SQL Dump
-- version 3.5.0-rc1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2013 at 10:19 AM
-- Server version: 5.1.33-community
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hvac`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `license` varchar(100) DEFAULT NULL,
  `weathercity` varchar(65) DEFAULT NULL,
  `weatherstate` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `company` varchar(100) DEFAULT NULL,
  `firstname` varchar(65) DEFAULT NULL,
  `lastname` varchar(65) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `busphone` varchar(100) DEFAULT NULL,
  `homephone` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `webpage` varchar(100) DEFAULT NULL,
  `notes` longtext,
  `preferred` enum('yes','no','','') DEFAULT 'no',
  `commercial` enum('yes','no','','') DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE IF NOT EXISTS `dashboard` (
  `dashboard_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`dashboard_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE IF NOT EXISTS `docs` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(100) NOT NULL,
  `notes` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `customer` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `month` varchar(65) DEFAULT NULL,
  `year` varchar(65) DEFAULT NULL,
  `item1qty` varchar(65) DEFAULT NULL,
  `item1description` varchar(100) DEFAULT NULL,
  `item1cost` varchar(100) DEFAULT NULL,
  `item2qty` varchar(65) DEFAULT NULL,
  `item2description` varchar(100) DEFAULT NULL,
  `item2cost` varchar(100) DEFAULT NULL,
  `item3qty` varchar(65) DEFAULT NULL,
  `item3description` varchar(100) DEFAULT NULL,
  `item3cost` varchar(100) DEFAULT NULL,
  `item4qty` varchar(65) DEFAULT NULL,
  `item4description` varchar(100) DEFAULT NULL,
  `item4cost` varchar(100) DEFAULT NULL,
  `item5qty` varchar(65) DEFAULT NULL,
  `item5description` varchar(100) DEFAULT NULL,
  `item5cost` varchar(100) DEFAULT NULL,
  `item6qty` varchar(65) DEFAULT NULL,
  `item6description` varchar(100) DEFAULT NULL,
  `item6cost` varchar(100) DEFAULT NULL,
  `labor1qty` varchar(65) DEFAULT NULL,
  `labor1description` varchar(255) DEFAULT NULL,
  `labor1cost` varchar(100) DEFAULT NULL,
  `labor2qty` varchar(65) DEFAULT NULL,
  `labor2description` varchar(255) DEFAULT NULL,
  `labor2cost` varchar(100) DEFAULT NULL,
  `labor3qty` int(100) DEFAULT NULL,
  `labor3description` varchar(255) DEFAULT NULL,
  `labor3cost` varchar(100) DEFAULT NULL,
  `tax` varchar(100) DEFAULT NULL,
  `labortotal` varchar(100) DEFAULT NULL,
  `partstotal` varchar(100) DEFAULT NULL,
  `subtotal` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `custcomments` longtext,
  `address` varchar(100) DEFAULT NULL,
  `property` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `payment1` varchar(100) NOT NULL DEFAULT '00.00',
  `paymentdate1` varchar(100) DEFAULT NULL,
  `printdate` varchar(100) DEFAULT NULL,
  `notes` longtext,
  `item7qty` varchar(65) DEFAULT NULL,
  `item7description` varchar(100) DEFAULT NULL,
  `item7cost` varchar(100) DEFAULT NULL,
  `item8qty` varchar(65) DEFAULT NULL,
  `item8description` varchar(100) DEFAULT NULL,
  `item8cost` varchar(100) DEFAULT NULL,
  `item9qty` varchar(65) DEFAULT NULL,
  `item9description` varchar(100) DEFAULT NULL,
  `item9cost` varchar(100) DEFAULT NULL,
  `difference` varchar(100) DEFAULT NULL,
  `labortaxable` varchar(100) DEFAULT NULL,
  `partstaxable` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=517 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice__history`
--

CREATE TABLE IF NOT EXISTS `invoice__history` (
  `history__id` int(11) NOT NULL AUTO_INCREMENT,
  `history__language` varchar(2) DEFAULT NULL,
  `history__comments` text,
  `history__user` varchar(32) DEFAULT NULL,
  `history__state` int(5) DEFAULT '0',
  `history__modified` datetime DEFAULT NULL,
  `id` int(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `property` varchar(100) DEFAULT NULL,
  `labortotal` varchar(100) DEFAULT NULL,
  `partstotal` varchar(100) DEFAULT NULL,
  `subtotal` varchar(100) DEFAULT NULL,
  `tax` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `month` varchar(65) DEFAULT NULL,
  `year` varchar(65) DEFAULT NULL,
  `item1qty` varchar(65) DEFAULT NULL,
  `item1description` varchar(100) DEFAULT NULL,
  `item1cost` varchar(100) DEFAULT NULL,
  `item2qty` varchar(65) DEFAULT NULL,
  `item2description` varchar(100) DEFAULT NULL,
  `item2cost` varchar(100) DEFAULT NULL,
  `item3qty` varchar(65) DEFAULT NULL,
  `item3description` varchar(100) DEFAULT NULL,
  `item3cost` varchar(100) DEFAULT NULL,
  `item4qty` varchar(65) DEFAULT NULL,
  `item4description` varchar(100) DEFAULT NULL,
  `item4cost` varchar(100) DEFAULT NULL,
  `item5qty` varchar(65) DEFAULT NULL,
  `item5description` varchar(100) DEFAULT NULL,
  `item5cost` varchar(100) DEFAULT NULL,
  `item6qty` varchar(65) DEFAULT NULL,
  `item6description` varchar(100) DEFAULT NULL,
  `item6cost` varchar(100) DEFAULT NULL,
  `labor1qty` varchar(65) DEFAULT NULL,
  `labor1description` varchar(255) DEFAULT NULL,
  `labor1cost` varchar(100) DEFAULT NULL,
  `labor2qty` varchar(65) DEFAULT NULL,
  `labor2description` varchar(255) DEFAULT NULL,
  `labor2cost` varchar(100) DEFAULT NULL,
  `labor3qty` int(100) DEFAULT NULL,
  `labor3description` varchar(255) DEFAULT NULL,
  `labor3cost` varchar(100) DEFAULT NULL,
  `custcomments` longtext,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `payment1` varchar(100) DEFAULT NULL,
  `paymentdate1` varchar(100) DEFAULT NULL,
  `printdate` varchar(100) DEFAULT NULL,
  `notes` longtext,
  `item7qty` varchar(65) DEFAULT NULL,
  `item7description` varchar(100) DEFAULT NULL,
  `item7cost` varchar(100) DEFAULT NULL,
  `item8qty` varchar(65) DEFAULT NULL,
  `item8description` varchar(100) DEFAULT NULL,
  `item8cost` varchar(100) DEFAULT NULL,
  `item9qty` varchar(65) DEFAULT NULL,
  `item9description` varchar(100) DEFAULT NULL,
  `item9cost` varchar(100) DEFAULT NULL,
  `difference` varchar(100) DEFAULT NULL,
  `labortaxable` varchar(100) DEFAULT NULL,
  `partstaxable` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`history__id`),
  KEY `prikeys` (`id`) USING HASH,
  KEY `datekeys` (`history__modified`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Table structure for table `partial`
--

CREATE TABLE IF NOT EXISTS `partial` (
  `partial_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`partial_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `invoiceid` varchar(100) NOT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `tax` varchar(11) DEFAULT NULL,
  `amount` varchar(65) DEFAULT NULL,
  `notes` longtext,
  `invoicedate` varchar(100) DEFAULT NULL,
  `partstotal` varchar(100) DEFAULT NULL,
  `labortotal` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=492 ;

-- --------------------------------------------------------

--
-- Table structure for table `payments__history`
--

CREATE TABLE IF NOT EXISTS `payments__history` (
  `history__id` int(11) NOT NULL AUTO_INCREMENT,
  `history__language` varchar(2) DEFAULT NULL,
  `history__comments` text,
  `history__user` varchar(32) DEFAULT NULL,
  `history__state` int(5) DEFAULT '0',
  `history__modified` datetime DEFAULT NULL,
  `id` int(4) DEFAULT NULL,
  `invoiceid` varchar(100) DEFAULT NULL,
  `invoicedate` varchar(100) DEFAULT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `labortotal` varchar(100) DEFAULT NULL,
  `partstotal` varchar(100) DEFAULT NULL,
  `tax` varchar(11) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` varchar(65) DEFAULT NULL,
  `notes` longtext,
  PRIMARY KEY (`history__id`),
  KEY `prikeys` (`id`) USING HASH,
  KEY `datekeys` (`history__modified`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE IF NOT EXISTS `quote` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `customer` varchar(100) NOT NULL,
  `date` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `month` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `year` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `item1qty` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `item1description` varchar(100) NOT NULL,
  `item1cost` varchar(100) NOT NULL,
  `item2qty` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `item2description` varchar(100) NOT NULL,
  `item2cost` varchar(100) NOT NULL,
  `item3qty` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `item3description` varchar(100) NOT NULL,
  `item3cost` varchar(100) NOT NULL,
  `item4qty` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `item4description` varchar(100) NOT NULL,
  `item4cost` varchar(100) NOT NULL,
  `item5qty` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `item5description` varchar(100) NOT NULL,
  `item5cost` varchar(100) NOT NULL,
  `item6qty` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `item6description` varchar(100) NOT NULL,
  `item6cost` varchar(100) NOT NULL,
  `labor1qty` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `labor1description` longtext NOT NULL,
  `labor1cost` varchar(100) NOT NULL,
  `labor2qty` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `labor2description` longtext NOT NULL,
  `labor2cost` varchar(100) NOT NULL,
  `labor3qty` int(100) NOT NULL,
  `labor3description` longtext NOT NULL,
  `labor3cost` int(100) NOT NULL,
  `employee` varchar(100) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `labortotal` varchar(100) NOT NULL,
  `partstotal` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `custcomments` longtext NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `payment1` varchar(100) DEFAULT '0',
  `paymentdate1` varchar(100) NOT NULL,
  `notes` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `invoiceid` tinytext NOT NULL,
  `customer` tinytext NOT NULL,
  `date` date DEFAULT NULL,
  `amount` tinytext NOT NULL,
  `paid` tinytext NOT NULL,
  `paiddate` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=352 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `password` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `email` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `firstname` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `lastname` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `sig` varchar(100) DEFAULT NULL,
  `pic` varchar(300) DEFAULT NULL,
  `joindate` date NOT NULL,
  `exitdate` date NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('READ ONLY','NO ACCESS','ADMIN','') NOT NULL DEFAULT 'READ ONLY',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `sig`, `pic`, `joindate`, `exitdate`, `admin`, `role`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', '', '0000-00-00', '0000-00-00', 1, 'ADMIN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
