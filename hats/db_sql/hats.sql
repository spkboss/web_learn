-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2023 at 03:30 PM
-- Server version: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hats`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_record`
--

CREATE TABLE `asset_record` (
  `srno` int(10) NOT NULL,
  `rec_date` date NOT NULL,
  `aname` varchar(100) NOT NULL,
  `aserial` varchar(100) NOT NULL,
  `acode` varchar(100) NOT NULL,
  `amake` varchar(200) NOT NULL,
  `asset_des` varchar(10000) NOT NULL,
  `atype` varchar(10) NOT NULL,
  `astatus` enum('Ok','Not Ok') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Ok',
  `Status` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `asset_record`
--

INSERT INTO `asset_record` (`srno`, `rec_date`, `aname`, `aserial`, `acode`, `amake`, `asset_des`, `atype`, `astatus`, `Status`) VALUES
(1, '2023-06-05', 'CPU core i3', '3hhhcccc', '101014', 'HP', 'HCL cpu with  10 nos pack system.', 'CPU', 'Ok', '1'),
(2, '2023-05-27', 'CPU core i3', '3hh', '101014', 'HCL', 'HCL cpu with  10 nos pack system. TEST', 'CPU', 'Ok', '1'),
(3, '2023-05-27', 'printer -Laserjet', 'l120', '32234', 'HP', 'printer colours', 'Printer', 'Ok', '1'),
(4, '2023-05-27', 'Core i5 cpu-M1', '3425345234C', '5322453324234', 'HCL', 'CPU with core i5 8th gen 16gb ram and 1TB sdd.', 'CPU', 'Ok', '1'),
(5, '2023-05-27', 'scanjet m222', '34235545556', 'sc324324254253234', 'HP', 'scanner with all fn. test', 'Scanner', 'Ok', '1'),
(6, '2023-05-27', 'mouse-m22', '34252M', 'ms33352345432', 'DELL', 'mouse optical set ', 'Mouse', 'Ok', '1'),
(7, '2023-05-27', 'i12 all in one ipad', 'a10', 'i223211111', 'i-Mac', 'imac system with all set', 'AIO', 'Ok', '1'),
(8, '2023-05-28', 'server-s1', '3333', 's333333333', 'IBM', 'server s-I with installation', 'Server', 'Ok', '1'),
(9, '2023-05-27', 'mouse dlll', 'd121', '3425436543333', 'DELL', 'dell mouse extra set', 'Mouse', 'Ok', '1'),
(10, '2023-05-28', 'laser printer -b1', '3555bl', 'l33454654', 'HP', 'black laser printer', 'Printer', 'Ok', '1'),
(11, '2023-05-28', 'a1', 'a343252', '2325463', 'HCL', 'all in one pc', 'AIO', 'Ok', '1'),
(12, '2023-05-28', 'server 10', '1011010', 'as21100000', 'IBM', 'two server for host web ', 'Server', 'Ok', '1'),
(16, '2023-05-28', 'server 10', '1011010', 'as21100000', 'IBM', 'two server for host web a', 'Server', 'Ok', '1'),
(19, '2023-05-28', 'server 10', '1011010', 'as21100000', 'IBM', 'two server for host web as', 'Server', 'Ok', '1'),
(21, '2023-05-27', 'mouse-m222', '34252Maa', 'ms33352345432a', 'DELL', 'mouse optical ', 'Mouse', 'Ok', '1'),
(22, '2023-06-12', 'a1 server', '2244d3333', '11121112211', 'IBM', 'a1 server', 'Scanner', 'Ok', '1'),
(23, '2023-06-12', 'dell c1', 'd123456464567', '333', 'DELL', 'dell system', 'CPU', 'Ok', '1'),
(24, '2023-06-13', 'all in one pc', 'all1111', '21314124214', 'HCL', 'hcl allin one 7th gen system', 'AIO', 'Ok', '1'),
(25, '2023-06-14', 'hcl allinone key', 'h124547435', 's22222333', 'HCL', 'all in one keyboard with number and multimedia ', 'Keyboard', 'Ok', '1'),
(26, '2023-06-19', 'all in one system', 'a121', 'all223311', 'HCL', 'set pc', 'AIO', 'Ok', '1');

-- --------------------------------------------------------

--
-- Table structure for table `assign_asset`
--

CREATE TABLE `assign_asset` (
  `srno` int(10) NOT NULL,
  `an_rec_date` date NOT NULL,
  `an_dept` varchar(300) NOT NULL,
  `an_type` varchar(10) NOT NULL,
  `an_make` varchar(200) NOT NULL,
  `an_serial` varchar(100) NOT NULL,
  `an_name` varchar(100) NOT NULL,
  `an_mobile` bigint(10) NOT NULL,
  `an_email` varchar(200) NOT NULL,
  `an_location` varchar(500) NOT NULL,
  `an_des` varchar(10000) NOT NULL,
  `an_rel_des` varchar(10000) DEFAULT 'blank data',
  `an_rel_date` date DEFAULT NULL,
  `use_status` enum('In Use','Free') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'In Use',
  `asset_status` enum('1','0') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `assign_asset`
--

INSERT INTO `assign_asset` (`srno`, `an_rec_date`, `an_dept`, `an_type`, `an_make`, `an_serial`, `an_name`, `an_mobile`, `an_email`, `an_location`, `an_des`, `an_rel_des`, `an_rel_date`, `use_status`, `asset_status`) VALUES
(1, '2023-06-13', 'Acedmic', 'AIO', 'HCL', 'a1232134214', 'mr a', 9998887770, 'a@a.com', 'bsb', 'stage-1 test', 'aio set retun complete', '2023-06-14', 'Free', '1'),
(2, '2023-06-13', 'Acedmic', 'Mouse', 'HCL', 'a343252', 'Mr b kumar', 9897979594, 'b@bm.com', 'gccccc loc', 'a type', 'only mouse', '2023-06-14', 'Free', '1'),
(3, '2023-06-13', 'Processor', 'CPU', 'HP', '3hhhcccc', 'pro r kumar', 9798979897, 'r@h.res.in', 'IInd floor ', 'dddd', 'all set return', '2023-06-14', 'Free', '1'),
(4, '2023-06-13', 'Post_Doc', 'CPU', 'HCL', 'a343252', 'ar roy', 9896939290, 'ar@h.res.in', 'center area ', 'hri std', 'blank', NULL, 'In Use', '1'),
(5, '2023-06-14', 'Processor', 'CPU', 'HCL', '3425345234C', 'pro mn kumar', 9001122337, 'mn@h.res.in', 's hriiii', 'p-h', 'blank', NULL, 'In Use', '1'),
(6, '2023-06-14', 'Phd', 'Keyboard', 'HCL', 'h124547435', 'jr sem', 7080708999, 'jr@hri.res.in', 'hri-v', 'v sec build', 'blank', NULL, 'In Use', '1'),
(7, '2023-06-14', 'Acedmic', 'Mouse', 'DELL', '34252M', 'Mr a kumar', 9192939495, 'a@h.res.in', 'fst floor hri', 'all sec user use.', 'blank data', NULL, 'In Use', '1'),
(8, '2023-06-19', 'Acedmic', 'AIO', 'HCL', 'a121', 'Mr sr aiyar', 9111922292, 'sra@hri.inn', 'hr adm', 'adm sec', 'blank data', NULL, 'In Use', '1'),
(9, '2023-06-19', 'Phd', 'AIO', 'HCL', 'a121', 'shyama', 7070708080, 'sh@hr.in', 'hr', 'a hri loc', 'blank data', NULL, 'In Use', '1'),
(10, '2023-06-19', 'Tech_Dept', 'AIO', 'HCL', 'a121', 'alok ji', 9091929091, 'ak@hri.in', 'hri -cc', 'cc user', 'blank data', NULL, 'In Use', '1'),
(11, '2023-06-19', 'Post_Doc', 'AIO', 'HCL', 'a121', 'aaaaadsafsf', 9192939494, 'aaad@hr.in', 'ef dept', 'for ef', 'blank data', NULL, 'In Use', '1'),
(12, '2023-06-19', 'Tech_Dept', 'CPU', 'HCL', '3hh', 'sri s kr', 8788788970, 'sk@hrr.in', 'hr a ofc', 'ofc site', 'blank data', NULL, 'In Use', '1'),
(13, '2023-06-19', 'others', 'Keyboard', 'HCL', 'h124547435', 'sri ram', 9998887665, 'ram@hr.in', 'fst floor', 'all in on keyboard', 'blank data', NULL, 'In Use', '1'),
(14, '2023-06-19', 'Phd', 'CPU', 'HCL', 'A1110487858', 'Nishant', 9685747485, 'xyz@gmail.com', 'Room no.225', 'no other issued item ', '', '2023-06-19', 'In Use', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users_new`
--

CREATE TABLE `users_new` (
  `id` int(8) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `img_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_new`
--

INSERT INTO `users_new` (`id`, `userid`, `username`, `email`, `mobile`, `password`, `dept_name`, `gender`, `img_name`, `uploaded_on`, `status`) VALUES
(1, 'admin', 'admin', 'admin@mail.com', 9898979796, '0cc175b9c0f1b6a831c399e269772661', 'DEPT-IT', 'male', 'us1.jpg', '2023-05-24 11:35:51', '1'),
(2, 'administrator', 'superuser', 'superadmin@mail.com', 9998887771, '8a8bb7cd343aa2ad99b7d762030857a2', 'DEPT-IT', 'male', 'u1.png', '2023-05-28 11:30:50', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users_record`
--

CREATE TABLE `users_record` (
  `id` int(10) NOT NULL,
  `udept` varchar(300) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `umobile` bigint(10) NOT NULL,
  `uemail` varchar(200) NOT NULL,
  `ulocation` varchar(500) NOT NULL,
  `udes` varchar(10000) NOT NULL,
  `issued_ats` varchar(100) DEFAULT NULL,
  `make` varchar(100) DEFAULT NULL,
  `daterec` date DEFAULT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_record`
--

INSERT INTO `users_record` (`id`, `udept`, `uname`, `umobile`, `uemail`, `ulocation`, `udes`, `issued_ats`, `make`, `daterec`, `status`) VALUES
(1, 'Acedmic', 'Mr a kumar', 9192939495, 'a@h.res.in', 'HRI-Acedmic - Ist floor', 'academic office room no. 1', NULL, NULL, NULL, '1'),
(2, 'Acedmic', 'Mr b kumar ', 9195949392, 'b@h.res.in', 'HRI-Acedmic - Ist floor', 'academic office room no. 1-I ', NULL, NULL, NULL, '1'),
(3, 'Library', 'Ms m shenn', 9955443322, 'm1@h.res.in', 'HRI -lib ', 'ground floor - library head', NULL, NULL, NULL, '1'),
(4, 'Library', 'mis n shen', 9922003344, 'n@h.res.in', 'HRI -lib ', 'ground floor - library staff', NULL, NULL, NULL, '1'),
(5, 'Processor', 'pro s kumar ', 9798979897, 's@h.res.in', 'IInd floor room no 222', 'prof - math', NULL, NULL, NULL, '1'),
(6, 'Processor', 'pro r kumar ', 9798979897, 'r@h.res.in', 'IInd floor room no 233', 'prof - math', NULL, NULL, NULL, '1'),
(7, 'Processor', 'pro rs kumar ', 9797979797, 'rs@h.res.in', 'IIInd floor room no 411', 'prof - Physics', NULL, NULL, NULL, '1'),
(8, 'Processor', 'pro mn kumar ', 9001122337, 'mn@h.res.in', 'IIInd floor room no 500', 'prof - Physics', NULL, NULL, NULL, '1'),
(9, 'Post_Doc', 'ar roy', 9896939290, 'ar@h.res.in', 'center area - Ist floor', 'user for 2 year program', NULL, NULL, NULL, '1'),
(10, 'Post_Doc', 'mr roy', 9090988876, 'mr@h.res.in', 'ground floor hall area - Ist floor', 'user for 3 year program', NULL, NULL, NULL, '1'),
(11, 'Phd', 'rj shingh', 7807807800, 'rj@hri.res.in', 'main hall @ IInd floor', 'V year complete program', NULL, NULL, NULL, '1'),
(12, 'Phd', 'ss sen', 7008007008, 'ss@hri.res.in', 'main hall @ IInd floor', 'V year complete program with math dept', NULL, NULL, NULL, '1'),
(13, 'Phd', 'jr sem', 7080708999, 'jr@hri.res.in', 'main hall @ IIIrd floor', 'V year complete program with Phy depta', NULL, NULL, NULL, '1'),
(14, 'Processor', 'mr sen', 1921231239, 'ss@m.com', 'h1', 'hri g', NULL, NULL, NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_record`
--
ALTER TABLE `asset_record`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `assign_asset`
--
ALTER TABLE `assign_asset`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `users_new`
--
ALTER TABLE `users_new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_record`
--
ALTER TABLE `users_record`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_record`
--
ALTER TABLE `asset_record`
  MODIFY `srno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `assign_asset`
--
ALTER TABLE `assign_asset`
  MODIFY `srno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_new`
--
ALTER TABLE `users_new`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_record`
--
ALTER TABLE `users_record`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
