-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2023 at 08:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getlisting`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` int(10) NOT NULL,
  `listing_id` int(10) NOT NULL,
  `listing_name` varchar(50) NOT NULL,
  `member_email` varchar(50) NOT NULL,
  `favourite` int(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id`, `listing_id`, `listing_name`, `member_email`, `favourite`, `user_email`, `user_name`) VALUES
(1, 1, 'Harsidhhi Fiance ', 'jaimish@gmail.com', 1, 'hkuchadiya24@gmail.com', 'Harsh Uchadiya'),
(2, 1, 'Harsidhhi Fiance ', 'jaimish@gmail.com', 1, 'jack@gmail.com', 'Jack'),
(3, 2, 'Pizaa', 'bob@gmail.com', 1, 'hkuchadiya24@gmail.com', 'Harsh Uchadiya');

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `id` int(10) NOT NULL,
  `listing_name` varchar(50) NOT NULL,
  `listing_location` varchar(200) NOT NULL,
  `listing_email` varchar(50) NOT NULL,
  `listing_member_name` varchar(100) NOT NULL,
  `listing_category` varchar(300) NOT NULL,
  `listing_city` varchar(100) NOT NULL,
  `listing_description` varchar(400) NOT NULL,
  `listing_contact` varchar(10) NOT NULL,
  `listing_telephone` varchar(50) NOT NULL,
  `listing_image1` varchar(100) NOT NULL,
  `listing_image2` varchar(200) DEFAULT NULL,
  `listing_image3` varchar(200) DEFAULT NULL,
  `listing_video_url` varchar(100) DEFAULT NULL,
  `listing_website_url` varchar(100) DEFAULT NULL,
  `listing_date` date NOT NULL,
  `listing_facebook_url` varchar(100) DEFAULT NULL,
  `listing_instagram_url` varchar(100) DEFAULT NULL,
  `listing_favourite` int(10) NOT NULL DEFAULT 0,
  `listing_latitude` varchar(500) NOT NULL,
  `listing_longitude` varchar(500) NOT NULL,
  `active_deactive` varchar(20) NOT NULL DEFAULT 'active',
  `avg_rating` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `listing_name`, `listing_location`, `listing_email`, `listing_member_name`, `listing_category`, `listing_city`, `listing_description`, `listing_contact`, `listing_telephone`, `listing_image1`, `listing_image2`, `listing_image3`, `listing_video_url`, `listing_website_url`, `listing_date`, `listing_facebook_url`, `listing_instagram_url`, `listing_favourite`, `listing_latitude`, `listing_longitude`, `active_deactive`, `avg_rating`) VALUES
(1, 'Harsidhhi Finance ', 'Delhi', 'Jaimish@gmail.com', 'Jaimish', 'Finance', 'Delhi', 'Well known finance advisor in Delhi', '9106790297', '9106790297', 'image1.jpeg', 'image2.png', 'image3.jpg', NULL, 'https://www.worldfinance.com/', '2023-04-02', 'https://www.facebook.com/', 'https://www.instagram.com/', 2, '28.6440836', '77.0932313', 'active', 5),
(2, 'Pizaa', 'Mumbai', 'bob@gmail.com', 'Bob Y', 'Restaurants', 'Mumbai', 'Serves Pizza', '9345124564', '923456789', '1.jpeg', '2.jpeg', '3.jpeg', NULL, '', '2023-05-09', '', '', 1, '19.0821775', '72.716372', 'active', 3);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(10) NOT NULL,
  `listing_id` int(10) NOT NULL,
  `listing_name` varchar(50) NOT NULL,
  `member_email` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_message` varchar(500) NOT NULL,
  `user_rating` varchar(20) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `listing_id`, `listing_name`, `member_email`, `user_name`, `user_email`, `user_message`, `user_rating`, `review_date`) VALUES
(1, 1, 'Harsidhhi Fiance ', 'jaimish@gmail.com', 'Harsh Uchadiya', 'hkuchadiya24@gmail.com', 'Good financial service.', '5', '2023-04-02'),
(2, 1, 'Harsidhhi Fiance ', 'jaimish@gmail.com', 'Sagar Koradiya', 'sagar@gmail.com', 'Good service.', '4', '2023-04-02'),
(3, 2, 'Pizaa', 'bob@gmail.com', 'Harsh Uchadiya', 'hkuchadiya24@gmail.com', 'Good service', '3', '2023-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `password`, `status`) VALUES
(1, 'Harsh Uchadiya', 'hkuchadiya24@gmail.com', '9106538331', '123456', 1),
(2, 'Jaimish Lakhani', 'jaimish@gmail.com', '7567921081', '123', 1),
(3, 'Sagar Koradiya', 'sagar@gmail.com', '9106790297', '123', 1),
(4, 'Jack', 'jack@gmail.com', '6354753406', '123', 1),
(5, 'Bob Y', 'bob@gmail.com', '9345124564', '12345678', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
