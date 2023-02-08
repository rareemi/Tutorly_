-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2023 at 11:06 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `381`
--

-- --------------------------------------------------------

--
-- Table structure for table `kids`
--

CREATE TABLE `kids` (
  `ID` int(11) NOT NULL,
  `kidName` varchar(200) NOT NULL,
  `kidAge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kids`
--

INSERT INTO `kids` (`ID`, `kidName`, `kidAge`) VALUES
(1, 'bassam', 14),
(2, 'maha', 10),
(3, 'rama', 8),
(4, 'Yazan', 6);

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(30) NOT NULL,
  `price` int(110) NOT NULL,
  `tutorName` varchar(200) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `offerstatus` varchar(2000) NOT NULL,
  `tutorEmail` varchar(100) NOT NULL,
  `startDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `price`, `tutorName`, `RequestID`, `offerstatus`, `tutorEmail`, `startDate`, `startTime`, `endTime`) VALUES
(1, 100, 'hifza', 1, 'accepted', 'Hifza2@gmail.com', '2023-02-07', '00:00:05', '00:00:00'),
(2, 200, 'RANA', 4, 'pending', 'bro_200@gmail.com', '2023-02-06', '12:30:00', '13:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `email` varchar(200) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `city` varchar(100) NOT NULL,
  `Location` varchar(200) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`email`, `password`, `firstName`, `lastName`, `city`, `Location`, `img`) VALUES
('gh__201@gmail.com', '123456', 'ghada', 'alotaibi', 'riyadh', 'https://goo.gl/maps/VHanMnQ54Zj8Mvbo9', 'TutorPic1.png'),
('N__2067@gmail.com', 'NN09876', 'nada', 'ahmad', 'Jeddah', 'https://goo.gl/maps/hkSLxuPmskSzFNGH8', ''),
('ree-901@gmail.com', 'R234567', 'razan', 'alenezi', 'riyadh', 'https://goo.gl/maps/nDmLQZBuLVParwkd8', '');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `TypeOfClass` varchar(100) NOT NULL,
  `ID` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `parentEmail` varchar(255) DEFAULT NULL,
  `startDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `comments` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`TypeOfClass`, `ID`, `status`, `parentEmail`, `startDate`, `startTime`, `endTime`, `comments`, `created_at`) VALUES
('Biology', 1, 'accepted', 'gh__201@gmail.com', '2023-02-06', '00:00:00', '00:00:00', '', '2023-02-07 13:02:00'),
('Math', 2, 'served', 'N__2067@gmail.com', '2023-02-10', '12:30:00', '14:30:00', '', '2023-02-07 19:11:28'),
('English language', 3, 'served', 'ree-901@gmail.com', '2023-02-22', '10:00:00', '12:00:00', '', '2023-02-07 21:25:04'),
('Math', 4, 'unserved', 'ree-901@gmail.com', '2023-02-06', '09:00:00', '10:00:00', '', '2023-02-08 00:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Rate` int(11) NOT NULL,
  `feedBack` text NOT NULL,
  `Date` date NOT NULL,
  `time` varchar(5) NOT NULL,
  `parentEmail` varchar(200) NOT NULL,
  `tutorEmail` varchar(100) NOT NULL,
  `offerID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `ID` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `city` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`email`, `password`, `firstName`, `lastName`, `gender`, `ID`, `age`, `city`, `phone`, `bio`, `img`) VALUES
('bro_200@gmail.com', 'BB23456', 'RANA', ' B.', 'female', 467293840, 36, 'Jeddah', '0503999204', 'I have more than 4 years of experience teaching to students from grade 1 to 12. I love science and math and  I make them fun to learn. I am very patient and I would go step by step with you, make sure you understand everything and you are not bored.', ''),
('Hifza2@gmail.com', 'H1234567', 'Hifza', 'A', 'female', 123456789, 35, 'riyadh', '0555555555', 'Hey there, I\'m Dr. Hifza and I am an experienced Biology and Chemistry tutor. I\'m also proficient in teaching medical subjects (Physiology, Biochemistry Anatomy & Pathology) I can teach any age group from 6 year olds to Adults.\nBiology is a subject I really enjoy teaching and I consider myself', 'TutorPic1.png'),
('rr_288@gmail.com', 'R12345', 'Reem', 'mohammed', 'female', 234567894, 34, 'riyadh', '0502000000', 'Hi, my name is reem and I’m a certified tutor with a degree in math education. I’ve been tutoring math for the past five years and specialize in all topics of mathematics including calculus, geometry, algebra, and trigonometry. I’m passionate about teaching and helping my students achieve their full potential by providing them with personalized instruction and guidance. I enjoy using technology to make learning more interactive and enjoyable.', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kids`
--
ALTER TABLE `kids`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_ibfk_1` (`RequestID`),
  ADD KEY `offer_ibfk_2` (`tutorEmail`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `request_ibfk_1` (`parentEmail`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `review_ibfk_1` (`parentEmail`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kids`
--
ALTER TABLE `kids`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kids`
--
ALTER TABLE `kids`
  ADD CONSTRAINT `kids_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `requests` (`ID`);

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`RequestID`) REFERENCES `requests` (`ID`),
  ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`tutorEmail`) REFERENCES `tutor` (`email`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`parentEmail`) REFERENCES `parent` (`email`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`parentEmail`) REFERENCES `parent` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;