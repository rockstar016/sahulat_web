-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2017 at 07:43 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sahulat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `master_name` varchar(50) NOT NULL,
  `master_email` varchar(50) NOT NULL,
  `master_phone` varchar(20) NOT NULL,
  `master_password` varchar(200) NOT NULL,
  `level` tinyint(1) NOT NULL COMMENT '0: admin, 1: manager'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `master_name`, `master_email`, `master_phone`, `master_password`, `level`) VALUES
(1, 'sahulat_admin', 'zeus.rock0116@gmail.com', '9231234567', '68694c89be696069702dd19e93a6438f', 0),
(4, 'testadmin', 'testadmin@testadmin.com', '1233456', '9283a03246ef2dacdc21a9b137817ec1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_checkout`
--

CREATE TABLE `tb_checkout` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `checkout_type` tinyint(1) NOT NULL COMMENT '0:wallet, 1: cash, 2:card',
  `other_info` varchar(120) NOT NULL COMMENT 'wallet_id, null, card_token',
  `amount` double NOT NULL,
  `created_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_client`
--

CREATE TABLE `tb_client` (
  `id` int(11) NOT NULL,
  `kind` tinyint(1) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_pwd` varchar(120) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `current_deposit` double NOT NULL DEFAULT '0' COMMENT 'current deposit amount',
  `verified_phone` tinyint(1) NOT NULL,
  `verified_email` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '1',
  `is_agree` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:agree 1: disagree'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_feedback`
--

CREATE TABLE `tb_feedback` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `rate_score` int(11) NOT NULL,
  `feedback` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `request_time` datetime NOT NULL COMMENT 'client request time.',
  `status` tinyint(4) NOT NULL COMMENT '0:pending,1:processed,2:assigned 3: accepted, 4: served, 5: payout, 6: finished, 7:cancelled',
  `ord_address` varchar(120) NOT NULL,
  `attach_file` varchar(300) NOT NULL COMMENT 'attach file path',
  `estimation_arrival` datetime DEFAULT NULL COMMENT 'estimation time',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_orderman_history`
--

CREATE TABLE `tb_orderman_history` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `result` tinyint(1) NOT NULL DEFAULT '5' COMMENT '0:reject, 1: accept',
  `assigned_time` datetime NOT NULL,
  `replied_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penalty`
--

CREATE TABLE `tb_penalty` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_service`
--

CREATE TABLE `tb_service` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_cur_long` double NOT NULL,
  `service_cur_lat` double NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_suggestion`
--

CREATE TABLE `tb_suggestion` (
  `id` int(11) NOT NULL,
  `kind` tinyint(1) NOT NULL COMMENT '0: compliant 1: suggestion',
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='suggestion table';

-- --------------------------------------------------------

--
-- Table structure for table `tb_token`
--

CREATE TABLE `tb_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fire_token` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_wallet`
--

CREATE TABLE `tb_wallet` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `order_id` int(11) NOT NULL COMMENT '-1: by client, else: from order',
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_checkout`
--
ALTER TABLE `tb_checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_client`
--
ALTER TABLE `tb_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_feedback`
--
ALTER TABLE `tb_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_orderman_history`
--
ALTER TABLE `tb_orderman_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penalty`
--
ALTER TABLE `tb_penalty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_service`
--
ALTER TABLE `tb_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_suggestion`
--
ALTER TABLE `tb_suggestion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_wallet`
--
ALTER TABLE `tb_wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_checkout`
--
ALTER TABLE `tb_checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_client`
--
ALTER TABLE `tb_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_feedback`
--
ALTER TABLE `tb_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_orderman_history`
--
ALTER TABLE `tb_orderman_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_penalty`
--
ALTER TABLE `tb_penalty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_service`
--
ALTER TABLE `tb_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_suggestion`
--
ALTER TABLE `tb_suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_token`
--
ALTER TABLE `tb_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_wallet`
--
ALTER TABLE `tb_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
