-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 10:42 AM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `author` text NOT NULL,
  `description` text NOT NULL,
  `body` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `author`, `description`, `body`, `image`, `create_at`, `update_at`) VALUES
(3, 'Maximizing Web Development Efficiency with React.js', 'webprowale', 'Choosing the right technology stack is crucial for building robust and efficient web applications', 'In the ever-evolving landscape of web development, choosing the right technology stack is crucial for building robust and efficient web applications. React.js, maintained by Facebook and a community of developers, has emerged as a powerful front-end library that offers several key benefits for developers. Let&#039;s explore how React.js can maximize your web development efficiency.', '1712997133_855.png', '2024-04-13 08:32:13', NULL),
(4, 'Safeguarding Your Business: The Importance of Cybersecurity', 'spaceman', 'Let&#039;s explore why cybersecurity is essential for modern businesses and how you can safeguard your organization against cyber attacks.', 'In today&#039;s digital age, cybersecurity has become a critical concern for businesses of all sizes. With the increasing number of cyber threats and data breaches, protecting sensitive information and ensuring the integrity of business operations are paramount. Let&#039;s explore why cybersecurity is essential for modern businesses and how you can safeguard your organization against cyber attacks.', '1712997281_791.jpg', '2024-04-13 08:34:41', NULL),
(5, 'Mitigation of Financial Losses', 'webprowale', 'Cyber attacks can result in significant financial losses for businesses, including costs associated with data recovery', 'In today&#039;s competitive business landscape, cybersecurity can serve as a differentiator that sets businesses apart from their competitors. By demonstrating a strong commitment to cybersecurity, businesses can enhance their reputation, build customer trust, and attract new opportunities and partnerships.', '1712997423_602.jpg', '2024-04-13 08:37:03', NULL),
(6, 'Transforming Industries: The Impact of Artificial Intelligence', 'webprowale', 'Artificial intelligence (AI) has emerged as a transformative technology that is revolutionizing industries across the globe.', 'Artificial intelligence (AI) has emerged as a transformative technology that is revolutionizing industries across the globe. From healthcare to finance to manufacturing, AI is driving innovation, improving efficiency, and transforming business operations. Let&#039;s explore the impact of AI on various industries and how it is reshaping the future of work.', '1712997520_815.jpg', '2024-04-13 08:38:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
