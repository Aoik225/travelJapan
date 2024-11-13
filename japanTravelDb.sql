-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 12, 2024 at 06:44 AM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `japanTravelDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `eid` int NOT NULL,
  `cid` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `title` tinytext,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`eid`, `cid`, `name`, `email`, `title`, `message`, `image`) VALUES
(1, 1, 'Aoi', 'aoi@gmail.com', 'Test', 'This is a test.', 'no image'),
(2, 1, 'Aoi', 'aoi@gmail.com', 'Test', 'Did you get it?', 'no image'),
(3, 1, 'Aoi', 'aoi@gmail.com', 'Test', 'This is a test.', 'no image'),
(4, 1, 'Aoi', 'aoi@gmail.com', 'Test', 'This is a test.', 'no image'),
(5, 1, 'Aoi', 'aoi@gmail.com', 'Test', 'This is a test.', 'no image'),
(6, 1, 'Aoi', 'aoi@gmail.com', 'Test', 'This is a test.', 'no image'),
(7, 1, 'Aoi', 'aoi@gmail.com', 'Test', 'This is a test.', 'no image'),
(8, 1, 'Aoi', 'aoi@gmail.com', 'Test', 'This is a test.', 'no image'),
(9, 1, 'Aoi', 'aoi@gmail.com', 'Test', 'This is a test.', './uploads/9ef4a5b9e48a92206973ac98b933e1c0.png'),
(10, 1, 'Aoi', 'aoi@gmail.com', 'GIF', 'Cat', './uploads/e57658f5e6430d2998b771dc06f57cee.gif'),
(11, 7, 'Adam', 'adam@gmail.com', 'About posts', 'I really like the posts here!', './uploads/4e16e309c02ada78c9896f4ba75163df.gif'),
(12, 2, 'Aoi', 'aoi@gmail.com', 'Test', 'Test', './uploads/76a21b097fcc5b6dfb9d96848d9e6134.jpeg'),
(13, 2, 'Aoi', 'aoi@gmail.com', 'Cat', 'Cat', './uploads/2031a656eef6175c89e5cb6e8fb584dc.jpeg'),
(14, 2, 'Aoi', 'aoi@gmail.com', 'This is a cat', 'Test cat', './uploads/3068c0550f3c7310782b4be1c78f311a.jpeg'),
(15, NULL, 'Admin', 'admin@gmail.com', 'teat', 'teat', 'no image'),
(16, 1, 'Admin', 'admin@gmail.com', 'test', 'test12', './uploads/f3d0e0e58fc393f3c70ef5c5e3050e8a.jpeg'),
(17, 1, 'Admin', 'admin@gmail.com', 'cat', 'cute cat', './uploads/4a3259d3c0bfb2ff2ff6f6f2902dfe49.jpeg'),
(18, 1, 'Admin', 'admin@gmail.com', 'Hello!', 'This is a test!', './uploads/a0829273a0ae804dbee8ef2d49f5e198.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `pid` int NOT NULL,
  `uid` int DEFAULT NULL,
  `title` tinytext,
  `imageurl` text,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `websitetitle` tinytext,
  `websiteurl` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`pid`, `uid`, `title`, `imageurl`, `comment`, `websitetitle`, `websiteurl`) VALUES
(11, 1, 'Cherry Blossom', 'https://images.unsplash.com/photo-1524413840807-0c3cb6fa808d?q=80&w=3870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '🌸Sakura🌸', 'Unsplash', 'https://unsplash.com/'),
(14, 3, 'Mt Fuji', 'https://images.unsplash.com/photo-1605206809417-31eed948187f?q=80&w=3774&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '⛰️Beautiful Mountain⛰️', 'Unsplash', 'https://unsplash.com/'),
(15, 3, 'Farm Tomita', 'https://images.unsplash.com/photo-1603435580027-f30889418372?q=80&w=3871&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'So beautiful🌷', 'Unsplash', 'https://unsplash.com/'),
(17, 2, 'Mt. Fuji ⛰️', 'https://images.unsplash.com/photo-1528884089-4582fe06c516?q=80&w=3870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'I like Mt. Fuji 😎', 'Unsplash', 'https://unsplash.com/'),
(19, 2, 'Shrine', 'https://images.unsplash.com/photo-1478436127897-769e1b3f0f36?q=80&w=3870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '⛩️🦊⛩️✨', 'Unsplash', 'https://unsplash.com/');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `rid` int NOT NULL,
  `pid` int DEFAULT NULL,
  `reviewerid` int DEFAULT NULL,
  `rname` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `rcomment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`rid`, `pid`, `reviewerid`, `rname`, `rcomment`, `date`) VALUES
(32, 11, 1, 'Admin', 'This is a test.', '2024-11-01'),
(46, 15, 2, 'Aoi', 'This is a test.', '2024-11-05'),
(47, 11, 2, 'Aoi', 'This is a test.', '2024-11-05'),
(51, 14, 2, 'Aoi', 'This is a test.', '2024-11-05'),
(53, 15, 2, 'Aoi', 'This is a test.', '2024-11-05'),
(64, 14, 2, 'Aoi', 'This is a test.', '2024-11-05'),
(78, 11, 1, 'Aoi', 'This is a test.', '2024-11-06'),
(83, 19, 2, 'Aoi', 'This is cool, isn\'t it?', '2024-11-12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int NOT NULL,
  `uname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$qrXzF00Yh5JW37rIZ2lgg.UJ1oykW5UNH8W01MkLp7BuODfZBCkEa'),
(2, 'Aoi', 'aoi@gmail.com', '$2y$10$j.h0MSfg5CnZBaHjv/aHkOLVwhXYRTSlfyBrNlQXGBLDnoQEXSKSG'),
(3, 'JohnD', 'john@gmail.com', '$2y$10$tlEEF/aoTjcFyFBzi3sX4ONIcr7iPPhQZ7CSFepL1r7lvnAuxJspC'),
(7, 'AdamB', 'adam@gmail.com', '$2y$10$kknfOE/Hm/tvntpgbJwqPevKcCSf/wBzMfInXCNBK0KyKN8mi2uCe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `reviewerid` (`reviewerid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `eid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `rid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD CONSTRAINT `cid` FOREIGN KEY (`cid`) REFERENCES `user` (`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `uid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `pid` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reviewerid` FOREIGN KEY (`reviewerid`) REFERENCES `user` (`uid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
