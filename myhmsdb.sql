-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 06:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myhmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`username`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointmenttb`
--

CREATE TABLE `appointmenttb` (
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `doctor` varchar(30) NOT NULL,
  `docFees` int(5) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `userStatus` int(5) NOT NULL,
  `doctorStatus` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointmenttb`
--

INSERT INTO `appointmenttb` (`pid`, `ID`, `fname`, `lname`, `gender`, `email`, `contact`, `doctor`, `docFees`, `appdate`, `apptime`, `userStatus`, `doctorStatus`) VALUES
(67, 68, 'jay', 'sekhaliya', 'Female', 'jay@gmail.com', '1234567890', 'Dinesh', 1000, '2025-03-28', '08:00:00', 1, 1),
(68, 69, 'hasti', 'ghelani', 'Female', 'hasti@gmail.com', '1234567890', 'Kartik', 2000, '2025-03-31', '14:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(10) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `contact`, `message`) VALUES
('khushi', 'khushi@gmail.com', '9874563210', 'nice!!!'),
('janvi', 'janvi@gmail.com', '7896542301', 'Wonderfull!!!'),
('harsh', 'harsh@gmail.com', '6925801473', 'GiVe better advice'),
('hiren', 'hiren@gmail.com', '8596471235', 'good'),
('utsav', 'utsav@gmail.com', '7456982013', 'great !!!'),
('shivani', 'shivani@gmail.com', '9856201454', 'I Like it'),
('jiya', 'jiya@gmail.com', '7894561230', 'your picture is not good');

-- --------------------------------------------------------

--
-- Table structure for table `doctb`
--

CREATE TABLE `doctb` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `spec` varchar(50) NOT NULL,
  `exper` varchar(50) NOT NULL,
  `joindate` date NOT NULL,
  `docFees` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctb`
--

INSERT INTO `doctb` (`id`, `username`, `password`, `email`, `spec`, `exper`, `joindate`, `docFees`) VALUES
(1, 'abhi', 'abhi123', 'abhi@gmail.com', 'Neurologist', '2 years', '2024-10-10', 900),
(2, 'Aditya', 'aditya123', 'aditya@gmail.com', 'Neurologist', '6 years', '2024-08-09', 1500),
(3, 'Amit', 'amit123', 'amit@gmail.com', 'Cardiologist', '2 years', '2025-02-05', 700),
(4, 'arun', 'arun123', 'arun@gmail.com', 'Cardiologist', '3 years', '2024-11-14', 600),
(5, 'ashok', 'ashok123', 'ashok@gmail.com', 'General', '2 years', '2025-03-15', 500),
(6, 'Dinesh', 'dinesh123', 'dinesh@gmail.com', 'General', '5 years', '2022-01-01', 1000),
(7, 'Ganesh', 'ganesh123', 'ganesh@gmail.com', 'Pediatrician', '1 years', '2025-02-01', 550),
(8, 'Kartik', 'kartik123', 'kartik@gmail.com', 'Pediatrician', '15 years', '2020-09-02', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `srno` int(10) UNSIGNED NOT NULL,
  `drugname` varchar(200) NOT NULL,
  `quantity` int(200) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patreg`
--

CREATE TABLE `patreg` (
  `pid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cpassword` varchar(30) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patreg`
--

INSERT INTO `patreg` (`pid`, `fname`, `lname`, `gender`, `age`, `email`, `contact`, `password`, `cpassword`, `city`) VALUES
(67, 'jay', 'sekhaliya', 'Female', 20, 'jay@gmail.com', '1234567890', '123456', '123456', 'surat'),
(68, 'hasti', 'ghelani', 'Female', 21, 'hasti@gmail.com', '1234567890', '123456', '123456', 'surat');

-- --------------------------------------------------------

--
-- Table structure for table `prestb`
--

CREATE TABLE `prestb` (
  `id` int(11) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `drugname` varchar(250) NOT NULL,
  `route` varchar(250) NOT NULL,
  `frequencytime` text NOT NULL,
  `quantity` int(200) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prestb`
--

INSERT INTO `prestb` (`id`, `doctor`, `pid`, `did`, `fname`, `lname`, `appdate`, `apptime`, `drugname`, `route`, `frequencytime`, `quantity`, `price`) VALUES
(70, 'Dinesh', 67, 68, 'jay', 'sekhaliya', '2025-03-28', '08:00:00', 'pantoprazole', 'oral', '1-1-1-1', 15, 90),
(72, 'Dinesh', 67, 68, 'jay', 'sekhaliya', '2025-03-28', '08:00:00', 'omeprazole', 'ointment', '1-1-1-1', 15, 105),
(73, 'Dinesh', 67, 68, 'jay', 'sekhaliya', '2025-03-28', '08:00:00', 'omeprazole', 'ointment', '1-1-1-1', 156, 1092),
(74, 'Dinesh', 67, 68, 'jay', 'sekhaliya', '2025-03-28', '08:00:00', 'vmlodipine', 'oral', '1-1-1-1', 1552, 3104),
(75, 'Kartik', 68, 69, 'hasti', 'ghelani', '2025-03-31', '14:00:00', 'oxycodone', 'oral', '1-1-1-1', 52, 624);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctb`
--
ALTER TABLE `doctb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`username`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `patreg`
--
ALTER TABLE `patreg`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `prestb`
--
ALTER TABLE `prestb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `doctb`
--
ALTER TABLE `doctb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `srno` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patreg`
--
ALTER TABLE `patreg`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `prestb`
--
ALTER TABLE `prestb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
