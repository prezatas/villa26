-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 07:38 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thevilla_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `b_id` int(11) NOT NULL,
  `b_checkin` date NOT NULL,
  `b_checkout` date NOT NULL,
  `b_country` varchar(20) NOT NULL,
  `b_fname` varchar(20) NOT NULL,
  `b_lname` varchar(20) NOT NULL,
  `b_nog` varchar(10) NOT NULL,
  `b_nor` varchar(10) NOT NULL,
  `b_email` varchar(100) NOT NULL,
  `b_tel` varchar(15) NOT NULL,
  `b_comment` varchar(500) NOT NULL,
  `b_status` varchar(20) NOT NULL,
  `b_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`b_id`, `b_checkin`, `b_checkout`, `b_country`, `b_fname`, `b_lname`, `b_nog`, `b_nor`, `b_email`, `b_tel`, `b_comment`, `b_status`, `b_date`) VALUES
(1, '2018-10-23', '2018-10-31', 'Sri Lanka', 'Dushan', 'De Seram', '6', '4', 'deseramdushan0@gmail.com', '+9433263456', 'Can I arrange this', 'active', '2018-10-21 11:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `e_id` int(11) NOT NULL,
  `e_image` varchar(200) NOT NULL,
  `e_title` varchar(20) NOT NULL,
  `e_description` varchar(500) NOT NULL,
  `e_status` varchar(10) NOT NULL,
  `e_view_status` varchar(10) NOT NULL,
  `e_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`e_id`, `e_image`, `e_title`, `e_description`, `e_status`, `e_view_status`, `e_date`) VALUES
(1, '1_083bb0f.jpg', 'Website Launch', 'We have lift off. Our new website launch. You can View our facilities, rates and much more things through it. Visit on www.thevilla26.com', 'active', 'unread', '2018-06-18 04:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `g_id` int(11) NOT NULL,
  `g_image` varchar(200) NOT NULL,
  `g_type` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`g_id`, `g_image`, `g_type`) VALUES
(20, '1_0367dc3.jpg', 'interior'),
(19, '0_ed705cb.JPG', 'interior'),
(18, '2_07978b1.jpg', 'interior'),
(17, '0_06c00b9.jpg', 'interior'),
(14, '2_c4c61a2.jpg', 'fandb'),
(13, '1_19ad13e.png', 'fandb'),
(12, '0_1a3439d.png', 'fandb'),
(16, '3_9bf791b.jpg', 'interior'),
(21, '0_c63bf17.jpg', 'interior');

-- --------------------------------------------------------

--
-- Table structure for table `guestbook`
--

CREATE TABLE `guestbook` (
  `g_id` int(11) NOT NULL,
  `g_name` varchar(50) NOT NULL,
  `g_title` varchar(20) NOT NULL,
  `g_email` varchar(100) NOT NULL,
  `g_comment` varchar(500) NOT NULL,
  `g_status` varchar(10) NOT NULL,
  `g_view_status` varchar(10) NOT NULL,
  `g_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guestbook`
--

INSERT INTO `guestbook` (`g_id`, `g_name`, `g_title`, `g_email`, `g_comment`, `g_status`, `g_view_status`, `g_date`) VALUES
(1, 'Dushan De Seram', 'Best Villa for Visit', 'deseramdushan@gmail.com', 'We loved our stay, everything was amazing. Great breakfast, lovely environment and the villa is very relaxing. The staff very friendly and helpful, we really enjoy to stay in the villa 26. Thank you very much, let me come back again!', 'active', 'unread', '2018-10-21 05:54:55'),
(2, 'AlfredRab', 'inquiry', 'rogers.bill@inbox.r', 'Good afternoon. \r\nIt\'s hard for me to navigate the site, could you help me find it? \r\nHere, little place, I have everything I need written on the plate here is the link. \r\nI really look forward to hearing from you. Bill Rogers \r\n \r\nhttps://bit.ly/2MNbcjU', 'deactive', 'unread', '2018-10-21 05:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `r_id` int(11) NOT NULL,
  `r_image` varchar(200) NOT NULL,
  `r_title` varchar(20) NOT NULL,
  `r_bed` varchar(10) NOT NULL,
  `r_size` varchar(10) NOT NULL,
  `r_price` varchar(20) NOT NULL,
  `r_description` varchar(500) NOT NULL,
  `r_status` varchar(10) NOT NULL,
  `r_view_status` varchar(10) NOT NULL,
  `r_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`r_id`, `r_image`, `r_title`, `r_bed`, `r_size`, `r_price`, `r_description`, `r_status`, `r_view_status`, `r_date`) VALUES
(7, '7_f48bdb8.jpg', 'Room 1', '2', '123', '$300', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'active', 'unread', '2018-06-09 06:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(20) NOT NULL,
  `user_lname` varchar(20) NOT NULL,
  `user_tel` varchar(20) NOT NULL,
  `user_nic` varchar(10) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_password` char(50) NOT NULL,
  `user_status` varchar(20) NOT NULL,
  `user_ur_id` int(11) NOT NULL,
  `user_view_status` varchar(20) NOT NULL,
  `user_create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_tel`, `user_nic`, `user_email`, `user_password`, `user_status`, `user_ur_id`, `user_view_status`, `user_create_at`) VALUES
(1, 'Dushan', 'De Seram', '+94772141632', '922850224v', 'deseramdushan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'active', 1, 'unread', '2021-06-18 03:49:36'),
(2, 'Gridlite', 'Solutions', '+94772141632', '922850224v', 'gridlitesolutions@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'active', 1, 'unread', '2018-06-08 05:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `ur_id` int(11) NOT NULL,
  `ur_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`ur_id`, `ur_title`) VALUES
(1, 'Admin'),
(2, 'Super User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`ur_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `ur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
