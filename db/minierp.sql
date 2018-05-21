-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2018 at 09:47 AM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minierp`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

DROP TABLE IF EXISTS `company_details`;
CREATE TABLE IF NOT EXISTS `company_details` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `street` varchar(20) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `VAT` varchar(20) NOT NULL,
  `reply_to_email` varchar(30) NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `component_details`
--

DROP TABLE IF EXISTS `component_details`;
CREATE TABLE IF NOT EXISTS `component_details` (
  `cd_key_id` int(11) NOT NULL AUTO_INCREMENT,
  `cd_type` int(11) NOT NULL,
  `cd_code` varchar(25) NOT NULL,
  `cd_description` varchar(50) NOT NULL,
  `cd_baseunit` decimal(6,2) NOT NULL,
  `cd_unit` varchar(5) NOT NULL,
  `cd_amount_unit` decimal(8,2) DEFAULT '0.00',
  `cd_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `cd_pricing_type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cd_key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=437 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `component_list`
--

DROP TABLE IF EXISTS `component_list`;
CREATE TABLE IF NOT EXISTS `component_list` (
  `key_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `full_id` varchar(25) NOT NULL,
  `comp_type` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `code_id` int(11) NOT NULL,
  `amount_per_set` decimal(6,4) NOT NULL DEFAULT '1.0000',
  `unit_price` decimal(7,4) DEFAULT '0.0000',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=935 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `component_types`
--

DROP TABLE IF EXISTS `component_types`;
CREATE TABLE IF NOT EXISTS `component_types` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(25) NOT NULL,
  `price_unit` decimal(6,4) NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(30) NOT NULL,
  `c_address` varchar(50) NOT NULL,
  `c_postcode` varchar(6) NOT NULL,
  `c_city` varchar(20) NOT NULL,
  `c_vat` varchar(20) DEFAULT NULL,
  `c_email` varchar(50) DEFAULT NULL,
  `c_buyer` varchar(50) DEFAULT NULL,
  `c_delivery_way` varchar(30) DEFAULT NULL,
  `c_delivery_custno` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

DROP TABLE IF EXISTS `employers`;
CREATE TABLE IF NOT EXISTS `employers` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `at_work` int(11) NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `machine_list`
--

DROP TABLE IF EXISTS `machine_list`;
CREATE TABLE IF NOT EXISTS `machine_list` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

DROP TABLE IF EXISTS `order_history`;
CREATE TABLE IF NOT EXISTS `order_history` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `order_state` int(11) NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2081 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

DROP TABLE IF EXISTS `order_list`;
CREATE TABLE IF NOT EXISTS `order_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(12) NOT NULL,
  `ordered_date` date NOT NULL,
  `c_id` varchar(30) NOT NULL,
  `pc_id_code` varchar(20) NOT NULL,
  `date_wanted` date NOT NULL,
  `pcs` decimal(11,0) NOT NULL,
  `date_sent` date DEFAULT NULL,
  `visible_warehouse` tinyint(1) NOT NULL,
  `invoiced` tinyint(1) NOT NULL,
  `c_warehouse` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2921 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `packing_list`
--

DROP TABLE IF EXISTS `packing_list`;
CREATE TABLE IF NOT EXISTS `packing_list` (
  `pl_key_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pl_list_no` bigint(20) NOT NULL,
  PRIMARY KEY (`pl_key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pallet_list`
--

DROP TABLE IF EXISTS `pallet_list`;
CREATE TABLE IF NOT EXISTS `pallet_list` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(5) NOT NULL,
  `length` float NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `p_key_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id_code` varchar(25) DEFAULT NULL,
  `p_instock` int(11) NOT NULL DEFAULT '0',
  `p_instock_checked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_full_id` varchar(25) NOT NULL,
  `p_area` decimal(7,4) DEFAULT NULL,
  `p_weight` decimal(7,4) DEFAULT NULL,
  `p_lot_size` int(11) DEFAULT NULL,
  `p_share_qualifier` float(8,2) DEFAULT NULL,
  `p_description` varchar(20) NOT NULL,
  PRIMARY KEY (`p_key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_name` varchar(30) NOT NULL,
  `s_address` varchar(30) NOT NULL,
  `s_postcode` varchar(10) NOT NULL,
  `s_city` varchar(30) NOT NULL,
  `s_email` varchar(60) NOT NULL,
  `s_phone` varchar(30) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `lang` int(11) NOT NULL DEFAULT '0',
  `pay_days` int(11) NOT NULL DEFAULT '14',
  `deliveryterm` varchar(5) DEFAULT NULL,
  `delivery_way` varchar(20) DEFAULT NULL,
  `force_offer` tinyint(4) NOT NULL DEFAULT '0',
  `cust_no` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_calendar`
--

DROP TABLE IF EXISTS `work_calendar`;
CREATE TABLE IF NOT EXISTS `work_calendar` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_list`
--

DROP TABLE IF EXISTS `work_list`;
CREATE TABLE IF NOT EXISTS `work_list` (
  `wl_key_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `wl_full_id` varchar(25) NOT NULL,
  `wl_work_type` int(11) NOT NULL,
  `wl_order_no` int(11) NOT NULL,
  `wl_amount_per_set` decimal(6,4) NOT NULL,
  `wl_description` varchar(100) NOT NULL,
  `wl_order_code` int(11) NOT NULL,
  `wl_default_machine` int(11) NOT NULL,
  PRIMARY KEY (`wl_key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1182 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_load`
--

DROP TABLE IF EXISTS `work_load`;
CREATE TABLE IF NOT EXISTS `work_load` (
  `wlo_key_id` int(11) NOT NULL AUTO_INCREMENT,
  `wlo_machine` int(11) NOT NULL,
  `wlo_work_id` int(11) NOT NULL,
  `wlo_day` date NOT NULL,
  PRIMARY KEY (`wlo_key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_types`
--

DROP TABLE IF EXISTS `work_types`;
CREATE TABLE IF NOT EXISTS `work_types` (
  `wt_key_id` int(11) NOT NULL AUTO_INCREMENT,
  `wt_description` varchar(25) NOT NULL,
  `wt_multiplier` decimal(6,4) NOT NULL,
  PRIMARY KEY (`wt_key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
